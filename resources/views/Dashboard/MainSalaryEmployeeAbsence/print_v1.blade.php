<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>تقرير الغياب</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">

    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            padding: 20px;
        }

        td {
            font-size: 15px !important;
            text-align: center;
        }

        th {
            text-align: center;
        }

        @media print {
            .hidden-print, #printButton {
                display: none;
            }

            /* Watermark متكرر */
            body::before {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url("{{ asset('storage/images/company/'.$systemData->com_code .'/'.$systemData->image) }}")
                no-repeat center center;
                background-size: 300px 300px;
                opacity: 0.07;
                z-index: -1;
            }

            /* التوقيع يدخل لجوا */
            .signature {
                margin-right: 80px;
                margin-top: 60px;
                text-align: right;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>

<table style="width: 60%; float: right; margin-right: 5px;" dir="rtl">
    <tr>
        <td style="text-align: center; padding: 5px;">
            <span> نوع التقرير </span>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; padding: 10px; font-weight: bold;">
            <span style="display:inline-block;width:500px;height:30px;text-align:center;color:blue;border:1px solid #000;">
                تقرير بسجل غياب الموظفين عن الشهر المالي:
                {{ $month ?? '---' }} سنة {{ $year ?? '---' }}
                (طُبع بواسطة: {{ auth()->user()->name }})
            </span>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; padding: 5px; font-weight: bold;">
            <span style="display: inline-block; width: 200px; height: 30px; text-align: center; color: blue; border: 1px solid black;">
                طبع بتاريخ @php echo date('Y-m-d'); @endphp
            </span>
        </td>
    </tr>
</table>

<table style="width: 35%; float: right; margin-left: 5px;" dir="rtl">
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
    <table dir="rtl" class="table table-bordered table-hover" style="width: 99%; margin: 0 auto;">
        <thead style="background-color: yellow">
        <th style="width: 10%;">#</th>
        <th style="width: 20%;">الموظف</th>
        <th style="width: 15%;">ملاحظات</th>
        <th style="width: 10%;">عدد الأيام / القيمة</th>
        <th style="width: 10%;">القيمة</th>
        <th style="width: 10%;">الحالة</th>
        <th style="width: 15%;">التاريخ</th>
        </thead>
        <tbody>
        @foreach ($data as $info)
            <tr>
                <td>{{  $loop->iteration }}</td>
                <td>{{ $info->Employee->employee_name ?? '---' }}</td>
                <td>{{ $info->notes }}</td>
                <td>{{ $info->days_deducted }}</td>
                <td>{{ $info->total_value }}</td>
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
<p style="padding: 10px; bottom: 0; width: 100%; text-align: center; font-size: 16px; font-weight: bold;">
    {{ $systemData['address'] }} - {{ $systemData['phones'] }}
</p>

<!-- التوقيع -->
<div class="signature">
    التوقيع / الاعتماد: .....................
</div>

<br>
<p class="text-center hidden-print">
    <button onclick="window.print()" class="btn btn-success btn-sm" id="printButton">طباعة</button>
</p>

</body>
</html>
