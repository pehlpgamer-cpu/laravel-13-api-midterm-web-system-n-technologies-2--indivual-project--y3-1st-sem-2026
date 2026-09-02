<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        // $this->rateLimiters();
        $this->jwtAuthRateLimit();
        $this->configureModels();
        $this->configureUrl();
        $this->configureCommands();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->environment('production')
        );
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict();
        // Model::unguard(); // "for faster development"
        Model::preventLazyLoading(! $this->app->environment('production'));
    }

    private function configureUrl(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }

    private function jwtAuthRateLimit()
    {
        RateLimiter::for('login', function (Request $request): array {
            $email = Str::lower(
                trim((string) $request->input('email')),
            );

            return [
                Limit::perMinute(5)
                    ->by($email.'|'.$request->ip()),

                Limit::perMinute(30)
                    ->by((string) $request->ip()),
            ];
        });

        RateLimiter::for('refresh', fn (Request $request): Limit => Limit::perMinute(30)->by((string) $request->ip())
        );
    }

    private function rateLimiters(): void
    {
        // TODO
    }
}
