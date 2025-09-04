<?php

namespace App\Http\Controllers;

use App\Models\Occasion;
use Illuminate\Http\Request;

class OccasionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = Occasion::all();
       return view('Dashboard.occasions.index',compact('data'));
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
            $branch = new Occasion();
            $branch->name = $request->name;
            $branch->from_date = $request->from_date;
            $branch->to_date = $request->to_date;

            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه
            $branch->days_counter = $request->days_counter ?? null;

            // تفعيل الفرع بشكل افتراضي
            $branch->active = $request->active ;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->added_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('occasions.index')
                ->with(['success' => 'تم إضافة المناسبة بنجاح ']);

        } catch (\Exception $ex) {
            // لو حصل خطأ أثناء التنفيذ، رجّع للمستخدم رسالة خطأ
            return redirect()->back()
                ->with(['error' => 'عفوًا، حدث خطأ ما: ' . $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Occasion $occasion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Occasion $occasion)
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
            $branch =Occasion::findorfail($request->id);
            $branch->name = $request->name;
            $branch->from_date = $request->from_date;
            $branch->to_date = $request->to_date;

            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه
            $branch->days_counter = $request->days_counter ?? null;

            // تفعيل الفرع بشكل افتراضي
          //  $branch->active = $request->active ;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->updated_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('occasions.index')
                ->with(['success' => 'تم تعديل المناسبة بنجاح ']);

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
            $delete_Shift=Occasion::findorfail($request->id);
            $delete_Shift->delete();
            return redirect()->back()->with('success', 'Occasion Deleted Successfully');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Occasion Deleted failed',$ex);
        }
    }
}
