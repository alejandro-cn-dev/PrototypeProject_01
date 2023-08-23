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
            'ap_paterno' => 'Valencia',
            'ap_materno' => 'Palacios',
            'name' => 'Gonzalo',
            'ci' => '83610041',
            'expedido' => 'LP',
            'telefono' => '69612471',
            'matricula' => 'GVP83610041LP',
            'email' => 'gpalacios@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('administrador');
        User::create([
            'ap_paterno' => 'Conde',
            'ap_materno' => 'Pillco',
            'name' => 'Alejandro',
            'ci' => '4889167',
            'expedido' => 'LP',
            'telefono' => '61115903',
            'matricula' => 'ACP4889167LP',
            'email' => 'aconde@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('administrador');
        User::create([
            'ap_paterno' => 'Apaza',
            'ap_materno' => 'Colima',
            'name' => 'Eduardo',
            'ci' => '2969372',
            'expedido' => 'LP',
            'telefono' => '1100100',
            'matricula' => 'ECV2969372LP',
            'email' => 'vendedor1@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('vendedor');
        User::create([
            'ap_paterno' => 'Luque',
            'ap_materno' => 'Condori',
            'name' => 'Oscar',
            'ci' => '64973110',
            'expedido' => 'CB',
            'telefono' => '6325222',
            'matricula' => 'OCL64973110CB',
            'email' => 'acomodador1@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('acomodador');
        User::create([
            'ap_paterno' => 'Huanca',
            'ap_materno' => 'Flores',
            'name' => 'Blanca',
            'ci' => '93462514',
            'expedido' => 'LP',
            'telefono' => '325236',
            'matricula' => 'BFH93462514LP',
            'email' => 'cobrador1@admin.com',
            'password' => 'admin_admin'            
        ])->assignRole('cobrador');
    }
}
