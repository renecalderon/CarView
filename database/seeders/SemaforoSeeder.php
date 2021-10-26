<?php

namespace Database\Seeders;

use App\Models\Semaforo;
use Illuminate\Database\Seeder;

class SemaforoSeeder extends Seeder
{
    public function run()
    {
        Semaforo::create([
            'nombre' => 'Urgente',
            'descripcion' => 'Se requiere con urgencia',
            'color' => '#FF0000',
            'colorname' => 'danger',
        ]);

        Semaforo::create([
            'nombre' => 'Necesario',
            'descripcion' => 'Descripcion de necesario',
            'color' => '#FFD700',
            'colorname' => 'warning',
        ]);

        Semaforo::create([
            'nombre' => 'Recomendado',
            'descripcion' => 'Descripcion de recomendacion',
            'color' => '#6495ED',
            'colorname' => 'success',
        ]);
    }
}
