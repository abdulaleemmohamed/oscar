<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Interface\MainSalaryEmployeeAbsenceinterface;
use Illuminate\Http\Request;


class MainSalaryEmployeeAbsenceController extends Controller
{
    private $MainSalaryEmployeeAbsenceController;

    public function __construct(MainSalaryEmployeeAbsenceinterface $MainSalaryEmployeeAbsenceController)
    {
        $this->MainSalaryEmployeeAbsenceController = $MainSalaryEmployeeAbsenceController;
    }

    public function index()
    {

        return $this->MainSalaryEmployeeAbsenceController->index();
    }

    public function show_months($id)
    {

        return $this->MainSalaryEmployeeAbsenceController->show_months($id);
    }
    public function getSalary(Request $request)
    {
        return$this->MainSalaryEmployeeAbsenceController->getSalary($request);
    }
    public function check_exit(Request $request)
    {
        return$this->MainSalaryEmployeeAbsenceController->check_exit($request);
    }
    public function store(Request $request)
    {
        return$this->MainSalaryEmployeeAbsenceController->store($request);
    }
    public function destroy(Request $request)
    {
        return$this->MainSalaryEmployeeAbsenceController->destroy($request);
    }
    public function update(Request $request)
    {
        return$this->MainSalaryEmployeeAbsenceController->update($request);
    }
    public function printAbsences($periodId){

        return $this->MainSalaryEmployeeAbsenceController->printAbsences($periodId);
    }
}
