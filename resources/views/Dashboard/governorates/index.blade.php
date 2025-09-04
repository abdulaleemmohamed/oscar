@extends('Dashboard.layouts.master')

@section('title', 'الديانات ')

@section('contentheader', 'قائمة الضبط')

@section('contentheaderactivelink')
    <a href="{{ route('nationalities.index') }}">الديانات  </a>
@endsection

@section('contentheaderactive', 'عرض')

@section('content')

    @include('Dashboard.layouts.massges')

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title card_title_center">بيانات الديانات </h3>

            </div>

            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th>كود الادارة</th>
                        <th>الاسم</th>
                        <th>تمت الإضافة بواسطة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $info)
                        <tr>
                            <td>{{ $info->id }}</td>
                            <td>{{$info->name}}</td>
                            <td>{{ $info->added->username }}</td>


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
