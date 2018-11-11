<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $products = [
        1 => [
            'name'            => 'Beer',
            'brand_id'        => rand(1, 10),
            'country_id'      => [3, 5, 7, 8, 14][rand(0, 4)],
            'product_type_id' => 1,
        ],
        2 => [
            'name'            => 'Red Wine',
            'brand_id'        => rand(1, 10),
            'country_id'      => [1, 2, 4, 6, 9, 10, 11][rand(0, 6)],
            'product_type_id' => 2,
        ],
        3 => [
            'name'            => 'White Wine',
            'brand_id'        => rand(1, 10),
            'country_id'      => [1, 2, 4, 6, 9, 10, 11][rand(0, 6)],
            'product_type_id' => 3,
        ],
        4 => [
            'name'            => 'Whiskey',
            'brand_id'        => rand(1, 10),
            'country_id'      => [12, 13, 14][rand(0, 2)],
            'product_type_id' => 4,
        ],
    ];
    $i   = rand(1, 4);
    $img = 4 * rand(0, 2) + $i;
    return [
        'name'            => $products[$i]['name'] . ' - ' . $faker->text(8),
        'price'           => rand(0, 400) / 10,
        'src'             => "/images/products/" . $img . ".jpeg",
        'product_type_id' => $products[$i]['product_type_id'],
        'brand_id'        => $products[$i]['brand_id'],
        'country_id'      => $products[$i]['country_id'],
    ];
});
