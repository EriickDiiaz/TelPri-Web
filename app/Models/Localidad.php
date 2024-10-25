<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidades';
    
    protected $fillable = ['nombre'];

    public function pisos()
    {
        return $this->hasMany(Piso::class);
    }

    public function lineas()
    {
        return $this->hasMany(Linea::class);
    }
}
