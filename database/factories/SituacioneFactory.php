<?php

namespace Database\Factories;

use App\Models\Situacione;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SituacioneFactory extends Factory
{
    protected $model = Situacione::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
        ];
    }
}
