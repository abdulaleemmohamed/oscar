<?php

namespace App\Providers;

use App\Interface\employee_penaltiesRepositoryInterface;
use App\Interface\MainSalaryEmployeeAbsenceinterface;
use App\Interface\MainSalaryEmployeeAddtioninterface;
use App\Interface\MainSalaryEmployeeAllowancesInterface;
use App\Interface\MainSalaryEmployeeDiscountInterface;
use App\Interface\MainSalaryEmployeeLoansInterface;
use App\Interface\MainSalaryEmployeeRewardsInterface;
use App\Interface\SaleryRepositoryInterface;
use App\Repository\employee_penaltiesRepository;
use App\Repository\MainSalaryEmployeeAbsenceRepositroy;
use App\Repository\MainSalaryEmployeeAddtionRepositroy;
use App\Repository\MainSalaryEmployeeAllowancesRepositroy;
use App\Repository\MainSalaryEmployeeDiscountRepositroy;
use App\Repository\MainSalaryEmployeeLoansRespositroy;
use App\Repository\MainSalaryEmployeeRewardsRepositroy;
use App\Repository\SaleryRepositry;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       $this->app->bind(SaleryRepositoryInterface::class, SaleryRepositry::class);
        $this->app->bind(employee_penaltiesRepositoryInterface::class, employee_penaltiesRepository::class);
        $this->app->bind(MainSalaryEmployeeAbsenceinterface::class, MainSalaryEmployeeAbsenceRepositroy::class);
        $this->app->bind(MainSalaryEmployeeAddtioninterface::class, MainSalaryEmployeeAddtionRepositroy::class);
        $this->app->bind(MainSalaryEmployeeDiscountInterface::class, MainSalaryEmployeeDiscountRepositroy::class);
        $this->app->bind(MainSalaryEmployeeRewardsInterface::class, MainSalaryEmployeeRewardsRepositroy::class);
        $this->app->bind(MainSalaryEmployeeAllowancesInterface::class, MainSalaryEmployeeAllowancesRepositroy::class);
        $this->app->bind(MainSalaryEmployeeLoansInterface::class, MainSalaryEmployeeLoansRespositroy::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
