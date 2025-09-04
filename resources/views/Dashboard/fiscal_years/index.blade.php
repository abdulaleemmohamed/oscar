@extends('Dashboard.layouts.master')
@section('title')
    السنوات المالية
@endsection
@section('contentheader')
    قائمة الضبط
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
                <h3 class="card-title card_title_center">  بيانات السنوات المالية
                    <a href="{{ route('fiscal_years.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
                </h3>
            </div>
            <div class="card-body">

                @if(@isset($data) and !@empty($data) )
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                        <th> كود السنة</th>
                        <th> وصف السنة</th>
                        <th>  تاريخ البداية</th>
                        <th>  تاريخ النهاية</th>
                        <th>  الاضافة بواسطة</th>
                        <th>  التحديث بواسطة</th>
                        <th>التفاصيل </th>
                        </thead>
                        <tbody>
                        @foreach ( $data as $info )
                            <tr>
                                <td><a href="{{route('fiscal_years.show',$info->id)}}">{{ $info->FINANCE_YR }}</a>  </td>
                                <td> {{ $info->FINANCE_YR_DESC }} </td>
                                <td> {{ $info->start_date }} </td>
                                <td> {{ $info->end_date }} </td>
                            <td>  {{$info->added->username}}  </td>
                                <td>
                                    @if($info->updated_by>0)
                                        {{ $info->updatedby->username }}
                                    @else
                                        لايوجد
                                    @endif
                                </td>
                                <td>
                                    @if($info->is_open==0)
                                        <a  href="{{ route('fiscal_years.edit',$info->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>
                                            تعديل</a>

                                        <button type="button" class="btn  btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$info->id}}">
                                           <i class="fa fa-trash" aria-hidden="true"></i>
                                           حذف

                                       </button>
                                    @if($finance_year_count ==0)
                                            <button type="button" class="btn  btn-sm btn-info" data-toggle="modal" data-target="#open{{$info->id}}">
                                                <i class="fa fa-info" aria-hidden="true"></i> فتح السنة المالية</button>
                                    @endif
                                    @else
                                       <span class="badge badge-pill badge-success  text-center">سنة مالية مفتوحة</span>
                                    @endif

                                </td>
                            </tr>
                            @include('Dashboard.fiscal_years.delete')
                            @include('Dashboard.fiscal_years.change_year_status')
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
                @endif

            </div>
        </div>
    </div>

    <div class="modal fade " id="show_year_monthesModal" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">عرض الشهور  للسنة المالية</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="show_year_monthesModalBody">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline-light">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click','.show_year_monthes',function(){
                var id=$(this).data('id');
                jQuery.ajax({
                    url:'',
                    type:'post',
                    'dataType':'html',
                    cache:false,
                    data:{ "_token":'{{ csrf_token() }}','id':id },
                    success:function(data){
                        $("#show_year_monthesModalBody").html(data);
                        $("#show_year_monthesModal").modal("show");
                    },
                    error:function(){

                    }

                });


            });
        });


    </script>
@endsection
