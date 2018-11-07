<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $products = [
        1 => ['name' => 'Beer', 'product_type_id' => 1],
        2 => ['name' => 'Red Wine', 'product_type_id' => 2],
        3 => ['name' => 'White Wine', 'product_type_id' => 3],
        4 => ['name' => 'Whiskey', 'product_type_id' => 4],
    ];
    $i = rand(1, 4);
    return [
        'name'            => $products[$i]['name'] . ' - ' . $faker->text(8),
        'price'           => rand(0, 400) / 10,
        'src'             => "/images/products/" . $i . ".jpeg",
        'product_type_id' => $products[$i]['product_type_id'],
    ];
});
