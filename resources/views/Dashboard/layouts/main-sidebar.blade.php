<aside class="main-sidebar" style="background-color: #004d4d;">
    <style>
        body, .sidebar, .nav-sidebar, .brand-link, .nav-link, .user-panel, .main-sidebar {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-white">
        <img src="{{ asset('assets/dist/img/hero_header.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-white">HR System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel d-flex mt-3 pb-3 mb-3">
            <div class="image">
                <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            @php
                $settingRoutes = [
                    'Admin_setting*', 'fiscal_years*', 'Branches*',
                    'Work_Shifts*', 'departments*', 'job_categories*',
                    'qualifications*', 'occasions*', 'Resignations*',
                    'Nationalities*', 'Religions*'
                ];
                $isSettingsOpen = collect($settingRoutes)->contains(fn($route) => request()->is($route));
                 $employee = collect($settingRoutes)->contains(fn($route) => request()->is($route));
            @endphp

            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <!-- General Settings -->
                <li class="nav-item has-treeview {{ $isSettingsOpen ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isSettingsOpen ? 'active' : '' }} text-white">
                        <i class="nav-icon fas fa-cogs text-white"></i>
                        <p class="text-white">
                            الضبط العام
                            <i class="right fas fa-angle-left text-white"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('Admin_setting.index') }}" class="nav-link {{ request()->is('Admin_setting*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs text-white"></i>
                                <p class="text-white">الضبط العام</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('fiscal_years.index') }}" class="nav-link {{ request()->is('fiscal_years*') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-days text-white"></i>
                                <p class="text-white">السنوات المالية</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Branches.index') }}" class="nav-link {{ request()->is('Branches*') ? 'active' : '' }}">
                                <i class="fa-regular fa-building text-white"></i>
                                <p class="text-white">الفروع</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Work_Shifts.index') }}" class="nav-link {{ request()->is('Work_Shifts*') ? 'active' : '' }}">
                                <i class="fa-solid fa-clock text-white"></i>
                                <p class="text-white">الشفتات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('departments.index') }}" class="nav-link {{ request()->is('departments*') ? 'active' : '' }}">
                                <i class="fa-regular fa-building text-white"></i>
                                <p class="text-white">إدارات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('job_categories.index') }}" class="nav-link {{ request()->is('job_categories*') ? 'active' : '' }}">
                                <i class="fa-solid fa-school text-white"></i>

                                <p class="text-white">أنواع الوظائف</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('qualifications.index') }}" class="nav-link {{ request()->is('qualifications*') ? 'active' : '' }}">
                                <i class="fa-solid fa-briefcase text-white"></i>

                                <p class="text-white">المؤهلات الدراسية</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('occasions.index') }}" class="nav-link {{ request()->is('occasions*') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-days text-white"></i>
                                <p class="text-white">المناسبات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('resignations.index') }}" class="nav-link {{ request()->is('resignations*') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-days text-white"></i>
                                <p class="text-white">الاستقالة وترك العمل</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nationalities.index') }}" class="nav-link {{ request()->is('nationalities*') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-days text-white"></i>
                                <p class="text-white">الجنسيات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('religions.index') }}" class="nav-link {{ request()->is('religions*') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-days text-white"></i>
                                <p class="text-white">الديانات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('governorates.index') }}" class="nav-link {{ request()->is('governorates*') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-days text-white"></i>
                                <p class="text-white">المحافظات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cities.index') }}" class="nav-link {{ request()->is('cities*') ? 'active' : '' }}">
                                <i class="fa-solid fa-calendar-days text-white"></i>
                                <p class="text-white">المدن</p>
                            </a>
                        </li>

                    </ul>
                </li>
               <li class="nav-item has-treeview {{ $employee ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ $employee ? 'active' : '' }} text-white">
                    <i class="fa-solid fa-users-gear text-white"></i>
                    <p class="text-white">
                       الموظفين
                        <i class="right fas fa-angle-left text-white"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('employees.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users-gear text-white"></i>
                            <p class="text-white">الموظفين </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Additional_salary.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users-gear text-white"></i>
                            <p class="text-white">اضافي الراتب </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('salary_deduction.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users-gear text-white"></i>
                            <p class="text-white">خصومات الراتب </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Salary_allowances.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users-gear text-white"></i>
                            <p class="text-white">بدلات  الراتب </p>
                        </a>
                    </li>


                </ul>
            </li>
                <li class="nav-item has-treeview {{ $employee ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $employee ? 'active' : '' }} text-white">
                        <i class="fa-solid fa-users-gear text-white"></i>
                        <p class="text-white">
                            الاجور
                            <i class="right fas fa-angle-left text-white"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('Main_Salery.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear text-white"></i>
                                <p class="text-white">الاجور </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('employee_penaltie.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear text-white"></i>
                                <p class="text-white">الجزءات  </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('MainSalaryEmployeeAbsence.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear text-white"></i>
                                <p class="text-white"> الغياب</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('MainSalaryEmployeeAddtion.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear text-white"></i>
                                <p class="text-white">اضافي الراتب </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('MainSalaryEmployeeDiscount.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear text-white"></i>
                                <p class="text-white">الخصومات المالية </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('MainSalaryEmployeeRewards.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear text-white"></i>
                                <p class="text-white">المكافات المالية </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('MainSalaryEmployeeAllowances.index') }}" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear text-white"></i>
                                <p class="text-white">البدلات  المالية </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('MainSalaryEmployeeLoans.index') }}"
                               class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                                <i class="fa-solid fa-users-gear text-white"></i>
                                <p class="text-white">السلف الشهرية </p>
                            </a>
                        </li>





                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
