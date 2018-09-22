<?php

use Faker\Generator as Faker;

/* Factory Identifier */
$factory->define(App\Sale::class, function (Faker $faker, $attrib = array('vehicle_id' => 1)) {
//    print_r($attrib['vehicle_id']);
//    exit;
    $vehicle_id = $attrib['vehicle_id'];
    $seller = DB::select("select id from users where role = 'operator' ORDER BY RAND() LIMIT 1");
    $buyer = DB::select("select id from users where role = 'client' ORDER BY RAND() LIMIT 1");
    $cost = $faker->randomFloat(350000, 2000000);
    $pvp = $cost * 1.3;
    $tax = $pvp * 0.15;
    return [
        'vehicle_id' => $vehicle_id,
        'cost' => $cost,
        'pvp' => $pvp,
        'tax' => $tax,
        'seller_id' => $seller,
        'buyer_id' => $buyer,
        'sold_on' => $faker->dateTimeBetween('-5 years', 'now'),
    ];
});

