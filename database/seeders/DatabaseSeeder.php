<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        /*\App\Models\User::factory()->times(1)->create([
          "name" => "Pablo Martinez",
          "email" => "pmartinez1929@gmail.com",
          "password" => bcrypt("password")
        ]);
        \App\Models\User::factory()->times(1)->create([
          "name" => "Marco Morales",
          "email" => "marco@gmail.com",
          "password" => bcrypt("password")
        ]);
        \App\Models\User::factory()->times(1)->create([
          "name" => "Esteban del Castillo",
          "email" => "esteban@gmail.com",
          "password" => bcrypt("password")
        ]);
        \App\Models\User::factory()->times(1)->create([
          "name" => "Daniel Zarate",
          "email" => "daniel@gmail.com",
          "password" => bcrypt("password")
        ]);

        \App\Models\Games::factory()->times(5)->create();*/
        \App\Models\Stats::factory()->times(2)->create();
    }
}
