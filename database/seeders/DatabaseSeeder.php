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
            'matricula' => 'ACV2969372LP',
            'email' => 'vendedor1@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('vendedor');
        \App\Models\User::create([
            'ap_paterno' => 'Apaza',
            'ap_materno' => 'Colima',
            'name' => 'Acomodador1',
            'ci' => '452112',
            'expedido' => 'LP',
            'telefono' => '6325222',
            'matricula' => 'ACA2969372LP',
            'email' => 'acomodador1@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('acomodador');
        \App\Models\User::create([
            'ap_paterno' => 'Apaza',
            'ap_materno' => 'Colima',
            'name' => 'Cobrador1',
            'ci' => '5623532',
            'expedido' => 'LP',
            'telefono' => '325236',
            'matricula' => 'ACC5623532LP',
            'email' => 'cobrador1@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('cobrador');

        \App\Models\Proveedor::create([
            'nombre' => 'Fernando Cora - ASATEX',
            'telefono' => '60291828',
            'id_usuario' => '1'
        ]);
        \App\Models\Proveedor::create([
            'nombre' => 'Gabriel Araujo - ASATEX',
            'telefono' => '69800166',
            'id_usuario' => '1'
        ]);
        \App\Models\Proveedor::create([
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
            'nombre' => 'Hilo cruzado',
            'descripcion' => 'Hilo entretegido con varias hebras de nylon',
            'color' => 'Verde',            
            'id_usuario' => '1',            
            'unidad' => 'unidad',
            'precio_compra' =>  '4.00',
            'precio_venta'  =>  '5.00',
            'id_categoria'  =>  '1',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
        \App\Models\Producto::create([
            'item_producto' => 'TS-001',
            'nombre' => 'Tela piel de sirena',
            'descripcion' => 'Tela que tiene relieves con forma de escamas y con tacto resbaloso',
            'color' => 'estampado rojo',            
            'id_usuario' => '1',            
            'unidad' =>  'metro',
            'precio_compra' =>  '8.40',
            'precio_venta'  =>  '10.00',
            'id_categoria'  =>  '2',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
        \App\Models\Producto::create([
            'item_producto' => 'TP-001',
            'nombre' => 'Tela Cuadrile',
            'descripcion' => 'Tela con diseños a cuadros entremezclando el color principal con varios colores',
            'color' => 'azul rey',            
            'id_usuario' => '1',            
            'unidad' =>  'metro',
            'precio_compra' =>  '10.40',
            'precio_venta'  =>  '13.00',
            'id_categoria'  =>  '6',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
        \App\Models\Producto::create([
            'item_producto' => 'TS-002',
            'nombre' => 'Tela Gamuza',
            'descripcion' => 'Tela con relieve tipo alfombra y con un toque de terciopelo',
            'color' => 'rojo',            
            'id_usuario' => '1',
            'unidad'  =>  'metro',
            'precio_compra' =>  '10.00',
            'precio_venta'  =>  '11.00',
            'id_categoria'  =>  '2',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
    }
}
