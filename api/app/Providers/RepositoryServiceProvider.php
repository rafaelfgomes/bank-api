<?php

namespace App\Providers;

use App\Controllers\Contracts\DepositControllerInterface;
use App\Controllers\Contracts\TransferControllerInterface;
use App\Controllers\Contracts\WithdrawControllerInterface;
use App\Services\AccountService;
use App\Services\Contracts\AccountServiceInterface;
use App\Repositories\AccountRepository;
use App\Repositories\Contracts\AccountRepositoryInterface;
use App\Http\Controllers\Events\DepositController;
use App\Http\Controllers\Events\TransferController;
use App\Http\Controllers\Events\WithdrawController;
use App\Services\Contracts\ResetServiceContract;
use App\Services\ResetService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->singleton(AccountServiceInterface::class, AccountService::class);
        $this->app->singleton(DepositControllerInterface::class, DepositController::class);
        $this->app->singleton(WithdrawControllerInterface::class, WithdrawController::class);
        $this->app->singleton(TransferControllerInterface::class, TransferController::class);
        $this->app->singleton(ResetServiceContract::class, ResetService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
