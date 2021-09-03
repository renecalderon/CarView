<?php

namespace Database\Factories;

use App\Models\Taller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TallerFactory extends Factory
{
    protected $model = Tallere::class;

    public function definition()
    {
        return [
			'numero' => $this->faker->name,
			'descripcion' => $this->faker->name,
        ];
    }
}
