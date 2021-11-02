<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        Categoria::create([
            'categoria' => 'Citas',
            'icono' => 'clock',
            'color' => 'default',
            'colorname' => 'yellow',
        ]);
        Categoria::create([
            'categoria' => 'Seguridad',
            'icono' => 'shield-alt',
            'color' => 'secondary',
            'colorname' => 'blue',
        ]);
        Categoria::create([
            'categoria' => 'Asesor',
            'icono' => 'user-check',
            'color' => 'success',
            'colorname' => 'green',
        ]);
        Categoria::create([
            'categoria' => 'Tecnico',
            'icono' => 'tools',
            'color' => 'danger',
            'colorname' => 'red',
        ]);
        Categoria::create([
            'categoria' => 'Lavado',
            'icono' => 'tint',
            'color' => 'primary',
            'colorname' => 'blue',
        ]);

    }
}
