@section('css')

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection
<div class="modal fade" id="createoccasion" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" style="width:90% !important; max-width:90% !important; ">
        <div class="modal-content" style=" border-radius:0 !important;">

            <div class="modal-header">
                <h3 class="text-lg font-bold mb-4">  تسجيل جزاء موظف شهر :{{ $finance_per->Month->name_ar}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- اسم الفرع -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">اسم الموظف</label>
                            <input type="hidden" id="finance_cln_period_id" value="{{ $finance_per->id}}">
                            <select name="employees_code" id="emp_id" class="form-control select2">
                                <option value="">اختر الموظف </option>
                                @foreach($get_emps as $emp)
                                    <option value="{{ $emp->id }}" data-code="{{ $emp->employee->employees_code }}">
                                        Code:({{ $emp->employee->employees_code }}) {{ $emp->employee->employee_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shift_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- العنوان -->
                    <div class="col-md-3 salay_div" style="display: none">
                        <div class="form-group" >
                            <label for="address">المرتب</label>
                            <input readonly type="text" name="salary" id="salary_input"  class="form-control">
                            @error('start_time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                <div class="col-md-3  day_salary" style="display: none">
                    <div class="form-group" >
                        <label for="address">اجر اليوم الواحد</label>
                        <input readonly type="text" name="emp_day_price" id="day_salary" value="day_salary" class="form-control">
                        @error('start_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                    <div class="col-md-3 " >
                        <div class="form-group" >
                            <label for="address">اختار نوع الخصم   </label>
                            <select name="deduction_types_id" id="deduction_types_id" class="form-control select2">
                            <option value="">اختر  </option>
                                @foreach($get_deductions as $deductions)
                                    <option value="{{$deductions->id}}">{{$deductions->name}}  </option>
                                @endforeach
                            </select>
                            @error('start_time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>

            <div class="row">
                <!-- اسم الفرع -->


                <!-- العنوان -->
                <div class="col-md-6" >
                    <div class="form-group" >
                        <label for="address">اجمال قيمة الخصم</label>
                        <input  type="text" name="total" id="total" class="form-control">
                        @error('start_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group" >
                        <label for="address">ملاحظات </label>
                        <input  type="text" name="notes" id="notes" class="form-control">
                        @error('start_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



            </div>


            </div>

        <div class="model-footer">
            <div class="col-md-4">
                <div class="form-group">
                    <a type="submit" id ="do_action" class="btn btn-success">حفظ</a>
                </div>

            </div>

        </div>
        </div>


    </div>
</div>


