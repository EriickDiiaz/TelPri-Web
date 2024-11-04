<?php

namespace App\Helpers;

class FieldNameHelper
{
    public static function getAestheticName($fieldName)
    {
        $aestheticNames = [
            'linea' => 'Línea',
            'vip' => 'VIP',
            'inventario' => 'Cod. Inventario',
            'serial' => 'Serial',
            'plataforma' => 'Plataforma',
            'estado' => 'Estado',
            'titular' => 'Titular',
            'acceso' => 'Acceso',
            'localidad_id' => 'Localidad',
            'piso_id' => 'Piso',
            'mac' => 'MAC/EQ/LI3',
            'campo_id' => 'Campo',
            'par' => 'Par',
            'directo' => 'Directo',
            'observacion' => 'Observación',
            'modificado' => 'Modificado por',
            // Add more field names as needed
        ];

        return $aestheticNames[$fieldName] ?? ucfirst($fieldName);
    }
}