<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Services\SpringBootApiService;

class SpringBootApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SpringBootApiService::class, function ($app) {
            return new SpringBootApiService(config('services.spring_boot_api.base_url'));
        });
    }
}

