<?php

namespace Tests;

use App\Bundle;
use App\Product;
use App\RecommendedBundle;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RecommendedBundleTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canGetBundles()
    {
        $productIds = [];
        foreach (range(1, 10) as $i) {
            $productIds[] = factory(Product::class)->create()->id;
        }

        $bundle = factory(Bundle::class)->create();
        $bundle->products()->sync($productIds);

        $recommendedBundle = factory(RecommendedBundle::class)->create([
            'bundle_id' => $bundle->id,
        ]);

        $this->assertEquals($recommendedBundle->getBundles()->first()->id, $bundle->id);
        $this->assertEquals(sizeof($recommendedBundle->getBundles()), 1);
    }
}
