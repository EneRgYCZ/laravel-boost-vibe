<?php

declare(strict_types=1);

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

uses(MockeryPHPUnitIntegration::class)->in(__DIR__.'/Unit', __DIR__.'/Integration');

if (! function_exists('config')) {
    function config(string $key, mixed $default = null): mixed
    {
        return $default;
    }
}
