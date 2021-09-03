<?php

namespace Database\Seeders;

use App\Models\Reparacion;
use Illuminate\Database\Seeder;

class ReparacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reparacion::factory(500)->create();
    }
}
