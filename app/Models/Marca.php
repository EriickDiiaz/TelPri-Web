<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';
    
    protected $fillable = ['nombre'];

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }

    public function depositos()
    {
        return $this->hasMany(Deposito::class);
    }
}