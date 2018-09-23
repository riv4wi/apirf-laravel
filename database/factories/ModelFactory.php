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

/*--------------------------------------------------------------------------------*/
/* USERS                                                                          */
/*--------------------------------------------------------------------------------*/

/* Factory User 'en_US' by default */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName('male' | 'female'),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['client', 'operator', 'admin']),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'locale' => 'en_US',
    ];
});

/* Factory User 'es_VE' */
$factory->defineAs(App\User::class, 'es_VE', function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('es_VE');  // Init Faker in lang mode
    return [
        'first_name' => $faker->firstName('male' | 'female'),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['client', 'operator', 'admin']),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'locale' => 'es_VE',
    ];
});

/* Factory User 'pt_BR' */
$factory->defineAs(App\User::class, 'pt_BR', function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('pt_BR');  // Init Faker in lang mode
    return [
        'first_name' => $faker->firstName('male' | 'female'),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['client', 'operator', 'admin']),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'locale' => 'pt_BR',
    ];
});

/* Factory User 'it_IT' */
$factory->defineAs(App\User::class, 'it_IT', function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('it_IT');  // Init Faker in lang mode
    return [
        'first_name' => $faker->firstName('male' | 'female'),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['client', 'operator', 'admin']),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'locale' => 'it_IT',
    ];
});

/* Factory User 'ar_SA'*/
$factory->defineAs(App\User::class, 'ar_SA', function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('ar_SA');  // Init Faker in lang mode
    return [
        'first_name' => $faker->firstName('male' | 'female'),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['client', 'operator', 'admin']),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'locale' => 'ar_SA',
    ];
});


/*--------------------------------------------------------------------------------*/
/* VEHICLES                                                                       */
/*--------------------------------------------------------------------------------*/

/* Factory Vehicle 'ar_SA'*/
$factory->defineAs(App\Vehicle::class, 'ar_SA', function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('ar_SA');  // Init Faker in lang mode
    $faker->addProvider(new Faker\Provider\VehicleBrandProvider($faker));
    $faker->addProvider(new Faker\Provider\VehicleModelProvider($faker));
    $brandi = $faker->brand;
    $manufacturer = DB::select("SELECT id FROM manufacturers where name = '".$brandi."'");
    return [
        'manufacturer_id' => $manufacturer[0]->id,
        'model' => $faker->modelveh($brandi),
        'color' => $faker->ColorName(),
        'year' => $faker->numberBetween(2010, 2018),
    ];
});

/* Factory Vehicle 'en_US' by defautl */
$factory->define(App\Vehicle::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\VehicleBrandProvider($faker));
    $faker->addProvider(new Faker\Provider\VehicleModelProvider($faker));
    $brandi = $faker->brand;
    $manufacturer = DB::select("SELECT id FROM manufacturers where name = '".$brandi."'");
    return [
        'manufacturer_id' => $manufacturer[0]->id,
        'model' => $faker->modelveh($brandi),
        'color' => $faker->ColorName(),
        'year' => $faker->numberBetween(2010, 2018),
    ];
});

