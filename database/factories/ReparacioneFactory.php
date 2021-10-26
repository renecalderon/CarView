<?php

namespace Database\Factories;

use App\Models\Reparacione;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReparacioneFactory extends Factory
{
    protected $model = Reparacione::class;

    public function definition()
    {
        return [
			'referencia' => $this->faker->name,
			'descripcion' => $this->faker->name,
			'fechacita' => $this->faker->name,
			'tiempoestimado' => $this->faker->name,
			'fechaingreso' => $this->faker->name,
			'fechafin' => $this->faker->name,
			'fechaentrega' => $this->faker->name,
			'codigodmsasesorservicio' => $this->faker->name,
			'codigodmsoperadortecnico' => $this->faker->name,
			'matriculatemporal' => $this->faker->name,
			'user_id' => $this->faker->name,
			'situacion_id' => $this->faker->name,
			'vehiculo_id' => $this->faker->name,
			'taller_id' => $this->faker->name,
			'tipo_id' => $this->faker->name,
        ];
    }
}
