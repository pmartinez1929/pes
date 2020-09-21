<?php

namespace Database\Factories;

use App\Models\Games;
use App\Models\Stats;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Illuminate\Support\Str;

class StatsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $stats = Stats::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::all()->random()->id,
            "wins" => 2,
            "loses" => 2,
            "draws" => 0,
            "gols_favor" =>99,
            "gols_against" =>3,
        ];
    }
}
