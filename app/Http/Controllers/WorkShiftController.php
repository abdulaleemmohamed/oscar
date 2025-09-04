<?php

namespace App\Http\Controllers;

use App\Models\Work_shift;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class WorkShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $com_code=auth()->user()->com_code;
        $data = Work_shift::all();
        return view('Dashboard.workShifts.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // إنشاء فرع جديد
            $branch = new Work_shift();
            $branch->shift_type = $request->shift_type;
            $branch->start_time = $request->start_time;
            $branch->end_time = $request->end_time;

            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه
            $branch->work_hours = $request->work_hours ?? null;

            // تفعيل الفرع بشكل افتراضي
            $branch->active = $request->active ?? 0;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->added_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('Work_Shifts.index')
                ->with(['success' => 'تم إضافة الشفت بنجاح ']);

        } catch (\Exception $ex) {
            // لو حصل خطأ أثناء التنفيذ، رجّع للمستخدم رسالة خطأ
            return redirect()->back()
                ->with(['error' => 'عفوًا، حدث خطأ ما: ' . $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Work_shift $work_shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work_shift $work_shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            // إنشاء فرع جديد
            $branch =Work_shift::findorfail($request->id);
            $branch->shift_type = $request->shift_type;
            $branch->start_time = $request->start_time;
            $branch->end_time = $request->end_time;

            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه
            $branch->work_hours = $request->work_hours ?? null;

            // تفعيل الفرع بشكل افتراضي
           // $branch->active = $request->active ?? 0;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->updated_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('Work_Shifts.index')
                ->with(['success' => 'تم تعديل الشفت بنجاح ']);

        } catch (\Exception $ex) {
            // لو حصل خطأ أثناء التنفيذ، رجّع للمستخدم رسالة خطأ
            return redirect()->back()
                ->with(['error' => 'عفوًا، حدث خطأ ما: ' . $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $delete_Shift=Work_shift::findorfail($request->id);
            $delete_Shift->delete();
            return redirect()->back()->with('success', 'Shift Deleted Successfully');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Shift Deleted failed',$ex);
        }
    }
}
