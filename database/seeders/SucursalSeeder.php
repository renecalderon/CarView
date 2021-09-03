<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalSeeder extends Seeder
{
    public function run()
    {
        Sucursal::create([
            'nombre' => 'TOYOTA GUERRERO',
            'direccion' => 'Blvd. de las Naciones 52-B, Col. Granjas del Marquez, CP 39890',
            'pagina' => 'www.toyotaguerrero.com.mx',
            'telefono' => '744-435-1414',
            'empresa_id'  =>  '1',
        ]);

        Sucursal::create([
            'nombre' => 'TOYOTA UNIVERSIDAD',
            'direccion' => 'Av. Universidad 300',
            'pagina' => 'www.toyotauni.com.mx',
            'telefono' => '55-3000-3300',
            'empresa_id'  =>  '1',
        ]);

        Sucursal::create([
            'nombre' => 'TOYOTA CUERNAVACA',
            'direccion' => 'Av. Universidad 300',
            'pagina' => 'www.toyotauni.com.mx',
            'telefono' => '55-3000-3300',
            'empresa_id'  =>  '2',
        ]);
    }
}
