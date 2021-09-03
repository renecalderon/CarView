<?php

namespace Database\Factories;

use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehiculoFactory extends Factory
{
    protected $model = Vehiculo::class;

    public function definition()
    {
        return [
			'vin' => $this->faker->isbn13(),
            'matricula' => $this->faker->ssn,
            'familia' => $this->faker->word,
            'modelo' => $this->faker->word,
            'color' => $this->faker->colorName(),
            'anio' => '2021',
            'marca_id' => '1',
            'cliente_id' => $this->faker->randomElement(['1','2','3','4','5','6','7','8','9','10']),
        ];
    }
}
