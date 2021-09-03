<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    public function run()
    {
        Empresa::create([
            'rfc' => 'ATO0108161E1',
            'razonsocial' => 'AUTOMOTRIZ TOY SA DE CV',
        ]);

        Empresa::create([
            'rfc' => 'TMO141008CP6',
            'razonsocial' => 'TOY MOTORS SA DE CV',
        ]);
    }
}
