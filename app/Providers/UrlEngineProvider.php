<?php

namespace App\Providers;

use App\Contracts\UrlEngineContract;
use App\Services\ShortenerEngine\Base62Encoder;
use Illuminate\Support\ServiceProvider;

class UrlEngineProvider extends ServiceProvider
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
        $this->app->bind(UrlEngineContract::class, Base62Encoder::class);
    }
}
