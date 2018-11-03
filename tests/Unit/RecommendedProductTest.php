<?php

namespace Tests;

use App\Product;
use App\RecommendedProduct;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RecommendedProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canGetProducts()
    {
        $product = factory(Product::class)->create();

        $recommendedProduct = factory(RecommendedProduct::class)->create([
            'product_id' => $product->id,
        ]);

        $this->assertEquals($recommendedProduct->getProducts()->first()->id, $product->id);
        $this->assertEquals(sizeof($recommendedProduct->getProducts()), 1);
    }
}
