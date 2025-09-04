<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_name' => 'required|string|max:255',
           'zketo_code' => 'required|string|max:255',
           'employee_gender' => 'required|string|max:255',
            'branch_id' => 'required',
           'Qualifications_id' => 'required',
           'Qualifications_year' => 'required',

           //'employee_national_identity' => 'required',
          // 'employee_identityPlace' => 'required',
         //  'employee_end_identityIDate' => 'required|date',
            'blood_group_id' => 'required',
            'employee_Departments_code' => 'required',
            'employee_jobs_id' => 'required',
            'employee_sal' => 'required|integer|min:1',
            'MotivationType' => 'required',
            'isSocialnsurance' => 'required',
            'ismedicalinsurance' => 'required',
            'sal_cach_or_visa' => 'required',
            'brith_date' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_name.required' => 'اسم الموظف مطلوب',
            'zketo_code.required' => 'كود البصمة مطلوب',
            'employee_gender.required' => 'اختيار الجنس مطلوب',
            'branch_id.required' => 'اختيار الفرع مطلوب',
            'Qualifications_id.required' => 'اختيار المؤهل مطلوب',
            'Qualifications_year.required' => 'سنة التخرج مطلوبة',
            'employee_national_identity.required' => 'أرقام الهوية مطلوبة',
            'employee_national_identity.digits' => 'الهوية يجب أن تكون 14 رقمًا',
            'employee_identityPlace.required' => 'مكان استخراج الهوية مطلوب',
            'employee_end_identityIDate.required' => 'تاريخ نهاية الهوية مطلوب',
            'blood_group_id.required' => 'فصيلة الدم مطلوبة',
            'employee_Departments_code.required' => 'الإدارة مطلوبة',
            'employee_jobs_id.required' => 'الوظيفة مطلوبة',
            'employee_sal.required' => 'اختيار الراتب مطلوب',
            'employee_sal.integer' => 'الراتب يجب أن يكون رقماً',
            'employee_sal.min' => 'الراتب يجب ألا يقل عن 1',
            'MotivationType.required' => 'اختيار نوع الحافز مطلوب',
            'isSocialnsurance.required' => 'اختيار التأمين الاجتماعي مطلوب',
            'ismedicalinsurance.required' => 'اختيار التأمين الطبي مطلوب',
            'sal_cach_or_visa.required' => 'اختيار طريقة الدفع مطلوب',
            'brith_date.required' => 'اختيار تاريخ الميلاد مطلوب',
            'brith_date.date' => 'تاريخ الميلاد يجب أن يكون بصيغة صحيحة',
        ];
    }
}
