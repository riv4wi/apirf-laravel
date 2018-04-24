<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'first_name' 	=> 'Pink',
            'last_name' 	=> 'Panther',
            'email'			=> 'pp@gmail.com',
            'role'		 	=> 'admin',
            'password'      => bcrypt('123'),
            'locale'        => 'en_US',
        ]);

        factory(App\User::class, 'es_VE', 20)->create();
        factory(App\User::class, 'pt_BR', 20)->create();
        factory(App\User::class, 'it_IT', 20)->create();
        factory(App\User::class, 'ar_SA', 20)->create();
        factory(App\User::class, 20)->create();
    }
}
