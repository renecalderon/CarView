<?php

namespace Database\Factories;

use App\Models\Reparacion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReparacionFactory extends Factory
{
    protected $model = Reparacion::class;

    public function definition()
    {
        return [
			'referencia' => $this->faker->numerify('##########'),
			'descripcion' => $this->faker->text,
			'fechacita' => $this->faker->dateTimeBetween($startDate = "-5 days", $endDate = "now")->format('Y-m-d H:i:s'),
			'tiempoestimado' => $this->faker->randomElement(['0.5','1.0','1.5']),
			'fechaingreso' => null,
			'fechafin' => null,
			'fechaentrega' => null,
			'codigodmsasesorservicio' => $this->faker->randomElement(['402','406','403']),
			'codigodmsoperadortecnico' => $this->faker->randomElement(['401','402','406']),
			'matriculatemporal' => null,
			'user_id' => '1',
			'estado_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9']),
			'vehiculo_id' => $this->faker->numberBetween(1,100),
			'taller_id' => '1',
			'tipo_id' => $this->faker->randomElement(['1','2','3']),
        ];
    }
}
