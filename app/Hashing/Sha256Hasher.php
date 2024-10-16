<?php

namespace App\Hashing;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class Sha256Hasher implements HasherContract
{
    public function make($value, array $options = [])
    {
        // Aquí podrías agregar un salt si lo deseas
        return hash('sha256', $value);
    }

    public function check($value, $hashedValue, array $options = [])
    {
        // Comparar el hash con el valor dado
        return hash('sha256', $value) === $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        // Define si se necesita rehash, en este caso siempre será falso
        return false;
    }
    public function info($hashedValue)
    {
        // Devuelve la información del hash en el formato esperado
        return [
            'algo' => PASSWORD_BCRYPT, // Usa bcrypt como referencia para la estructura
            'algoName' => 'sha256',
            'options' => [],
        ];
    }
}
