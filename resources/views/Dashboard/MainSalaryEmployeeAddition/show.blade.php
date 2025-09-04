@extends('Dashboard.layouts.master')

@section('title', 'اضافي الراتب ')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('nationalities.index') }}">اضافي الراتب   </a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات الاضافي {{ $finance_per->year_and_month}} </h3>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#createoccasion">
                    <i class="fa fa-plus"></i> إضافة اضافي راتب جديد
                </button>
                <a href="{{ route('MainSalaryEmployeeAddtion.print', $finance_per->id) }}"
                   target="_blank"
                   class="btn btn-sm btn-success">
                    <i class="fa fa-print"></i> طباعة
                </a>

            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center" style="border: 2px solid #4CAF50;
  background-color: #f9f9f9;">

                    <thead style=" background-color: #4CAF50;color: white;">


                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>نوع اضافة الراتب</th>
                        <th>الإجمالي</th>
                        <th> الإضافة </th>
                        <th> التحديث  </th>
                        <th> حالة الاعتماد </th>
                        <th> العمليات </th>
                    </tr>
                    </thead>
                    <tbody style="background-color:#919BA5">
                    @foreach ($data as $info)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $info->Employee->employee_name  }}
                                <span class="badge badge-warning">{{$info->notes }}</span></td>
                            <td>{{ $info->AdditionalType->name  }}
                            <td>{{ $info->total}}</td>
                            <td>{{ $info->created_at->translatedFormat('l') }} - {{ $info->created_at->diffForHumans() }}

                                بواسطة {{ $info->added->name }}</td>
                            <td>{{ $info->updated_at->translatedFormat('l') }} - {{ $info->updated_at->diffForHumans() }}

                                بواسطة {{ $info->added->name }}</td>
                            <td>
                                @if($info->is_approved == 1)
                                    <span class="badge badge-success">
        تمت الموافقة
    </span>
                                    <small class="text-muted">بواسطة {{ optional($info->Approvedby)->name ?? 'لا يوجد' }}</small>
                                @else
                                    <span class="badge badge-warning">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        جاري
    </span>
                                @endif
                            </td>
                            <td>
                                <button
                                    class="btn btn-info btn-sm editAbsenceBtn"
                                    data-id="{{ $info->id }}"
                                    data-notes="{{ $info->notes }}"
                                    data-additional_types_id="{{ $info->additional_types_id }}"
                                    data-total="{{ $info->total}}">
                                    <i class="fa fa-edit"></i> تعديل
                                </button>

                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $info->id }}">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </td>
                        </tr>
                        @include('Dashboard.MainSalaryEmployeeAddition.delete')
                        @include('Dashboard.MainSalaryEmployeeAddition.edit')

                    @endforeach
                    </tbody>
                </table>
                @include('Dashboard.MainSalaryEmployeeAddition.create')

            </div>
        </div>


    </div>



@endsection
@section('script')
    <script>
        // عند اختيار موظف
        $(document).on('change','#emp_id',function(e){
            $(".salay_div").hide();
            $(".day_salary").hide();

            var empId = $(this).val();
            if (empId) {
                $(".salay_div").show();
                $(".day_salary").show();
            }

            var empId = $(this).val();
            if(empId) {
                $.ajax({
                    url: "{{ route('get.salary') }}",
                    type: 'POST',
                    data: {
                        id: empId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        $("#salary_input").val(res.employee_sal);
                        $("#day_salary").val(res.daily_rate);
                    },
                    error: function() {
                        alert('حصل خطأ أثناء جلب البيانات');
                    }
                });
            } else {
                $("#salary_input").val('');
                $("#day_salary").val('');
            }
        });

        // عند الضغط على حفظ
        $(document).on('click', '#do_action', function(e) {
            e.preventDefault();

            var Emp_code = $('#emp_id').val();
            if (Emp_code === "") {
                alert('من فضلك ادخل الموظف');
                $('#emp_id').focus();
                return false;
            }





            var employee_id = $('#emp_id').val();
            var finance_cln_period_id = $('#finance_cln_period_id').val();


            $.ajax({
                url: "{{ route('check_exit') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    employee_id,
                    finance_cln_period_id
                },
                success: function(res) {
                    if (res.status === 'found') {
                        if (confirm('يوجد سجل سابق، هل تريد الاستمرار؟')) {
                            // ✅ المستخدم ضغط OK
                            console.log("هيكمل العملية");
                            // هنا تكتب الكود اللي ينفذ لو وافق
                        } else {
                            // ❌ المستخدم ضغط Cancel
                            console.log("ألغى العملية");
                            // هنا توقف العملية أو تعمله رجوع
                        }
                    }
                },
                error: function() {
                    alert('حصل خطأ أثناء التحقق من السجلات السابقة');
                }

            });
            $('#backup_freeze_modal').modal('show');
            var employees_code = $('#emp_id option:selected').data('code');
            let additional_types_id = $('#additional_types_id').val();
            let emp_day_price = $('#day_salary').val();
            let total = $('#total').val();
            let notes = $('#notes').val();


            $.ajax({
                url: "{{ route('MainSalaryEmployeeAddtion.store') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    employees_code,
                    finance_cln_period_id,
                    emp_day_price ,
                    additional_types_id,
                    total,
                    notes,
                    employee_id
                },

                success: function (res) {
                    $('#backup_freeze_modal').modal('hide');

                    alert('تم حفظ الجزاء بنجاح');
                    location.reload();
                },
                error: function(xhr) {
                    let response = xhr.responseJSON;
                    let message = "حصل خطأ أثناء حفظ البيانات:\n";
                    message += "---------------------------\n";

                    if (response && response.errors) {
                        // عرض جميع الأخطاء
                        Object.keys(response.errors).forEach(function(key) {
                            message += "- " + response.errors[key].join(", ") + "\n";
                        });
                    } else if (response && response.message) {
                        message += response.message;
                    } else {
                        message += "خطأ غير معروف.";
                    }

                    alert(message);
                }
            });
        });
        $(document).on('click', '.editAbsenceBtn', function (e) {
            let penaltyId = $(this).data('id');
            let total = $(this).data('total');
            let emp_day_salary = $(this).data('emp_day_salary');
            let notes = $(this).data('notes');

            // تعبئة الحقول
            $('#penalty_id').val(penaltyId);
            $('#edit_daily_rate').val(emp_day_salary);
            $('#edit_total').val(total);
            $('#edit_notes').val(notes);

            // عرض المودال
            $('#editAbsenceBtn').modal('show');
        });

        $(document).on('click', '#updatePenaltyBtn', function(e) {
            e.preventDefault();






            var id = $('#penalty_id').val();
            var employee_id = $('#emp_id').val();
            var finance_cln_period_id = $('#finance_cln_period_id').val();



            $('#backup_freeze_modal').modal('show');


            let additional_types_id = $('#edit_additional_types_id').val();
            let total = $('#edit_total').val();
            let notes = $('#edit_notes').val();


            $.ajax({
                url: "{{ route('MainSalaryEmployeeAddtion.update') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    id,
                    finance_cln_period_id,
                    additional_types_id,
                    total,
                    notes,
                    employee_id
                },

                success: function (res) {
                    $('#backup_freeze_modal').modal('hide');

                    alert('تم حفظ الطلب بنجاح');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('pwg');
                //     let message = "حصل خطأ أثناء حفظ البيانات.\n";
                //     message += "---------------------------\n";
                //     message += "الحالة: " + status + "\n";
                //     message += "الخطأ: " + error + "\n";
                //
                //     if (xhr.responseText) {
                //         message += "---------------------------\n";
                //         // ناخد أول 200 حرف بس علشان ما يكونش HTML طويل
                //         message += "التفاصيل:\n" + xhr.responseText.substring(0, 200) + "...";
                //     }
                //
                //     alert(message);
                 }
            });
        });

        // Select2

    </script>
    <script>
        $(document).ready(function () {
            $('#example2').DataTable({
                language: {
                    url: '/assets/ar.json',

                },
                searching: false
            });
        });
    </script>
@endsection
