<?php

namespace App\Providers;

// Ditambahkan: Import class Application
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $publicPath = base_path('public_html');

    if (file_exists($publicPath)) {
        $this->app->bind('path.public', function() use ($publicPath) {
            return $publicPath;
        });
    }
    }
}

