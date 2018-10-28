<?php

use Faker\Generator as Faker;

$factory->define(App\RecommendedProduct::class, function (Faker $faker) {
    return [
        'product_id' => rand(1, 5),
    ];
});
