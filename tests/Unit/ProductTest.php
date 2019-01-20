<?php

namespace Tests;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductTest extends TestCase
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
    public function canGetcents()
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

        $this->assertEquals($product->cents, 90);
        $this->assertEquals($product2->cents, 10);
        $this->assertEquals($product3->cents, 11);
    }

    /** @test */
    public function canGetPriceRanges()
    {
        //tier 1
        $p1 = factory(Product::class)->create(['price' => 0.90, 'product_type_id' => 1]);
        $p2 = factory(Product::class)->create(['price' => 1.10, 'product_type_id' => 1]);
        $p3 = factory(Product::class)->create(['price' => 1.11, 'product_type_id' => 1]);
        //tier 2
        $p4 = factory(Product::class)->create(['price' => 10.90, 'product_type_id' => 1]);
        $p5 = factory(Product::class)->create(['price' => 10.10, 'product_type_id' => 1]);
        $p6 = factory(Product::class)->create(['price' => 15.11, 'product_type_id' => 1]);
        //tier 3
        $p7 = factory(Product::class)->create(['price' => 50.00, 'product_type_id' => 1]);
        //tier 4
        $p8 = factory(Product::class)->create(['price' => 100.00, 'product_type_id' => 1]);

        //irrelevant types
        factory(Product::class)->create(['price' => 0.90, 'product_type_id' => 2]);
        factory(Product::class)->create(['price' => 1.10, 'product_type_id' => 3]);
        factory(Product::class)->create(['price' => 1.11, 'product_type_id' => 4]);
        factory(Product::class)->create(['price' => 10.90, 'product_type_id' => 2]);
        factory(Product::class)->create(['price' => 10.10, 'product_type_id' => 2]);
        factory(Product::class)->create(['price' => 15.11, 'product_type_id' => 4]);
        factory(Product::class)->create(['price' => 50.00, 'product_type_id' => 3]);
        factory(Product::class)->create(['price' => 100.00, 'product_type_id' => 3]);

        $priceRanges = Product::getPriceRanges([
            $p1->id, $p2->id, $p3->id, $p4->id, $p5->id, $p6->id, $p7->id, $p8->id,
        ]);

        $this->assertEquals(sizeof($priceRanges), 4);
        $this->assertEquals($priceRanges[0]->min, 0);
        $this->assertEquals($priceRanges[0]->max, 9.99);
        $this->assertEquals($priceRanges[0]->qty, 3);
        $this->assertEquals($priceRanges[1]->min, 10);
        $this->assertEquals($priceRanges[1]->max, 19.99);
        $this->assertEquals($priceRanges[1]->qty, 3);
        $this->assertEquals($priceRanges[2]->min, 50);
        $this->assertEquals($priceRanges[2]->max, 59.99);
        $this->assertEquals($priceRanges[2]->qty, 1);
        $this->assertEquals($priceRanges[3]->min, 100);
        $this->assertEquals($priceRanges[3]->max, 109.99);
        $this->assertEquals($priceRanges[3]->qty, 1);
    }

    /** @test */
    public function canGetHashedId()
    {
        $product = factory(Product::class)->create();

        $this->assertTrue(strlen($product->hashedId) >= 10);
    }

    /** @test */
    public function canGetUrl()
    {
        $product = factory(Product::class)->create();

        $this->assertEquals($product->url, '/product/' . $product->hashedId);
    }
}
