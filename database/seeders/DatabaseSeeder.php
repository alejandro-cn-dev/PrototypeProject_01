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
    }
}
