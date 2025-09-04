<?php

namespace App\Repository;

use App\Interface\MainSalaryEmployeeAbsenceinterface;
use App\Models\admin_panel_setting;
use App\Models\Employment_detail;
use App\Models\Finance_calender;
use App\Models\Finance_cln_periods;
use App\Models\MainSalaryEmployeeAbsence;
use App\Models\salary_sheet;

class MainSalaryEmployeeAbsenceRepositroy implements MainSalaryEmployeeAbsenceinterface
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
        return view('Dashboard.MainSalaryEmployeeAbsence.index', compact('get_months'));
    }

    public function show_months($id)
    {
        $com_code = auth()->user()->com_code;
        $finance_per = Finance_cln_periods::where('com_code', $com_code)->where('id', $id)->first();
        $data = MainSalaryEmployeeAbsence::all();
        $get_emps = Employment_detail::with('employee')->where('Functiona_status', 1)->get();
        return view('Dashboard.MainSalaryEmployeeAbsence.show', compact('data', 'get_emps', 'finance_per'));
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

        $get_count = MainSalaryEmployeeAbsence::where([
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
                'notes'            => 'string',
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


            $Absence = MainSalaryEmployeeAbsence::create([
                'employee_id'           => $validated['employee_id'],
                'finance_cln_period_id' => $request->finance_cln_period_id,
                'month_salary_id'       => $salary_month->id,
                'emp_day_salary'        => $validated['emp_day_salary'],
                'days_deducted'         => $validated['days_deducted'],
                'total_value'           => $validated['total_value'],
                'notes'                  => $validated['notes'],
                'com_code'              => $com_code,
                'employees_code'        => $validated['employees_code'],
                'added_by'              =>auth()->user()->id

            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'تم حفظ الجزاء بنجاح',
                'data'    => $Absence
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'الطلب غير صالح'
        ],400);

    }
    public function destroy( $request)
    {
        try {
            $delete_Shift=MainSalaryEmployeeAbsence::findorfail($request->id);
            $delete_Shift->delete();
            return redirect()->back()->with('success', 'MainSalaryEmployeeAbsence Deleted Successfully');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error', 'MainSalaryEmployeeAbsence Deleted failed',$ex);
        }
    }
    public function update( $request)
    {
        $request->validate([
            'id' => 'required|exists:main_salary_employee_absences,id',
            'notes' => 'string',
            'days_deducted' => 'required|numeric|min:1',
            'total_value' => 'required|numeric|min:0',
        ]);

        try {
            $Absence = MainSalaryEmployeeAbsence::findOrFail($request->id);

            // تعديل البيانات المطلوبة فقط
           $Absence->notes = $request->notes;
           $Absence->days_deducted   = $request->days_deducted;
           $Absence->total_value     = $request->total_value;
           $Absence->save();

            return response()->json([
                'status' => true,
                'message' => 'تم تعديل الجزاء بنجاح',
                'data' => $Absence
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'حصل خطأ: ' . $ex->getMessage()
            ], 500);
        }
    }
    public function printAbsences($periodId)
    {
        $systemData = Admin_panel_setting::select('com_code','image','company_name','address','phones')->first();

        // بيانات الجزاءات الخاصة بالفترة المالية
        $data = MainSalaryEmployeeAbsence::with('Employee')
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

        return view('Dashboard.MainSalaryEmployeeAbsence.print_v1', compact(
            'systemData','data','month','year','total_days','total_value'
        ));
    }

}
