<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class GlobalSettings extends Model
{
    protected $settings;
    protected $keyValuePair;

    public function __construct(Collection $settings)
    {
        $this->settings = $settings;
        foreach ($settings as $setting){
            $this->keyValuePair[$setting->key] = $setting->value;
        }
    }

    public function has(string $key){ /* check key exists */ }
    public function contains(string $key){ /* check value exists */ }
    public function get(string $key){ 
        /* get by key */ 
        return $this->keyValuePair[$key];
    }
}
