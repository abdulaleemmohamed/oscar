<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Branchesrequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
           'is_active' => 'required',
            'email' => 'required|email',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم الفرع مطلوب',
            'phone.required' => 'هاتف الفرع مطلوب',
            'address.required' => 'عنوان الفرع مطلوب',
            'is_active.required' => 'حالة تفعيل الفرع مطلوب',
            'email.required' => 'حالة ايميل الفرع مطلوب',
        ];
    }
}
