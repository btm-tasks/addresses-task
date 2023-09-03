<?php

namespace App\Providers;

use App\Adapters\IGeolocationDecoder;
use App\Adapters\Implementation\GeolocationDecoder\PositionStackGeolocationDecoder;
use App\Adapters\Implementation\GeolocationDecoder\TestingGeolocationDecoder;
use App\Services\IAddressesService;
use App\Services\Implementation\AddressesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAddressesService::class, AddressesService::class);
        $this->app->bind(IGeolocationDecoder::class, PositionStackGeolocationDecoder::class);

        //it is like mocking
        if (env("APP_ENV") == "testing"){
            $this->app->bind(IGeolocationDecoder::class, TestingGeolocationDecoder::class);
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
