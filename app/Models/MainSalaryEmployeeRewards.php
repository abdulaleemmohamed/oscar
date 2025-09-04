<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSalaryEmployeeRewards extends Model
{
    use HasFactory;
    protected $fillable = [
        'employees_code',
        'finance_cln_period_id',
        'main_salary_employee_id',
        'emp_day_price',
        'allowance_types_id',
        'total',
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
    public function allowanceType(){
        return $this->belongsTo('\App\Models\Salary_allowances','allowance_types_id');
    }
    public function Approvedby(){
        return $this->belongsTo('\App\Models\Admin','Approved_by');
    }
}
