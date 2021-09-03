<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        Estado::create([
            'nombre' => 'CITA',
            'descripcion' => 'Importación de Citas',
        ]);
        Estado::create([
            'nombre' => 'ARRIBO',
            'descripcion' => 'Bienvenido a Toyota Guerrero',
        ]);
        Estado::create([
            'nombre' => 'RECEPCION',
            'descripcion' => 'Su vehiculo esta en las mejores manos para brindarle un excelente servicio!',
        ]);
        Estado::create([
            'nombre' => 'TALLER',
            'descripcion' => 'Nuestro personal especializado ya se encuentra trabajando en su vehiculo',
        ]);
        Estado::create([
            'nombre' => 'AUTORIZACION',
            'descripcion' => 'Esperamos su autorizacion de un trabajo adicional',
        ]);
        Estado::create([
            'nombre' => 'REFACCION',
            'descripcion' => 'Estamos pendiente del arribo de la pieza para su vehiculo',
        ]);
        Estado::create([
            'nombre' => 'LAVADO',
            'descripcion' => 'Estamos iniciando el lavado de cortesia a su vehiculo',
        ]);
        Estado::create([
            'nombre' => 'TERMINADO',
            'descripcion' => 'Hemos terminado con su vehiculo, ya podemos entregarselo',
        ]);
        Estado::create([
            'nombre' => 'ENTREGADO',
            'descripcion' => 'La familia Toyota Guerrero agradece su preferencia y estamos a sus ordenes',
        ]);
    }
}
