<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    /**
     * Obtener la LOCALIDAD a la que pertenece la linea. 
     */
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
    /**
     * Obtener el PISO al que pertenece la linea. 
     */
    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }
}
