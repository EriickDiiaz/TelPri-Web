<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Par extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'pares';

    protected $fillable = [
        'numero',
        'variable',
        'estado',
        'plataforma',
        'ubicacion_id',
        'observaciones',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['numero ', 'estado', 'plataforma', 'ubicacion_id ', 'observaciones'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
