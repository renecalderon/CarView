<?php

namespace Database\Factories;

use App\Models\Refaccione;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RefaccioneFactory extends Factory
{
    protected $model = Refaccione::class;

    public function definition()
    {
        return [
			'parte' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'cantidad' => $this->faker->name,
			'precio' => $this->faker->name,
			'propuesta_id' => $this->faker->name,
        ];
    }
}
