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
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'administrador']);
        $role2 = Role::create(['name' => 'vendedor']);
        
        Permission::create(['name' => 'dashboard'])->syncRoles([$role1,$role2]);

        Permission::create(['name' => 'empleados.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleados.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleados.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleados.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'productos.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'productos.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'productos.delete'])->syncRoles([$role2]);
    }
}
