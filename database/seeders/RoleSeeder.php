<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Postulante']);
        $role2 = Role::create(['name' => 'Evaluador']);
        $role3 = Role::create(['name' => 'Admin']);
        $role4 = Role::create(['name' => 'Secretaria']);
        $role4 = Role::create(['name' => 'Contador']);

        /*
        Permission::create(['name' => 'dashboard'])->syncRoles([$role2,$role3]);
        Permission::create(['name' => 'formulario'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role3]);
        Permission::create(['name' => 'admin.roles.index'])->syncRoles([$role3]);*/

        $permisions = [
            'dashboard',
            'formulario',
            'admin.users.index',
            'admin.roles.index',

            //tabla roles
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
        ];

        foreach($permisions as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
