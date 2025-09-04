@extends('Dashboard.layouts.master')
@section('title')
    الشهور المالية
@endsection
@section('contentheader')
    الشهور المالية
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('fiscal_years.index') }}">  السنوات المالية</a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            @include('Dashboard.layouts.massges');
            <div class="card-header">
                <h3 class="card-title card_title_center">  بيانات الشهور المالية
                </h3>
            </div>
            <div class="card-body">

@if(@isset($finance_cln_periods) and !@empty($finance_cln_periods) )
    <table id="example2" class="table table-bordered table-hover">
        <thead class="custom_thead">
        <th>  اسم الشهر عربي</th>
        <th>  اسم الشهر انجليزي</th>
        <th>  تاريخ البداية</th>
        <th>  تاريخ النهاية</th>
        <th>   عدد الايام</th>
        <th>    حالة الشهر</th>
        <th>  الاضافة بواسطة</th>
        <th>  التحديث بواسطة</th>

        </thead>
        <tbody>
        @foreach ( $finance_cln_periods as $info )
            <tr>
                <td> {{ $info->Month->name_ar }} </td>
                <td> {{ $info->Month->name_en }} </td>
                <td> {{ $info->START_DATE_M }} </td>
                <td> {{ $info->END_DATE_M }} </td>
                <td> {{ $info->number_of_days }} </td>
                <td> @if($info->is_open==1) مفتوح @elseif ($info->is_open==2) مؤرشف @else  مغلق @endif</td>

                <td>{{ $info->added->username }} </td>
                <td>
                    @if($info->updated_by>0)
                        {{ $info->updatedby->username }}
                    @else
                        لايوجد
                    @endif
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif

            </div>
        </div>
    </div>
@endsection
