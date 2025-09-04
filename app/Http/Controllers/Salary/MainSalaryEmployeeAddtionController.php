<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Interface\MainSalaryEmployeeAddtioninterface;
use Illuminate\Http\Request;

class MainSalaryEmployeeAddtionController extends Controller
{
    private $MainSalaryEmployeeAddition;

    public function __construct(MainSalaryEmployeeAddtioninterface $MainSalaryEmployeeAddition)
    {
        $this->MainSalaryEmployeeAddition = $MainSalaryEmployeeAddition;
    }

    public function index()
    {

        return $this->MainSalaryEmployeeAddition->index();
    }

    public function show_months($id)
    {

        return $this->MainSalaryEmployeeAddition->show_months($id);
    }
    public function getSalary(Request $request)
    {
        return$this->MainSalaryEmployeeAddition->getSalary($request);
    }
    public function check_exit(Request $request)
    {
        return$this->MainSalaryEmployeeAddition->check_exit($request);
    }
    public function store(Request $request)
    {
        return$this->MainSalaryEmployeeAddition->store($request);
    }
    public function destroy(Request $request)
    {
        return$this->MainSalaryEmployeeAddition->destroy($request);
    }
    public function update(Request $request)
    {
        return$this->MainSalaryEmployeeAddition->update($request);
    }
    public function printAbsences($periodId){

        return $this->MainSalaryEmployeeAddition->printAbsences($periodId);
    }

}
