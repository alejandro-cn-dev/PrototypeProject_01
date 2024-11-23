<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marca::create([
            'detalle' => 'Genérico',
            'sufijo_marca' => 'GN',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'ASATEX',
            'sufijo_marca' => 'AS',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'TEXTILON',
            'sufijo_marca' => 'TT',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'TEXBOL',
            'sufijo_marca' => 'TB',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'TEXBOL',
            'sufijo_marca' => 'TB',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'Lafayette',
            'sufijo_marca' => 'LY',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'Lamtex',
            'sufijo_marca' => 'LT',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'TEYCOT',
            'sufijo_marca' => 'TC',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'Construex',
            'sufijo_marca' => 'CT',
            'id_usuario' => '1'
        ]);
        Marca::create([
            'detalle' => 'SENATEX',
            'sufijo_marca' => 'ST',
            'id_usuario' => '1'
        ]);
    }
}
