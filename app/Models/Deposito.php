<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventario',
        'serial',
        'marca_id',
        'modelo_id',
        'ubicacion',
        'estado',
        'observacion',
        'modificado',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }
}