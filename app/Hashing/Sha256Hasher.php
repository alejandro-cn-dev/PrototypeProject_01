<?php

namespace App\Hashing;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class Sha256Hasher implements HasherContract
{
    public function make($value, array $options = [])
    {
        return hash('sha256', $value);
    }

    public function check($value, $hashedValue, array $options = [])
    {
        return hash('sha256', $value) === $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }
    public function info($hashedValue)
    {
        return [
            'algo' => PASSWORD_BCRYPT,
            'algoName' => 'sha256',
            'options' => [],
        ];
    }
}
