@extends('Dashboard.layouts.master')
@section('title')
    الرئيسية
@endsection
@section('content')

    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="card-text">عدد الموظفين</p>
                        <h5 class="card-title">{{\App\Models\Employee::count()}}</h5>
                    </div>
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="card-text">عدد الشفتات</p>
                        <h5 class="card-title">{{\App\Models\Work_shift::count()}}</h5>
                    </div>
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="card-text">عدد الأقسام</p>
                        <h5 class="card-title">{{\App\Models\Department::count()}}</h5>
                    </div>
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="card-text">التقارير الجديدة</p>
                        <h5 class="card-title">5</h5>
                    </div>
                    <i class="fas fa-file-alt"></i>
                </div>
            </div>
        </div>
    </div>
<div class="row">

</div>


@endsection
