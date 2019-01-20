<?php

namespace Tests;

use App\Brand;
use App\Bundle;
use App\Country;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BundleTest extends TestCase
{
    use DatabaseMigrations;

    private function createProduct($packaging, $brandId, $countryId)
    {
        return factory(Product::class)->create([
            'packaging'  => $packaging,
            'brand_id'   => $brandId,
            'country_id' => $countryId,
        ]);
    }

    /** @test */
    public function canGetProductList()
    {
        $brandA   = factory(Brand::class)->create(['name' => 'Brand A']);
        $countryA = factory(Country::class)->create(['name' => 'Country A']);
        $brandB   = factory(Brand::class)->create(['name' => 'Brand B']);
        $countryB = factory(Country::class)->create(['name' => 'Country B']);
        $p1       = $this->createProduct('bottle', $brandA->id, $countryA->id);
        $p2       = $this->createProduct('can', $brandA->id, $countryB->id);
        $p3       = $this->createProduct('bottle', $brandB->id, $countryB->id);
        $bundle   = factory(Bundle::class)->create();

        $bundle->products()->attach(array_map(function ($p) {
            return $p->id;
        }, [$p1, $p1, $p1, $p2, $p2, $p3]));

        $list = $bundle->getProductList();

        $this->assertEquals(sizeof($list), 3);

        $this->assertEquals($list[0]->qty, 3);
        $this->assertEquals($list[0]->packaging, "bottles");
        $this->assertEquals($list[0]->volume, $p1->volume);
        $this->assertEquals($list[0]->name, $p1->name);
        $this->assertEquals($list[0]->description, $p1->description);
        $this->assertEquals($list[0]->alcohol, $p1->alcohol);
        $this->assertEquals($list[0]->brand->name, $brandA->name);
        $this->assertEquals($list[0]->country->name, $countryA->name);

        $this->assertEquals($list[1]->qty, 2);
        $this->assertEquals($list[1]->packaging, "cans");
        $this->assertEquals($list[1]->volume, $p2->volume);
        $this->assertEquals($list[1]->name, $p2->name);
        $this->assertEquals($list[1]->description, $p2->description);
        $this->assertEquals($list[1]->alcohol, $p2->alcohol);
        $this->assertEquals($list[1]->brand->name, $brandA->name);
        $this->assertEquals($list[1]->country->name, $countryB->name);

        $this->assertEquals($list[2]->qty, 1);
        $this->assertEquals($list[2]->packaging, "bottle");
        $this->assertEquals($list[2]->volume, $p3->volume);
        $this->assertEquals($list[2]->name, $p3->name);
        $this->assertEquals($list[2]->description, $p3->description);
        $this->assertEquals($list[2]->alcohol, $p3->alcohol);
        $this->assertEquals($list[2]->brand->name, $brandB->name);
        $this->assertEquals($list[2]->country->name, $countryB->name);
    }

    /** @test */
    public function canGetUrl()
    {
        $bundle = factory(Bundle::class)->create();

        $this->assertEquals($bundle->url, '/bundle/' . $bundle->hashedId);
    }
}
