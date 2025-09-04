<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>تقرير الجزاءات</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
    <style>
        @media print {
            .hidden-print, #printButton {
                display: none;
            }
        }

        td {
            font-size: 15px !important;
            text-align: center;
        }
        th{
            text-align: center;
        }
    </style>
</head>

<body style="padding-top: 10px;font-family: tahoma;">

<table style="width: 60%;float: right; margin-right: 5px;" dir="rtl">
    <tr>
        <td style="text-align: center;padding: 5px;"> <span> نوع التقرير </span></td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 10px;font-weight: bold;">
    <span style="display:inline-block;width:500px;height:30px;text-align:center;color:blue;border:1px solid #000;"> تقرير بسجل جزءات الموظفين عن
    الشهر المالي: {{ $month ?? '---' }} سنة{{ $year ?? '---' }}
</span>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 5px;font-weight: bold;">
            <span style="display: inline-block; width: 200px; height: 30px; text-align: center; color: blue; border: 1px solid black;">
               طبع بتاريخ @php echo date('Y-m-d'); @endphp
            </span>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;padding: 5px;font-weight: bold;">
            <span style="display: inline-block; width: 200px; height: 30px; text-align: center; color: blue; border: 1px solid black;">
               طبع بواسطة {{ auth()->user()->name }}
            </span>
        </td>
    </tr>
</table>

<table style="width: 35%;float: right; margin-left: 5px;" dir="rtl">
    <tr>
        <td style="text-align:left !important;padding: 5px;">
            <img style="width: 150px; height: 110px; border-radius: 10px;"
                 src="{{ asset('storage/images/company/'.$systemData->com_code .'/'.$systemData->image) }}">
            <p>{{ $systemData->company_name }}</p>
        </td>

    </tr>
</table>

<br><br><br><br>

@if(isset($data) && count($data)>0)
    <table dir="rtl" class="table table-bordered table-hover" style="width: 99%;margin: 0 auto;">
        <thead style="background-color: yellow">
        <th style="width: 10%;">#</th>
        <th style="width: 20%;">الموظف</th>
        <th style="width: 15%;">النوع</th>
        <th style="width: 10%;">عدد الأيام / القيمة</th>
        <th style="width: 10%;"> القيمة</th>
        <th style="width: 10%;">الحالة</th>
        <th style="width: 15%;">التاريخ</th>
        </thead>

        <tbody>
        @foreach ($data as $info)
            <tr>
                <td>{{  $loop->iteration}}</td>
                <td>{{ $info->Employee->employee_name ?? '---' }}</td>
                <td>{{ $info->Sanctions_types == 1 ? 'تحقيق' : ($info->Sanctions_types == 2 ? 'غياب' : 'غير محدد') }}</td>
                <td>{{ $info->days_deducted }}</td>
                <td>{{  $info->total_value }}</td>
                <td>@if($info->is_approved==1) معتمد @else غير معتمد @endif</td>
                <td>{{ $info->created_at->format('Y-m-d') }}</td>
            </tr>

        @endforeach
        <tr>
            <td colspan="3" style="background-color:lightsalmon; text-align:center; font-weight:bold;">
                الإجمالي
            </td>
            <td style="background-color: lightgreen; text-align: right;">
                {{ number_format($total_days, 0) }} يوم
            </td>
            <td style="background-color: lightgreen; text-align: right;">
                {{ number_format($total_value, 2) }} جنيه
            </td>
        </tr>
        </tbody>
    </table>
@else
    <p class="text-center" style="font-size: 16px; font-weight: bold; color: brown">
        عفوا لاتوجد بيانات لعرضها !!
    </p>
@endif

<br>
<p style="padding: 10px 10px 0px 10px; bottom: 0; width: 100%; text-align: center; font-size: 16px; font-weight: bold;">
    {{ $systemData['address'] }} - {{ $systemData['phones'] }}
</p>

<br>
<p class="text-center hidden-print">
    <button onclick="window.print()" class="btn btn-success btn-sm" id="printButton">طباعة</button>
</p>

</body>
</html>
