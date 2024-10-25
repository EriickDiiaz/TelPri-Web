<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piso extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'localidad_id'];

    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }

    public function lineas()
    {
        return $this->hasMany(Linea::class);
    }
}