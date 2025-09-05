<?php

use App\Http\Controllers\AdditionalSalaryController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\citiescontroller;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\fiscal_years_Controller;
use App\Http\Controllers\governoratescontroller;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\nationalitiescontroller;
use App\Http\Controllers\OccasionController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\religionscontroller;
use App\Http\Controllers\ResignationController;
use App\Http\Controllers\Salary\EmployeePenaltieController;
use App\Http\Controllers\Salary\MainSalaryEmployeeAbsenceController;
use App\Http\Controllers\Salary\MainSalaryEmployeeAddtionController;
use App\Http\Controllers\salary\MainSalaryEmployeeAllowancesController;
use App\Http\Controllers\salary\MainSalaryEmployeeDiscountController;
use App\Http\Controllers\salary\MainSalaryEmployeeRewardsController;
use App\Http\Controllers\salary\MainsalaryofemployeeloanController;
use App\Http\Controllers\Salary\MainSaleryRecoerd;
use App\Http\Controllers\SalaryAllowancesController;
use App\Http\Controllers\SalaryDeductionController;
use App\Http\Controllers\WorkShiftController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('Admin/dashboard', function () {
    return view('admindashboard');
})->middleware(['auth:admin'])->name(name: 'Admin.dashboard');

Route::middleware(['auth:admin'])->group(function () {

    Route::resource('Admin_setting',\App\Http\Controllers\Admin_settingController::class);
    Route::get('/generalSettingsEdit', [\App\Http\Controllers\Admin_settingController::class, 'edit'])->name('admin_panel_settings.edit');

    Route::get('/generalSettingsupdate', [\App\Http\Controllers\Admin_settingController::class, 'update'])->name('admin_panel_settings.update');


    /*----------------- fiscal_years---------------------*/

    Route::resource('fiscal_years',\App\Http\Controllers\Finance_calendersController::class);
    Route::post('change_year_status', [\App\Http\Controllers\Finance_calendersController::class, 'change_year_status'])->name('change_year_status');

    /*----------------- end_fiscal_years---------------------*/

    /*-----------------  start_Branches---------------------*/
     Route::resource('Branches',BranchController::class);
    /*----------------- end_Branches---------------------*/
    /*-----------------  start_Work_Shifts---------------------*/
    Route::resource('Work_Shifts',WorkShiftController::class);
    /*----------------- end_Work_Shifts---------------------*/
    /*-----------------  start_departments---------------------*/
    Route::resource('departments',DepartmentController::class);
    /*----------------- end_departments---------------------*/
    /*-----------------  start_job_categories---------------------*/
    Route::resource('job_categories',JobCategoryController::class);
    /*----------------- end_job_categories---------------------*/
    /*-----------------  start_qualifications---------------------*/
    Route::resource('qualifications',QualificationController::class);
    /*----------------- end_qualifications---------------------*/
    /*-----------------  start_Occasion---------------------*/
    Route::resource('occasions',OccasionController::class);
    /*----------------- end_Occasion---------------------*/
    /*-----------------  start_resignations---------------------*/
    Route::resource('resignations',ResignationController::class);
    /*----------------- end_resignations---------------------*/
    /*-----------------  start_nationalities---------------------*/
    Route::resource('nationalities',nationalitiesController::class);
    /*----------------- end_nationalities---------------------*/
    /*-----------------  start_religions---------------------*/
    Route::resource('religions',religionsController::class);
    /*----------------- end_religions---------------------*/
    /*-----------------  start_governorates---------------------*/
    Route::resource('governorates',governoratesController::class);
    /*----------------- end_governorates---------------------*/
    /*-----------------  start_cities---------------------*/
    Route::resource('cities',citiesController::class);
    /*----------------- end_cities---------------------*/
    /*-----------------  start_employee---------------------*/
    Route::resource('employees',EmployeeController::class);
    Route::post("employees/get_governorates", [EmployeeController::class, 'get_governorates'])->name('employees.get_governorates');
    Route::post("employees/get_centers", [EmployeeController::class, 'get_centers'])->name('employees.get_centers');
    /*----------------- end_employee---------------------*/
    /*-----------------  start_Additional salary---------------------*/
    Route::resource('Additional_salary',AdditionalSalaryController::class);
    /*----------------- end_Additional salary---------------------*/
    /*-----------------  start_salary deduction---------------------*/
    Route::resource('salary_deduction',SalaryDeductionController::class);
    /*----------------- end_salary deduction---------------------*/
    /*-----------------  start_Salary allowances---------------------*/
    Route::resource('Salary_allowances',SalaryAllowancesController::class);
    /*----------------- end_Salary allowances---------------------*/
    /*-----------------  start_Salary MAin---------------------*/
    Route::resource('Main_Salery',MainSaleryRecoerd::class);
    Route::post('Main_Salery/open_month/{id}',[MainSaleryRecoerd::class,'open_month'],)->name('Main_Salery.open_month');
    /*----------------- end_Salary Main---------------------*/
    /*-----------------  start_employee_penaltie---------------------*/
    Route::resource('employee_penaltie',EmployeePenaltieController::class);
    Route::get('employee_penaltie/show_month/{id}',[EmployeePenaltieController::class,'show_months'])->name('employee_penaltie.show_month');
    Route::post('/get-salary', [EmployeePenaltieController::class, 'getSalary'])->name('get.salary');
    Route::post('/check_exit', [EmployeePenaltieController::class, 'check_exit'])->name('check_exit');
    Route::post('/employee-penaltie/update', [EmployeePenaltieController::class, 'update'])->name('employee_penaltie.update');
    Route::get('employee-penalties/print/{periodId}', [EmployeePenaltieController::class, 'printPenalties'] )->name('employee-penalties.print');
    /*----------------- end_employee_penaltie---------------------*/
    Route::resource('MainSalaryEmployeeAbsence',MainSalaryEmployeeAbsenceController::class);
    Route::get('MainSalaryEmployeeAbsence/show_month/{id}',[MainSalaryEmployeeAbsenceController::class,'show_months'])->name('MainSalaryEmployeeAbsence.show_month');
    Route::post('/get-salary', [MainSalaryEmployeeAbsenceController::class, 'getSalary'])->name('get.salary');
    Route::post('/check_exit', [MainSalaryEmployeeAbsenceController::class, 'check_exit'])->name('check_exit');
    Route::post('/MainSalaryEmployeeAbsence/update', [MainSalaryEmployeeAbsenceController::class, 'update'])->name('MainSalaryEmployeeAbsence.update');
    Route::get('MainSalaryEmployeeAbsences/print/{periodId}', [MainSalaryEmployeeAbsenceController::class, 'printAbsences'] )->name('MainSalaryEmployeeAbsence.print');
    /*----------------- end_MainSalaryEmployeeAbsence---------------------*/
    /*----------------- start_MainSalaryEmployeeAddition---------------------*/
    Route::resource('MainSalaryEmployeeAddtion',MainSalaryEmployeeAddtionController::class);
    Route::get('MainSalaryEmployeeAddtion/show_month/{id}',[MainSalaryEmployeeAddtionController::class,'show_months'])->name('MainSalaryEmployeeAddtion.show_month');
    Route::post('/get-salary', [MainSalaryEmployeeAddtionController::class, 'getSalary'])->name('get.salary');
    Route::post('/check_exit', [MainSalaryEmployeeAddtionController::class, 'check_exit'])->name('check_exit');
    Route::post('/MainSalaryEmployeeAddtion/update', [MainSalaryEmployeeAddtionController::class, 'update'])->name('MainSalaryEmployeeAddtion.update');
    Route::get('MainSalaryEmployeeAddtion/print/{periodId}', [MainSalaryEmployeeAddtionController::class, 'printAbsences'] )->name('MainSalaryEmployeeAddtion.print');
    /*----------------- end_MainSalaryEmployeeAddtion---------------------*/
    /*----------------- start_MainSalaryEmployeeDiscount---------------------*/
    Route::resource('MainSalaryEmployeeDiscount',MainSalaryEmployeeDiscountController::class);
    Route::get('MainSalaryEmployeeDiscount/show_month/{id}',[MainSalaryEmployeeDiscountController::class,'show_months'])->name('MainSalaryEmployeeDiscount.show_month');
    Route::post('/get-salary', [MainSalaryEmployeeDiscountController::class, 'getSalary'])->name('get.salary');
    Route::post('/check_exit', [MainSalaryEmployeeDiscountController::class, 'check_exit'])->name('check_exit');
    Route::post('/MainSalaryEmployeeDiscount/update', [MainSalaryEmployeeDiscountController::class, 'update'])->name('MainSalaryEmployeeDiscount.update');
    Route::get('MainSalaryEmployeeDiscount/print/{periodId}', [MainSalaryEmployeeDiscountController::class, 'print'] )->name('MainSalaryEmployeeDiscount.print');
    /*----------------- end_MainSalaryEmployeeDiscount---------------------*/
    /*----------------- start_MainSalaryEmployeeRewards---------------------*/
    Route::resource('MainSalaryEmployeeRewards',MainSalaryEmployeeRewardsController::class);
    Route::get('MainSalaryEmployeeRewards/show_month/{id}',[MainSalaryEmployeeRewardsController::class,'show_months'])->name('MainSalaryEmployeeRewards.show_month');
    Route::post('/get-salary', [MainSalaryEmployeeRewardsController::class, 'getSalary'])->name('get.salary');
    Route::post('/check_exit', [MainSalaryEmployeeRewardsController::class, 'check_exit'])->name('check_exit');
    Route::post('/MainSalaryEmployeeRewards/update', [MainSalaryEmployeeRewardsController::class, 'update'])->name('MainSalaryEmployeeRewards.update');
    Route::get('MainSalaryEmployeeRewards/print/{periodId}', [MainSalaryEmployeeRewardsController::class, 'print'] )->name('MainSalaryEmployeeRewards.print');
    /*----------------- end_MainSalaryEmployeeRewards---------------------*/
    /*----------------- start_MainSalaryEmployeeAllowances---------------------*/
    Route::resource('MainSalaryEmployeeAllowances',MainSalaryEmployeeAllowancesController::class);
    Route::get('MainSalaryEmployeeAllowances/show_month/{id}',[MainSalaryEmployeeAllowancesController::class,'show_months'])->name('MainSalaryEmployeeAllowances.show_month');
    Route::post('/get-salary', [MainSalaryEmployeeAllowancesController::class, 'getSalary'])->name('get.salary');
    Route::post('/check_exit', [MainSalaryEmployeeAllowancesController::class, 'check_exit'])->name('check_exit');
    Route::post('/MainSalaryEmployeeAllowances/update', [MainSalaryEmployeeAllowancesController::class, 'update'])->name('MainSalaryEmployeeAllowances.update');
    Route::get('MainSalaryEmployeeAllowances/print/{periodId}', [MainSalaryEmployeeAllowancesController::class, 'print'] )->name('MainSalaryEmployeeAllowances.print');
    /*----------------- end_MainSalaryEmployeeAllowances---------------------*/
    /*----------------- start_MainSalaryEmployeeLoans---------------------*/
    Route::resource('MainSalaryEmployeeLoans', MainsalaryofemployeeloanController::class);
    Route::get('MainSalaryEmployeeLoans/show_month/{id}', [MainsalaryofemployeeloanController::class, 'show_months'])->name('MainSalaryEmployeeLoans.show_month');
    Route::post('/get-salary', [MainsalaryofemployeeloanController::class, 'getSalary'])->name('get.salary');
    Route::post('/check_exit', [MainsalaryofemployeeloanController::class, 'check_exit'])->name('check_exit');
    Route::post('/MainSalaryEmployeeLoans/update', [MainsalaryofemployeeloanController::class, 'update'])->name('MainSalaryEmployeeLoans.update');
    Route::get('MainSalaryEmployeeLoans/print/{periodId}', [MainsalaryofemployeeloanController::class, 'print'])->name('MainSalaryEmployeeLoans.print');
});

require __DIR__ . '/auth.php';
