<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CartTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canUpdateCart()
    {
        $this->assertEquals(session('cart'), null);

        $this->post('/cart', [
            'type'      => 'product',
            'productId' => 1,
            'qty'       => 3,
        ]);
        $this->post('/cart', [
            'type'      => 'product',
            'productId' => 2,
            'qty'       => 1,
        ]);
        $this->post('/cart', [
            'type'      => 'product',
            'productId' => 1,
            'qty'       => 0,
        ]);

        $expected = [
            'products' => [
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

        $response = $this->json('post', '/cart', [
            'productId' => 1,
            'qty'       => 3,
        ]);
        $response->assertStatus(422);
        $this->assertEquals(session('cart'), null);

        $response = $this->json('post', '/cart', [
            'type'      => 'product',
            'productId' => 1,
        ]);
        $response->assertStatus(422);
        $this->assertEquals(session('cart'), null);
    }
}