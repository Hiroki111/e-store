<?php

namespace Tests;

use App\Bundle;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewViewcartTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canShowTheItemDetails()
    {
        $this->assertEquals(session('cart'), null);

        $product1 = factory(Product::class)->create(['price' => 1.11, 'name' => 'product1']);
        $product2 = factory(Product::class)->create(['price' => 2.00, 'name' => 'product2']);
        $product3 = factory(Product::class)->create(['price' => 3.00, 'name' => 'product3']);
        $product4 = factory(Product::class)->create(['price' => 4.00, 'name' => 'product4']);
        $bundle   = factory(Bundle::class)->create(['price' => 10.55, 'name' => 'bundle']);
        $bundle->products()->attach([$product2->id, $product3->id, $product4->id]);

        $this->post('/cart/add', [
            'type'   => 'product',
            'itemId' => $product1->hashed_id,
            'qty'    => 2,
        ]);
        $this->post('/cart/add', [
            'type'   => 'bundle',
            'itemId' => $bundle->hashed_id,
            'qty'    => 1,
        ]);
        $res = $this->get("/viewcart");

        //assert
        $res->assertSee('product1');
        $res->assertSee('$1.11');
        $res->assertSee('$2.22');

        $res->assertSee('bundle');
        $res->assertSee('$10.55');

        $res->assertSee('$12.77');

        //$res->assertDontSee('product2');
        //$res->assertDontSee('$2.00');
        $res->assertDontSee('product3');
        $res->assertDontSee('$3.00');
        $res->assertDontSee('product4');
        $res->assertDontSee('$4.00');
    }

    public function canUpdateCart()
    {
        $this->assertEquals(session('cart'), null);

        $product1 = factory(Product::class)->create(['price' => 1.11, 'name' => 'product1']);
        $product2 = factory(Product::class)->create(['price' => 2.00, 'name' => 'product2']);
        $product3 = factory(Product::class)->create(['price' => 3.00, 'name' => 'product3']);
        $product4 = factory(Product::class)->create(['price' => 4.00, 'name' => 'product4']);
        $bundle   = factory(Bundle::class)->create(['price' => 10.55, 'name' => 'bundle']);
        $bundle->products()->attach([$product2->id, $product3->id, $product4->id]);

        $this->post('/cart/add', [
            'type'   => 'product',
            'itemId' => $product1->hashed_id,
            'qty'    => 2,
        ]);
        $this->post('/cart/add', [
            'type'   => 'bundle',
            'itemId' => $bundle->hashed_id,
            'qty'    => 1,
        ]);
        $res = $this->get("/viewcart");
    }
}
