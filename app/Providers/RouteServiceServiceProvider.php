<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RouteServiceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            $user = auth('sanctum')->user();

            if ($user) {
                return Limit::none();
            }

            return Limit::perHour(30)->by($request->ip());
        });
    }
}
