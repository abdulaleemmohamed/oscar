<!-- resources/views/employees/show.blade.php -->
@extends('Dashboard.layouts.master')
@section('title')
    {{ $employee->employee_name }}
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('storage/images/employees'. '/'. $employee->employees_code.'/' .$employee->image->name) }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $employee->employee_name }}</h3>

                            <p class="text-muted text-center">{{ $employee2->job->name ?? '---' }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>القسم</b> <a class="float-right">{{ $employee2->department->name ?? '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>الفرع</b> <a class="float-right">{{ $employee->branch->name ?? '-' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>الشفت</b> <a class="float-right">{{ optional($employee2->shift)->shift_type == 1 ? 'صباحي' : 'مسائي' }}({{ $employee2->job->name ?? '---' }})</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">معلومات إضافية</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-id-card mr-1"></i> رقم الهوية</strong>
                            <p class="text-muted">{{ $employee->employee_national_idenity }}</p>
                            <hr>

                            <strong><i class="fas fa-calendar-alt mr-1"></i> تاريخ الميلاد</strong>
                            <p class="text-muted">{{ $employee->brith_date }}</p>
                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> العنوان</strong>
                            <p class="text-muted">{{ $employee->staies_address }}</p>
                            <hr>

                            <strong><i class="fas fa-envelope mr-1"></i> البريد الإلكتروني</strong>
                            <p class="text-muted">{{ $employee->employee_email }}</p>
                        </div>
                    </div>
                </div>

                <!-- بيانات تفصيلية -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">الوظيفة</a></li>
                                <li class="nav-item"><a class="nav-link" href="#military" data-toggle="tab">الخدمة العسكرية</a></li>
                                <li class="nav-item"><a class="nav-link" href="#passport" data-toggle="tab">الجواز والإقامة</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
{{--                                    <div class="row">--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'كود الموظف', 'value' => $employee->employees_code])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'كود البصمة', 'value' => $employee->zketo_code])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'النوع', 'value' => $employee->employee_gender == 1 ? 'ذكر' : 'أنثى'])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'المؤهل', 'value' => $employee->qualification->name ?? '-'])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'سنة التخرج', 'value' => $employee->Qualifications_year])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'تقدير التخرج', 'value' => getEstimateText($employee->graduation_estimate)])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'تخصص التخرج', 'value' => $employee->Graduation_specialization])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'الديانة', 'value' => $employee->religion->name ?? '-'])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'فصيلة الدم', 'value' => $employee->bloodGroup->name ?? '-'])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'رقم هاتف المنزل', 'value' => $employee->emp_home_tel])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'رقم هاتف العمل', 'value' => $employee->emp_work_tel])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'عدد ساعات العمل', 'value' => $employee->jobData->daily_work_hour])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'الراتب الأساسي', 'value' => $employee->jobData->employee_sal])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'هل لديه دوام ثابت؟', 'value' => $employee->jobData->is_has_fixced_shift ? 'نعم' : 'لا'])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'تأمين اجتماعي؟', 'value' => $employee->jobData->isSocialnsurance ? 'نعم' : 'لا'])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'رقم التأمين الاجتماعي', 'value' => $employee->jobData->SocialnsuranceNumber])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'تأمين طبي؟', 'value' => $employee->jobData->ismedicalinsurance ? 'نعم' : 'لا'])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'رقم التأمين الطبي', 'value' => $employee->jobData->medicalinsuranceNumber])--}}
{{--                                    </div>--}}
                                </div>
                                <div class="tab-pane" id="military">
{{--                                    <div class="row">--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'نوع الخدمة العسكرية', 'value' => getMilitaryStatusText($employee->military->employee_military_id)])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'من تاريخ', 'value' => $employee->military->employee_military_date_from])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'إلى تاريخ', 'value' => $employee->military->employee_military_date_to])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'السلاح', 'value' => $employee->military->employee_military_wepon])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'تاريخ الإعفاء', 'value' => $employee->military->exemption_date])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'سبب الإعفاء', 'value' => $employee->military->exemption_reason])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'سبب التأجيل', 'value' => $employee->military->postponement_reason])--}}
{{--                                    </div>--}}
                                </div>
                                <div class="tab-pane" id="passport">
{{--                                    <div class="row">--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'رقم الجواز', 'value' => $employee->employee_pasport_no])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'جهة الإصدار', 'value' => $employee->employee_pasport_from])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'تاريخ الانتهاء', 'value' => $employee->employee_pasport_exp])--}}
{{--                                        @include('employees.partials.show-input', ['label' => 'جهة الإقامة', 'value' => $employee->employee_Basic_stay_com])--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

