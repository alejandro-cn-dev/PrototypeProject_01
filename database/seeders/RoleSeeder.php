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
        $dev = Role::create(['name' => 'desarrollador']);
        $admin = Role::create(['name' => 'administrador']);
        $vendedor = Role::create(['name' => 'vendedor']);
        $acomodador = Role::create(['name' => 'acomodador']);
        $cobrador = Role::create(['name' => 'cobrador']);

        Permission::create(['name' => 'panel-config-admin'])->syncRoles([$dev,$admin]);
        Permission::create(['name' => 'panel-config-dev'])->syncRoles([$dev]);
        Permission::create(['name' => 'panel-backup-admin'])->syncRoles([$dev,$admin]);
        Permission::create(['name' => 'backup.create'])->syncRoles([$dev,$admin]);
        Permission::create(['name' => 'dashboard'])->syncRoles([$dev,$admin,$vendedor,$acomodador]);
        Permission::create(['name' => 'admin-dashboard'])->syncRoles([$dev,$admin]);

        Permission::create(['name' => 'productos.index'])->syncRoles([$dev,$admin,$vendedor,$acomodador]);
        Permission::create(['name' => 'productos.create'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'productos.delete'])->syncRoles([$dev,$vendedor]);

        Permission::create(['name' => 'empleados.index'])->syncRoles([$dev,$admin]);
        Permission::create(['name' => 'empleados.create'])->syncRoles([$dev,$admin]);
        Permission::create(['name' => 'empleados.edit'])->syncRoles([$dev,$admin]);
        Permission::create(['name' => 'empleados.delete'])->syncRoles([$dev,$admin]);
        Permission::create(['name' => 'empleados.change_password'])->syncRoles([$dev,$admin]);

        Permission::create(['name' => 'categorias.index'])->syncRoles([$dev,$admin,$vendedor]);
        Permission::create(['name' => 'categorias.create'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'categorias.edit'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'categorias.delete'])->syncRoles([$dev,$vendedor]);

        Permission::create(['name' => 'reportes.index'])->syncRoles([$dev,$admin]);

        Permission::create(['name' => 'marcas.index'])->syncRoles([$dev,$admin,$vendedor]);
        Permission::create(['name' => 'marcas.create'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'marcas.edit'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'marcas.delete'])->syncRoles([$dev,$vendedor]);

        Permission::create(['name' => 'almacens.index'])->syncRoles([$dev,$admin,$vendedor,$acomodador]);
        Permission::create(['name' => 'almacens.create'])->syncRoles([$dev,$vendedor,$acomodador]);
        Permission::create(['name' => 'almacens.edit'])->syncRoles([$dev,$vendedor,$acomodador]);
        Permission::create(['name' => 'almacens.delete'])->syncRoles([$dev,$vendedor,$acomodador]);

        Permission::create(['name' => 'proveedores.index'])->syncRoles([$dev,$admin,$vendedor]);
        Permission::create(['name' => 'proveedores.create'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'proveedores.edit'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'proveedores.delete'])->syncRoles([$dev,$vendedor]);

        Permission::create(['name' => 'ventas.index'])->syncRoles([$dev,$admin,$vendedor,$acomodador,$cobrador]);
        Permission::create(['name' => 'ventas.create'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'ventas.delete'])->syncRoles([$dev,$vendedor,$cobrador]);
        Permission::create(['name' => 'ventas.movimientos'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'ventas.existencias'])->syncRoles([$dev,$vendedor,$admin]);

        Permission::create(['name' => 'compras.index'])->syncRoles([$dev,$admin,$vendedor,$cobrador,$acomodador]);
        Permission::create(['name' => 'compras.create'])->syncRoles([$dev,$vendedor]);
        Permission::create(['name' => 'compras.delete'])->syncRoles([$dev,$vendedor,$cobrador]);

        Permission::create(['name' => 'reporte.control_stock'])->syncRoles([$dev,$admin,$cobrador]);
        Permission::create(['name' => 'reporte.valoracion'])->syncRoles([$dev,$admin,$cobrador]);
    }
}
