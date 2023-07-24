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
        $role3 = Role::create(['name' => 'acomodador']);
        $role4 = Role::create(['name' => 'cobrador']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name' => 'productos.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'productos.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'productos.delete'])->syncRoles([$role2]);

        Permission::create(['name' => 'empleados.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleados.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleados.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'empleados.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'categorias.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'categorias.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'categorias.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'categorias.delete'])->syncRoles([$role2]);

        Permission::create(['name' => 'reportes.index'])->syncRoles([$role1,$role1]);

        Permission::create(['name' => 'marcas.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'marcas.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'marcas.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'marcas.delete'])->syncRoles([$role2]);

        Permission::create(['name' => 'almacens.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'almacens.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'almacens.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'almacens.delete'])->syncRoles([$role2]);

        Permission::create(['name' => 'ventas.index'])->syncRoles([$role1,$role2,$role3,$role4]);
        Permission::create(['name' => 'ventas.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'ventas.delete'])->syncRoles([$role2]);

        Permission::create(['name' => 'compras.index'])->syncRoles([$role1,$role2,$role4]);
        Permission::create(['name' => 'compras.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'compras.delete'])->syncRoles([$role2]);
    }
}
