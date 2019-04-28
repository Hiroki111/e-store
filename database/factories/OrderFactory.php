<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'first_name'           => $faker->firstName,
        'last_name'            => $faker->lastName,
        'phone'                => $faker->phoneNumber,
        'email'                => $faker->email,
        'delivery_address_1'   => $faker->streetAddress,
        'delivery_address_2'   => $faker->streetAddress,
        'delivery_suburb'      => $faker->city,
        'delivery_state'       => $faker->state,
        'delivery_postcode'    => $faker->postcode,
        'use_delivery_address' => 0,
        'billing_address_1'    => $faker->streetAddress,
        'billing_address_2'    => $faker->streetAddress,
        'billing_suburb'       => $faker->city,
        'billing_state'        => $faker->state,
        'billing_postcode'     => $faker->postcode,
        'read_policy'          => 1,
    ];
});
