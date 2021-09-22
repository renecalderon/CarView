<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* $role1 = Role::create(['name' => 'root']);
        $role2 = Role::create(['name' => 'admin']);

        Permission::create(['name' => 'admin.index'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'admin.user.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.user.create'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.user.edit'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.user.destroy'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'empresas.index'])->syncRoles([$role1]); */

        $sysadmin = Role::create(['name' => 'Sysadmin']);
        $serviciogte = Role::create(['name' => 'Gerente de Servicio']);
        $serviciojefetaller = Role::create(['name' => 'Jefe Taller']);
        $servicioasesor = Role::create(['name' => 'Asesor de Servicio']);
        $serviciotecnico = Role::create(['name' => 'Tecnico']);
        $serviciocitas = Role::create(['name' => 'Citas']);
        $refaccionesgte = Role::create(['name' => 'Gerente de Refacciones']);
        $refaccionesasesor = Role::create(['name' => 'Asesor de Refacciones']);
        $seguridad = Role::create(['name' => 'Personal de Seguridad']);

        Permission::create(['name' => 'empresas.index'])->syncRoles([$sysadmin]);
        Permission::create(['name' => 'sucursales.index'])->syncRoles([$sysadmin]);
        Permission::create(['name' => 'users.index'])->syncRoles([$sysadmin]);
        Permission::create(['name' => 'reparaciones.index'])->syncRoles([$sysadmin, $servicioasesor]);
        Permission::create(['name' => 'citas.index'])->syncRoles([$sysadmin, $serviciocitas]);
        Permission::create(['name' => 'seguridad.index'])->syncRoles([$sysadmin, $seguridad]);
        Permission::create(['name' => 'tecnicos.index'])->syncRoles([$sysadmin, $serviciotecnico]);
        Permission::create(['name' => 'refacciones.index'])->syncRoles([$sysadmin, $refaccionesgte, $refaccionesasesor]);



    }
}
