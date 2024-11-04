<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Linea extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'linea', 'vip', 'inventario', 'serial', 'plataforma', 'estado', 'titular',
        'acceso', 'localidad_id', 'piso_id', 'mac', 'campo_id', 'par', 'directo',
        'observacion', 'modificado'
    ];

    protected $casts = [
        'acceso' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "Esta línea ha sido {$eventName}");
    }

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
}