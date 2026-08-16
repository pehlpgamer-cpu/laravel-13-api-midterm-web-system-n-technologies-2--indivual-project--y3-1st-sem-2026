<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\DevCommands;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FormRequest::failOnUnknownFields();
        /* php artisan dev */
        // DevCommands::only('server');
        // DevCommands::only('queue');

        $this->rateLimiters();
        $this->configureModels();
        $this->configureUrl();
        //$this->configureCommands();
        }

        // private function configureCommands(): void
        // {
            //     DB::prohibitDestructiveCommands(
    //         $this->app->isProduction(), // <-- idk why it doesn't work, maybe outdated?
    //     );
    // }

    private function configureModels(): void
    {
        Model::shouldBeStrict();
        Model::unguard(); // "for faster development"
        // Model::preventLazyLoading(! $this->app->isProduction());
    }

    private function configureUrl(): void
    {
        //URL::forceScheme('https');
    }

    private function rateLimiters(): void
    {
        RateLimiter::for('api', function () {
            return Limit::perMinute(30); // temporary
        });

        RateLimiter::for('customer', function () {
            return Limit::perMinute(60);
        });

        RateLimiter::for('admin', function () {
            return Limit::perMinute(2000);
        });
    }
}
