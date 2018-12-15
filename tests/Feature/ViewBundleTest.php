<?php

namespace Tests;

use App\Brand;
use App\Bundle;
use App\Country;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewBundleTest extends TestCase
{
    use DatabaseMigrations;

    private function createProduct($name, $price, $countryId, $brandId)
    {
        return factory(Product::class)->create([
            'name'       => $name,
            'price'      => $price,
            'country_id' => $countryId,
            'brand_id'   => $brandId,
        ]);
    }

    /** @test */
    public function canShowItemsThatAreIncluded()
    {
        //products which will be included
        $country1 = factory(Country::class)->create(['name' => 'Country A']);
        $brand1   = factory(Brand::class)->create(['name' => 'Brand A']);
        $p1       = $this->createProduct('$p1', 1.1, $country1->id, $brand1->id);
        $p2       = $this->createProduct('$p2', 2.2, $country1->id, $brand1->id);
        $p3       = $this->createProduct('$p3', 3.3, $country1->id, $brand1->id);
        $p4       = $this->createProduct('$p4', 4.4, $country1->id, $brand1->id);
        $p5       = $this->createProduct('$p5', 5.5, $country1->id, $brand1->id);
        $p6       = $this->createProduct('$p6', 6.6, $country1->id, $brand1->id);
        $p7       = $this->createProduct('$p7', 7.7, $country1->id, $brand1->id);
        $p8       = $this->createProduct('$p8', 8.8, $country1->id, $brand1->id);

        //products which won't
        $country2 = factory(Country::class)->create(['name' => 'Country B']);
        $brand2   = factory(Brand::class)->create(['name' => 'Brand B']);
        $p9       = $this->createProduct('$p9', 9.9, $country2->id, $brand2->id);
        $p10      = $this->createProduct('$p10', 10.99, $country2->id, $brand2->id);
        $p11      = $this->createProduct('$p11', 11.11, $country2->id, $brand2->id);
        $p12      = $this->createProduct('$p12', 12.12, $country2->id, $brand2->id);

        $bundle = factory(Bundle::class)->create([
            'name'        => 'Bundle',
            'description' => 'Description',
        ]);
        $bundle->products()->attach(collect([$p1, $p1, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8])->map(function ($p) {
            return $p->id;
        })->all());

        $res = $this->get("/bundle/$bundle->hashed_id");
        $res->assertSee($bundle->name);
        $res->assertSeeText($bundle->dollars);
        $res->assertSee(".$bundle->cents");
        $res->assertSee($bundle->description);

        collect([$p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8])->each(function ($p) use ($res, $p1) {
            $res->assertSee($p->name);
            $res->assertSee("$p->alcohol%");
            $res->assertSee($p->description);
            $res->assertSee($p->volume . "ml");

            if ($p->id === $p1->id) {
                $res->assertSee("3 $p->packaging" . "s of $p->name");
            } else {
                $res->assertSee("1 $p->packaging of $p->name");
            }
        });

        collect([$p9, $p10, $p11, $p12])->each(function ($p) use ($res) {
            $res->assertDontSee($p->name);
        });

        $res->assertSee($brand1->name);
        $res->assertSee($country1->name);
        $res->assertDontSee($brand2->name);
        $res->assertDontSee($country2->name);
    }
}
