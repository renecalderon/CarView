<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::create([
            'nombre' => 'Autorizado',
            'descripcion' => 'El cliente autorizo la propuesta',
            'color' => '#6495ED',
            'colorname' => 'success',
        ]);

        Status::create([
            'nombre' => 'Rechazado',
            'descripcion' => 'El cliente rechazo la propuesta',
            'color' => '#FF0000',
            'colorname' => 'danger',
        ]);
    }
}
