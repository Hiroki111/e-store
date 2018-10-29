<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $products = [
        ['name' => 'Beer', 'type_id' => 1],
        ['name' => 'Red Wine', 'type_id' => 2],
        ['name' => 'White Wine', 'type_id' => 3],
        ['name' => 'Whiskey', 'type_id' => 4],
    ];
    $i = rand(0, 3);
    return [
        'name'    => $products[$i]['name'],
        'price'   => rand(0, 400) / 10,
        'type_id' => $products[$i]['type_id'],
    ];
});
