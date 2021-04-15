<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\FeatureFlags\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

trait HasFeatures
{
    public function inGroup(string $groupName)
    {
        //
    }

    public function giveFeature(string $featureName)
    {
        return $this->features()->sync(Feature::firstOrCreate([
            'name' => $featureName
        ]));
    }

    public function hasFeature(string $featureName)
    {
        return $this->features->contains('name', $featureName);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(
            Feature::class,
            'feature_user'
        );
    }
}
