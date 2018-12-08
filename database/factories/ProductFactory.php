<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $products = [
        1 => [
            'name'            => 'Beer',
            'alcohol'         => mt_rand(30, 50) / 10,
            'country_id'      => [3, 5, 7, 8, 14][mt_rand(0, 4)],
            'product_type_id' => 1,
            'price'           => rand(30, 110) / 10,
            'discount_price'  => [5, 10][mt_rand(0, 1)],
            'volume'          => [330, 500][mt_rand(0, 1)],
        ],
        2 => [
            'name'            => 'Red Wine',
            'alcohol'         => mt_rand(50, 150) / 10,
            'country_id'      => [1, 2, 4, 6, 9, 10, 11][mt_rand(0, 6)],
            'product_type_id' => 2,
            'price'           => rand(50, 400) / 10,
            'discount_price'  => [15, 20][mt_rand(0, 1)],
            'volume'          => 750,
        ],
        3 => [
            'name'            => 'White Wine',
            'alcohol'         => mt_rand(50, 150) / 10,
            'country_id'      => [1, 2, 4, 6, 9, 10, 11][mt_rand(0, 6)],
            'product_type_id' => 3,
            'price'           => rand(50, 400) / 10,
            'discount_price'  => [15, 20][mt_rand(0, 1)],
            'volume'          => 750,
        ],
        4 => [
            'name'            => 'Whiskey',
            'alcohol'         => mt_rand(300, 500) / 10,
            'country_id'      => [12, 13, 14][mt_rand(0, 2)],
            'product_type_id' => 4,
            'price'           => rand(200, 800) / 10,
            'discount_price'  => [20, 40][mt_rand(0, 1)],
            'volume'          => 750,
        ],
    ];

    $i              = rand(1, 4);
    $imageSubFolder = str_replace(" ", "_", strtolower($products[$i]['name']));
    $imageId        = mt_rand(1, 6);
    $packaging      = ($products[$i]['name'] === 'Beer' && in_array($imageId, [3, 4])) ? 'can' : 'bottle';

    return [
        'name'               => ucfirst($faker->firstName()) . ' ' . $products[$i]['name'],
        'price'              => $products[$i]['price'],
        'alcohol'            => $products[$i]['alcohol'],
        'volume'             => $products[$i]['volume'],
        'packaging'          => $packaging,
        'description'        => $faker->paragraph(mt_rand(4, 6)),
        'limit_per_checkout' => [0, 6, 10][mt_rand(0, 2)],
        'discount_qty'       => [0, 4, 6][mt_rand(0, 2)],
        'discount_price'     => $products[$i]['discount_price'],
        'src'                => "/images/products/" . $imageSubFolder . "/" . $imageId . ".jpeg",
        'product_type_id'    => $products[$i]['product_type_id'],
        'brand_id'           => mt_rand(1, 10),
        'country_id'         => $products[$i]['country_id'],
    ];
});
