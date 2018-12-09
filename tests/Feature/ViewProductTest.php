<?php

namespace Tests;

use App\Brand;
use App\Country;
use App\Product;
use App\ProductType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewProductTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canShowTheProductDetailsWithDiscountAndLimit()
    {
        $productType = factory(ProductType::class)->create();
        $country     = factory(Country::class)->create(['name' => 'Country']);
        $brand       = factory(Brand::class)->create(['name' => 'Brand Ltd']);

        $product = factory(Product::class)->create([
            'country_id'         => $country->id,
            'brand_id'           => $brand->id,
            'product_type_id'    => $productType->id,
            'price'              => 11.55,
            'discount_qty'       => 6,
            'discount_price'     => 5,
            'limit_per_checkout' => 8,
        ]);

        $res = $this->get("/product/$product->hashed_id");
        $res->assertSee($product->name);
        $res->assertSeeText($product->dollars);
        $res->assertSee(".$product->cents");
        $res->assertSee($product->brand->name);
        $res->assertSee($product->discount_qty);
        $res->assertSee("$product->discount_price discount");
        $res->assertSee("Limit of $product->limit_per_checkout");
        $res->assertSee("$product->alcohol%");
        $res->assertSee($product->packaging);
        $res->assertSee($product->description);
        $res->assertSee($product->country->name);
        $res->assertSee($productType->name);
    }

    /** @test */
    public function canShowTheProductDetailsWithoutDiscountAndLimit()
    {
        $productType = factory(ProductType::class)->create();
        $country     = factory(Country::class)->create(['name' => 'Country']);
        $brand       = factory(Brand::class)->create(['name' => 'Brand Ltd']);

        $product = factory(Product::class)->create([
            'country_id'         => $country->id,
            'brand_id'           => $brand->id,
            'product_type_id'    => $productType->id,
            'price'              => 11.55,
            'discount_qty'       => 0,
            'discount_price'     => 6,
            'limit_per_checkout' => 0,
        ]);

        $res = $this->get("/product/$product->hashed_id");
        $res->assertSee($product->name);
        $res->assertSeeText($product->dollars);
        $res->assertSee(".$product->cents");
        $res->assertSee($product->brand->name);
        $res->assertSee($product->discount_qty);
        $res->assertDontSee("$product->discount_price discount");
        $res->assertDontSee("Limit of $product->limit_per_checkout");
        $res->assertSee("$product->alcohol%");
        $res->assertSee($product->packaging);
        $res->assertSee($product->description);
        $res->assertSee($product->country->name);
        $res->assertSee($productType->name);
    }
}
