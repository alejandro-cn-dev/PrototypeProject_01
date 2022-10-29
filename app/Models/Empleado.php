<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'ap_paterno',
        'ap_materno',
        'nombre',
        'ci',
        'expedido',
        'id_user',
        'telefono',
        'matricula',
        'id_rol' 
    ];
}
