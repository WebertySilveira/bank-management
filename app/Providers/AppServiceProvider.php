<?php

namespace App\Providers;

use App\Contracts\AccountRepository;
use App\Contracts\TransactionRepository;
use App\Repositories\Account\AccountEloquentRepository;
use App\Repositories\Transaction\TransactionEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AccountRepository::class, AccountEloquentRepository::class);
        $this->app->bind(TransactionRepository::class, TransactionEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
