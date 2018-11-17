<?php

namespace Tests;

use App\Brand;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canGetBrandsWithQty()
    {
        $a     = factory(Brand::class)->create(['name' => 'Sample Brand A']);
        $b     = factory(Brand::class)->create(['name' => 'Sample Brand B']);
        $c     = factory(Brand::class)->create(['name' => 'Sample Brand C']);
        $blank = factory(Brand::class)->create(['name' => 'blank']);
        $ids   = [];

        foreach (range(1, 20) as $i) {
            $ids[] = factory(Product::class)->create(['brand_id' => $a->id])->id;
        }

        foreach (range(1, 15) as $i) {
            $ids[] = factory(Product::class)->create(['brand_id' => $c->id])->id;
        }

        foreach (range(1, 5) as $i) {
            factory(Product::class)->create(['brand_id' => $c->id])->id;
        }

        foreach (range(1, 10) as $i) {
            $ids[] = factory(Product::class)->create(['brand_id' => $b->id])->id;
        }

        foreach (range(1, 10) as $i) {
            factory(Product::class)->create(['brand_id' => $c->id]);
        }

        $countries = Brand::getWithQtyOfProducts($ids);

        $this->assertEquals($countries[0]->name, "Sample Brand A");
        $this->assertEquals($countries[0]->qty, 20);
        $this->assertEquals($countries[1]->name, "Sample Brand B");
        $this->assertEquals($countries[1]->qty, 10);
        $this->assertEquals($countries[2]->name, "Sample Brand C");
        $this->assertEquals($countries[2]->qty, 15);
        $this->assertEquals(sizeof($countries), 3);
    }

    /** @test */
    public function canGetIdsFromUrlSafeNames()
    {
        $sampleA     = factory(Brand::class)->create(['name' => 'Fadel and Sons']);
        $irrelevantA = factory(Brand::class)->create(['name' => 'irrelevant A']);
        $sampleB     = factory(Brand::class)->create(['name' => 'Bergstrom-VonRueden']);
        $irrelevantB = factory(Brand::class)->create(['name' => 'irrelevant B']);
        $sampleC     = factory(Brand::class)->create(['name' => "O'Connell-Turner"]);

        $ids = Brand::getIdsFromUrlSafeNames("Fadel_and_Sons,Bergstrom-VonRueden,O'Connell-Turner");

        $this->assertEquals($ids[0], $sampleA->id);
        $this->assertEquals($ids[1], $sampleB->id);
        $this->assertEquals($ids[2], $sampleC->id);
        $this->assertEquals(sizeof($ids), 3);
    }
}
