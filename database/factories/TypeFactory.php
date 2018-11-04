<?php

use Faker\Generator as Faker;

$factory->define(App\Type::class, function (Faker $faker) {
    $names = ['Beer', 'Red Wine', 'White Wine', 'Whiskey'];
    return [
        'name' => $names[rand(0, 3)],
    ];
});
