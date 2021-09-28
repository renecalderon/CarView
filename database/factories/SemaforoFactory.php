<?php

namespace Database\Factories;

use App\Models\Semaforo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SemaforoFactory extends Factory
{
    protected $model = Semaforo::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'descripcion' => $this->faker->name,
        ];
    }
}
