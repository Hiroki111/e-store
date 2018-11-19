<?php

namespace Tests;

use App\Country;
use App\Product;
use App\ProductType;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewProductTypeTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function productsCanBeFilteredByPrice()
    {
        $pt1 = factory(ProductType::class)->create();
        $pt2 = factory(ProductType::class)->create();
        $pt3 = factory(ProductType::class)->create();
        $pt4 = factory(ProductType::class)->create();

        $p1  = factory(Product::class)->create(['price' => 0.90, 'product_type_id' => $pt1->id]);
        $p2  = factory(Product::class)->create(['price' => 1.10, 'product_type_id' => $pt1->id]);
        $p3  = factory(Product::class)->create(['price' => 1.11, 'product_type_id' => $pt1->id]);
        $p4  = factory(Product::class)->create(['price' => 10.90, 'product_type_id' => $pt1->id]);
        $p5  = factory(Product::class)->create(['price' => 10.10, 'product_type_id' => $pt1->id]);
        $p6  = factory(Product::class)->create(['price' => 15.11, 'product_type_id' => $pt1->id]);
        $p7  = factory(Product::class)->create(['price' => 50.00, 'product_type_id' => $pt1->id]);
        $p8  = factory(Product::class)->create(['price' => 100.00, 'product_type_id' => $pt1->id]);
        $p9  = factory(Product::class)->create(['price' => 0.90, 'product_type_id' => $pt2->id]);
        $p10 = factory(Product::class)->create(['price' => 1.10, 'product_type_id' => $pt3->id]);
        $p11 = factory(Product::class)->create(['price' => 10.10, 'product_type_id' => $pt2->id]);
        $p12 = factory(Product::class)->create(['price' => 15.11, 'product_type_id' => $pt4->id]);
        $p13 = factory(Product::class)->create(['price' => 50.00, 'product_type_id' => $pt3->id]);

        $res = $this->get('/product-type/' . $pt1->id . '?price_min=0,50&price_max=9.99,59.99');

        $res->assertViewHas('products', function ($products) use ($p1) {
            return $products->contains($p1);
        });
        $res->assertViewHas('products', function ($products) use ($p2) {
            return $products->contains($p2);
        });

        $res->assertViewHas('products', function ($products) use ($p3) {
            return $products->contains($p3);
        });

        $res->assertViewHas('products', function ($products) use ($p7) {
            return $products->contains($p7);
        });

        $res->assertViewHas('products', function ($products) {
            return $products->count() === 4;
        });
    }

    /** @test */
    public function productsCanBeFilteredByCountry()
    {
        $pt1 = factory(ProductType::class)->create();
        $pt2 = factory(ProductType::class)->create();

        $c1 = factory(Country::class)->create(['name' => 'Country_1']);
        $c2 = factory(Country::class)->create(['name' => 'Country_2']);
        $c3 = factory(Country::class)->create(['name' => 'Country_3']);
        $c4 = factory(Country::class)->create(['name' => 'Country_4']);

        $p1  = factory(Product::class)->create(['country_id' => $c1->id, 'product_type_id' => $pt1->id]);
        $p2  = factory(Product::class)->create(['country_id' => $c2->id, 'product_type_id' => $pt1->id]);
        $p3  = factory(Product::class)->create(['country_id' => $c3->id, 'product_type_id' => $pt1->id]);
        $p4  = factory(Product::class)->create(['country_id' => $c4->id, 'product_type_id' => $pt1->id]);
        $p5  = factory(Product::class)->create(['country_id' => $c1->id, 'product_type_id' => $pt1->id]);
        $p6  = factory(Product::class)->create(['country_id' => $c2->id, 'product_type_id' => $pt1->id]);
        $p7  = factory(Product::class)->create(['country_id' => $c3->id, 'product_type_id' => $pt2->id]);
        $p8  = factory(Product::class)->create(['country_id' => $c4->id, 'product_type_id' => $pt2->id]);
        $p9  = factory(Product::class)->create(['country_id' => $c1->id, 'product_type_id' => $pt2->id]);
        $p10 = factory(Product::class)->create(['country_id' => $c2->id, 'product_type_id' => $pt2->id]);
        $p11 = factory(Product::class)->create(['country_id' => $c3->id, 'product_type_id' => $pt2->id]);
        $p12 = factory(Product::class)->create(['country_id' => $c4->id, 'product_type_id' => $pt2->id]);

        $res = $this->get("/product-type/$pt1->id?country_names=$c1->name,$c2->name");

        $res->assertViewHas('products', function ($products) use ($p1) {
            return $products->contains($p1);
        });
        $res->assertViewHas('products', function ($products) use ($p2) {
            return $products->contains($p2);
        });
        $res->assertViewHas('products', function ($products) use ($p5) {
            return $products->contains($p5);
        });
        $res->assertViewHas('products', function ($products) use ($p6) {
            return $products->contains($p6);
        });

        $res->assertViewHas('products', function ($products) {
            return $products->count() === 4;
        });
    }
}
