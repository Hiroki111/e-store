<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CartTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canAddItemToCart()
    {
        $this->assertEquals(session('cart'), null);

        $this->post('/cart/add', [
            'type'   => 'products',
            'itemId' => 1,
            'qty'    => 1,
        ]);

        $expected = [
            'products' => [
                1 => 1,
            ],
        ];
        $this->assertEquals(session('cart'), $expected);

        $this->post('/cart/add', [
            'type'   => 'products',
            'itemId' => 2,
            'qty'    => 1,
        ]);
        $this->post('/cart/add', [
            'type'   => 'products',
            'itemId' => 1,
            'qty'    => 2,
        ]);
        $this->post('/cart/add', [
            'type'   => 'bundles',
            'itemId' => 10,
            'qty'    => 3,
        ]);

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

        $this->post('/cart', [
            'type'   => 'products',
            'itemId' => 1,
            'qty'    => 3,
        ]);
        $this->post('/cart', [
            'type'   => 'products',
            'itemId' => 2,
            'qty'    => 1,
        ]);
        $this->post('/cart', [
            'type'   => 'products',
            'itemId' => 1,
            'qty'    => 0,
        ]);

        $this->post('/cart', [
            'type'   => 'bundles',
            'itemId' => 1,
            'qty'    => 3,
        ]);
        $this->post('/cart', [
            'type'   => 'bundles',
            'itemId' => 2,
            'qty'    => 1,
        ]);
        $this->post('/cart', [
            'type'   => 'bundles',
            'itemId' => 1,
            'qty'    => 0,
        ]);

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

        $response = $this->json('post', '/cart', [
            'itemId' => 1,
            'qty'    => 3,
        ]);
        $response->assertStatus(422);
        $this->assertEquals(session('cart'), null);

        $response = $this->json('post', '/cart', [
            'type'   => 'products',
            'itemId' => 1,
        ]);
        $response->assertStatus(422);
        $this->assertEquals(session('cart'), null);
    }
}
