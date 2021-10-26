<?php

namespace Database\Seeders;

use App\Models\Situacione;
use Illuminate\Database\Seeder;

class SituacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Situacione::create([
            'nombre' => 'CITA',
            'descripcion' => 'IMPORTACION DE CITAS',
        ]);
        Situacione::create([
            'nombre' => 'ARRIBO',
            'descripcion' => 'BIENVENIDO A TOYOTA GUERRERO',
        ]);
        Situacione::create([
            'nombre' => 'RECEPCION',
            'descripcion' => 'SU VEHICULO ESTA EN LAS MEJORES MANOS PARA BRINDARLE UN EXCELENTE SERVICIO!',
        ]);
        Situacione::create([
            'nombre' => 'TALLER',
            'descripcion' => 'NUESTRO PERSONAL ESPECIALIZADO YA SE ENCUENTRA TRABAJANDO EN SU VEHICULO',
        ]);
        Situacione::create([
            'nombre' => 'AUTORIZACION',
            'descripcion' => 'ESPERAMOS SU AUTORIZACION DE UN TRABAJO ADICIONAL',
        ]);
        Situacione::create([
            'nombre' => 'REFACCION',
            'descripcion' => 'ESTAMOS PENDIENTE DEL ARRIBO DE LA PIEZA PARA SU VEHICULO',
        ]);
        Situacione::create([
            'nombre' => 'LAVADO',
            'descripcion' => 'ESTAMOS INICIANDO EL LAVADO DE CORTESIA A SU VEHICULO',
        ]);
        Situacione::create([
            'nombre' => 'TERMINADO',
            'descripcion' => 'HEMOS TERMINADO CON SU VEHICULO, YA PODEMOS ENTREGARSELO',
        ]);
        Situacione::create([
            'nombre' => 'ENTREGADO',
            'descripcion' => 'LA FAMILIA TOYOTA GUERRERO AGRADECE SU PREFERENCIA Y ESTAMOS A SUS ORDENES',
        ]);
    }
}
