<?php

namespace App\Repository;

use App\Interface\MainSalaryEmployeeAddtioninterface;
use App\Models\Additional_salary;
use App\Models\admin_panel_setting;
use App\Models\Employment_detail;
use App\Models\Finance_calender;
use App\Models\Finance_cln_periods;
use App\Models\MainSalaryEmployeeAbsence;
use App\Models\MainSalaryEmployeeAddtion;
use App\Models\salary_sheet;

class MainSalaryEmployeeAddtionRepositroy implements MainSalaryEmployeeAddtioninterface
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
        return view('Dashboard.MainSalaryEmployeeAddition.index', compact('get_months'));
    }

    public function show_months($id)
    {
        $com_code = auth()->user()->com_code;
        $get_additions=Additional_salary::where('active', 1)->get();
        $finance_per = Finance_cln_periods::where('com_code', $com_code)->where('id', $id)->first();
        $data = MainSalaryEmployeeAddtion::all();
        $get_emps = Employment_detail::with('employee')->where('Functiona_status', 1)->get();
        return view('Dashboard.MainSalaryEmployeeAddition.show', compact('data', 'get_emps', 'finance_per','get_additions'));
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
    }
    public function check_exit($request)
    {
        $com_code = auth()->user()->com_code;

        $get_count = MainSalaryEmployeeAddtion::where([
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
                'additional_types_id'   => 'required',
                'emp_day_price'   => 'required|numeric',
                'total'      => 'required|numeric',
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


            $Absence = MainSalaryEmployeeAddtion::create([
                'employee_id'           => $validated['employee_id'],
                'additional_types_id'           => $validated['additional_types_id'],
                'finance_cln_period_id' => $request->finance_cln_period_id,
                'main_salary_employee_id'       => $salary_month->id,
                'emp_day_price'        => $validated['emp_day_price'],
                'total'           => $validated['total'],
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

    }
    public function destroy($request)
    {
        try {
            $delete_Shift=MainSalaryEmployeeAddtion::findorfail($request->id);
            $delete_Shift->delete();
            return redirect()->back()->with('success', 'MainSalaryEmployeeAddtion Deleted Successfully');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error', 'MainSalaryEmployeeAddtion Deleted failed',$ex);
        }
    }

    public function update($request)
    {
       if($request->ajax()){

           $request->validate([
               'id' => 'required|exists:main_salary_employee_addtions,id',
               'notes' => 'string',
               'additional_types_id' => 'required|integer|exists:additional_salaries,id',
               'total' => 'required|numeric|min:0',
           ]);

           try {
               $Absence = MainSalaryEmployeeAddtion::findOrFail($request->id);

               // تعديل البيانات المطلوبة فقط
               $Absence->notes = $request->notes;
               $Absence->additional_types_id   = $request->additional_types_id;
               $Absence->total     = $request->total;
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
    }
    public function printAbsences($periodId)
    {
        $systemData = Admin_panel_setting::select('com_code','image','company_name','address','phones')->first();

        // بيانات الجزاءات الخاصة بالفترة المالية
        $data = MainSalaryEmployeeAddtion::with('Employee')
            ->where('finance_cln_period_id', $periodId)
            ->orderBy('id','DESC')
            ->get();

        // جلب الفترة المالية لاستخراج الشهر/السنة
        $period = Finance_cln_periods::with('Month')->find($periodId);
        $month  = optional($period->Month)->name_ar;     // اسم الشهر العربي
        $year   = $period->FINANCE_YR ?? null;         // السنة المالية

        // إجماليات

        $total_value = $data->sum('total');

        return view('Dashboard.MainSalaryEmployeeAddition.print_v1', compact(
            'systemData','data','month','year','total_value'
        ));
    }

}
