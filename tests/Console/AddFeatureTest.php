<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\FeatureFlags\Tests\Console;

use JustSteveKing\Laravel\FeatureFlags\Models\Feature;
use JustSteveKing\Laravel\FeatureFlags\Tests\TestCase;

class AddFeatureTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_a_new_feature()
    {
        $this->assertCount(0, Feature::all());

        $this->artisan('feature-flags:add-feature')
            ->expectsQuestion('Feature Name', 'test')
            ->expectsQuestion('Feature Description', 'a test feature')
            ->expectsChoice('Is the feature active', 'yes', ['yes', 'no'])
            ->expectsOutput("Created 'test' feature");

        $this->assertCount(1, Feature::all());
        $this->assertDatabaseHas('features', ['name' => 'test']);
    }
}
