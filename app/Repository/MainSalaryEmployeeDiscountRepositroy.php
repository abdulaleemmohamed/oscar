<?php

namespace App\Repository;

use App\Interface\MainSalaryEmployeeDiscountInterface;
use App\Models\admin_panel_setting;
use App\Models\Employment_detail;
use App\Models\Finance_calender;
use App\Models\Finance_cln_periods;
use App\Models\MainSalaryEmployeeDiscount;
use App\Models\salary_deduction;
use App\Models\salary_sheet;

class MainSalaryEmployeeDiscountRepositroy implements MainSalaryEmployeeDiscountInterface
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
    return view('Dashboard.MainSalaryEmployeeDiscount.index', compact('get_months'));
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

    $get_count = MainSalaryEmployeeDiscount::where([
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
            'deduction_types_id'   => 'required',
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


        $Absence = MainSalaryEmployeeDiscount::create([
            'employee_id'           => $validated['employee_id'],
            'deduction_types_id'           => $validated['deduction_types_id'],
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
public function update($request)
{
    if($request->ajax()){
        $request->validate([
            'id' => 'required|exists:main_salary_employee_discounts,id',
            'notes' => 'string',
            'deduction_types_id' => 'required|integer|exists:salary_deductions,id',
            'total' => 'required|numeric|min:0',
        ]);

        try {
            $Absence = MainSalaryEmployeeDiscount::findOrFail($request->id);

            // تعديل البيانات المطلوبة فقط
            $Absence->notes = $request->notes;
            $Absence->deduction_types_id   = $request->deduction_types_id;
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
public function destroy($request)
{
    try {
        $delete_Shift=MainSalaryEmployeeDiscount::findorfail($request->id);
        $delete_Shift->delete();
        return redirect()->back()->with('success', 'MainSalaryEmployeeDiscount Deleted Successfully');
    }
    catch (\Exception $ex) {
        return redirect()->back()->with('error', 'MainSalaryEmployeeDiscount Deleted failed',$ex);
    }
}
public function print($periodId)
{
    $systemData = Admin_panel_setting::select('com_code','image','company_name','address','phones')->first();

    // بيانات الجزاءات الخاصة بالفترة المالية
    $data = MainSalaryEmployeeDiscount::with('Employee')
        ->where('finance_cln_period_id', $periodId)
        ->orderBy('id','DESC')
        ->get();

    // جلب الفترة المالية لاستخراج الشهر/السنة
    $period = Finance_cln_periods::with('Month')->find($periodId);
    $month  = optional($period->Month)->name_ar;     // اسم الشهر العربي
    $year   = $period->FINANCE_YR ?? null;         // السنة المالية

    // إجماليات

    $total_value = $data->sum('total');

    return view('Dashboard.MainSalaryEmployeeDiscount.print_v1', compact(
        'systemData','data','month','year','total_value'
    ));
}
public function show_months($id)
{
    $com_code = auth()->user()->com_code;
    $get_deductions=salary_deduction::where('active', 1)->get();
    $finance_per = Finance_cln_periods::where('com_code', $com_code)->where('id', $id)->first();
    $data = MainSalaryEmployeeDiscount::all();
    $get_emps = Employment_detail::with('employee')->where('Functiona_status', 1)->get();
    return view('Dashboard.MainSalaryEmployeeDiscount.show', compact('data', 'get_emps', 'finance_per','get_deductions'));
}
}
