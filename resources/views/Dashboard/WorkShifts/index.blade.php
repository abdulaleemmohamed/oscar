@extends('Dashboard.layouts.master')

@section('title', 'شفتات العمل')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('Work_Shifts.index') }}">شفتات العمل</a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات شفتات العمل</h3>
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#createShift">
                    <i class="fa fa-plus" aria-hidden="true"></i> إضافة شفت جديد
                </button>
            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th>كود الشفت</th>
                        <th>النوع</th>
                        <th>من </th>
                        <th>الي</th>
                        <th>عدد الساعات</th>
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
                            <td>@if($info->shift_type ==1 )
                                صباحي
                                @elseif($info->shift_type ==2 )
                                    مسائي
                                @else
                                    وردية عمل كاملة
                                @endif</td>
                            <td>{{ $info->start_time }}</td>
                            <td>{{ $info->end_time }}</td>
                            <td>{{ $info->work_hours }}</td>
                            <td>{{ $info->is_active ? 'مفعل' : 'معطل' }}</td>
                            <td>{{ $info->added->username }}</td>
                            <td>{{ $info->updated_by ? $info->updatedby->username : 'لا يوجد' }}</td>
                            <td>  <button class="btn btn-info btn-sm" data-toggle="modal"
                                          data-target="#editworkshift{{ $info->id }}">
                                    <i class="fa fa-pencil-alt"></i> تعديل
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteshift{{ $info->id }}">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </td>
                        </tr>
                        @include('Dashboard.WorkShifts.edit')
                        @include('Dashboard.WorkShifts.delete')

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('Dashboard.WorkShifts.create')

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#example2').DataTable({
                language: {
                    url: 'assets/ar.json',
                    searching: false
                }
            });
        });
    </script>
@endsection
