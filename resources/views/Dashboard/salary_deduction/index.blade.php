@extends('Dashboard.layouts.master')

@section('title', 'خصومات الرواتب ')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('salary_deduction.index') }}">خصومات الرواتب  </a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات خصومات الرواتب</h3>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#createdepartment">
                    <i class="fa fa-plus" aria-hidden="true"></i> إضافة خصم راتب  جديد
                </button>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th>كود </th>
                        <th>الاسم</th>
                        <th>التفعيل</th>
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
                        @include('Dashboard.salary_deduction.edit')
                        @include('Dashboard.salary_deduction.delete')

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('Dashboard.salary_deduction.create')

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
