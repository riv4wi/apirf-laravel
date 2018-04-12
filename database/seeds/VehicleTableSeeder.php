<?php

use Illuminate\Database\Seeder;
//require_once 'VehicleBrandProvider.php';

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vehicle::class, 10)->create();
    }
}
