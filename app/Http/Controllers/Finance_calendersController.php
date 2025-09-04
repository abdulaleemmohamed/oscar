<?php

namespace App\Http\Controllers;

use App\Http\Requests\Finance_calendersUpdate;
use App\Http\Requests\fiscal_yearsRequest;
use App\Models\Finance_calender;
use App\Models\Finance_cln_periods;
use App\Models\month;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Finance_calendersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $finance_year_count=Finance_calender::where('is_open',1)->count();
        $data=Finance_calender::all();
       return view('Dashboard.fiscal_years.index',compact('data','finance_year_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
  return view('Dashboard.fiscal_years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(fiscal_yearsRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataToInsert['FINANCE_YR'] = $request->FINANCE_YR;
            $dataToInsert['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
            $dataToInsert['start_date'] = $request->start_date;
            $dataToInsert['end_date'] = $request->end_date;
            $dataToInsert['added_by'] = auth()->user()->id;
            $dataToInsert['com_code'] = auth()->user()->com_code;
            $falg = Finance_calender::insert($dataToInsert);
            if ($falg) {
                $dataParent = Finance_calender::select("id")->where($dataToInsert)->first();
                if (!$dataParent) {
                    throw new \Exception("Finance_calender not found.");
                }
                $dataMonth['finance_calenders_id'] = $dataParent->id;
                $startDate = new DateTime($request->start_date);
                $endDate = new DateTime($request->end_date);
                $dareInterval = new DateInterval('P1M');
                $datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
                foreach ($datePerioud as $date) {
                    $dataMonth['finance_calenders_id'] = $dataParent['id'];
                    $Montname_en = $date->format('F');
                    $dataParentMonth = month::select("id")->where(['name_en' => $Montname_en])->first();
                    $dataMonth['MONTH_ID'] = $dataParentMonth['id'];
                    $dataMonth['FINANCE_YR'] = $dataToInsert['FINANCE_YR'];
                    $dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                    $dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                    $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
                    $datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
                    $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
                    $dataMonth['com_code'] = auth()->user()->com_code;
                    $dataMonth['updated_at'] = date("Y-m-d H:i:s");
                    $dataMonth['created_at'] = date("Y-m-d H:i:s");
                    $dataMonth['added_by'] = auth()->user()->id;
                    $dataMonth['updated_by'] = auth()->user()->id;
                    $dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                    $dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                    Finance_cln_periods::insert($dataMonth);
                }
            }
            DB::commit();
            return redirect()->route('fiscal_years.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data= Finance_calender::findorfail($id);
        $finance_cln_periods= Finance_cln_periods::where('finance_calenders_id',$id)->get();
            return view('Dashboard.fiscal_years.show_month',compact('finance_cln_periods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit_finance_year=Finance_calender::findorfail($id);
        if(empty($edit_finance_year)){
            return redirect()->back()->with(['error'=>'حدث خطا ما ']);
        }
        if ($edit_finance_year['is_open']!= 0){

            return redirect()->back()->with(['error'=>'لا يمكن تعديل السنة المالية في هذه الحالة ']);
        }

        return view('Dashboard.fiscal_years.edit',compact('edit_finance_year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Finance_calendersUpdate  $request, string $id)
    {
        try {
            $data = Finance_calender::select("*")->where(['id' => $id])->first();
            if (empty($data)) {
                return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
            }
            if ($data['is_open'] != 0) {
                return redirect()->back()->with(['error' => ' عفوا لايمكن تعديل السنة المالية في هذه الحالة'])->withInput();
            }
            $validator=Validator::make($request->all(),[
                'FINANCE_YR'=>['required',Rule::unique('finance_calenders')->ignore($id) ],
            ]);
            if($validator->fails()){
                return redirect()->back()->with(['error' => ' عفوا اسم السنة المالية مسجل من قبل'])->withInput();
            }
            DB::beginTransaction();
            $dataToUpdate['FINANCE_YR'] = $request->FINANCE_YR;
            $dataToUpdate['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
            $dataToUpdate['start_date'] = $request->start_date;
            $dataToUpdate['end_date'] = $request->end_date;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $falg = Finance_calender::where(['id' => $id])->update($dataToUpdate);
            if ($falg) {
                if ($data['start_date'] != $request->start_date or $data['end_date'] != $request->end_date) {
                    $flagDelete = Finance_cln_periods::where(['finance_calenders_id' => $id])->delete();
                    if ($flagDelete) {
                        $startDate = new DateTime($request->start_date);
                        $endDate = new DateTime($request->end_date);
                        $dareInterval = new DateInterval('P1M');
                        $datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
                        foreach ($datePerioud as $date) {
                            $dataMonth['finance_calenders_id'] = $id;
                            $Montname_en = $date->format('F');
                            $dataParentMonth = month::select("id")->where(['name_en' => $Montname_en])->first();
                            $dataMonth['MONTH_ID'] = $dataParentMonth['id'];
                            $dataMonth['FINANCE_YR'] = $dataToUpdate['FINANCE_YR'];
                            $dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                            $dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                            $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
                            $datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
                            $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
                            $dataMonth['com_code'] = auth()->user()->com_code;
                            $dataMonth['updated_at'] = date("Y-m-d H:i:s");
                            $dataMonth['created_at'] = date("Y-m-d H:i:s");
                            $dataMonth['added_by'] = auth()->user()->id;
                            $dataMonth['updated_by'] = auth()->user()->id;
                            $dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                            $dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                            Finance_cln_periods::insert($dataMonth);
                        }
                    }
                }
            }
            DB::commit();
            return    redirect()->route('fiscal_years.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return   redirect()->back()->with(['error' => 'عفو حدث خطأ ما ' . $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $data=Finance_calender::findorfail($request->id)->delete();;

            return redirect()->route('fiscal_years.index')->with(['success' => 'تم حذف البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
        }
    }

    public function change_year_status(Request $request){

        $change_finance_year=Finance_calender::findorfail($request->id);
        if(empty($change_finance_year)){
            return redirect()->back()->with(['error'=>'حدث خطا ما ']);
        }
        if ($change_finance_year['is_open']!= 0){

            return redirect()->back()->with(['error'=>'لا يمكن تعديل السنة المالية في هذه الحالة ']);
        }
        $change_finance_year->is_open=1;
        $change_finance_year->updated_by=auth()->user()->id;
        $change_finance_year->save();
        return    redirect()->route('fiscal_years.index')->with(['success' => 'تم تحديث البيانات بنجاح']);

    }
}
