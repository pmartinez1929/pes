<?php

namespace Database\Factories;

use App\Models\Games;
use App\Models\Stats;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
//use Illuminate\Support\Str;

class GamesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $games = Games::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "local_id" => User::all()->random()->id,
            "visit_id" => User::all()->random()->id,
            "gol_local" => 0,
            "gol_visit" => 0,
            "winnerpenaltys" => User::all()->random()->id,
            "winner" => User::all()->random()->id,
            "loser" => User::all()->random()->id,
            "draw" => 0,
            "created_at" => now()
        ];
    }
}
