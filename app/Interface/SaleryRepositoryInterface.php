<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface SaleryRepositoryInterface
{
    public function index();

    public function open_month(Request $request, $id);

}
