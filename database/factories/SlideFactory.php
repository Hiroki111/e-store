<?php

use Faker\Generator as Faker;

$factory->define(App\Slide::class, function (Faker $faker) {
    return [
        'product_id'  => rand(1, 5),
        'title'       => $faker->text(20),
        'description' => $faker->realText(rand(0, 200)),
        'src'         => "test.jpg",
        'is_active'   => $faker,
    ];
});
