<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
			'categoria' => $this->faker->name,
			'icono' => $this->faker->name,
			'color' => $this->faker->name,
			'colorname' => $this->faker->name,
        ];
    }
}
