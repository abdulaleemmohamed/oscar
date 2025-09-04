@extends('Dashboard.layouts.master')

@section('title', 'الموظفين ')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('nationalities.index') }}">الموظفين  </a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات الموظفين </h3>
                <a href="{{route('employees.create')}}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> اضافة موظف جديد</a>

            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center" style="border: 2px solid #4CAF50;
  background-color: #f9f9f9;">

                    <thead style=" background-color: #4CAF50;color: white;">


                    <tr>
                        <th>#</th>
                        <th>الصورة </th>
                        <th>كود الموظفين</th>
                        <th>الاسم</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody style="background-color:#919BA5">
                    @foreach ($data as $info)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($info->image)
                                    <img src="{{ asset('storage/images/employees'. '/'. $info->employees_code.'/' .$info->image->name) }}" width="25" alt="صورة المستخدم">
                                @endif
                            </td>
                            <td>{{ $info->employees_code }}</td>
                            <td>{{$info->employee_name}}</td>
                            <td>  <a class="btn btn-info btn-sm"
                                         href="{{route('employees.edit',$info->id)}}" >
                                    <i class="fa fa-pencil-alt"></i> تعديل
                                </a>
                                <a class="btn btn-info btn-sm"
                                href="{{route('employees.show',$info->id)}}" >
                                <i class="fa fa-pencil-alt"></i> عرض
                                </a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $info->id }}">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </td>

@include('Dashboard.employees.delete')

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>



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
