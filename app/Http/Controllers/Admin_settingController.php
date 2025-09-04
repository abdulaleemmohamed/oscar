<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin_panel_settingRequest;
use App\Models\Admin;
use App\Models\admin_panel_setting;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin_settingController extends Controller
{
    public function index()
    {
        $data = admin_panel_setting::select('*')->first();
        return view('Dashboard.Admin_setting.index', ['data' => $data]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit()
    {
        $data = admin_panel_setting::select('*')->first();
        return view('Dashboard.Admin_setting.edit', ['data' => $data]);

    }

    public function update(Admin_panel_settingRequest $request)
    {
        try {
            DB::beginTransaction();
            $com_code = auth()->user()->com_code;
            $dataToUpdate['company_name'] = $request->company_name;
            $dataToUpdate['phones'] = $request->phones;
            $dataToUpdate['address'] = $request->address;
            $dataToUpdate['email'] = $request->email;
            $dataToUpdate['after_miniute_calculate_delay'] = $request->after_miniute_calculate_delay;
            $dataToUpdate['after_miniute_calculate_early_departure'] = $request->after_miniute_calculate_early_departure;
            $dataToUpdate['after_miniute_quarterday'] = $request->after_miniute_quarterday;
            $dataToUpdate['after_time_half_daycut'] = $request->after_time_half_daycut;
            $dataToUpdate['after_time_allday_daycut'] = $request->after_time_allday_daycut;
            $dataToUpdate['monthly_vacation_balance'] = $request->monthly_vacation_balance;
            $dataToUpdate['after_days_begin_vacation'] = $request->after_days_begin_vacation;
            $dataToUpdate['first_balance_begin_vacation'] = $request->first_balance_begin_vacation;
            $dataToUpdate['sanctions_value_first_abcence'] = $request->sanctions_value_first_abcence;
            $dataToUpdate['sanctions_value_second_abcence'] = $request->sanctions_value_second_abcence;
            $dataToUpdate['sanctions_value_thaird_abcence'] = $request->sanctions_value_thaird_abcence;
            $dataToUpdate['sanctions_value_forth_abcence'] = $request->sanctions_value_forth_abcence;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $adminSetting = admin_panel_setting::where(['com_code' => $com_code])->first();
            $adminSetting->update($dataToUpdate);

            // لو فيه لوجو جديد مرفوع
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $extension = $file->getClientOriginalExtension();
                $filename = "logo_" .   $com_code . $adminSetting->company_name . "." . $extension;

                $folder = 'company/' . $com_code;
                $path = $file->storeAs($folder, $filename, 'images');

                // حفظ الصورة في جدول الصور وربطها بالشركة
                $dataToUpdate['image'] = $filename;
            }

            $adminSetting = admin_panel_setting::where(['com_code' => $com_code])->first();
            $adminSetting->update($dataToUpdate);
            DB::commit();

            return redirect()->route('Admin_setting.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما'])->withInput();
        }

    }
    public function destroy($id)
    {
    }
}
