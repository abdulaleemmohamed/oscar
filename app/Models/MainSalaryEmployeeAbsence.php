<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSalaryEmployeeAbsence extends Model
{
    use HasFactory;
    protected $table="main_salary_employee_absences";

    protected $fillable = [
        'employees_code',
        'finance_cln_period_id',
        'month_salary_id',
        'emp_day_salary',
        'days_deducted',
        'total_value',
        'notes',
        'com_code','employee_id','added_by'
    ];
    public function added(){
        return $this->belongsTo('\App\Models\Admin','added_by');
    }
    public function updatedby(){
        return $this->belongsTo('\App\Models\Admin','updated_by');
    }
    public function Employee(){
        return $this->belongsTo('\App\Models\Employee','employee_id');
    }
    public function Approvedby(){
        return $this->belongsTo('\App\Models\Admin','Approved_by');
    }
}
