<?php

use Faker\Generator as Faker;

/* Factory Identifier */
$factory->define(App\Identifier::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('ar_SA');
    $faker2 = \Faker\Factory::create('pl_PL');
    $available = DB::select("Select vehicles.id from vehicles where vehicles.id not in (select vehicle_id from identifiers) ORDER BY RAND() LIMIT 1");
    return [
        'vehicle_id' => $available[0]->id,
        'plate' =>  $faker->isbn10,
        'engine_serial' => $faker->bankAccountNumber(),
        'body_vin' => $faker2->pesel(),
    ];
});

