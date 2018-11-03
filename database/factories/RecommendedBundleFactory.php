<?php

use Faker\Generator as Faker;

$factory->define(App\RecommendedBundle::class, function (Faker $faker) {
    return [
        'bundle_id' => rand(1, 5),
    ];
});
