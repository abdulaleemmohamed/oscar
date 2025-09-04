@extends('Dashboard.layouts.master')

@section('title', 'الجزاءات ')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('nationalities.index') }}">الجزاءات  </a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات الجزاءات {{ $finance_per->year_and_month}} </h3>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#createoccasion">
                    <i class="fa fa-plus"></i> إضافة جزاء جديد
                </button>
                <a href="{{ route('employee-penalties.print', $finance_per->id) }}"
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
                        <th>النوع</th>
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
                            <td>{{ $info->Employee->employee_name }}</td>
                            <td>
                                {{ $info->Sanctions_types == 1 ? 'تحقيق' : ($info->Sanctions_types == 2 ? 'غياب' : 'غير محدد') }}
                            </td>
                            <td>{{ $info->days_deducted }}</td>
                            <td>{{ $info->total_value }}</td>
                            <td>{{ $info->created_at->translatedFormat('l') }} - {{ $info->created_at->diffForHumans() }}
                                بواسطة {{ $info->added->name }}</td>
                            <td>{{ $info->updated_at->translatedFormat('l') }} - {{ $info->updated_at->diffForHumans() }}
                                بواسطة {{ $info->added->name }}</td>
                            <td>
                                @if($info->is_approved == 1)
                                    <span class="badge badge-success">تمت الموافقة</span>
                                    <small class="text-muted">بواسطة {{ optional($info->Approvedby)->name ?? 'لا يوجد' }}</small>
                                @else
                                    <span class="badge badge-warning">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        جاري
                                    </span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm editPenaltyBtn"
                                        data-id="{{ $info->id }}"
                                        data-type="{{ $info->Sanctions_types }}"
                                        data-days="{{ $info->days_deducted }}"
                                        data-total="{{ $info->total_value }}"
                                        data-day_salary="{{ $info->emp_day_salary }}">
                                    تعديل
                                </button>

                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $info->id }}">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </td>
                        </tr>
                        @include('Dashboard.employee_penaltie.delete')


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- مودال إنشاء جزاء --}}
    @include('Dashboard.employee_penaltie.create')
    @include('Dashboard.employee_penaltie.edit')



@endsection

@section('script')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.js') }}"></script>
    <script>
        // عند اختيار موظف
        $(document).on('change', '#emp_id', function(e) {
            $(".salay_div").hide();
            $(".day_salary").hide();

            var empId = $(this).val();
            if (empId) {
                $(".salay_div").show();
                $(".day_salary").show();

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
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('حصل خطأ أثناء جلب البيانات: ' + xhr.responseText);
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

            var types = $('#Sanctions_types').val();
            if (types === "") {
                alert('من فضلك اختر نوع الجزاء');
                $('#Sanctions_types').focus();
                return false;
            }

            var days = $('#days_deducted').val();
            if (days === "") {
                alert('من فضلك ادخل عدد ايام الجزاء');
                $('#days_deducted').focus();
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
            let Sanctions_types = $('#Sanctions_types').val();

            $.ajax({
                url: "{{ route('employee_penaltie.store') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    employees_code,
                    finance_cln_period_id,
                    emp_day_salary: day_salary,
                    days_deducted,
                    total_value,
                    Sanctions_types,
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
        })
        $(document).on('click', '.editPenaltyBtn', function () {
            let penaltyId = $(this).data('id');
            let sanctionType = $(this).data('type');
            let days = $(this).data('days');
            let total = $(this).data('total');
            let dailyRate = $(this).data('day_salary');

            $('#penalty_id').val(penaltyId);
            $('#edit_Sanctions_types').val(sanctionType).trigger('change');
            $('#edit_days_deducted').val(days);
            $('#edit_total_value').val(total);
            $('#editPenaltyModal').modal('show');

            $('#edit_days_deducted').data('daily-rate', dailyRate);
        });

        $(document).on('input', '#edit_days_deducted', function () {
            let dailyRate = $(this).data('daily-rate') || 0;
            let days = parseFloat($(this).val()) || 0;
            $('#edit_total_value').val(dailyRate * days);
        });

        $('#updatePenaltyBtn').click(function (e) {
            e.preventDefault();

            let penaltyId = $('#penalty_id').val();
            let sanctionType = $('#edit_Sanctions_types').val();
            let days = $('#edit_days_deducted').val();
            let total = $('#edit_total_value').val();

            $.ajax({
                url: "{{ route('employee_penaltie.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: penaltyId,
                    Sanctions_types: sanctionType,
                    days_deducted: days,
                    total_value: total
                },
                success: function (res) {
                    $('#editPenaltyModal').modal('hide');
                    alert('تم تعديل الجزاء بنجاح');
                    location.reload();
                },
                error: function () {
                    alert('حصل خطأ أثناء تعديل البيانات');
                }
            });


        });

        // Select2
        $('.select2').select2({ theme: 'bootstrap4' });

        // DataTable
        $('#example2').DataTable({
            language: { url: '/assets/ar.json' },
            searching: false
        });
    </script>
@endsection
