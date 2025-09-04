@extends('Dashboard.layouts.master')

@section('title', 'المناسبات الرسمية')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('Work_Shifts.index') }}">المناسبات الرسمية</a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات المناسبات الرسمية</h3>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#createoccasion">
                    <i class="fa fa-plus" aria-hidden="true"></i> إضافة مناسبة  جديد
                </button>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th>كود المناسبة </th>
                        <th>الاسم </th>
                        <th>من يوم</th>
                        <th>الي يوم</th>
                        <th>عدد الايام</th>
                        <th>حالة التفعيل</th>
                        <th>تمت الإضافة بواسطة</th>
                        <th>التحديث بواسطة</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $info)
                        <tr>
                            <td>{{ $info->id }}</td>
                            <td>{{$info->name}}</td>
                            <td>{{ $info->from_date }}</td>
                            <td>{{ $info->to_date }}</td>
                            <td>{{ $info->days_counter }}</td>
                            <td>{{ $info->active ? 'مفعل' : 'معطل' }}</td>
                            <td>{{ $info->added->username }}</td>
                            <td>{{ $info->updated_by ? $info->updatedby->username : 'لا يوجد' }}</td>
                            <td>  <button class="btn btn-info btn-sm" data-toggle="modal"
                                          data-target="#edit{{ $info->id }}">
                                    <i class="fa fa-pencil-alt"></i> تعديل
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $info->id }}">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </td>
                        </tr>
                        @include('Dashboard.occasions.edit')
                        @include('Dashboard.occasions.delete')

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('Dashboard.occasions.create')

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#example2').DataTable({
                language: {
                    url: 'assets/ar.json',

                },
                searching: false
            });
        });
    </script>
@endsection
