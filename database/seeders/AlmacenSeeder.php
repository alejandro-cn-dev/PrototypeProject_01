<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Almacen;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Almacen::create([
            'nombre' => 'Deposito #3',
            'tipo' => 'deposito',
            'sufijo_almacen' => 'D3',
            'id_usuario' => '1'
        ]);
        Almacen::create([
            'nombre' => 'Almacen #2',
            'tipo' => 'almacen',
            'sufijo_almacen' => 'A2',
            'id_usuario' => '1'
        ]);
        Almacen::create([
            'nombre' => 'Almacen principal #1',
            'tipo' => 'almacen',
            'sufijo_almacen' => 'A1',
            'id_usuario' => '1'
        ]);
    }
}
