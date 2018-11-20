<?php

namespace Tests;

use App\Brand;
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

    /** @test */
    public function productsCanBeFilteredByBrand()
    {
        $pt1 = factory(ProductType::class)->create();
        $pt2 = factory(ProductType::class)->create();

        $b1 = factory(Brand::class)->create(['name' => 'Brand1']);
        $b2 = factory(Brand::class)->create(['name' => 'Brand2']);
        $b3 = factory(Brand::class)->create(['name' => 'Brand3']);
        $b4 = factory(Brand::class)->create(['name' => 'Brand4']);

        $p1  = factory(Product::class)->create(['brand_id' => $b1->id, 'product_type_id' => $pt1->id]);
        $p2  = factory(Product::class)->create(['brand_id' => $b2->id, 'product_type_id' => $pt1->id]);
        $p3  = factory(Product::class)->create(['brand_id' => $b3->id, 'product_type_id' => $pt1->id]);
        $p4  = factory(Product::class)->create(['brand_id' => $b4->id, 'product_type_id' => $pt1->id]);
        $p5  = factory(Product::class)->create(['brand_id' => $b1->id, 'product_type_id' => $pt1->id]);
        $p6  = factory(Product::class)->create(['brand_id' => $b2->id, 'product_type_id' => $pt1->id]);
        $p7  = factory(Product::class)->create(['brand_id' => $b3->id, 'product_type_id' => $pt2->id]);
        $p8  = factory(Product::class)->create(['brand_id' => $b4->id, 'product_type_id' => $pt2->id]);
        $p9  = factory(Product::class)->create(['brand_id' => $b1->id, 'product_type_id' => $pt2->id]);
        $p10 = factory(Product::class)->create(['brand_id' => $b2->id, 'product_type_id' => $pt2->id]);
        $p11 = factory(Product::class)->create(['brand_id' => $b3->id, 'product_type_id' => $pt2->id]);
        $p12 = factory(Product::class)->create(['brand_id' => $b4->id, 'product_type_id' => $pt2->id]);

        $res = $this->get("/product-type/$pt1->id?brand_names=$b1->name,$b2->name");

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

    /** @test */
    public function productsCanBeFilteredByPriceCountryBrand()
    {
        $pt1 = factory(ProductType::class)->create();
        $pt2 = factory(ProductType::class)->create();

        $c1 = factory(Country::class)->create(['name' => 'Country_1']);
        $c2 = factory(Country::class)->create(['name' => 'Country_2']);

        $b1 = factory(Brand::class)->create(['name' => 'Brand1']);
        $b2 = factory(Brand::class)->create(['name' => 'Brand2']);

        //create instances with right parameters, and store them
        $pass = [
            'price'           => 1.50,
            'brand_id'        => $b1->id,
            'country_id'      => $c1->id,
            'product_type_id' => $pt1->id,
        ];
        $passedProducts = [];
        foreach (range(1, 9) as $price) {
            $passedProducts[] = factory(Product::class)->create($pass, ['price' => $price]);
        }

        //create failed ones
        //price
        factory(Product::class)->create(array_merge($pass, ['price' => 15.90]));

        //brand
        factory(Product::class)->create(array_merge($pass, ['brand_id' => $b2->id]));

        //country
        factory(Product::class)->create(array_merge($pass, ['country_id' => $c2->id]));

        //product type
        factory(Product::class)->create(array_merge($pass, ['product_type_id' => $pt2->id]));

        $res = $this->get("/product-type/$pt1->id?price_min=0&price_max=9.99&country_names=$c1->name&brand_names=$b1->name");

        foreach ($passedProducts as $passedProduct) {
            $res->assertViewHas('products', function ($products) use ($passedProduct) {
                return $products->contains($passedProduct);
            });
        }

        $res->assertViewHas('products', function ($products) {
            return $products->count() === 9;
        });
    }
}
