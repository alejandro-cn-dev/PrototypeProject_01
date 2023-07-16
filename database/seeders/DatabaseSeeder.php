<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
       //\App\Models\User::factory(1)->create();
        //Role Seeder's.
        $this->call(RoleSeeder::class);

        //\App\Models\Rol::factory()->count(3)->sequence(['name' => 'Administrador'],['name' => 'Vendedor'],['name' => 'Acomodador'])->create();
        \App\Models\User::create([
            'ap_paterno' => 'Demo',
            'ap_materno' => 'Demo',
            'name' => 'Admin1',
            'ci' => '0000000',
            'expedido' => 'XX',
            'telefono' => '000000',
            'matricula' => 'DDD0000000XX',
            'email' => 'admin@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('administrador');
        \App\Models\User::create([
            'ap_paterno' => 'Apaza',
            'ap_materno' => 'Colima',
            'name' => 'Vendedor1',
            'ci' => '2969372',
            'expedido' => 'LP',
            'telefono' => '1100100',
            'matricula' => 'ACF2969372LP',
            'email' => 'vendedor1@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('vendedor');

        \App\Models\Proveedor::create([
            'nombre' => 'Fernando Cora - ASATEX',
            'telefono' => '60291828',
            'id_usuario' => '1'
        ],[
            'nombre' => 'Gabriel Araujo - ASATEX',
            'telefono' => '69800166',
            'id_usuario' => '1'
        ],[
            'nombre' => 'Vicente Mallorca - TEXBOL',
            'telefono' => '70583801',
            'id_usuario' => '1'
        ]);
        \App\Models\Almacen::create([
            'nombre' => 'Esq. Gonzalves #219 piso 2',
            'tipo' => 'deposito',
            'sufijo_almacen' => 'ES',
            'id_usuario' => '1'
        ]);
        \App\Models\Marca::create([
            'detalle' => 'ASATEX',
            'sufijo_marca' => 'AS',
            'id_usuario' => '1'
        ]);
        \App\Models\Categoria::create([
            'nombre' => 'Tela corriente',
            'detalle' => 'Tela de uso común',
            'sufijo_categoria' => 'TC',
            'id_usuario' => '1'
        ]);
        \App\Models\Categoria::create([
            'nombre' => 'Tela especial',
            'detalle' => 'Tela de uso específico',
            'sufijo_categoria' => 'TS',
            'id_usuario' => '1'
        ]);
        \App\Models\Categoria::create([
            'nombre' => 'Tela Algodon',
            'detalle' => 'Telas hechas de algodon',
            'sufijo_categoria' => 'TA',
            'id_usuario' => '1'
        ]);
        \App\Models\Categoria::create([
            'nombre' => 'Tela Lino',
            'detalle' => 'Tela hechas de Lino',
            'sufijo_categoria' => 'TL',
            'id_usuario' => '1'
        ]);
        \App\Models\Categoria::create([
            'nombre' => 'Tela Nailon',
            'detalle' => 'Tela hechas de Nailon',
            'sufijo_categoria' => 'TN',
            'id_usuario' => '1'
        ]);
        \App\Models\Categoria::create([
            'nombre' => 'Tela Poliéster',
            'detalle' => 'Tela hechas de alguna variedad de poliéster',
            'sufijo_categoria' => 'TP',
            'id_usuario' => '1'
        ]);
        \App\Models\Categoria::create([
            'nombre' => 'Hilos',
            'detalle' => 'Hilanderia no especializada',
            'sufijo_categoria' => 'HI',
            'id_usuario' => '1'
        ]);
        \App\Models\Producto::create([
            'item_producto' => 'HI-001',
            'descripcion' => 'Hilo cruzado',
            'color' => 'Verde',            
            'id_usuario' => '1',            
            'unidad' => 'unidad',
            'precio_compra' =>  '40.00',
            'precio_venta'  =>  '5.00',
            'id_categoria'  =>  '1',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
        \App\Models\Producto::create([
            'item_producto' => 'TS-001',
            'descripcion' => 'Tela piel de sirena',
            'color' => 'estampado rojo',            
            'id_usuario' => '1',            
            'unidad' =>  'metro',
            'precio_compra' =>  '530.40',
            'precio_venta'  =>  '10.00',
            'id_categoria'  =>  '2',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
        \App\Models\Producto::create([
            'item_producto' => 'TP-001',
            'descripcion' => 'Tela Cuadrile',
            'color' => 'azul rey',            
            'id_usuario' => '1',            
            'unidad' =>  'metro',
            'precio_compra' =>  '200.40',
            'precio_venta'  =>  '13.00',
            'id_categoria'  =>  '6',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
        \App\Models\Producto::create([
            'item_producto' => 'TS-002',
            'descripcion' => 'Tela Gamuza',
            'color' => 'rojo',            
            'id_usuario' => '1',
            'unidad'  =>  'metro',
            'precio_compra' =>  '345.00',
            'precio_venta'  =>  '11.00',
            'id_categoria'  =>  '2',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
    }
}
