<?php

namespace App\Http\Controllers\salary;

use App\Http\Controllers\Controller;
use App\Interface\MainSalaryEmployeeLoansInterface;
use Illuminate\Http\Request;

class MainsalaryofemployeeloanController extends Controller
{
    private $MainSalaryEmployeeLoans;

    public function __construct(MainSalaryEmployeeLoansInterface $MainSalaryEmployeeLoans)
    {
        $this->MainSalaryEmployeeLoans = $MainSalaryEmployeeLoans;
    }

    public function index()
    {

        return $this->MainSalaryEmployeeLoans->index();
    }

    public function show_months($id)
    {

        return $this->MainSalaryEmployeeLoans->show_months($id);
    }

    public function getSalary(Request $request)
    {
        return $this->MainSalaryEmployeeLoans->getSalary($request);
    }

    public function check_exit(Request $request)
    {
        return $this->MainSalaryEmployeeLoans->check_exit($request);
    }

    public function store(Request $request)
    {
        return $this->MainSalaryEmployeeLoans->store($request);
    }

    public function destroy(Request $request)
    {
        return $this->MainSalaryEmployeeLoans->destroy($request);
    }

    public function update(Request $request)
    {
        return $this->MainSalaryEmployeeLoans->update($request);
    }

    public function print($periodId)
    {

        return $this->MainSalaryEmployeeLoans->print($periodId);
    }
}
