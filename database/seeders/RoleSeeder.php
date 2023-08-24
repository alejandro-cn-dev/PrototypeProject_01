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
        $admin = Role::create(['name' => 'administrador']);
        $vendedor = Role::create(['name' => 'vendedor']);
        $acomodador = Role::create(['name' => 'acomodador']);
        $cobrador = Role::create(['name' => 'cobrador']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$admin,$vendedor,$acomodador]);
        Permission::create(['name' => 'admin-dashboard'])->syncRoles([$admin]);

        Permission::create(['name' => 'productos.index'])->syncRoles([$admin,$vendedor,$acomodador]);
        Permission::create(['name' => 'productos.create'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'productos.delete'])->syncRoles([$vendedor]);

        Permission::create(['name' => 'empleados.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'empleados.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'empleados.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'empleados.delete'])->syncRoles([$admin]);
        Permission::create(['name' => 'empleados.change_password'])->syncRoles([$admin]);

        Permission::create(['name' => 'categorias.index'])->syncRoles([$admin,$vendedor]);
        Permission::create(['name' => 'categorias.create'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'categorias.edit'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'categorias.delete'])->syncRoles([$vendedor]);

        Permission::create(['name' => 'reportes.index'])->syncRoles([$admin]);

        Permission::create(['name' => 'marcas.index'])->syncRoles([$admin,$vendedor]);
        Permission::create(['name' => 'marcas.create'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'marcas.edit'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'marcas.delete'])->syncRoles([$vendedor]);

        Permission::create(['name' => 'almacens.index'])->syncRoles([$admin,$vendedor,$acomodador]);
        Permission::create(['name' => 'almacens.create'])->syncRoles([$vendedor,$acomodador]);
        Permission::create(['name' => 'almacens.edit'])->syncRoles([$vendedor,$acomodador]);
        Permission::create(['name' => 'almacens.delete'])->syncRoles([$vendedor,$acomodador]);

        Permission::create(['name' => 'proveedores.index'])->syncRoles([$admin,$vendedor]);
        Permission::create(['name' => 'proveedores.create'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'proveedores.edit'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'proveedores.delete'])->syncRoles([$vendedor]);

        Permission::create(['name' => 'ventas.index'])->syncRoles([$admin,$vendedor,$acomodador,$cobrador]);
        Permission::create(['name' => 'ventas.create'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'ventas.delete'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'ventas.movimientos'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'ventas.existencias'])->syncRoles([$vendedor,$admin]);

        Permission::create(['name' => 'compras.index'])->syncRoles([$admin,$vendedor,$cobrador,$acomodador]);
        Permission::create(['name' => 'compras.create'])->syncRoles([$vendedor]);
        Permission::create(['name' => 'compras.delete'])->syncRoles([$vendedor]);

        Permission::create(['name' => 'reporte.control_stock'])->syncRoles([$admin,$cobrador]);
        Permission::create(['name' => 'reporte.valoracion'])->syncRoles([$admin,$cobrador]);
    }
}
