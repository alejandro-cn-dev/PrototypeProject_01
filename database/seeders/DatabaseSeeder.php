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
            'password' => '87654321',
            'role' => 'admin'
        ]);
        \App\Models\Rol::factory()->create([
            'detalle' => 'admin'
        ]);
        \App\Models\Empleado::factory()->create([
            'ap_paterno' => 'Demo',
            'ap_materno' => 'Demo',
            'nombre' => 'Demo',
            'id_user' => '1',
            'telefono' => '000000',
            'matricula' => 'Xxx########YY',
            'id_rol' => '1',            
        ]);
    }
}
