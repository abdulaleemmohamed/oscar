<?php

namespace App\Http\Controllers;

use App\Models\Additional_salary;
use Illuminate\Http\Request;

class AdditionalSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Additional_salary::all();
       return view('Dashboard.Additional_salary.index',compact('data'));
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
            $Additional_salary = new Additional_salary();
            $Additional_salary->name = $request->name;


            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه


            // تفعيل الفرع بشكل افتراضي
            $Additional_salary->active = $request->active ?? 0;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $Additional_salary->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $Additional_salary->added_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $Additional_salary->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('Additional_salary.index')
                ->with(['success' => 'تم إضافة المؤهل بنجاح ']);

        } catch (\Exception $ex) {
            // لو حصل خطأ أثناء التنفيذ، رجّع للمستخدم رسالة خطأ
            return redirect()->back()
                ->with(['error' => 'عفوًا، حدث خطأ ما: ' . $ex->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Additional_salary $additional_salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Additional_salary $additional_salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
        $branch =Additional_salary::findorfail($request->id);
        $branch->name = $request->name;


        // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه


        // تفعيل الفرع بشكل افتراضي
        // $branch->active = $request->active ?? 0;

        // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
        $branch->com_code = auth()->user()->com_code;

        // تخزين من أضاف هذا الفرع
        $branch->updated_by = auth()->user()->id;

        // حفظ البيانات في قاعدة البيانات
        $branch->save();

        // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
        return redirect()->route('Additional_salary.index')
            ->with(['success' => 'تم تعديل المؤهل بنجاح ']);

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
            $delete_job=Additional_salary::findorfail($request->id)->delete();

            return redirect()->back()->with('success', 'Qualification Deleted Successfully');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Qualification Deleted failed',$ex);
        }
    }
}
