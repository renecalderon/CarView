<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Rene',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'email' => 'renecalderon@gmail.com',
            'password'  =>  bcrypt('password'),
            'sucursal_id'  =>  '1',
            'email_verified_at' => Carbon::now()
        ])->assignRole('Sysadmin');

        User::create([
            'name' => 'Citas',
            'apellidopaterno' => 'Servicio',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'email' => 'citas@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas', 'Personal de Seguridad');

        User::create([
            'name' => 'Tecnico 1',
            'apellidopaterno' => 'Servicio',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'codigodmsoperadortecnico' => '409',
            'email' => 'tecnico@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Tecnico');

        User::create([
            'name' => 'Tecnico 2',
            'apellidopaterno' => 'Servicio',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'codigodmsoperadortecnico' => '408',
            'email' => 'tecnico2@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Tecnico');

        User::create([
            'name' => 'Asesor 1',
            'apellidopaterno' => 'Servicio',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'codigodmsasesorservicio' => '402',
            'email' => 'asesor@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Asesor de Servicio');

        User::create([
            'name' => 'Asesor 2',
            'apellidopaterno' => 'Servicio',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'codigodmsasesorservicio' => '404',
            'email' => 'asesor2@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Asesor de Servicio');

        User::create([
            'name' => 'Seguridad',
            'apellidopaterno' => 'Vigilancia',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'email' => 'seguridad@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Personal de Seguridad');

        User::create([
            'name' => 'Citas4',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'email' => 'citas4@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas');

        User::create([
            'name' => 'Citas5',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'email' => 'citas5@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas');

        User::create([
            'name' => 'Citas6',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'email' => 'citas6@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas');

        User::create([
            'name' => 'Citas7',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'email' => 'citas7@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas');

        User::create([
            'name' => 'Citas8',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'sucursal_id' => '1',
            'email' => 'citas8@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas');

        User::create([
            'name' => 'Citas9',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'sucursal_id' => '3',
            'email' => 'citas9@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas');

        User::create([
            'name' => 'Citas10',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'sucursal_id' => '2',
            'email' => 'citas10@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas');

        User::create([
            'name' => 'Citas11',
            'apellidopaterno' => 'Calderon',
            'apellidomaterno' => 'M',
            'sucursal_id' => '2',
            'email' => 'citas11@gtu.com.mx',
            'password'  =>  bcrypt('password'),
            'email_verified_at' => Carbon::now()
        ])->assignRole('Citas');


    }
}
