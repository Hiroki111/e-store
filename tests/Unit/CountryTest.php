<?php

namespace Tests;

use App\Country;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canGetCountriesWithQty()
    {
        $australia   = factory(Country::class)->create(['name' => 'Australia']);
        $southAfrica = factory(Country::class)->create(['name' => 'South Africa']);
        $denmark     = factory(Country::class)->create(['name' => 'Denmark']);
        $blank       = factory(Country::class)->create(['name' => 'blank']);

        foreach (range(1, 20) as $i) {
            factory(Product::class)->create([
                'country_id'      => $australia->id,
                'product_type_id' => 1,
            ]);
        }

        foreach (range(1, 15) as $i) {
            factory(Product::class)->create([
                'country_id'      => $southAfrica->id,
                'product_type_id' => 1,
            ]);
        }

        foreach (range(1, 10) as $i) {
            factory(Product::class)->create([
                'country_id'      => $denmark->id,
                'product_type_id' => 1,
            ]);
        }

        foreach (range(1, 10) as $i) {
            factory(Product::class)->create([
                'country_id'      => $denmark->id,
                'product_type_id' => 2,
            ]);
        }

        $countries = Country::getWithQtyOfProducts(1);

        $this->assertEquals($countries[0]->name, "Australia");
        $this->assertEquals($countries[0]->qty, 20);
        $this->assertEquals($countries[1]->name, "Denmark");
        $this->assertEquals($countries[1]->qty, 10);
        $this->assertEquals($countries[2]->name, "South Africa");
        $this->assertEquals($countries[2]->qty, 15);
        $this->assertEquals(sizeof($countries), 3);
    }

    /** @test */
    public function canGetIdsFromUrlSafeNames()
    {
        $australia    = factory(Country::class)->create(['name' => 'Australia']);
        $southAfrica  = factory(Country::class)->create(['name' => 'South Africa']);
        $unitedStates = factory(Country::class)->create(['name' => 'United States']);

        $ids = Country::getIdsFromUrlSafeNames("Australia,South-Africa,United-States");

        $this->assertEquals($ids[0], $australia->id);
        $this->assertEquals($ids[1], $southAfrica->id);
        $this->assertEquals($ids[2], $unitedStates->id);
        $this->assertEquals(sizeof($ids), 3);
    }
}
