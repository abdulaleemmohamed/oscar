<?php

namespace App\Http\Controllers\salary;

use App\Http\Controllers\Controller;
use App\Interface\MainSalaryEmployeeAllowancesInterface;
use App\Interface\MainSalaryEmployeeRewardsInterface;
use Illuminate\Http\Request;

class MainSalaryEmployeeRewardsController extends Controller
{
    private $MainSalaryEmployeeRewards;

    public function __construct(MainSalaryEmployeeRewardsInterface $MainSalaryEmployeeRewards)
    {
        $this->MainSalaryEmployeeRewards = $MainSalaryEmployeeRewards;
    }
    public function index()
    {

        return $this->MainSalaryEmployeeRewards->index();
    }

    public function show_months($id)
    {

        return $this->MainSalaryEmployeeRewards->show_months($id);
    }
    public function getSalary(Request $request)
    {
        return$this->MainSalaryEmployeeRewards->getSalary($request);
    }
    public function check_exit(Request $request)
    {
        return$this->MainSalaryEmployeeRewards->check_exit($request);
    }
    public function store(Request $request)
    {
        return$this->MainSalaryEmployeeRewards->store($request);
    }
    public function destroy(Request $request)
    {
        return$this->MainSalaryEmployeeRewards->destroy($request);
    }
    public function update(Request $request)
    {
        return$this->MainSalaryEmployeeRewards->update($request);
    }
    public function print($periodId){

        return $this->MainSalaryEmployeeRewards->print($periodId);
    }
}
