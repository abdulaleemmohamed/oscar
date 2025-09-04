<?php

namespace App\Interface;

interface MainSalaryEmployeeAbsenceinterface
{
    public function index();
    public function show_months($id);

    public function getSalary( $request);
    public function check_exit( $request);
    public function store( $request);
    public function update( $request);
    public function printAbsences($periodId);
}
