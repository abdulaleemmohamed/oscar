<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Blood_group;
use App\Models\Branch;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Driving_License;
use App\Models\Employee;
use App\Models\Employment_detail;
use App\Models\File;
use App\Models\Governorate;
use App\Models\Image;
use App\Models\Job_category;
use App\Models\Nationality;
use App\Models\Personal_detail;
use App\Models\Qualification;
use App\Models\Religions;
use App\Models\Work_shift;
use App\Traits\delete_final;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class EmployeeController extends Controller
{

    use Delete_final;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Employee::all();
        return view('Dashboard.employees.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $com_code= auth()->user()->com_code;
      $branches=Branch::Where('active',1)->get();
        $qualifications=qualification::where('active',1)->get();
        $nationalities=nationality::where('is_active',1)->get();
        $religions=Religions::where('active',1)->get();
        $countires=Country::where('is_active',1)->get();
        $departements=Department::all();
        $jobs=Job_category::where('active',1)->get();
        $shifts_types=Work_shift::where('active',1)->get();
        $blood_groups=Blood_group::all();
        $governorates=Governorate::all();
        $cities=City::all();
        $driving_license=Driving_license::all();
      return view('Dashboard.employees.create',compact('branches','qualifications','nationalities','religions','countires',
          'departements','jobs','shifts_types','blood_groups','com_code','governorates','cities','driving_license'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        DB::beginTransaction();
        $last_employee = Employee::orderBy('employees_code', 'desc')->first();
        $employee = new Employee();
        $com_code=Auth::user()->com_code;

        try {
            if (!empty($last_employee)) {
                // استخراج الرقم من الكود السابق
                $last_code = $last_employee->employees_code; // مثال: OSA_015
                $last_number = (int) str_replace('EMP_'. $com_code .'_', '', $last_code); // 15
                $new_number = $last_number + 1;
            } else {
                $new_number = 1;
            }
            $new_code = 'EMP_'. $com_code .'_'. str_pad($new_number, 3, '0', STR_PAD_LEFT); // مثال: OSA_016
            $employee->employee_name=$request->employee_name;
            $employee->employees_code = $new_code;
            $employee->zketo_code=$request->zketo_code;
            $employee->employee_gender=$request->employee_gender;
            $employee->branch_id=$request->branch_id;
            $employee->Qualifications_id =$request->Qualifications_id ;
            $employee->Qualifications_year=$request->Qualifications_year;
            $employee->employee_national_idenity=$request->employee_national_idenity;
            $employee->employee_end_identityIDate=$request->employee_end_identityIDate;
            $employee->employee_identityPlace=$request->employee_identityPlace;

            $employee->brith_date=$request->brith_date;
            $employee->religion_id=$request->religion_id;
            $employee->employee_lang_id=$request->employee_lang_id;
            $employee->employee_email=$request->employee_email;
            $employee->staies_address=$request->staies_address;
            $employee->blood_group_id=$request->blood_group_id;
            $employee->notes=$request->notes;
            $employee->graduation_estimate=$request->graduation_estimate;
            $employee->Graduation_specialization=$request->Graduation_specialization;
            $employee->emp_home_tel=$request->emp_home_tel;
            $employee->emp_work_tel=$request->emp_work_tel;




            // $employee->employee_social_status_id=$request->employee_social_status_id;
            $employee->save();

            $job_data= new Employment_detail();
            $job_data->employee_id=$employee->id;
            $job_data->employee_Departments_code=$request->employee_Departments_code;
            $job_data->emp_start_date = $request->emp_start_date;
            $job_data->employee_jobs_id=$request->employee_jobs_id;
            $job_data->shift_type_id=$request->shift_type_id;
            $job_data->daily_work_hour=$request->daily_work_hour;
            $job_data->employee_sal=$request->employee_sal;
            $job_data->Functiona_status=$request->Functiona_status;
            $job_data->does_has_ateendance=$request->does_has_ateendance;
            $job_data->is_has_fixced_shift	=$request->is_has_fixced_shift	;
            $job_data->MotivationType=$request->MotivationType;
            $job_data->Motivation=$request->Motivation ?? 0;
            $job_data->isSocialnsurance=$request->isSocialnsurance;
            $job_data->Socialnsurancecutmonthely=$request->Socialnsurancecutmonthely;
            $job_data->SocialnsuranceNumber=$request->SocialnsuranceNumber;
            $job_data->ismedicalinsurance=$request->ismedicalinsurance;
            $job_data->medicalinsurancecutmonthely=$request->medicalinsurancecutmonthely;
            $job_data->medicalinsuranceNumber=$request->medicalinsuranceNumber;
            $job_data->sal_cach_or_visa=$request->sal_cach_or_visa;
            $job_data->daily_rate=$request->daily_rate;
         //   $job_data->active_for_Vaccation=$request->active_for_Vaccation;
            $job_data->is_done_Vaccation_formula=$request->is_done_Vaccation_formula;
            $job_data->urgent_person_details=$request->urgent_person_details;
            //->Does_have_fixed_allowances=$request->Does_have_fixed_allowances;
            $job_data->save();
            $person_data= new Personal_detail();
            $person_data->employee_id=$employee->id;
            $person_data->employee_cafel=$request->employee_cafel;
            $person_data->employee_pasport_no=$request->employee_pasport_no;
            $person_data->employee_pasport_from=$request->employee_pasport_from;
            $person_data->employee_pasport_exp=$request->employee_pasport_exp;
            $person_data->employee_Basic_stay_com=$request->employee_Basic_stay_com;
            $person_data->employee_military_id=$request->employee_military_id;
            $person_data->employee_military_date_from=$request->employee_military_date_from;
            $person_data->employee_military_date_to=$request->employee_military_date_to;
            $person_data->employee_military_wepon=$request->employee_military_wepon;
            $person_data->exemption_date=$request->exemption_date;
            $person_data->exemption_reason=$request->exemption_reason;
            $person_data->postponement_reason=$request->postponement_reason;
            $person_data->does_has_Driving_License=$request->does_has_Driving_License;
            $person_data->driving_license_types_id=$request->driving_license_types_id;
            $person_data->driving_License_degree=$request->driving_License_degree;
            $person_data->has_Relatives=$request->has_Relatives;
            $person_data->Relatives_details=$request->Relatives_details;
            $person_data->is_Disabilities_processes=$request->is_Disabilities_processes;
            $person_data->Disabilities_processes=$request->Disabilities_processes;






            $person_data->save();

            // حفظ الصورة داخل مجلد خاص بالموظف
            if ($request->hasFile('emp_photo')) {
                $file = $request->file('emp_photo');
                $extension = $file->getClientOriginalExtension();
                $filename = $new_code . '_profile.' . $extension;
                $folder = 'employees/' . $new_code;

                $path = $file->storeAs($folder, $filename, 'images');

                // حفظ الصورة في جدول الصور وربطها بالموظف
                $image = new Image();
                $image->name = $filename;
                $image->imageable_id=$employee->id;
                $image->imageable_type='App\Models\Employee';
                $image->save();

            }
            if ($request->hasFile('emp_CV')) {
                $file = $request->file('emp_CV');
                $extension = $file->getClientOriginalExtension();
                $filename = $new_code . '_cv.' . $extension;
                $folder = 'employees/' . $new_code;

                $path = $file->storeAs($folder, $filename, 'images');

                // حفظ الصورة في جدول الصور وربطها بالموظف
                $image = new File();
                $image->name = $filename;
                $image->fileable_id=$employee->id;
                $image->fileable_type='App\Models\Employee';
                $image->save();

            }

            DB::commit();
            return redirect()->route('employees.index')->with(['success' => 'تم ادخال البيانات بنجاح']);





        }
        catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee=Employee::findorfail($id);
        $employee2=Employment_detail::where('employee_id',$id)->first();
        $employee3=Personal_detail::where('employee_id',$id)->first();
        return view('Dashboard.employees.show',compact('employee','employee2','employee3'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee=Employee::findorfail($id);
        $job_data_edit=Employment_detail::where('employee_id',$id)->first();
        $person_data_edit=Personal_detail::where('employee_id',$id)->first();
        $emp_image=Image::where('imageable_id',$id)->first();
        $com_code= auth()->user()->com_code;
        $branches=Branch::Where('active',1)->get();
        $qualifications=qualification::where('active',1)->get();
        $nationalities=nationality::where('is_active',1)->get();
        $religions=Religions::where('active',1)->get();
        $countires=Country::where('is_active',1)->get();
        $departements=Department::all();
        $jobs=Job_category::where('active',1)->get();
        $shifts_types=Work_shift::where('active',1)->get();
        $blood_groups=Blood_group::all();
        $governorates=Governorate::all();
        $cities=City::all();
        $driving_license=Driving_License::all();
        return view('Dashboard.employees.edit', compact('employee','com_code','branches','qualifications','nationalities','religions',
        'countires','departements','jobs','shifts_types','blood_groups','governorates','cities','job_data_edit','person_data_edit','emp_image','driving_license',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();

            $employee = Employee::findOrFail($id);

            $employee->employee_name = $request->employee_name;
            $employee->employee_gender = $request->employee_gender;
            $employee->branch_id = $request->branch_id;
            $employee->Qualifications_id = $request->Qualifications_id;
            $employee->Qualifications_year = $request->Qualifications_year;
            $employee->employee_national_idenity = $request->employee_national_idenity;
          //  $employee->employee_end_identityIDate = $request->employee_end_identityIDate;
          //  $employee->employee_identityPlace = $request->employee_identityPlace;
            $employee->brith_date = $request->brith_date;
            $employee->religion_id = $request->religion_id;
            $employee->employee_lang_id = $request->employee_lang_id;
            $employee->employee_email = $request->employee_email;
            $employee->staies_address = $request->staies_address;
            $employee->blood_group_id = $request->blood_group_id;
            $employee->save();

            $job_data = Employment_detail::firstOrNew(['employee_id' => $employee->id]);
            $job_data->employee_Departments_code = $request->employee_Departments_code;
            $job_data->emp_start_date= $request->emp_start_date;
            $job_data->shift_type_id = $request->shift_type_id;
            $job_data->employee_jobs_id = $request->employee_jobs_id;
            $job_data->daily_work_hour = $request->daily_work_hour;
            $job_data->employee_sal = $request->employee_sal;
            $job_data->Functiona_status = $request->Functiona_status;
            $job_data->does_has_ateendance = $request->does_has_ateendance;
            $job_data->is_has_fixced_shift = $request->is_has_fixced_shift;
            $job_data->MotivationType = $request->MotivationType;
            $job_data->Motivation = $request->Motivation ?? 0;
            $job_data->isSocialnsurance = $request->isSocialnsurance;
            $job_data->Socialnsurancecutmonthely = $request->Socialnsurancecutmonthely;
            $job_data->SocialnsuranceNumber = $request->SocialnsuranceNumber;
            $job_data->ismedicalinsurance = $request->ismedicalinsurance;
            $job_data->medicalinsurancecutmonthely = $request->medicalinsurancecutmonthely;
            $job_data->medicalinsuranceNumber = $request->medicalinsuranceNumber;
            $job_data->sal_cach_or_visa = $request->sal_cach_or_visa;
            $job_data->daily_rate=$request->daily_rate;
            $job_data->save();

            $person_data = Personal_detail::firstOrNew(['employee_id' => $employee->id]);
            $person_data->employee_cafel = $request->employee_cafel;
            $person_data->employee_pasport_no = $request->employee_pasport_no;
            $person_data->employee_pasport_from = $request->employee_pasport_from;
            $person_data->employee_pasport_exp = $request->employee_pasport_exp;
            $person_data->employee_Basic_stay_com=$request->employee_Basic_stay_com;
            $person_data->employee_military_date_from=$request->employee_military_date_from;
            $person_data->employee_military_id=$request->employee_military_id;
            $person_data->employee_military_date_to=$request->employee_military_date_to;
            $person_data->employee_military_wepon=$request->employee_military_wepon;
            $person_data->exemption_date=$request->exemption_date;
            $person_data->exemption_reason=$request->exemption_reason;
            $person_data->postponement_reason=$request->postponement_reason;
            $person_data->does_has_Driving_License=$request->does_has_Driving_License;
            $person_data->driving_license_types_id=$request->driving_license_types_id;
            $person_data->driving_License_degree=$request->driving_License_degree;
            $person_data->has_Relatives=$request->has_Relatives;
            $person_data->Relatives_details=$request->Relatives_details;
            $person_data->is_Disabilities_processes=$request->is_Disabilities_processes;
            $person_data->Disabilities_processes=$request->Disabilities_processes;


            $person_data->save();
            $code =$employee->employees_code;
            if ($request->hasFile('emp_photo')) {
                $file = $request->file('emp_photo');
                $extension = $file->getClientOriginalExtension();
                $filename = $code . '_profile.' . $extension;
                $folder = 'employees/' . $code;

                $path = $file->storeAs($folder, $filename, 'images');

                // حفظ الصورة في جدول الصور وربطها بالموظف
                $image = new Image();
                $image->name = $filename;
                $image->imageable_id=$employee->id;
                $image->imageable_type='App\Models\Employee';
                $image->save();

            }


            DB::commit();

            return redirect()->route('employees.index')->with('success', 'تم تحديث بيانات الموظف بنجاح.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'فشل التحديث: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $employee = Employee::findOrFail($request->id);

        // جلب الصورة المرتبطة
        $this->Delete_attachment('images','employees/'.$employee->employees_code,$request->id);

    // حذف الموظف نفسه
        $employee->delete();

        return redirect()->back()->with('success', 'تم حذف الموظف والصورة المرتبطة!');
    }
    public function get_governorates(Request $request)
    {
        if ($request->ajax()) {
            $country_id = $request->country_id;
            $governorates = Governorate::where('country_id', $country_id)->get(['id', 'name']);
            return view('Dashboard.employees.governments',compact('governorates'));
        }
    }

    public function get_centers(Request $request)
    {
        if ($request->ajax()) {
            $governorates_id = $request->governorate_id;
            $cities = City::where('governorate_id', $governorates_id)->get(['id', 'name']);
            return view('Dashboard.employees.get_centers',compact('cities'));
        }
    }
}
