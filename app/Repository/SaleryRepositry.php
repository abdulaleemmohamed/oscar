<?php

namespace App\Repository;

use App\Interface\SaleryRepositoryInterface;
use App\Models\Employee;
use App\Models\Employment_detail;
use App\Models\Finance_calender;
use App\Models\Finance_cln_periods;
use App\Models\salary_sheet;
use DB;
use Illuminate\Http\Request;

class SaleryRepositry implements SaleryRepositoryInterface
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
    return view('Dashboard.Main_salery.index',compact('get_months'));
}
public function open_month(Request $request  ,$id){
DB::beginTransaction();
    $com_code = auth()->user()->com_code;

// اجلب الشهر حسب ID
    $get_month = Finance_cln_periods::where('com_code', $com_code)->where('id', $id)->first();

// تحقق إذا لم يتم العثور عليه
    if (!$get_month) {
        return redirect()->route('Main_salery.index')->with(['error' => 'غير قادر على الوصول إلى البيانات المطلوبة']);
    }

// تحقق من حالة الشهر
    if ($get_month->is_open == 1) {
        return redirect()->route('Main_salery.index')->with(['error' => 'الشهر الحالي مفتوح']);
    }

    if ($get_month->is_open == 2) {
        return redirect()->route('Main_salery.index')->with(['error' => 'الشهر الحالي مؤرشف']);
    }

// تحقق من وجود سنة مالية مفتوحة لهذا الشهر
    $current_year = Finance_calender::where('com_code', $com_code)
        ->where('FINANCE_YR', $get_month->FINANCE_YR)
        ->where('is_open', 1)
        ->first();

    if (!$current_year) {
        return redirect()->route('Main_salery.index')->with(['error' => 'السنة المالية التابعة لهذا الشهر غير مفتوحة']);
    }

// تحقق من عدم وجود شهر مفتوح حالياً
    $count_months = Finance_cln_periods::where('com_code', $com_code)
        ->where('is_open', 1)
        ->count();

    if ($count_months > 0) {
        return redirect()->route('Main_salery.index')->with(['error' => 'لا يمكن فتح الشهر لوجود شهر مفتوح حالياً']);
    }

// تحقق من عدم وجود سنة مالية سابقة مفتوحة
    $la_sanawat_qabla_maftoha = Finance_calender::where('com_code', $com_code)
        ->where('is_open', 1) // لاحظ هنا كانت غلط عندك: كنت تبحث عن المغلقة
        ->where('FINANCE_YR', '<', $get_month->FINANCE_YR)
        ->exists();

    if ($la_sanawat_qabla_maftoha) {
        return redirect()->route('Main_salery.index')->with(['error' => 'لا يمكن فتح الشهر لوجود سنة مالية سابقة لا تزال مفتوحة']);
    }

// الآن نفتح الشهر
    $get_month->is_open = 1;
    $get_month->start_date_for_pasma = $request->start_date_for_pasma;
    $get_month->end_date_for_pasma = $request->end_date_for_pasma;
    $get_month->updated_by = auth()->user()->id;
    $get_month->save();

   $get_emps=Employment_detail::with('employee')->where('Functiona_status',1)->get();

    if (!empty($get_emps)) {
        foreach ($get_emps as $emp) {
             $in_salary= new salary_sheet();
             $in_salary->month_id=$id;
             $in_salary->finance_year=$current_year->FINANCE_YR;
             $in_salary->employee_id=$emp->id;
             $in_salary->basic_salary=$emp->employee_sal;
            $in_salary->employees_code=$emp->employee->employees_code ;
            $in_salary->daily_rate=$emp->daily_rate ;
            $in_salary->total_days=25;
            $in_salary->total_salary=$emp->daily_rate*25;
            $in_salary->employee_name=$emp->employee->employee_name;
            $in_salary->com_code=$com_code;
            $in_salary->added_by=auth()->user()->id;
            $in_salary->level='employee';
            $in_salary->save();

}
DB::commit();


        }

     return redirect()->route('Main_Salery.index')->with(['success' => 'تم فتح الشهر المالي بنجاح']);



}

}
