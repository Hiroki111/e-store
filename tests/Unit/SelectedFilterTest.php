<?php

namespace Tests;

use App\SelectedFilter;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SelectedFilterTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canGetSelectedFilterWithThreeConditions()
    {
        $query = [
            "sort_by"       => "name",
            "order_by"      => "asc",
            "price_min"     => "0,20",
            "price_max"     => "9.99,29.99",
            "country_names" => "Czech",
            "brand_names"   => "Bergstrom-VonRueden,Fadel_and_Sons,Fay-Hodkiewicz,Green_Ltd,Lang_LLC",
        ];

        $filter = (new SelectedFilter($query))->getIterator();

        $this->assertEquals($filter['Price Range'], ["$0 - $9.99", "$20 - $29.99"]);
        $this->assertEquals($filter['Country'], ["Czech"]);
        $this->assertEquals($filter['Brand'], [
            "Bergstrom-VonRueden", "Fadel_and_Sons", "Fay-Hodkiewicz", "Green_Ltd", "Lang_LLC",
        ]);
        $this->assertEquals(sizeof($filter), 3);
    }

    /** @test */
    public function canGetSelectedFilterWithTwoConditions()
    {
        $query = [
            "sort_by"       => "price",
            "order_by"      => "desc",
            "price_min"     => "0,20",
            "price_max"     => "9.99,29.99",
            "country_names" => "Czech,Australia",
        ];

        $filter = (new SelectedFilter($query))->getIterator();

        $this->assertEquals($filter['Price Range'], ["$0 - $9.99", "$20 - $29.99"]);
        $this->assertEquals($filter['Country'], ["Czech", "Australia"]);
        $this->assertEquals(sizeof($filter), 2);
    }

    /** @test */
    public function doesNotCrashWithIncompletePrices()
    {
        $query = [
            "price_min" => "0,20",
            "price_max" => null,
        ];

        $filter = (new SelectedFilter($query))->getIterator();

        $this->assertEquals($filter['Price Range'], ["$0 - $", "$20 - $"]);
        $this->assertEquals(sizeof($filter), 1);

        $query["price_min"] = "";
        $query["price_max"] = "9.99,29.99";

        $filter = (new SelectedFilter($query))->getIterator();

        $this->assertEquals($filter['Price Range'], ["$ - $9.99", "$ - $29.99"]);
        $this->assertEquals(sizeof($filter), 1);
    }
}
