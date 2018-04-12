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
        ]);

        factory(App\User::class, 10)->create();
    }
}
