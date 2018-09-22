<?php

use Illuminate\Database\Seeder;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = DB::select("select vehicle_id from identifiers");
        foreach ($vehicles as $vehicle) {
//            print_r($vehicle->vehicle_id);
//            exit;
            factory(App\Sale::class)->create([
                'vehicle_id' => $vehicle->vehicle_id,
            ]);
        }
    }
}
