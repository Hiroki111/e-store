<?php

namespace Tests;

use App\Bundle;
use App\Cart;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CartTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canAddItemToCart()
    {
        $this->assertEquals(session('cart'), null);

        $this->post('/cart/add', ['type' => 'products', 'itemId' => 1, 'qty' => 1]);
        $expected = [
            'products' => [
                1 => 1,
            ],
        ];
        $this->assertEquals(session('cart'), $expected);

        $this->post('/cart/add', ['type' => 'products', 'itemId' => 2, 'qty' => 1]);
        $this->post('/cart/add', ['type' => 'products', 'itemId' => 1, 'qty' => 2]);
        $this->post('/cart/add', ['type' => 'bundles', 'itemId' => 10, 'qty' => 3]);
        $expected = [
            'products' => [
                1 => 3,
                2 => 1,
            ],
            'bundles'  => [
                10 => 3,
            ],
        ];
        $this->assertEquals(session('cart'), $expected);
    }

    /** @test */
    public function canUpdateCart()
    {
        $this->assertEquals(session('cart'), null);

        $this->post('/cart', ['type' => 'products', 'itemId' => 1, 'qty' => 3]);
        $this->post('/cart', ['type' => 'products', 'itemId' => 2, 'qty' => 1]);
        $this->post('/cart', ['type' => 'products', 'itemId' => 1, 'qty' => 0]);

        $this->post('/cart', ['type' => 'bundles', 'itemId' => 1, 'qty' => 3]);
        $this->post('/cart', ['type' => 'bundles', 'itemId' => 2, 'qty' => 1]);
        $this->post('/cart', ['type' => 'bundles', 'itemId' => 1, 'qty' => 0]);

        $expected = [
            'products' => [
                1 => 0,
                2 => 1,
            ],
            'bundles'  => [
                1 => 0,
                2 => 1,
            ],
        ];
        $this->assertEquals(session('cart'), $expected);
    }

    /** @test */
    public function canNotUpdateCartWihtoutTypeOrQty()
    {
        $this->assertEquals(session('cart'), null);

        $response = $this->json('post', '/cart', ['itemId' => 1, 'qty' => 3]);
        $response->assertStatus(422);
        $this->assertEquals(session('cart'), null);

        $response = $this->json('post', '/cart', ['type' => 'products', 'itemId' => 1]);
        $response->assertStatus(422);
        $this->assertEquals(session('cart'), null);
    }

    /** @test */
    public function canGetItemsAndTotalPrice()
    {
        $this->assertEquals(session('cart'), null);

        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();
        $product3 = factory(Product::class)->create();
        $product4 = factory(Product::class)->create();
        $bundle   = factory(Bundle::class)->create();
        $bundle->products()->attach([$product2->id, $product3->id, $product4->id]);

        $this->post('/cart/add', ['type' => 'product', 'itemId' => $product1->hashed_id, 'qty' => 2]);
        $this->post('/cart/add', ['type' => 'bundle', 'itemId' => $bundle->hashed_id, 'qty' => 1]);

        $cart = new Cart(session('cart'));

        $cartItems = $cart->getItems();
        collect($cartItems)->zip([[$product1, $product1], [$bundle]])->each(function ($set) {
            $cartItem   = $set[0];
            $actualItem = collect($set[1])->first();
            $qty        = sizeof($set[1]);

            $this->assertEquals($cartItem->name, $actualItem->name);
            $this->assertEquals($cartItem->price, $actualItem->price);
            $this->assertEquals($cartItem->qty, $qty);
            $this->assertEquals($cartItem->total_price, number_format($actualItem->price * $qty, 2));
        });
        $this->assertEquals(sizeof($cartItems), 2);

        $this->assertEquals($cart->getTotalPrice(), number_format($product1->price * 2 + $bundle->price, 2));
    }

    /** @test */
    public function canUpdateCartItemWithIdAndType()
    {
        $this->assertEquals(session('cart'), null);

        $this->post('/cart', ['type' => 'products', 'itemId' => 1, 'qty' => 3]);
        $this->post('/cart', ['type' => 'products', 'itemId' => 2, 'qty' => 1]);
        $this->post('/cart', ['type' => 'bundles', 'itemId' => 1, 'qty' => 3]);
        $this->post('/cart', ['type' => 'bundles', 'itemId' => 2, 'qty' => 1]);

        $expected = [
            'products' => [
                1 => 3,
                2 => 1,
            ],
            'bundles'  => [
                1 => 3,
                2 => 1,
            ],
        ];
        $this->assertEquals(session('cart'), $expected);

        $this->put('/cart/products/1', ['qty' => 2]);
        $this->put('/cart/products/2', ['qty' => 2]);
        $this->put('/cart/bundles/1', ['qty' => 5]);
        $this->put('/cart/bundles/2', ['qty' => 0]);

        $expected = [
            'products' => [
                1 => 2,
                2 => 2,
            ],
            'bundles'  => [
                1 => 5,
            ],
        ];
        $this->assertEquals(session('cart'), $expected);
    }

    /** @test */
    public function canDeleteItem()
    {
        $this->assertEquals(session('cart'), null);

        $this->post('/cart/add', ['type' => 'products', 'itemId' => 1, 'qty' => 1]);
        $this->post('/cart/add', ['type' => 'products', 'itemId' => 2, 'qty' => 1]);
        $this->post('/cart/add', ['type' => 'products', 'itemId' => 1, 'qty' => 2]);
        $this->post('/cart/add', ['type' => 'bundles', 'itemId' => 10, 'qty' => 3]);
        $expected = [
            'products' => [
                1 => 3,
                2 => 1,
            ],
            'bundles'  => [
                10 => 3,
            ],
        ];
        $this->assertEquals(session('cart'), $expected);

        $this->delete('/cart/delete', ['type' => 'products', 'itemId' => 2]);
        $expected = [
            'products' => [
                1 => 3,
            ],
            'bundles'  => [
                10 => 3,
            ],
        ];
        $this->assertEquals(session('cart'), $expected);

        $this->delete('/cart/delete', ['type' => 'bundles', 'itemId' => 10]);
        $expected = [
            'products' => [
                1 => 3,
            ],
            'bundles'  => [],
        ];
        $this->assertEquals(session('cart'), $expected);

        $this->delete('/cart/delete', ['type' => 'bundles', 'itemId' => 99999]);
        $expected = [
            'products' => [
                1 => 3,
            ],
            'bundles'  => [],
        ];
        $this->assertEquals(session('cart'), $expected);
    }

    /** @test */
    public function canGetTotalPriceInCents()
    {
        $this->assertEquals(session('cart'), null);

        $product = factory(Product::class)->create(['price' => 6.00]);
        $bundle  = factory(Bundle::class)->create(['price' => 70.51]);

        $this->post('/cart/add', ['type' => 'product', 'itemId' => $product->hashed_id, 'qty' => 2]);
        $this->post('/cart/add', ['type' => 'bundle', 'itemId' => $bundle->hashed_id, 'qty' => 1]);
        $cart = new Cart(session('cart'));

        $this->assertEquals($cart->getTotalPriceInCents(), 8251);
    }
}
