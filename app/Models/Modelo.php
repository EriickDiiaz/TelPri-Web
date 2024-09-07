<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    /**
     * Obtener los modelos que pertenece a la marca. 
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
