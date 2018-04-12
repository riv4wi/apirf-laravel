<?php

use Illuminate\Database\Seeder;
use \App\Manufacturer as Manufacturer;


class ManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        With DB not create create_at and updated_at fields
        //        Add: use Illuminate\Support\Facades\DB;
        //        DB::table('manufacturers')->insert([
        //            'name' => 'Chevrolet',
        //            'website' => 'chevrolet.com',
        //        ]);

        Manufacturer::create([
            'name' => 'Chevrolet',
            'website' => 'chevrolet.com',
        ]);

        Manufacturer::create([
            'name' => 'Fiat',
            'website' => 'fiat.com',
        ]);

        Manufacturer::create([
            'name' => 'Renault',
            'website' => 'renault.com',
        ]);

        Manufacturer::create([
            'name' => 'Ford',
            'website' => 'ford.com',
        ]);

        Manufacturer::create([
            'name' => 'Toyota',
            'website' => 'toyota.com',
        ]);

        Manufacturer::create([
            'name' => 'Jeep',
            'website' => 'jeep.com',
        ]);

        Manufacturer::create([
            'name' => 'Volkswagen',
            'website' => 'volkswagen.com',
        ]);

        Manufacturer::create([
            'name' => 'Hyundai',
            'website' => 'hyundai.com',
        ]);

        Manufacturer::create([
            'name' => 'Mitsubishi',
            'website' => 'mitsubishi.com',
        ]);

        Manufacturer::create([
            'name' => 'Honda',
            'website' => 'honda.com',
        ]);

        Manufacturer::create([
            'name' => 'Chrysler',
            'website' => 'chrysler.com',
        ]);

        Manufacturer::create([
            'name' => 'Nissan',
            'website' => 'nissan.com',
        ]);
    }
}
