<?php

namespace Database\Factories;

use App\Models\Tallere;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TallereFactory extends Factory
{
    protected $model = Tallere::class;

    public function definition()
    {
        return [
			'numero' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'sucursal_id' => $this->faker->name,
        ];
    }
}
