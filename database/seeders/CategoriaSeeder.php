<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Categoria::create([
            'nombre' => 'Tela corriente',
            'detalle' => 'Tela de uso común',
            'sufijo_categoria' => 'TC',
            'id_usuario' => '1'
        ]);
        Categoria::create([
            'nombre' => 'Tela special',
            'detalle' => 'Tela de uso específico',
            'sufijo_categoria' => 'TS',
            'id_usuario' => '1'
        ]);
        Categoria::create([
            'nombre' => 'Accesorios',
            'detalle' => 'Botones, tijeras, agujas, etc',
            'sufijo_categoria' => 'AC',
            'id_usuario' => '1'
        ]);
        Categoria::create([
            'nombre' => 'Hilos',
            'detalle' => 'Hilanderia no especializada',
            'sufijo_categoria' => 'HI',
            'id_usuario' => '1'
        ]);
        // Categoria::create([
        //     'nombre' => 'Tela Algodon',
        //     'detalle' => 'Telas hechas de algodon',
        //     'sufijo_categoria' => 'TA',
        //     'id_usuario' => '1'
        // ]);
        // Categoria::create([
        //     'nombre' => 'Tela Lino',
        //     'detalle' => 'Tela hechas de Lino',
        //     'sufijo_categoria' => 'TL',
        //     'id_usuario' => '1'
        // ]);
        // Categoria::create([
        //     'nombre' => 'Tela Nailon',
        //     'detalle' => 'Tela hechas de Nailon',
        //     'sufijo_categoria' => 'TN',
        //     'id_usuario' => '1'
        // ]);
        // Categoria::create([
        //     'nombre' => 'Tela Poliéster',
        //     'detalle' => 'Tela hechas de alguna variedad de poliéster',
        //     'sufijo_categoria' => 'TP',
        //     'id_usuario' => '1'
        // ]);
    }
}
