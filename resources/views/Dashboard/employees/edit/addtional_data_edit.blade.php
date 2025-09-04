<div class="row">
    <div class="col-md-4 " >
        <div class="form-group">
            <label>  اسم الكفيل 	</label>
            <input type="text" name="employee_cafel" id="employee_cafel" class="form-control" value="{{ old('employee_cafel',$person_data_edit->employee_cafel) }}" >
            @error('employee_cafel')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 " >
        <div class="form-group">
            <label>   رقم الباسبور ان وجد 	</label>
            <input type="text" name="emp_pasport_no" id="emp_pasport_no" class="form-control" value="{{ old('emp_pasport_no',$person_data_edit->employee_pasport_no) }}" >
            @error('emp_pasport_no')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4 " >
        <div class="form-group">
            <label>جهة اصدار الباسبور	</label>
            <input type="text" name="emp_pasport_from" id="emp_pasport_from" class="form-control" value="{{ old('emp_pasport_from',$person_data_edit->employee_pasport_from) }}" >
            @error('emp_pasport_from')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 " >
        <div class="form-group">
            <label>  تاريخ انتهاء الباسبور	</label>
            <input type="date" name="emp_pasport_exp" id="emp_pasport_exp" class="form-control" value="{{ old('emp_pasport_exp',$person_data_edit->emp_pasport_exp) }}" >
            @error('emp_pasport_exp')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label>    عنوان اقامة الموظف في بلده الام	</label>
            <input type="text" name="emp_Basic_stay_com" id="emp_Basic_stay_com" class="form-control" value="{{ old('emp_Basic_stay_com',$person_data_edit->emp_Basic_stay_com) }}" >
            @error('emp_Basic_stay_com')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>    حالة الخدمة العسكرية</label>
            <select name="employee_military_id" id="emp_military_id" class="form-control select2 ">
                <option value="">  اختر الحالة</option>
                <option   @if(old('employee_military_id',$person_data_edit->employee_military_id)==1) selected @endif  value="1">تمت  </option>
                <option @if(old('employee_military_id',$person_data_edit->employee_military_id)==0 and old('employee_military_id')!="" ) selected @endif value="2">معافي</option>

            </select>
            @error('country_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4 related_miltary_1"  style="display: none;">
        <div class="form-group">
            <label>    تاريخ بداية الخدمة العسكرية	</label>
            <input type="date" name="employee_military_date_from" id="employee_military_date_from" class="form-control" value="{{ old('employee_military_date_from',$person_data_edit->employee_military_date_from) }}" >
            @error('emp_military_date_from')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="col-md-4 related_miltary_1"  style="display: none;">
        <div class="form-group">
            <label>    تاريخ نهاية الخدمة العسكرية	</label>
            <input type="date" name="employee_military_date_to" id="employee_military_date_to" class="form-control" value="{{ old('emp_military_date_to',$person_data_edit->employee_military_date_to) }}" >
            @error('emp_military_date_to')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4 related_miltary_1"  style="display: none;">
        <div class="form-group">
            <label>     سلاح الخدمة العسكرية	</label>
            <input type="text" name="employee_military_wepon" id="employee_military_wepon	" class="form-control" value="{{ old('emp_military_wepon',$person_data_edit->employee_military_wepon) }}" >
            @error('emp_military_wepon	')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4 related_miltary_2"  style="display: none;">
        <div class="form-group">
            <label>    تاريخ اعفاء الخدمة العسكرية	</label>
            <input type="date" name="exemption_date" id="exemption_date" class="form-control" value="{{ old('exemption_date',$person_data_edit->exemption_date) }}" >
            @error('exemption_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="col-md-4 related_miltary_2"  style="display: none;">
        <div class="form-group">
            <label>    سبب اعفاء الخدمة العسكرية	</label>
            <input type="text" name="exemption_reason" id="exemption_reason" class="form-control" value="{{ old('exemption_reason',$person_data_edit->exemption_reason) }}" >
            @error('exemption_reason')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4 related_miltary_3"  style="display: none;">
        <div class="form-group">
            <label>  سبب ومدة تأجيل الخدمة العسكرية</label>
            <input type="text" name="postponement_reason" id="postponement_reason" class="form-control" value="{{ old('postponement_reason',$person_data_edit->postponement_reason) }}" >
            @error('postponement_reason')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label>    هل يمتلك رخصة قيادة</label>
            <select  name="does_has_Driving_License" id="does_has_Driving_License" class="form-control">
                <option value="">  اختر الحالة</option>
                <option   @if(old('does_has_Driving_License',$person_data_edit->does_has_Driving_License)==1) selected @endif  value="1">نعم </option>
                <option @if(old('does_has_Driving_License',$person_data_edit->does_has_Driving_License)==0 and old('does_has_Driving_License',$person_data_edit->does_has_Driving_License)!="" ) selected @endif value="2">لا</option>

            </select>
            @error('does_has_Driving_License')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4 related_does_has_Driving_License"  style="display: none;">
        <div class="form-group">
            <label>  رقم رخصة القيادة</label>
            <input type="text" name="driving_License_degree" id="driving_License_degree" class="form-control" value="{{ old('driving_License_degree',$person_data_edit->driving_License_degree) }}" >
            @error('driving_License_degree')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 related_does_has_Driving_License"  style="display: none;">
        <div class="form-group">
            <label>  نوع رخصة القيادة</label>
            <select name="driving_license_types_id" id="driving_license_types_id" class="form-control select2 ">
                <option value="">اختر  الحالة </option>
                @if (@isset($driving_license) && !@empty($driving_license))
                    @foreach ($driving_license as $info )
                        <option @if(old('driving_license_types_id',$person_data_edit->driving_license_types_id)==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                    @endforeach
                @endif
            </select>
            @error('driving_license_types_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>هل يمتلك أقارب بالعمل</label>
            <select name="has_Relatives" id="has_Relatives" class="form-control">
                <option value="">اختر الحالة</option>

                <option value="1" @if(old('has_Relatives', $person_data_edit->has_Relatives) == "1") selected @endif>نعم</option>
                <option value="2" @if(old('has_Relatives', $person_data_edit->has_Relatives) == "2") selected @endif>لا</option>
            </select>
            @error('has_Relatives')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-8 Related_Relatives_detailsDiv"  style="display: none;">
        <div class="form-group">
            <label> تفاصيل الاقارب</label>
            <textarea type="text" name="Relatives_details" id="Relatives_details" class="form-control" >
                        {{ old('Relatives_details',$person_data_edit->Relatives_details) }}

                     </textarea>
            @error('Relatives_details')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label> هل يمتلك اعاقة / عمليات سابقة</label>
            <select name="is_Disabilities_processes" id="is_Disabilities_processes" class="form-control">
                <option value="">اختر الحالة</option>

                <option value="1" @if(old('is_Disabilities_processes', $person_data_edit->is_Disabilities_processes) == "1") selected @endif>نعم</option>
                <option value="2" @if(old('is_Disabilities_processes', $person_data_edit->is_Disabilities_processes) == "2") selected @endif>لا</option>
            </select>
            @error('has_Relatives')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-8 Related_is_Disabilities_processesDiv"  style="display: none;">
        <div class="form-group">
            <label> تفاصيل الاعاقة / عمليات سابقة</label>
            <textarea type="text" name="Disabilities_processes" id="Disabilities_processes" class="form-control" >
                        {{ old('Disabilities_processes',$person_data_edit->Disabilities_processes) }}

                     </textarea>
            @error('Disabilities_processes')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label>صورة البطاقة الشخصية</label>

        @if ($emp_image)
            <img src="{{ asset('storage/images/employees'. '/'. $person_data_edit->employees_code) }}" width="25" alt="صورة المستخدم">


        @else
            <input type="file" name="emp_photo" class="form-control">
        @endif
    </div>
{{--    <div class="col-md-4">--}}
{{--        <div class="form-group">--}}
{{--            <label>   الصورة الشخصية للموظف</label>--}}
{{--            <input type="file" name="emp_photo" id="emp_photo" class="form-control" value="{{ old('emp_photo') }}" >--}}
{{--            @error('emp_photo')--}}
{{--            <span class="text-danger">{{ $message }}</span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-4">--}}
{{--        <div class="form-group">--}}
{{--            <label>     السرة الذاتية للموظف</label>--}}
{{--            <input type="file" name="emp_CV" id="emp_CV" class="form-control" value="{{ old('emp_CV') }}" >--}}
{{--            @error('emp_CV')--}}
{{--            <span class="text-danger">{{ $message }}</span>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
