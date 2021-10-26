<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        Estado::create([
            'nombre' => 'Autorizado',
            'descripcion' => 'El cliente autorizo la propuesta',
            'color' => '#6495ED',
            'colorname' => 'success',
        ]);

        Estado::create([
            'nombre' => 'Rechazado',
            'descripcion' => 'El cliente rechazo la propuesta',
            'color' => '#FF0000',
            'colorname' => 'danger',
        ]);
    }
}
