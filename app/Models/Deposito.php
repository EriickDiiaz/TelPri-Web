<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Deposito extends Model
{
    use HasFactory, LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['inventario', 'serial', 'marca_id', 'modelo_id', 'ubicacion', 'estado', 'observacion'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }
}