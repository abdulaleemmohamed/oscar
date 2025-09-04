@extends('Dashboard.layouts.master')
@section('title')
    الاجور المالية
@endsection
@section('contentheader')
    الاجور المالية
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('fiscal_years.index') }}">  الاجور المالية</a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            @include('Dashboard.layouts.massges')

            <div class="card-body">


                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                        <th>  اسم الشهر عربي</th>
                        <th>  تاريخ البداية</th>
                        <th>  تاريخ النهاية</th>
                        <th>  بداية البصمة  </th>
                        <th>  نهاية البصمة</th>
                        <th>   عدد الايام</th>
                        <th>  الاضافة بواسطة</th>
                        <th>  التحديث بواسطة</th>
                        <th>    حالة الشهر</th>


                        </thead>
                        <tbody>
                        @foreach ( $get_months as $info )
                            <tr>
                                <td> {{ $info->Month->name_ar }} </td>
                                <td> {{ $info->START_DATE_M }} </td>
                                <td> {{ $info->END_DATE_M }} </td>
                                <td> {{ $info->start_date_for_pasma }} </td>
                                <td> {{ $info->end_date_for_pasma }} </td>
                                <td> {{ $info->number_of_days }} </td>
                                <td>{{ $info->added->username }} </td>
                                <td>
                                    @if($info->updated_by>0)
                                        {{ $info->updatedby->username }}
                                    @else
                                        لايوجد
                                    @endif
                                </td>
                                <td>
                                    حالة:
                                    @if($info->is_open == 1)
                                      <span class="badge badge-pill badge-success">مفتوح</span>
                                    @elseif($info->is_open == 2)
                                        مؤرشف
                                    @else
                                        بانتظار الفتح
                                    @endif

                                    <br>

                                    @if(!empty($info->currentYear))
                                        @if($info->currentYear['is_open']==1)
                                            @if($info->is_open==0 and  $info->counterOpenMonth ==0 and $info->counterPreviousMonthWaitingOpen ==0 )
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#attendanceModal{{$info->id}}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>فتح الشهر المالي
                                                </button>
                                            @endif
                                        @endif
                                    @endif
                                </td>



                            </tr>
                            @include('Dashboard.Main_salery.openmonth')
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
<script>
    function confirmWithSweetAlert() {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "سيتم حفظ تواريخ البصمة لهذا الشهر",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'نعم، احفظ',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('attendanceForm').submit();
            }
        });
    }
</script>

