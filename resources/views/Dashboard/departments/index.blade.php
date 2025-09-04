@extends('Dashboard.layouts.master')

@section('title', 'ادرات العمل')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('departments.index') }}">ادرات العمل</a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات ادرات العمل</h3>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#createdepartment">
                    <i class="fa fa-plus" aria-hidden="true"></i> إضافة ادارة جديد
                </button>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th>كود الادارة</th>
                        <th>الاسم</th>
                        <th>الملاحظات </th>
                        <th>هاتف الادارة</th>
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
                            <td>{{ $info->notes ? $info->notes :'لا توجد ملاحظات' }}</td>
                            <td>{{ $info->phones ?  $info->phones :'لا توجد هاتف' }}</td>
                            <td>{{ $info->active ? 'مفعل' : 'معطل' }}</td>
                            <td>{{ $info->added->username }}</td>
                            <td>{{ $info->updated_by ? $info->updatedby->username : 'لا يوجد' }}</td>
                            <td>  <button class="btn btn-info btn-sm" data-toggle="modal"
                                          data-target="#editdepartment{{ $info->id }}">
                                    <i class="fa fa-pencil-alt"></i> تعديل
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deletedepartment{{ $info->id }}">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </td>
                        </tr>
                        @include('Dashboard.departments.edit')
                        @include('Dashboard.departments.delete')

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('Dashboard.departments.create')

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
