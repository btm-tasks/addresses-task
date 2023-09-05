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

        //PositionStack has error at the api itself, service is not avilable and i tried multiple keys
        //so i faked it
        //$this->app->bind(IGeolocationDecoder::class, PositionStackGeolocationDecoder::class);
        $this->app->bind(IGeolocationDecoder::class, TestingGeolocationDecoder::class);

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
