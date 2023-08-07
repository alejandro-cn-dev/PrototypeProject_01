<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::create([
            'nombre' => 'Fernando Cora - ASATEX',
            'telefono' => '60291828',
            'id_usuario' => '1'
        ]);
        Proveedor::create([
            'nombre' => 'Gabriel Araujo - ASATEX',
            'telefono' => '69800166',
            'id_usuario' => '1'
        ]);
        Proveedor::create([
            'nombre' => 'Vicente Mallorca - TEXBOL',
            'telefono' => '70583801',
            'id_usuario' => '1'
        ]);
    }
}
