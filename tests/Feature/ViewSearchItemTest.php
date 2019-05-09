<?php

namespace Tests;

use App\Brand;
use App\Country;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewSearchItemTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function itemsCanBeFilteredByQuery()
    {
        //create products
        $p1 = factory(Product::class)->create(['name' => "ABC"]);
        $p2 = factory(Product::class)->create(['name' => "BCD"]);
        $p3 = factory(Product::class)->create(['name' => "CDE"]);
        $p4 = factory(Product::class)->create(['name' => "DEF"]);

        //get the url
        $res = $this->get('/search-item?query=cd');

        //assert
        $res->assertViewHas('products', function ($products) use ($p2) {
            return $products->contains($p2);
        });

        $res->assertViewHas('products', function ($products) use ($p3) {
            return $products->contains($p3);
        });

        $res->assertViewHas('products', function ($products) {
            return $products->count() === 2;
        });
    }

    /** @test */
    public function itemsCanBeFilteredByPrice()
    {
        $p1 = factory(Product::class)->create(['price' => 0.50, 'name' => 'A']);
        $p2 = factory(Product::class)->create(['price' => 10.00, 'name' => 'A']);
        $p3 = factory(Product::class)->create(['price' => 59.99, 'name' => 'A']);
        $p4 = factory(Product::class)->create(['price' => 60.00, 'name' => 'A']);
        $p5 = factory(Product::class)->create(['price' => 10.00, 'name' => 'Z']);
        $p6 = factory(Product::class)->create(['price' => 75.00, 'name' => 'Z']);

        $res = $this->get('/search-item?query=a&price_min=10,50&price_max=19.99,59.99');

        $res->assertViewHas('products', function ($products) use ($p2) {
            return $products->contains($p2);
        });

        $res->assertViewHas('products', function ($products) use ($p3) {
            return $products->contains($p3);
        });

        $res->assertViewHas('products', function ($products) {
            return $products->count() === 2;
        });
    }

    /** @test */
    public function itemsCanBeFilteredByCountry()
    {
        $c1 = factory(Country::class)->create(['name' => 'Country_1']);
        $c2 = factory(Country::class)->create(['name' => 'Country_2']);
        $c3 = factory(Country::class)->create(['name' => 'Country_3']);

        $p1 = factory(Product::class)->create(['country_id' => $c1->id, 'name' => "A"]);
        $p2 = factory(Product::class)->create(['country_id' => $c2->id, 'name' => "A"]);
        $p3 = factory(Product::class)->create(['country_id' => $c3->id, 'name' => "A"]);
        $p4 = factory(Product::class)->create(['country_id' => $c1->id, 'name' => "Z"]);
        $p5 = factory(Product::class)->create(['country_id' => $c2->id, 'name' => "Z"]);
        $p6 = factory(Product::class)->create(['country_id' => $c3->id, 'name' => "Z"]);

        $res = $this->get("/search-item?query=a&country_names=$c1->name,$c2->name");

        $res->assertViewHas('products', function ($products) use ($p1) {
            return $products->contains($p1);
        });
        $res->assertViewHas('products', function ($products) use ($p2) {
            return $products->contains($p2);
        });

        $res->assertViewHas('products', function ($products) {
            return $products->count() === 2;
        });
    }

    /** @test */
    public function itemsCanBeFilteredByBrand()
    {
        $b1 = factory(Brand::class)->create(['name' => 'Brand1']);
        $b2 = factory(Brand::class)->create(['name' => 'Brand2']);
        $b3 = factory(Brand::class)->create(['name' => 'Brand3']);

        $p1 = factory(Product::class)->create(['brand_id' => $b1->id, 'name' => "A"]);
        $p2 = factory(Product::class)->create(['brand_id' => $b2->id, 'name' => "A"]);
        $p3 = factory(Product::class)->create(['brand_id' => $b3->id, 'name' => "A"]);
        $p4 = factory(Product::class)->create(['brand_id' => $b1->id, 'name' => "Z"]);
        $p5 = factory(Product::class)->create(['brand_id' => $b2->id, 'name' => "Z"]);
        $p6 = factory(Product::class)->create(['brand_id' => $b3->id, 'name' => "Z"]);

        $res = $this->get("/search-item?query=a&brand_names=$b1->name,$b2->name");

        $res->assertViewHas('products', function ($products) use ($p1) {
            return $products->contains($p1);
        });
        $res->assertViewHas('products', function ($products) use ($p2) {
            return $products->contains($p2);
        });

        $res->assertViewHas('products', function ($products) {
            return $products->count() === 2;
        });
    }

    /** @test */
    public function itemsCanBeFilteredByPriceCountryBrand()
    {
        $c1 = factory(Country::class)->create(['name' => 'Country_1']);
        $c2 = factory(Country::class)->create(['name' => 'Country_2']);

        $b1 = factory(Brand::class)->create(['name' => 'Brand1']);
        $b2 = factory(Brand::class)->create(['name' => 'Brand2']);

        //create instances with right parameters, and store them
        $pass = [
            'price'      => 1.50,
            'brand_id'   => $b1->id,
            'country_id' => $c1->id,
            'name'       => 'A',
        ];
        $passedProducts = [];
        foreach (range(1, 9) as $price) {
            $passedProducts[] = factory(Product::class)->create($pass, ['price' => $price]);
        }

        //create ones that wont' pass
        //price
        factory(Product::class)->create(array_merge($pass, ['price' => 15.90]));

        //brand
        factory(Product::class)->create(array_merge($pass, ['brand_id' => $b2->id]));

        //country
        factory(Product::class)->create(array_merge($pass, ['country_id' => $c2->id]));

        //name
        factory(Product::class)->create(array_merge($pass, ['name' => "Z"]));

        $res = $this->get("/search-item?query=A&price_min=0&price_max=9.99&country_names=$c1->name&brand_names=$b1->name");

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
