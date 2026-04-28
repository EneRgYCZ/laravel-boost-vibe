<?php

declare(strict_types=1);

namespace Energycz\LaravelBoostVibe;

use Illuminate\Support\ServiceProvider;
use Laravel\Boost\BoostManager;

class LaravelBoostVibeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/boost-vibe.php',
            'boost.agents.vibe'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/boost-vibe.php' => config_path('boost-vibe.php'),
        ], 'boost-vibe-config');

        if ($this->app->bound(BoostManager::class)) {
            $this->app->make(BoostManager::class)->registerAgent('vibe', VibeAgent::class);
        }
    }
}
