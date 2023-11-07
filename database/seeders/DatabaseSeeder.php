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
        //Role Seeder's.
        //\App\Models\Rol::factory()->count(3)->sequence(['name' => 'Administrador'],['name' => 'Vendedor'],['name' => 'Acomodador'])->create();
        $this->call(ParametrosSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ProductoSeeder::class);
    }
}
