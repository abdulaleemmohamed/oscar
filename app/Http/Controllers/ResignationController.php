<?php

namespace App\Http\Controllers;

use App\Models\Resignation;
use Illuminate\Http\Request;

class ResignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Resignation::all();
        return view('Dashboard.resignations.index', compact('data'));
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
            $branch = new Resignation();
            $branch->name = $request->name;


            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه


            // تفعيل الفرع بشكل افتراضي
              $branch->active = $request->active ?? 0;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->added_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('resignations.index')
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
    public function show(Resignation $resignation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resignation $resignation)
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
            $branch =Resignation::findorfail($request->id);
            $branch->name = $request->name;


            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه


            // تفعيل الفرع بشكل افتراضي
              $branch->active = $request->active ?? 0;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->updated_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('resignations.index')
                ->with(['success' => 'تم التعديل  بنجاح ']);

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
        $delete_job=Resignation::findorfail($request->id)->delete();

        return redirect()->back()->with('success', 'Resignation Deleted Successfully');
    }
        catch (\Exception $ex) {
        return redirect()->back()->with('error', 'Resignation Deleted failed',$ex);
    }
    }
}
