<?php

declare(strict_types=1);

namespace Energycz\LaravelBoostVibe\Tests\Integration;

use Energycz\LaravelBoostVibe\VibeAgent;
use Laravel\Boost\BoostManager;
use Laravel\Boost\Contracts\SupportsGuidelines;
use Laravel\Boost\Contracts\SupportsMcp;
use Laravel\Boost\Contracts\SupportsSkills;
use Laravel\Boost\Install\Agents\Agent;
use Laravel\Boost\Install\Detection\DetectionStrategyFactory;
use Mockery;

beforeEach(function (): void {
    $this->strategyFactory = Mockery::mock(DetectionStrategyFactory::class);
});

test('VibeAgent can be instantiated', function (): void {
    $agent = new VibeAgent($this->strategyFactory);

    expect($agent)->toBeInstanceOf(VibeAgent::class);
});

test('VibeAgent implements all required interfaces', function (): void {
    $agent = new VibeAgent($this->strategyFactory);

    expect($agent)
        ->toBeInstanceOf(Agent::class)
        ->toBeInstanceOf(SupportsGuidelines::class)
        ->toBeInstanceOf(SupportsMcp::class)
        ->toBeInstanceOf(SupportsSkills::class);
});

test('VibeAgent can be registered with BoostManager', function (): void {
    $boostManager = new BoostManager();

    $boostManager->registerAgent('vibe', VibeAgent::class);

    expect($boostManager->getAgents())->toHaveKey('vibe')
        ->and($boostManager->getAgents()['vibe'])->toBe(VibeAgent::class);
});

test('VibeAgent is not registered by default in BoostManager', function (): void {
    $boostManager = new BoostManager();

    expect($boostManager->getAgents())->not->toHaveKey('vibe');
});
