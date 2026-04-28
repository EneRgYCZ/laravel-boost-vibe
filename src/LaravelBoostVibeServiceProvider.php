<?php

declare(strict_types=1);

namespace Energycz\LaravelBoostVibe;

use Illuminate\Support\ServiceProvider;
use Laravel\Boost\BoostManager;

class LaravelBoostVibeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/boost-vibe.php',
            'boost.code_environments.vibe'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/boost-vibe.php' => config_path('boost-vibe.php'),
        ], 'boost-vibe-config');

        $this->registerVibeCodeEnvironment();
    }

    /**
     * Register the Vibe code environment with Laravel Boost.
     */
    protected function registerVibeCodeEnvironment(): void
    {
        if ($this->app->bound(BoostManager::class)) {
            $this->app->make(BoostManager::class)->registerCodeEnvironment('vibe', VibeAgent::class);
        }
    }
}
