<?php

namespace Database\Factories;

use App\Models\Propuesta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropuestaFactory extends Factory
{
    protected $model = Propuesta::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'reparacion_id' => $this->faker->name,
			'status_id' => $this->faker->name,
			'semaforo_id' => $this->faker->name,
        ];
    }
}
