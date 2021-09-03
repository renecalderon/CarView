<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create([
            'nombre' => 'SERVICIO KILOMETRADO',
            'descripcion' => 'SERVICIO KILOMETRADO',
        ]);

        Tipo::create([
            'nombre' => 'DIAGNOSTICO',
            'descripcion' => 'DIAGNOSTICO',
        ]);

        Tipo::create([
            'nombre' => 'SINIESTRO',
            'descripcion' => 'SINIESTRO',
        ]);
    }
}
