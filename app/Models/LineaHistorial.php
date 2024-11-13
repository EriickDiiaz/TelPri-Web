<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaHistorial extends Model
{
    protected $table = 'linea_historial';
    protected $fillable = [
        'linea_id',
        'evento',
        'valor_anterior',
        'nuevo_valor',
        'usuario_id',
    ];
}