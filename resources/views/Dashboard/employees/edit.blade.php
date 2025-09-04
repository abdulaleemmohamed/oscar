@extends('Dashboard.layouts.master')
@section('title')
    بيانات الموظفين
@endsection
@section("css")
    <style>
        .required {
            color: red;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('employees.index') }}"> الموظفين</a>
@endsection
@section('contentheaderactive')
    اضافة
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> اضافة موظف جديد
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- /.card -->


                    <div class="card-body">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="person_edit" data-toggle="tab" data-target="#home"
                                        type="button" role="tab" aria-controls="home" aria-selected="true">بيانات شخصية
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="jobs_edit" data-toggle="tab" data-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="false">بيانات
                                    وظيفة
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact"
                                        type="button" role="tab" aria-controls="contact" aria-selected="false">بيانات
                                    اضافية
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                 aria-labelledby="person_edit">
                                <br> @include('Dashboard.employees.edit.employess_content_edit')</div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="jobs_edit">
                                <br> @include('Dashboard.employees.edit.job_data_edit')</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <br> @include('Dashboard.employees.edit.addtional_data_edit')</div>
                        </div>


                        <!-- /.card -->


                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-success" type="submit" name="submit">اضف الموظف</button>
                                <a class="btn btn-danger btn-sm">الغاء</a>
                            </div>
                        </div>
                </form>
            </div>


        </div>
    </div>
@endsection
@section("script")
    <script src="{{ asset('assets/plugins/select2/js/select2.full.js') }}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    </script>
    <script>
        $(document).on('change', '#country_id', function (e) {
            get_governorates();
        });

        function get_governorates() {
            var country_id = $("#country_id").val();
            jQuery.ajax({
                url: '{{ route('employees.get_governorates') }}',
                type: 'post',
                'dataType': 'html',
                cache: false,
                data: {"_token": '{{ csrf_token() }}', country_id: country_id},
                success: function (data) {
                    $("#governorates_Div").html(data);
                },
                error: function () {
                    alert("عفوا لقد حدث خطأ ");
                }

            });
        }

        $(document).on('change', '#governorate_id', function (e) {
            get_citites();
        });

        function get_citites() {
            var governorate_id = $("#governorate_id").val();
            jQuery.ajax({
                url: '{{ route('employees.get_centers') }}',
                type: 'post',
                'dataType': 'html',
                cache: false,
                data: {"_token": '{{ csrf_token() }}', governorate_id: governorate_id},
                success: function (data) {
                    $("#centers_div").html(data);
                },
                error: function () {
                    alert("عفوا لقد حدث خطأ ");
                }

            });
        }


    </script>
    <script>
        $(document).on('change', '#emp_military_id', function (e) {
            var emp_military_id = $(this).val();
            if (emp_military_id == 1) {
                $(".related_miltary_1").show();
                $(".related_miltary_2").hide();
                $(".related_miltary_3").hide();
            } else if (emp_military_id == 2) {
                $(".related_miltary_1").hide();
                $(".related_miltary_2").show();
                $(".related_miltary_3").hide();
            } else if (emp_military_id == 3) {
                $(".related_miltary_1").hide();
                $(".related_miltary_2").hide();
                $(".related_miltary_3").show();
            } else {
                $(".related_miltary_1").hide();
                $(".related_miltary_2").hide();
                $(".related_miltary_3").hide();

            }
        });

        $(document).on('change', '#does_has_Driving_License', function (e) {
            if ($(this).val() == 1) {
                $(".related_does_has_Driving_License").show();
            } else {
                $(".related_does_has_Driving_License").hide();
            }
        });
        $(document).on('change', '#has_Relatives', function (e) {
            if ($(this).val() == 1) {
                $(".Related_Relatives_detailsDiv").show();
            } else {
                $(".Related_Relatives_detailsDiv").hide();
            }
        });

        $(document).on('change', '#is_Disabilities_processes', function (e) {
            if ($(this).val() == 1) {
                $(".Related_is_Disabilities_processesDiv").show();
            } else {
                $(".Related_is_Disabilities_processesDiv").hide();
            }
        });

        $(document).on('change', '#is_has_fixced_shift', function (e) {
            if ($(this).val() == 1) {
                $(".relatedfixced_shift").show();
                $("#daily_work_hourDiv").hide();
            } else {
                $(".relatedfixced_shift").hide();
                $("#daily_work_hourDiv").show();

            }
        });

        $(document).on('change', '#MotivationType', function (e) {
            if ($(this).val() != 1) {
                $("#MotivationDIV").hide();
            } else {
                $("#MotivationDIV").show();

            }

        });

        $(document).on('change', '#isSocialnsurance', function (e) {
            if ($(this).val() != 1) {
                $(".relatedisSocialnsurance").hide();
            } else {
                $(".relatedisSocialnsurance").show();

            }

        });


        $(document).on('change', '#ismedicalinsurance', function (e) {
            if ($(this).val() != 1) {
                $(".relatedismedicalinsurance").hide();
            } else {
                $(".relatedismedicalinsurance").show();

            }

        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hasRelatives = document.getElementById('has_Relatives');
            const relativesDiv = document.querySelector('.Related_Relatives_detailsDiv');

            function toggleRelativesDiv() {
                if (!hasRelatives || !relativesDiv) return;

                if (hasRelatives.value === "1") {
                    relativesDiv.style.display = "block";
                } else {
                    relativesDiv.style.display = "none";
                }
            }

            hasRelatives.addEventListener('change', toggleRelativesDiv);
            toggleRelativesDiv(); // لتحديث العرض عند تحميل الصفحة بناءً على القيمة المختارة
        });
    </script>
@endsection

