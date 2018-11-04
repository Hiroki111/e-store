<?php

namespace Tests;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canGetDollors()
    {
        $product = factory(Product::class)->create([
            'price' => 66.90,
        ]);

        $this->assertEquals($product->dollars, 66);
    }

    /** @test */
    public function canGetSents()
    {
        $product = factory(Product::class)->create([
            'price' => 66.90,
        ]);
        $product2 = factory(Product::class)->create([
            'price' => 1.10,
        ]);
        $product3 = factory(Product::class)->create([
            'price' => 1.11,
        ]);

        $this->assertEquals($product->sents, 90);
        $this->assertEquals($product2->sents, 10);
        $this->assertEquals($product3->sents, 11);
    }
}
