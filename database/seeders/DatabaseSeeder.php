<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EmpresaSeeder::class,
            SucursalSeeder::class,
            MarcaSeeder::class,
            EstadoSeeder::class,
            SituacionSeeder::class,
            TipoSeeder::class,
            TallerSeeder::class,
            //ClienteSeeder::class,
            //VehiculoSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            //ReparacionSeeder::class,
            SemaforoSeeder::class,
            //StatusSeeder::class,
            CategoriaSeeder::class,
        ]);
    }
}
