<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        User::create([
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
        User::create([
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
        User::create([
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
        User::create([
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
    }
}
