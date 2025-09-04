<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Interface\SaleryRepositoryInterface;
use Illuminate\Http\Request;

class MainSaleryRecoerd extends Controller
{
    private $SaleryRepository;

    public function __construct(SaleryRepositoryInterface $SaleryRepository)
    {
        $this->SaleryRepository = $SaleryRepository;
    }


    public function index(){

        return $this->SaleryRepository->index();
    }

    public function open_month( Request $request ,$id){
        return $this->SaleryRepository->open_month($request,$id);
    }
}
