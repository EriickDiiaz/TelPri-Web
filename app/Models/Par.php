<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Par extends Model
{
    use HasFactory;

    protected $table = 'pares';

    protected $fillable = [
        'numero',
        'estado',
        'plataforma',
        'ubicacion_id',
        'observaciones',
    ];

    /**
     * Relación: Un par pertenece a una ubicación.
     */
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }
}
