<?php

namespace Database\Factories;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MarcaFactory extends Factory
{
    protected $model = Marca::class;

    public function definition()
    {
        return [
			'prefijo' => $this->faker->name,
			'marca' => $this->faker->name,
        ];
    }
}
