<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Resources\Auth\TokenResponseResource;

/**
 * Class ResourceServiceProvider.
 */
class ResourceServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    { }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Set all api resource call
        TokenResponseResource::withoutWrapping();
    }
}
