<?php

namespace Database\Factories;

use App\Models\Sucursale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SucursaleFactory extends Factory
{
    protected $model = Sucursale::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'direccion' => $this->faker->name,
			'pagina' => $this->faker->name,
			'telefono' => $this->faker->name,
			'empresa_id' => $this->faker->name,
        ];
    }
}
