<?php

use Faker\Generator as Faker;

$factory->define(App\OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => rand(1, 10),
        'stock_id' => rand(1, 10),
        'name'     => $faker->company,
        'type'     => ['product', 'bundle'][rand(0, 1)],
        'price'    => rand(30, 110) / 10,
    ];
});
