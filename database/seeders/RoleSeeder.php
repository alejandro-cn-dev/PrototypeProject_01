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
        
        Permission::create(['name' => 'empleados.index']);
        Permission::create(['name' => 'empleados.create']);
        Permission::create(['name' => 'empleados.edit']);
        Permission::create(['name' => 'empleados.delete']);

        Permission::create(['name' => 'productos.index']);
        Permission::create(['name' => 'productos.create']);
        Permission::create(['name' => 'productos.edit']);
        Permission::create(['name' => 'productos.delete']);
    }
}
