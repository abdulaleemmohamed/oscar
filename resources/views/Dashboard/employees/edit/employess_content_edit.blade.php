<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>كود بصمة الموظف</label><span class="required">*</span>
            <input type="number" name="zketo_code" class="form-control" value="{{ old('zketo_code', $employee->zketo_code) }}">
            <input type="hidden" name="id" class="form-control" value="{{ old('id', $employee->id) }}">
            @error('zketo_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>اسم الموظف كاملاً</label><span class="required">*</span>
            <input type="text" name="employee_name" class="form-control" value="{{ old('employee_name', $employee->employee_name) }}">
            @error('employee_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>نوع الجنس</label><span class="required">*</span>
            <select name="employee_gender" class="form-control">
                <option value="1" {{ old('employee_gender', $employee->employee_gender) == 1 ? 'selected' : '' }}>ذكر</option>
                <option value="2" {{ old('employee_gender', $employee->employee_gender) == 2 ? 'selected' : '' }}>أنثى</option>
            </select>
            @error('employee_gender') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- مثال على حقل مرتبط بعلاقة --}}
    <div class="col-md-4">
        <div class="form-group">
            <label>الفرع التابع له الموظف</label><span class="required">*</span>
            <select name="branch_id" class="form-control select2">
                <option value="">اختر الفرع</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}" {{ old('branch_id', $employee->branch_id) == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
            @error('branch_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>  المؤهل الدراسي</label>
            <select name="Qualifications_id" id="Qualifications_id" class="form-control select2 ">
                <option value="">اختر المؤهل</option>

                @foreach ($qualifications as $info )
                    <option value="{{ $info->id }}"  {{ old('Qualifications_id', $employee->Qualifications_id) == $info->id ? 'selected' : '' }}>
                        {{ $info->name }}
                    </option>
                @endforeach
            </select>
            @error('Qualifications_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>       سنة التخرج</label>
            <input type="text" name="Qualifications_year" id="Qualifications_year" class="form-control" value="{{ old('Qualifications_year',$employee->Qualifications_year) }}" >
            @error('Qualifications_year')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>   تقدير التخرج</label>
            <select  name="graduation_estimate" id="graduation_estimate" class="form-control">
                <option   @if(old('graduation_estimate',$employee->graduation_estimate)==1) selected @endif  value="1">مقبول</option>
                <option @if(old('graduation_estimate',$employee->graduation_estimate)==2 ) selected @endif value="2">جيد</option>
                <option @if(old('graduation_estimate',$employee->graduation_estimate)==3 ) selected @endif value="3">جيد مرتفع</option>
                <option @if(old('graduation_estimate',$employee->graduation_estimate)==4 ) selected @endif value="4">جيد جداً</option>
                <option @if(old('graduation_estimate',$employee->graduation_estimate)==5 ) selected @endif value="5">إمتياز </option>

            </select>
            @error('graduation_estimate')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>       تخصص التخرج</label>
            <input type="text" name="Graduation_specialization" id="Graduation_specialization" class="form-control" value="{{ old('Graduation_specialization',$employee->Graduation_specialization)}}">
        </div>
    </div>

    {{-- مثال على حقل مرتبط بعلاقة --}}



    <div class="col-md-4">
        <div class="form-group">
            <label>        تاريخ الميلاد</label>
            <input type="date" name="brith_date" id="brith_date" class="form-control" value="{{ old('brith_date',$employee->brith_date) }}" >
            @error('brith_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>رقم بطاقة الهوية</label>
            <input type="text" name="employee_national_idenity" id="employee_national_idenity" class="form-control" value="{{ old('employee_national_idenity',$employee->employee_national_idenity) }}" >
            @error('emp_national_idenity')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>         مركز اصدار بطاقة الهوية </label>
            <input type="text" name="emp_identityPlace" id="emp_identityPlace" class="form-control" value="{{ old('employee_identityPlace',$employee->employee_identityPlace) }}" >
            @error('emp_identityPlace')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>         تاريخ انتهاء بطاقة الهوية</label>
            <input type="date" name="emp_end_identityIDate" id="emp_end_identityIDate" class="form-control" value="{{ old('employee_end_identityIDate',$employee->employee_end_identityIDate) }}" >
            @error('emp_end_identityIDate')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>   فصيلة الدم</label>
            <select name="blood_group_id" id="blood_group_id" class="form-control select2 ">
                <option value="">اختر الفصيلة</option>

                @foreach ($blood_groups as $info )
                    <option @if(old('blood_group_id',$employee->blood_group_id)==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                @endforeach

            </select>
            @error('blood_group_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>    الجنسية</label>
            <select name="emp_nationality_id" id="emp_nationality_id" class="form-control select2 ">
                <option value="">اختر الجنسية</option>

                @foreach ($nationalities as $info )
                    <option @if(old('employee_nationality_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                @endforeach

            </select>
            @error('emp_nationality_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>  اللغة الاساسية التي يتحدث بها</label>

            @error('emp_lang_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>    الديانة</label>
            <select name="religion_id" id="religion_id" class="form-control select2 ">
                <option value="">اختر الديانة</option>
                @if ( !@empty($religions))
                    @foreach ($religions as $info )
                        <option @if(old('religion_id',$employee->religion_id)==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                    @endforeach
                @endif
            </select>
            @error('religion_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>      البريد الالكتروني</label>
            <input type="text" name="employee_email" id="emp_email" class="form-control" value="{{ old('employee_email',$employee->employee_email) }}" >
            @error('emp_email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>    الدول</label>
            <select name="country_id" id="country_id" class="form-control select2 ">
                <option value="">اختر الدولة التابع لها الموظف</option>
                @if (@isset($countires) && !@empty($countires))
                    @foreach ($countires as $info )
                        <option @if(old('country_id',$employee->country_id)==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                    @endforeach
                @endif
            </select>
            @error('country_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group" id="governorates_Div">
            <label>    المحافظات</label>
            <select name="governorates_id" id="governorates_id" class="form-control select2 ">
                <option value="">اختر المحافظة التابع لها الموظف</option>

            </select>
            @error('governorates_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group" id="centers_div">
            <label>    المدينة/المركز</label>
            <select name="city_id" id="city_id" class="form-control select2 ">
                <option value="">اختر المدينة التابع لها الموظف</option>

            </select>
            @error('city_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>       عنوان الاقامة الحالي للموظف</label>
            <input type="text" name="staies_address" id="staies_address" class="form-control" value="{{ old('staies_address',$employee->staies_address) }}" >
            @error('staies_address')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>     هاتف المنزل</label>
            <input type="text" name="emp_home_tel" id="emp_home_tel" class="form-control" value="{{ old('emp_home_tel',$employee->emp_home_tel) }}" >
            @error('emp_home_tel')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>     هاتف العمل</label>
            <input type="text" name="emp_work_tel" id="emp_work_tel" class="form-control" value="{{ old('emp_work_tel',$employee->emp_work_tel) }}" >
            @error('emp_work_tel')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>




</div>
