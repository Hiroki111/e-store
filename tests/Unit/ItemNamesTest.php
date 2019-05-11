<?php

namespace Tests;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ItemNamesControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canGetAllProductNames()
    {
        $products = collect(range(1, 200))->map(function ($n) {
            return factory(Product::class)->create();
        });

        $res = $this->get('/item-names');

        $itemNames = Product::get()->map(function ($item) {
            return $item->name;
        })->all();

        $res->assertStatus(201)
            ->assertExactJson($itemNames);
    }
}
