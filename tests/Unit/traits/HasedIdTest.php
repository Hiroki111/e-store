<?php

namespace Tests;

use App\Bundle;
use App\Product;
use App\PseudoCrypt;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class HashedIdTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canReturnProducts()
    {
        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();

        $retreived = Product::find(PseudoCrypt::unhash($product1->hashed_id)[0]);

        $this->assertEquals($retreived->id, $product1->id);
        $this->assertTrue($retreived->id !== $product2->id);
    }

    /** @test */
    public function canReturnBundleWithProducts()
    {
        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();
        $product3 = factory(Product::class)->create();
        $product4 = factory(Product::class)->create();

        $bundle = factory(Bundle::class)->create();
        $bundle->products()->attach([$product1->id, $product2->id, $product3->id]);

        $retreived = Bundle::with('products')->find(PseudoCrypt::unhash($bundle->hashed_id)[0]);

        $this->assertEquals($retreived->id, $bundle->id);
        $this->assertEquals($retreived->products[0]->id, $product1->id);
        $this->assertEquals($retreived->products[1]->id, $product2->id);
        $this->assertEquals($retreived->products[2]->id, $product3->id);
        $this->assertEquals(sizeof($retreived->products), 3);
    }
}
