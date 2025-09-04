<?php

namespace App\Http\Controllers\salary;

use App\Http\Controllers\Controller;
use App\Interface\MainSalaryEmployeeAllowancesInterface;
use Illuminate\Http\Request;

class MainSalaryEmployeeAllowancesController extends Controller
{
    private $MainSalaryEmployeeAllowances;

    public function __construct(MainSalaryEmployeeAllowancesInterface $MainSalaryEmployeeAllowances)
    {
        $this->MainSalaryEmployeeAllowances = $MainSalaryEmployeeAllowances;
    }
    public function index()
    {

        return $this->MainSalaryEmployeeAllowances->index();
    }

    public function show_months($id)
    {

        return $this->MainSalaryEmployeeAllowances->show_months($id);
    }
    public function getSalary(Request $request)
    {
        return$this->MainSalaryEmployeeAllowances->getSalary($request);
    }
    public function check_exit(Request $request)
    {
        return$this->MainSalaryEmployeeAllowances->check_exit($request);
    }
    public function store(Request $request)
    {
        return$this->MainSalaryEmployeeAllowances->store($request);
    }
    public function destroy(Request $request)
    {
        return$this->MainSalaryEmployeeAllowances->destroy($request);
    }
    public function update(Request $request)
    {
        return$this->MainSalaryEmployeeAllowances->update($request);
    }
    public function print($periodId){

        return $this->MainSalaryEmployeeAllowances->print($periodId);
    }
}
