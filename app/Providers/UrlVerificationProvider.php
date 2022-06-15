<?php

namespace App\Providers;

use App\Contracts\UrlVerificationContract;
use App\Services\UrlVerification\GoogleVerificationService;
use Illuminate\Support\ServiceProvider;

class UrlVerificationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UrlVerificationContract::class, GoogleVerificationService::class);
    }
}
