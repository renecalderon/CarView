<?php

namespace Database\Seeders;

use App\Models\Situacion;
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
        Situacion::create([
            'nombre' => 'CITA',
            'descripcion' => 'IMPORTACION DE CITAS',
            'icono' => 'clock',
            'color' => '',
            'colorname' => ''
        ]);
        Situacion::create([
            'nombre' => 'ARRIBO',
            'descripcion' => 'BIENVENIDO A TOYOTA GUERRERO',
            'icono' => 'user-shield',
            'color' => '',
            'colorname' => ''
        ]);
        Situacion::create([
            'nombre' => 'RECEPCION',
            'descripcion' => 'SU VEHICULO ESTA EN LAS MEJORES MANOS PARA BRINDARLE UN EXCELENTE SERVICIO!',
            'icono' => 'hands',
            'color' => '',
            'colorname' => ''
        ]);
        Situacion::create([
            'nombre' => 'TALLER',
            'descripcion' => 'NUESTRO PERSONAL ESPECIALIZADO YA SE ENCUENTRA TRABAJANDO EN SU VEHICULO',
            'icono' => 'tools',
            'color' => '',
            'colorname' => ''
        ]);
        Situacion::create([
            'nombre' => 'AUTORIZACION',
            'descripcion' => 'ESPERAMOS SU AUTORIZACION DE UN TRABAJO ADICIONAL',
            'icono' => 'thumbs-up',
            'color' => '',
            'colorname' => ''
        ]);
        Situacion::create([
            'nombre' => 'REFACCION',
            'descripcion' => 'ESTAMOS PENDIENTE DEL ARRIBO DE LA PIEZA PARA SU VEHICULO',
            'icono' => 'cogs',
            'color' => '',
            'colorname' => ''
        ]);
        Situacion::create([
            'nombre' => 'LAVADO',
            'descripcion' => 'ESTAMOS INICIANDO EL LAVADO DE CORTESIA A SU VEHICULO',
            'icono' => 'tint',
            'color' => '',
            'colorname' => ''
        ]);
        Situacion::create([
            'nombre' => 'TERMINADO',
            'descripcion' => 'HEMOS TERMINADO CON SU VEHICULO, YA PODEMOS ENTREGARSELO',
            'icono' => 'hands-wash',
            'color' => '',
            'colorname' => ''
        ]);
        Situacion::create([
            'nombre' => 'ENTREGADO',
            'descripcion' => 'LA FAMILIA TOYOTA GUERRERO AGRADECE SU PREFERENCIA Y ESTAMOS A SUS ORDENES',
            'icono' => 'handshake',
            'color' => '',
            'colorname' => ''
        ]);
    }
}
