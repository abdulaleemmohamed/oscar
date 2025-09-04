@extends('Dashboard.layouts.master')

@section('title', 'الفروع')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('Branches.index') }}">الفروع</a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات الفروع</h3>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#createBranch">
                    <i class="fa fa-plus" aria-hidden="true"></i> إضافة فرع جديد
                </button>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>النوع</th>
                        <th>عدد الايام</th>
                        <th>الاجمالي</th>
                        <th>تمت الإضافة بواسطة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $info)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $info->Employee->employee_name }}</td>
                            <td>
                                {{ $info->Sanctions_types == 1 ? "تحقيق" : ($info->Sanctions_types == 2 ? "غياب" : "غير محدد") }}
                            </td>
                            <td>{{ $info->days_deducted }}</td>
                            <td>{{ $info->total_value }}</td>
                            <td>{{ $info->added->username }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- المودال برا الكارد --}}

@endsection
            @section('script')
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

