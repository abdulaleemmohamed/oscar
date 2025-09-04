<?php

namespace App\Http\Controllers;

use App\Http\Requests\Branchesrequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Branch::all();
        return view('Dashboard.branchs.index', compact('data'));
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
    public function store(Branchesrequest $request)
    {
//        $this->validate($request, [
//            'name' => 'required',
//            'phone' => 'required',
//            'address' => 'required',
//            'email' => 'required|email',
//        ]);
        try {
            // إنشاء فرع جديد
            $branch = new Branch();
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->phone = $request->phone;

            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه
            $branch->email = $request->email ?? null;

            // تفعيل الفرع بشكل افتراضي
            $branch->active = $request->active ?? 0;

            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            $branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->added_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('Branches.index')
                ->with(['success' => 'تم إضافة الفرع بنجاح ✅']);

        } catch (\Exception $ex) {
            // لو حصل خطأ أثناء التنفيذ، رجّع للمستخدم رسالة خطأ
            return redirect()->back()
                ->with(['error' => 'عفوًا، حدث خطأ ما: ' . $ex->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        try {
            // إنشاء فرع جديد
            $branch = Branch::findorfail($request->id);
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->phone = $request->phone;

            // اختياري: لو حقل الإيميل مش موجود في الـ validation لازم تتأكد منه
            $branch->email = $request->email ?? null;


            // ربط الفرع بالمؤسسة التابعة للمستخدم المسجل حالياً
            //$branch->com_code = auth()->user()->com_code;

            // تخزين من أضاف هذا الفرع
            $branch->updated_by = auth()->user()->id;

            // حفظ البيانات في قاعدة البيانات
            $branch->save();

            // إعادة التوجيه إلى صفحة الفروع مع رسالة نجاح
            return redirect()->route('Branches.index')
                ->with(['success' => 'تم تعديل الفرع بنجاح ✅']);

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
            $delete_branch=Branch::findorfail($request->id);
            $delete_branch->delete();
            return redirect()->back()->with('success', 'Branch Deleted Successfully');
        }
        catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Branch Deleted failed',$ex);
        }
    }
}
