<?php

namespace App\Interface;

interface employee_penaltiesRepositoryInterface
{
public function index();

    public function show_months($id);

    public function getSalary( $request);
    public function check_exit( $request);
    public function store( $request);
    public function destroy( $request);
    public function update( $request );
    public function printPenalties($periodId);



}
