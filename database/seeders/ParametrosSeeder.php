<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parametro;

class ParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parametro::create([
            'nombre' => 'nombre_sistema',
            'valor' => 'Presitex'
        ]);
        Parametro::create([
            'nombre' => 'logo_sistema',
            'valor' => 'data:image/png;base64,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'
        ]);
        Parametro::create([
            'nombre' => 'logo_sistema_path',
            'valor' => 'favicons/favicon32x32.ico'
        ]);
        Parametro::create([
            'nombre' => 'existencias_min',
            'valor' => '10'
        ]);
        Parametro::create([
            'nombre' => 'existencias_max',
            'valor' => '200'
        ]);
        Parametro::create([
            'nombre' => 'mision',
            'valor' => 'Presitex'
        ]);
        Parametro::create([
            'nombre' => 'vision',
            'valor' => 'Presitex'
        ]);
    }
}
