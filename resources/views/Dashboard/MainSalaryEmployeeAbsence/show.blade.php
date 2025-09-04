@extends('Dashboard.layouts.master')

@section('title', 'الغياب ')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('nationalities.index') }}">الغياب  </a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات الغياب {{ $finance_per->year_and_month}} </h3>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#createoccasion">
                    <i class="fa fa-plus"></i> إضافة غياب جديد
                </button>
                <a href="{{ route('MainSalaryEmployeeAbsence.print', $finance_per->id) }}"
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
                        <th>عدد الأيام</th>
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
                            <td>{{ $info->days_deducted }}</td>
                            <td>{{ $info->total_value }}</td>
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
                                    data-days="{{ $info->days_deducted }}"
                                    data-total="{{ $info->total_value }}"
                                    data-emp_day_salary="{{ $info->emp_day_salary}}">
                                    <i class="fa fa-edit"></i> تعديل
                                </button>

                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $info->id }}">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </td>
                        </tr>
                        @include('Dashboard.MainSalaryEmployeeAbsence.delete')
                        @include('Dashboard.MainSalaryEmployeeAbsence.edit')

                    @endforeach
                    </tbody>
                </table>
                @include('Dashboard.MainSalaryEmployeeAbsence.create')

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

        // حساب الإجمالي
        $(document).on('input', '#day_salary, #days_deducted', function() {
            var n1 = parseFloat($("#day_salary").val()) || 0;
            var n2 = parseFloat($("#days_deducted").val()) || 0;
            $("#total_value").val(n1 * n2);
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



            var days = $('#days_deducted').val();
            if (days === "") {
                alert('من فضلك ادخل عدد ايام الجزاء');
                $('#days').focus();
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
                        alert('حصل خطأ أثناء التحقق من السجلات السابقة');
                    }
                },
                error: function() {
                    alert('حصل خطأ أثناء التحقق من السجلات السابقة');
                }
            });
            $('#backup_freeze_modal').modal('show');
            var employees_code = $('#emp_id option:selected').data('code');
            let day_salary = $('#day_salary').val();
            let days_deducted = $('#days_deducted').val();
            let total_value = $('#total_value').val();
            let notes = $('#notes').val();


            $.ajax({
                url: "{{ route('MainSalaryEmployeeAbsence.store') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    employees_code,
                    finance_cln_period_id,
                    emp_day_salary: day_salary,
                    days_deducted,
                    total_value,
                    notes,
                    employee_id
                },

                success: function (res) {
                    $('#backup_freeze_modal').modal('hide');

                    alert('تم حفظ الجزاء بنجاح');
                    location.reload();
                },
                error: function () {
                    alert('حصل خطأ أثناء حفظ البيانات');
                }
            });
        });
        $(document).on('click', '.editAbsenceBtn', function (e) {
            let penaltyId = $(this).data('id');
            let days = $(this).data('days');
            let total = $(this).data('total');
            let emp_day_salary = $(this).data('emp_day_salary');
            let notes = $(this).data('notes');

            // تعبئة الحقول
            $('#penalty_id').val(penaltyId);
            $('#edit_days_deducted').val(days);
            $('#edit_daily_rate').val(emp_day_salary);
            $('#edit_total_value').val(total);
            $('#edit_notes').val(notes);

            // عرض المودال
            $('#editAbsenceBtn').modal('show');
        });
        $(document).on('input', '#edit_daily_rate, #edit_days_deducted', function() {
            var n1 = parseFloat($("#edit_daily_rate").val()) || 0;
            var n2 = parseFloat($("#edit_days_deducted").val()) || 0;
            $("#edit_total_value").val(n1 * n2);
        });
        $(document).on('click', '#updatePenaltyBtn', function(e) {
            e.preventDefault();






            var id = $('#penalty_id').val();
            var employee_id = $('#emp_id').val();
            var finance_cln_period_id = $('#finance_cln_period_id').val();



            $('#backup_freeze_modal').modal('show');


            let days_deducted = $('#edit_days_deducted').val();
            let total_value = $('#edit_total_value').val();
            let notes = $('#edit_notes').val();


            $.ajax({
                url: "{{ route('MainSalaryEmployeeAbsence.update') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    id,
                    finance_cln_period_id,
                    days_deducted,
                    total_value,
                    notes,
                    employee_id
                },

                success: function (res) {
                    $('#backup_freeze_modal').modal('hide');

                    alert('تم حفظ الغياب بنجاح');
                    location.reload();
                },
                error: function () {
                    alert('حصل خطأ أثناء حفظ البيانات');
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
