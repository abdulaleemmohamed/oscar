<div class="row">
    <div class="col-md-4 " >
        <div class="form-group">
            <label>تاريخ التعيين</label>
            <input type="date" name="emp_start_date" id="emp_start_date" class="form-control" value="{{ old('emp_start_date') }}" >
            @error('emp_start_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>الحالة الوظيفية</label>
            <select  name="Functiona_status" id="Functiona_status" class="form-control">
                <option   @if(old('Functiona_status')==1) selected @endif  value="1">يعمل</option>
                <option @if(old('Functiona_status')==0 and old('Functiona_status')!="" ) selected @endif value="0">خارج الخدمة</option>

            </select>
            @error('Functiona_status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>الادارة التابع لها الموظف</label><span class="required">*</span>
            <select name="employee_Departments_code" id="employee_Departments_code" class="form-control select2 ">
                <option value="">اختر الادارة</option>

                    @foreach( $departements as $info )
                        <option @if(old('departements_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                    @endforeach

            </select>
            @error('employee_Departments_code')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> وظيفة الموظف</label><span class="required">*</span>
            <select name="employee_jobs_id" id="employee_jobs_id" class="form-control  select2 ">
                <option value="">اختر الوظيفة</option>
                @if (!@empty($jobs))
                    @foreach ($jobs as $info )
                        <option @if(old('jobs')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                    @endforeach
                @endif
            </select>
            @error('employee_jobs_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>  هل  له بصمة حضور وانصراف</label><span class="required">*</span>
            <select  name="does_has_ateendance" id="does_has_ateendance" class="form-control">
                <option   @if(old('does_has_ateendance')==1) selected @endif  value="1">نعم</option>
                <option @if(old('does_has_ateendance')==0 and old('does_has_ateendance')!="" ) selected @endif value="0"> لا </option>

            </select>
            @error('does_has_ateendance')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>هل  له شفت ثابت</label>
            <select  name="is_has_fixced_shift" id="is_has_fixced_shift" class="form-control">
                <option value="">اختر الحالة</option>
                <option   @if(old('is_has_fixced_shift')==1) selected @endif  value="1">نعم</option>
                <option @if(old('is_has_fixced_shift')==0 and old('is_has_fixced_shift')!="" ) selected @endif value="0"> لا </option>

            </select>
            @error('is_has_fixced_shift')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4 relatedfixced_shift"  @if(old('do_has_shift')!=1) style="display: none;" @endif>
        <div class="form-group">
            <label>       أنواع الشفتات</label>
            <select name="shift_type_id" id="shift_type_id" class="form-control select2 ">
                <option value="">اختر الشفت</option>
                @if (!@empty( $shifts_types))
                    @foreach ( $shifts_types as $info )
                        <option @if(old('shifts_types_id')==$info->id) selected="selected" @endif value="{{ $info->id }}">

                            @if($info->type==1) صباحي @elseif ($info->type==2) مسائي @else يوم كامل @endif
                            من
                            @php
                                $dt=new DateTime($info->from_time);
                                $time=$dt->format("h:i");
                                $newDateTime=date("A",strtotime($info->from_time));
                                $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء');
                            @endphp

                            {{ $time }}
                            {{ $newDateTimeType }}
                            الي
                            @php
                                $dt=new DateTime($info->to_time);
                                $time=$dt->format("h:i");
                                $newDateTime=date("A",strtotime($info->to_time));
                                $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء');
                            @endphp

                            {{ $time }}
                            {{ $newDateTimeType }}
                            عدد
                            {{ $info->total_hour*1  }} ساعات




                        </option>
                    @endforeach
                @endif
            </select>
            @error('shifts_types_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" id="daily_work_hourDiv" style="display: none;">
        <div class="form-group">
            <label>عدد ساعات العمل اليومي</label>
            <input type="text" name="daily_work_hour" id="daily_work_hour" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('daily_work_hour') }}" >
            @error('daily_work_hour')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" >
        <div class="form-group">
            <label>راتب الموظف الشهري</label><span class="required">*</span>
            <input type="text" name="employee_sal" id="employee_sal" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('employee_sal') }}" >
            @error('employee_sal')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4" >
        <div class="form-group">
            <label>الاجر</label>
            <input type="text" name="daily_rate" id="daily_rate" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('daily_rate') }}" >
            @error('employee_sal')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>هل  له حافز </label><span class="required">*</span>
            <select  name="MotivationType" id="MotivationType" class="form-control">
                <option value="">اختر الحالة</option>
                <option   @if(old('Motivation')==1) selected @endif  value="1">ثابت</option>
                <option   @if(old('Motivation')==2) selected @endif  value="2">متغير</option>
                <option @if(old('Motivation')==0 and old('Motivation')!="" ) selected @endif value="0"> لايوجد </option>

            </select>
            @error('MotivationType')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 " id="MotivationDIV" style="display: none" >
        <div class="form-group">
            <label> قيمة الحافز الشهري الثابت</label>
            <input type="text" name="Motivation" id="Motivation" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('Motivation') }}" >
            @error('Motivation')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label>  هل  له تأمين اجتماعي </label>
            <select  name="isSocialnsurance" id="isSocialnsurance" class="form-control">
                <option value="">اختر الحالة</option>
                <option   @if(old('isSocialnsurance')==1) selected @endif  value="1">نعم</option>
                <option @if(old('isSocialnsurance')==0 and old('isSocialnsurance')!="" ) selected @endif value="0"> لا </option>

            </select>
            @error('isSocialnsurance')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-4 relatedisSocialnsurance" " style="display: none" >
    <div class="form-group">
        <label> قيمة التأمين المستقطع شهرياً</label>
        <input type="text" name="Socialnsurancecutmonthely" id="Socialnsurancecutmonthely" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('Socialnsurancecutmonthely') }}" >
        @error('Socialnsurancecutmonthely')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-4 relatedisSocialnsurance" " style="display: none" >
<div class="form-group">
    <label> رقم التامين الاجتماعي للموظف</label>
    <input type="text" name="SocialnsuranceNumber" id="SocialnsuranceNumber" class="form-control" value="{{ old('SocialnsuranceNumber') }}" >
    @error('SocialnsuranceNumber')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>  هل  له تأمين طبي </label>
        <select  name="ismedicalinsurance" id="ismedicalinsurance" class="form-control">
            <option value="">اختر الحالة</option>
            <option   @if(old('ismedicalinsurance')==1) selected @endif  value="1">نعم</option>
            <option @if(old('ismedicalinsurance')==0 and old('ismedicalinsurance')!="" ) selected @endif value="0"> لا </option>

        </select>
        @error('ismedicalinsurance')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="col-md-4 relatedismedicalinsurance" " style="display: none" >
<div class="form-group">
    <label> قيمة التأمين الطبي المستقطع شهرياً</label>
    <input type="text" name="medicalinsurancecutmonthely" id="medicalinsurancecutmonthely" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('medicalinsurancecutmonthely') }}" >
    @error('medicalinsurancecutmonthely')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
</div>

<div class="col-md-4 relatedismedicalinsurance" " style="display: none" >
<div class="form-group">
    <label> رقم التامين الطبي للموظف</label>
    <input type="text" name="medicalinsuranceNumber" id="medicalinsuranceNumber" class="form-control" value="{{ old('medicalinsuranceNumber') }}" >
    @error('medicalinsuranceNumber')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label> نوع صرف راتب الموظف</label>
        <select  name="sal_cach_or_visa" id="sal_cach_or_visa" class="form-control">
            <option value="">اختر الحالة</option>
            <option   @if(old('sal_cach_or_visa')==1) selected @endif  value="1">كاش</option>
            <option   @if(old('sal_cach_or_visa')==2) selected @endif  value="2">فيزا</option>

        </select>
        @error('sal_cach_or_visa')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label> هل له رصيد اجازات سنوي</label>
        <select  name="is_done_Vaccation_formula" id="is_done_Vaccation_formula" class="form-control">
            <option value="">اختر الحالة</option>
            <option   @if(old('is_done_Vaccation_formula')==1) selected @endif  value="1">نعم</option>
            <option   @if(old('is_done_Vaccation_formula')==0 and old('is_done_Vaccation_formula')!=""  ) selected @endif  value="0">لا</option>

        </select>
        @error('is_done_Vaccation_formula')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="col-md-4 " >
    <div class="form-group">
        <label>  شخص يمكن الرجوع اليه للضرورة  	</label>
        <input type="text" name="urgent_person_details" id="urgent_person_details" class="form-control" value="{{ old('urgent_person_details') }}" >
        @error('urgent_person_details')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

</div>
</div>
