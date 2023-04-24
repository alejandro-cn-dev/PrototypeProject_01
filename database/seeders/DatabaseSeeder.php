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

        \App\Models\User::factory()->create([
            'name' => 'demo',
            'email' => 'demo@demo.com',
            'password' => 'demo_demo',
            'role' => 'admin'
        ]);
        \App\Models\Rol::factory()->count(2)->sequence(['detalle' => 'admin'],['detalle' => 'encargado'])
        ->create();
        \App\Models\Empleado::factory()->create([
            'ap_paterno' => 'Demo',
            'ap_materno' => 'Demo',
            'nombre' => 'Demo',
            'ci' => '0000000',
            'expedido' => 'XX',
            'id_user' => '1',
            'telefono' => '000000',
            'matricula' => 'DDD0000000XX',
            //'email' => 'demo@demo.com',
            'id_rol' => '1',            
        ]);

        \App\Models\Proveedor::factory()->create([
            'nombre' => 'Fernando Cora - ASATEX',
            'telefono' => '60291828'    
        ]);
        \App\Models\Almacen::factory()->create([
            'nombre' => 'Esq. Gonzalves #219 piso 2',
            'tipo' => 'deposito',
            'sufijo_almacen' => 'ES',
            'matricula' => 'DDD0000000XX'
        ]);
        \App\Models\Marca::factory()->create([
            'detalle' => 'ASATEX',
            'sufijo_marca' => 'AS',
            'matricula' => 'DDD0000000XX'          
        ]);
        \App\Models\Categoria::factory()->create([
            'nombre' => 'Hilos',
            'detalle' => 'Hilanderia no especializada',
            'sufijo_categoria' => 'HI',
            'matricula' => 'DDD0000000XX'
        ]);
        \App\Models\Producto::factory()->create([
            'item_producto' => 'HI-AS-001',
            'descripcion' => 'Hilo cruzado',
            'color' => 'Verde',            
            'matricula' => 'DDD0000000XX',            
            'unidad_compra' => 'caja',            
            'unidad_venta'  =>  'unidad',
            'precio_compra' =>  '40',
            'precio_venta'  =>  '5',
            'existencia'    =>  '10',
            'id_categoria'  =>  '1',
            'id_almacen'    =>  '1',
            'id_marca'      =>  '1'
        ]);
    }
}
