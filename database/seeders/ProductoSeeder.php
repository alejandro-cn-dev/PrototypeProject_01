<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Producto::create([
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
        Producto::create([
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
        Producto::create([
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
        Producto::create([
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
