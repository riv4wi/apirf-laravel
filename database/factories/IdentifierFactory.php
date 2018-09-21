<?php

use Faker\Generator as Faker;

/* Factory Identifier */
$factory->define(App\Identifier::class, function (Faker $faker) {
    $faker = \Faker\Factory::create('ar_SA');
    $faker2 = \Faker\Factory::create('pl_PL');
//    $available_vehicles = DB::select("Select vehicles.id from vehicles where vehicles.id not in (select vehicle_id from identifiers)");
    //$available_vehicles = DB::raw("Select vehicles.id from vehicles where vehicles.id not in (select vehicle_id from identifiers) ORDER BY RAND() LIMIT 1");
    //print_r($available_vehicles);
    //exit;
//    $x=array_rand(array_column($available_vehicles, 'id'));
//    print_r($x);
//    $vehicle_selected_id = $available_vehicles[$x];
//    print_r($vehicle_selected_id);
//    exit;
    $not_available = \App\Vehicle::has("identifier")->inRandomOrder()->get()->pluck("id");
    $available = DB::select("Select vehicles.id from vehicles where vehicles.id not in (select vehicle_id from identifiers) ORDER BY RAND() LIMIT 1");
    print_r($available);
    return [
        'vehicle_id' => $available[0]->id,//\App\Vehicle::has("identifier")->inRandomOrder()->first()->id,
        'plate' =>  $faker->isbn10,
        'engine_serial' => $faker->bankAccountNumber(),
        'body_vin' => $faker2->pesel(),
    ];
});

