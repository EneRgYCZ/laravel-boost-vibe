<?php

declare(strict_types=1);

namespace Energycz\LaravelBoostVibe\Tests\Integration;

use Energycz\LaravelBoostVibe\VibeAgent;
use Laravel\Boost\BoostManager;
use Laravel\Boost\Install\Detection\DetectionStrategyFactory;
use Mockery;

beforeEach(function (): void {
    $this->strategyFactory = Mockery::mock(DetectionStrategyFactory::class);
});

test('VibeAgent can be instantiated', function (): void {
    $agent = new VibeAgent($this->strategyFactory);

    expect($agent)->toBeInstanceOf(VibeAgent::class);
});

test('VibeAgent can be registered with BoostManager', function (): void {
    $boostManager = new BoostManager();

    $boostManager->registerAgent('vibe', VibeAgent::class);

    $agents = $boostManager->getAgents();

    expect(array_key_exists('vibe', $agents))->toBeTrue();
    expect($agents['vibe'])->toBe(VibeAgent::class);
});

test('VibeAgent implements required interfaces', function (): void {
    $agent = new VibeAgent($this->strategyFactory);

    expect($agent)->toBeInstanceOf(\Laravel\Boost\Install\Agents\Agent::class);
    expect($agent)->toBeInstanceOf(\Laravel\Boost\Contracts\SupportsGuidelines::class);
    expect($agent)->toBeInstanceOf(\Laravel\Boost\Contracts\SupportsMcp::class);
});
