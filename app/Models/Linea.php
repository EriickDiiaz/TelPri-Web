<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;

    protected $fillable = [
        'linea', 'vip', 'inventario', 'serial', 'plataforma', 'estado', 'titular',
        'acceso', 'localidad_id', 'piso_id', 'mac', 'campo_id', 'par', 'directo',
        'observacion', 'modificado'
    ];

    protected $casts = [
        'acceso' => 'array',
    ];

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function piso()
    {
        return $this->belongsTo(Piso::class, 'piso_id');
    }

    public function campo()
    {
        return $this->belongsTo(Campo::class);
    }

    public function historial()
    {
        return $this->hasMany(Historial::class);
    }
}