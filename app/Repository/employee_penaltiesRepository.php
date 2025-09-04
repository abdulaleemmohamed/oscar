<?php

namespace App\Repository;

use App\Interface\employee_penaltiesRepositoryInterface;
use App\Models\admin_panel_setting;
use App\Models\Employee;
use App\Models\employee_penaltie;
use App\Models\Employment_detail;
use App\Models\Finance_calender;
use App\Models\Finance_cln_periods;
use App\Models\salary_sheet;

class employee_penaltiesRepository implements employee_penaltiesRepositoryInterface
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $get_months = Finance_cln_periods::where('com_code', $com_code)
            ->orderBy('FINANCE_YR', 'DESC')
            ->get();

        foreach ($get_months as $info) {

            $info->currentYear = Finance_calender::where('com_code', $com_code)
                ->where('FINANCE_YR', $info->FINANCE_YR)
                ->select('is_open')
                ->first();


            $info->counterOpenMonth = Finance_cln_periods::where('com_code', $com_code)
                ->where('is_open', 1)
                ->count();

            $info->counterPreviousMonthWaitingOpen = Finance_cln_periods::where("com_code", $com_code)
                ->where("FINANCE_YR", $info->FINANCE_YR)
                ->where("MONTH_ID", "<", $info->MONTH_ID)
                ->where("is_open", 0)
                ->count();


        }
        return view('Dashboard.employee_penaltie.index', compact('get_months'));
    }

    public function show_months($id)
    {
        $com_code = auth()->user()->com_code;
        $finance_per = Finance_cln_periods::where('com_code', $com_code)->where('id', $id)->first();
        $data = employee_penaltie::all();
        $get_emps = Employment_detail::with('employee')->where('Functiona_status', 1)->get();
        return view('Dashboard.employee_penaltie.show_EmployeePenaltie', compact('data', 'get_emps', 'finance_per'));
    }

    public function getSalary($request)
    {
        $employee = Employment_detail::find($request->id);
        if ($employee) {
            return response()->json([
                'employee_sal' => $employee->employee_sal,
                'daily_rate' => $employee->daily_rate,

            ]);
        }

        return response()->json([
            'salary' => '',
            'daily_rate' => '',

        ]);
    }

    public function check_exit($request)
    {
        $com_code = auth()->user()->com_code;

        $get_count = employee_penaltie::where([
            ['com_code', '=', $com_code],
            ['finance_cln_period_id', '=', $request->finance_cln_period_id],
            ['employee_id', '=', $request->employee_id],
        ])->count();

        if ($get_count > 0) {
            return json_encode(['status' => 'found']);
        } else {
            return json_encode(['status' => 'not_found']);
        }
    }

    public function store($request)
    {
        if ($request->ajax()) {

            $validated = $request->validate([
                'employees_code'   => 'required',
                'employee_id'   => 'required',
                'emp_day_salary'   => 'required|numeric',
                'days_deducted'    => 'required|integer|min:1',
                'total_value'      => 'required|numeric',
                'Sanctions_types'  => 'required|integer',
                'finance_cln_period_id' => 'required|integer'
            ]);

            $com_code = auth()->user()->com_code;


            $salary_month = salary_sheet::where('id', $request->finance_cln_period_id)->first();

            if (!$salary_month) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'لا توجد ورقة مرتب مطابقة لهذا الموظف أو الفترة'
                ], 400);
            }


            $penalty = employee_penaltie::create([
                'employee_id'           => $validated['employee_id'],
                'finance_cln_period_id' => $request->finance_cln_period_id,
                'month_salary_id'       => $salary_month->id,
                'emp_day_salary'        => $validated['emp_day_salary'],
                'days_deducted'         => $validated['days_deducted'],
                'total_value'           => $validated['total_value'],
                'Sanctions_types'       => $validated['Sanctions_types'],
                'com_code'              => $com_code,
                'employees_code'        => $validated['employees_code'],
                'added_by'              =>auth()->user()->id

            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'تم حفظ الجزاء بنجاح',
                'data'    => $penalty
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'الطلب غير صالح'
        ], 400);
    }
    public function destroy( $request)
    {
        try {
            $delete_Shift=employee_penaltie::findorfail($request->id);
            $delete_Shift->delete();
            return redirect()->back()->with('success', 'employee_penaltie Deleted Successfully');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error', 'employee_penaltie Deleted failed',$ex);
        }
    }
    public function update( $request)
    {
        $request->validate([
            'id' => 'required|exists:employee_penalties,id',
            'Sanctions_types' => 'required|in:1,2,3,4',
            'days_deducted' => 'required|numeric|min:1',
            'total_value' => 'required|numeric|min:0',
        ]);

        try {
            $penalty = employee_penaltie::findOrFail($request->id);

            // تعديل البيانات المطلوبة فقط
            $penalty->Sanctions_types = $request->Sanctions_types;
            $penalty->days_deducted   = $request->days_deducted;
            $penalty->total_value     = $request->total_value;
            $penalty->save();

            return response()->json([
                'status' => true,
                'message' => 'تم تعديل الجزاء بنجاح',
                'data' => $penalty
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'حصل خطأ: ' . $ex->getMessage()
            ], 500);
        }
    }
    // مثال داخل دالة الطباعة
    public function printPenalties($periodId)
    {
        $systemData = Admin_panel_setting::select('com_code','image','company_name','address','phones')->first();

        // بيانات الجزاءات الخاصة بالفترة المالية
        $data = Employee_penaltie::with('Employee')
            ->where('finance_cln_period_id', $periodId)
            ->orderBy('id','DESC')
            ->get();

        // جلب الفترة المالية لاستخراج الشهر/السنة
        $period = Finance_cln_periods::with('Month')->find($periodId);
        $month  = optional($period->Month)->name_ar;     // اسم الشهر العربي
        $year   = $period->FINANCE_YR ?? null;         // السنة المالية

        // إجماليات
        $total_days  = $data->sum('days_deducted');
        $total_value = $data->sum('total_value');

        return view('Dashboard.employee_penaltie.print_v1', compact(
            'systemData','data','month','year','total_days','total_value'
        ));
    }



}
