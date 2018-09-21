<?php

use Illuminate\Database\Seeder;

class IdentifierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20 ; $i++) {
            factory(App\Identifier::class)->create();
        }
    }
}
