<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositoHistorial extends Model
{
    use HasFactory;

    protected $table = 'deposito_historial';

    protected $fillable = [
        'deposito_id',
        'campo_modificado',
        'valor_anterior',
        'valor_nuevo',
        'usuario_id',
    ];

    public function deposito()
    {
        return $this->belongsTo(Deposito::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
