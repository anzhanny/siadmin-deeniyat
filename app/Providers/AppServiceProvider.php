<?php

namespace App\Providers;

use App\Http\Repositories\TransactionRepository as RepositoriesTransactionRepository;
use App\Http\Repositories\TransactionRepositoryInterface as RepositoriesTransactionRepositoryInterface;
use Midtrans\Config;


use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RepositoriesTransactionRepositoryInterface::class,
            RepositoriesTransactionRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = config('midtrans.is_sanitized');
    Config::$is3ds = config('midtrans.is_3ds');
}
}
