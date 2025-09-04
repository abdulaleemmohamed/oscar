<?php

namespace App\Http\Controllers;

use App\Models\Job_category;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = Job_category::all();
       return view('Dashboard.job_categories.index',compact('data'));
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
            $branch = new Job_category();
            $branch->name = $request->name;


            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه


            // تفعيل الفرع بشكل افتراضي
          //  $branch->active = $request->active ?? 0;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->added_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('job_categories.index')
                ->with(['success' => 'تم إضافة الوظيفية بنجاح ']);

        } catch (\Exception $ex) {
            // لو حصل خطأ أثناء التنفيذ، رجّع للمستخدم رسالة خطأ
            return redirect()->back()
                ->with(['error' => 'عفوًا، حدث خطأ ما: ' . $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Job_category $job_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job_category $job_category)
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
            $branch =Job_category::findorfail($request->id);
            $branch->name = $request->name;


            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه


            // تفعيل الفرع بشكل افتراضي
            //  $branch->active = $request->active ?? 0;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->updated_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('job_categories.index')
                ->with(['success' => 'تم تعديل الوظيفية بنجاح ']);

        } catch (\Exception $ex) {
            // لو حصل خطأ أثناء التنفيذ، رجّع للمستخدم رسالة خطأ
            return redirect()->back()
                ->with(['error' => 'عفوًا، حدث خطأ ما: ' . $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request $request)
    {

        try {
            $delete_job=Job_category::findorfail($request->id)->delete();

            return redirect()->back()->with('success', 'job_catrgory Deleted Successfully');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error', 'job_catrgory Deleted failed',$ex);
        }
    }
}
