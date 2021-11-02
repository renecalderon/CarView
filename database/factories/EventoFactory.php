<?php

namespace Database\Factories;

use App\Models\Evento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventoFactory extends Factory
{
    protected $model = Evento::class;

    public function definition()
    {
        return [
			'comentario' => $this->faker->name,
			'categoria_id' => $this->faker->name,
			'user_id' => $this->faker->name,
			'reparacion_id' => $this->faker->name,
        ];
    }
}
