<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hatillo extends Model
{
    use HasFactory;

    protected $table = 'hatillo';

    protected $fillable = [
        'linea',
        'estado',
        'titular',
        'inventario',
        'serial',
        'mac',
        'piso',
        'ephone',
        'dn',
        'observacion',
        'modificado',
    ];

    // If you need any relationships or custom methods, add them here
}