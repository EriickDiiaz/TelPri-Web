<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaHistorial extends Model
{
    protected $table = 'linea_historial';
    protected $fillable = [
        'linea_id',
        'user_id',
        'evento',
        'nombre_campo',
        'valor_anterior',
        'valor_nuevo',
        'ip_address',
        'user_agent'
    ];

    public function linea()
    {
        return $this->belongsTo(Linea::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}