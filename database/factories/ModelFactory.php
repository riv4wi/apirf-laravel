<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_ES');  // Init Faker in spanish mode
    return [
        'first_name' => $faker->firstName('male' | 'female'),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['client', 'operator', 'admin']),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Vehicle::class, function (Faker\Generator $faker) {
    $faker = new Faker\Generator();
    $faker->addProvider(new Faker\Provider\VehicleBrandProvider($faker));
    $faker->addProvider(new Faker\Provider\VehicleModelProvider($faker));
    $brandi = $faker->brand;

//    $manufacturer_id = \App\Manufacturer::where('name', '=', $brandi)->select('id')->get();
    $manufacturer_id = \App\Manufacturer::vehicle()->where('name', '=', $brandi)->select('id')->get();
    return [
        'manufacturer_id' => $manufacturer_id->id,
        'model' => $faker->modelveh($brandi),
    ];
});