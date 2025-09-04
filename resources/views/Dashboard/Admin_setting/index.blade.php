@extends('Dashboard.layouts.master')
@section('contentheaderactivelink')
    الرئيسية
@endsection
@section('contentheaderactive')
    الضبط العام
@endsection
@section('title')
    الضبط العام
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center">  بيانات الضبط العام للنظام </h3>
            </div>
            <div class="card-body">
                @include('Dashboard.layouts.massges')
                @if(@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <tr>
                            <td class="width30">اسم الشركة</td>
                            <td> {{ $data['company_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30"> حالة التفعيل</td>
                            <td> @if($data['saysem_status']==1) مفعل@else معطل  @endif</td>
                        </tr>
                        <tr>
                            <td class="width30">هاتف الشركة</td>
                            <td> {{ $data['phones'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">عنوان الشركة</td>
                            <td> {{ $data['address'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">بريد الشركة</td>
                            <td> {{ $data['email'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30"> بعد كم دقيقة نحسب تاخير حضور	</td>
                            <td> {{ $data['after_miniute_calculate_delay'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30"> بعد كم دقيقة نحسب انصراف مبكر	</td>
                            <td> {{ $data['after_miniute_calculate_delay'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30"> بعد كم دقيقه مجموع الانصراف المبكر او الحضور المتأخر نحصم ربع يوم	</td>
                            <td> {{ $data['after_miniute_quarterday'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30"> بعد كم مرة تأخير او انصارف مبكر نخصم نص يوم	</td>
                            <td> {{ $data['after_time_half_daycut'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">نخصم بعد كم مره تاخير او انصارف مبكر يوم كامل	</td>
                            <td> {{ $data['after_time_allday_daycut'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">رصيد اجازات الموظف الشهري	</td>
                            <td> {{ $data['monthly_vacation_balance'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">بعد كم يوم ينزل للموظف رصيد اجازات	</td>
                            <td> {{ $data['after_days_begin_vacation'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور للموظف	</td>
                            <td> {{ $data['first_balance_begin_vacation'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">قيمة خصم الايام بعد اول مرة غياب بدون اذن	</td>
                            <td> {{ $data['sanctions_value_first_abcence'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">قيمة خصم الايام بعد ثاني مرة غياب بدون اذن	  	</td>
                            <td> {{ $data['sanctions_value_second_abcence'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">قيمة خصم الايام بعد ثالث مرة غياب بدون اذن	 	</td>
                            <td> {{ $data['sanctions_value_thaird_abcence'] }}</td>
                        </tr>
                        <tr>
                            <td class="width30">قيمة خصم الايام بعد رابع مرة غياب بدون اذن	 	</td>
                            <td> {{ $data['sanctions_value_forth_abcence'] }}</td>
                        </tr>
                        <tr>
                            <td class="width10">لوجو الشركة 	 	</td>
                            <td>    <img style="width: 150px; height: 110px; border-radius: 10px;"
                                         src="{{ asset('storage/images/company/'.$data->com_code .'/'.$data->image) }}"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">  <a href="{{ route('admin_panel_settings.edit') }}" class="btn btn-sm btn-danger">تعديل</a> </td>
                        </tr>
                    </table>
                @else
                    <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
                @endif
            </div>
        </div>
    </div>
@endsection
