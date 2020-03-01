<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       
       
      \App\User::create([
            'name' => 'user demo',
        	'email' => 'user@email.com',
	        'email_verified_at' => now(),
	        'password' => bcrypt('password'), // password
	        'remember_token' => Str::random(10),
        ]);
        
        for ($i=1; $i < 11; $i++) {
            
            \App\User::create([
            'name' => $faker->name,
        	'email' => $faker->unique()->safeEmail,
	        'email_verified_at' => now(),
	        'password' => bcrypt('password'), // password
	        'remember_token' => Str::random(10),
            ]);
        }

       
    }
}
