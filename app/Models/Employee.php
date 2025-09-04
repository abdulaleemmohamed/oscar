<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable');
    }
//    public function jobData()
//    {
//        return $this->hasOne(Job_category::class, 'employee_id');
//    }


    // ✅ الفرع
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    // ✅ المؤهل العلمي
    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'Qualifications_id');
    }

    // ✅ الديانة
    public function religion()
    {
        return $this->belongsTo(Religions::class, 'religion_id');
    }

    // ✅ فصيلة الدم
    public function bloodGroup()
    {
        return $this->belongsTo(Blood_group::class, 'blood_group_id');
    }

    // ✅ الخدمة العسكرية
//    public function militaryService()
//    {
//        return $this->hasOne(::class, 'employee_id');
//    }

    // ✅ بيانات الأقارب (لو جدول مستقل)


    // ✅ نوع رخصة القيادة
    public function drivingLicenseType()
    {
        return $this->belongsTo(Driving_License::class, 'driving_license_types_id');
    }

    // ✅ الدولة (لو موجود جدول)
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // ✅ المحافظة (لو موجود جدول)
    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    // ✅ المدينة (لو موجود جدول)
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function employmentDetails()
    {
        return $this->belongsTo(Employment_detail::class, 'id');
    }

}
