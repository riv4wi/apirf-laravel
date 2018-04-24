<?php

use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vehicle::class, 'ar_SA', 20)->create();
        factory(App\Vehicle::class, 20)->create();
    }
}
