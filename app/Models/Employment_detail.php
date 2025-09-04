<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment_detail extends Model
{
    use HasFactory;
    public function department()
    {
        return $this->belongsTo(Department::class, 'employee_Departments_code');
    }

    public function job()
    {
        return $this->belongsTo(Job_category::class, 'employee_jobs_id');
    }

    public function shift()
    {
        return $this->belongsTo(Work_shift::class, 'shift_type_id');
    }
    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }



}
