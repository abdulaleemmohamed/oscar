<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Interface\employee_penaltiesRepositoryInterface;
use Illuminate\Http\Request;

class EmployeePenaltieController extends Controller
{
    private $EmployeePenaltie;

    public function __construct(employee_penaltiesRepositoryInterface $EmployeePenaltie)
    {
        $this->EmployeePenaltie = $EmployeePenaltie;
    }


    public function index(){

        return $this->EmployeePenaltie->index();
    }

    public function show_months($id){

        return $this->EmployeePenaltie->show_months($id);
    }
    public function getSalary(Request $request)
    {
        return$this->EmployeePenaltie->getSalary($request);
    }
    public function check_exit(Request $request)
    {
        return$this->EmployeePenaltie->check_exit($request);
    }
    public function store(Request $request)
    {
        return$this->EmployeePenaltie->store($request);
    }
    public function destroy(Request $request)
    {
        return$this->EmployeePenaltie->destroy($request);
    }
    public function update(Request $request)
    {
        return$this->EmployeePenaltie->update($request);
    }
    public function printPenalties($periodId){

        return $this->EmployeePenaltie->printPenalties($periodId);
    }
}
