<?php

namespace App\Http\Controllers\salary;

use App\Http\Controllers\Controller;
use App\Interface\MainSalaryEmployeeDiscountInterface;
use Illuminate\Http\Request;

class MainSalaryEmployeeDiscountController extends Controller
{
    private $MainSalaryEmployeeDiscount;

    public function __construct(MainSalaryEmployeeDiscountInterface $MainSalaryEmployeeDiscount)
    {
        $this->MainSalaryEmployeeDiscount = $MainSalaryEmployeeDiscount;
    }
    public function index()
    {

        return $this->MainSalaryEmployeeDiscount->index();
    }

    public function show_months($id)
    {

        return $this->MainSalaryEmployeeDiscount->show_months($id);
    }
    public function getSalary(Request $request)
    {
        return$this->MainSalaryEmployeeDiscount->getSalary($request);
    }
    public function check_exit(Request $request)
    {
        return$this->MainSalaryEmployeeDiscount->check_exit($request);
    }
    public function store(Request $request)
    {
        return$this->MainSalaryEmployeeDiscount->store($request);
    }
    public function destroy(Request $request)
    {
        return$this->MainSalaryEmployeeDiscount->destroy($request);
    }
    public function update(Request $request)
    {
        return$this->MainSalaryEmployeeDiscount->update($request);
    }
    public function print($periodId){

        return $this->MainSalaryEmployeeDiscount->print($periodId);
    }
}
