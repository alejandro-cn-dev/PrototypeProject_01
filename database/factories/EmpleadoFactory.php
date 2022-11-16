<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ap_paterno' => 'Demo',
            'ap_materno' => 'Demo',
            'nombre' => 'Demo',
            'ci' => '00000000',
            'expedido' => 'XX',
            'id_user' => '1',
            'telefono' => '0000000',
            'matricula' => 'DDD00000000XX',
            'id_rol' => '1',  
        ];
    }
}
