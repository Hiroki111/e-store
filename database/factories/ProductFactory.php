<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    $products = [
        1 => [
            'name'            => 'Beer',
            'alcohol'         => mt_rand(3, 5) / 10,
            'country_id'      => [3, 5, 7, 8, 14][mt_rand(0, 4)],
            'product_type_id' => 1,
        ],
        2 => [
            'name'            => 'Red Wine',
            'alcohol'         => mt_rand(5, 15) / 10,
            'country_id'      => [1, 2, 4, 6, 9, 10, 11][mt_rand(0, 6)],
            'product_type_id' => 2,
        ],
        3 => [
            'name'            => 'White Wine',
            'alcohol'         => mt_rand(5, 15) / 10,
            'country_id'      => [1, 2, 4, 6, 9, 10, 11][mt_rand(0, 6)],
            'product_type_id' => 3,
        ],
        4 => [
            'name'            => 'Whiskey',
            'alcohol'         => mt_rand(30, 50) / 10,
            'country_id'      => [12, 13, 14][mt_rand(0, 2)],
            'product_type_id' => 4,
        ],
    ];

    $i              = rand(1, 4);
    $imageSubFolder = str_replace(" ", "_", strtolower($products[$i]['name']));
    $imageId        = mt_rand(1, 6);
    $packaging      = ($products[$i]['name'] === 'Beer' && in_array($imageId, [3, 4])) ? 'can' : 'bottle';
    $price          = 0;
    if ($products[$i]['name'] === 'Beer') {
        $price = rand(30, 110) / 10;
    } else if ($products[$i]['name'] === 'Red Wine' || $products[$i]['name'] === 'White Wine') {
        $price = rand(50, 400) / 10;
    } else {
        $price = rand(200, 800) / 10;
    }
    $discountPrice = 0;
    if ($products[$i]['name'] === 'Beer') {
        $discountPrice = [5, 10][mt_rand(0, 1)];
    } else if ($products[$i]['name'] === 'Red Wine' || $products[$i]['name'] === 'White Wine') {
        $discountPrice = [15, 20][mt_rand(0, 1)];
    } else {
        $discountPrice = [20, 40][mt_rand(0, 1)];
    }

    return [
        'name'               => ucfirst($faker->word()) . ' ' . $products[$i]['name'],
        'price'              => $price,
        'alcohol'            => $products[$i]['alcohol'],
        'packaging'          => $packaging,
        'description'        => $faker->paragraph(mt_rand(2, 5)),
        'limit_per_checkout' => [0, 6, 10][mt_rand(0, 2)],
        'discount_qty'       => [0, 4, 6][mt_rand(0, 2)],
        'discount_price'     => [10, 15][mt_rand(0, 1)],
        'src'                => "/images/products/" . $imageSubFolder . "/" . $imageId . ".jpeg",
        'product_type_id'    => $products[$i]['product_type_id'],
        'brand_id'           => mt_rand(1, 10),
        'country_id'         => $products[$i]['country_id'],
    ];
});
