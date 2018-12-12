<?php

use Faker\Generator as Faker;

$factory->define(App\Bundle::class, function (Faker $faker) {
    return [
        'name'        => $faker->word(),
        'price'       => rand(600, 1000) / 10,
        'description' => $faker->paragraph(mt_rand(4, 6)),
    ];
});
