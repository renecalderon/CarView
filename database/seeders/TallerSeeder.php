<?php

namespace Database\Seeders;

use App\Models\Taller;
use Illuminate\Database\Seeder;

class TallerSeeder extends Seeder
{
    public function run()
    {
        Taller::create([
            'numero' => '4',
            'descripcion' => 'TOYOTA GUERRERO',
        ]);

        Taller::create([
            'numero' => '1',
            'descripcion' => 'TOYOTA UNIVERSIDAD',
        ]);
    }
}
