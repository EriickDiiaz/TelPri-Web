<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linea;
use App\Models\Deposito;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'lineas' => $this->getLineasData(),
            'depositos' => $this->getDepositosData(),
        ];

        return view('home', $data);
    }

    private function getLineasData()
    {
        $plataformas = ['Axe', 'Cisco', 'Ericsson', 'Externo'];
        $estados = ['Asignada', 'Disponible', 'Bloqueada', 'Por Verificar', 'Por Eliminar'];

        $lineasData = [];

        foreach ($plataformas as $plataforma) {
            $lineasData[strtolower($plataforma)] = $this->getPlataformaData($plataforma, $estados);
        }

        $lineasData['total'] = $this->getPlataformaData(null, $estados);

        return $lineasData;
    }

    private function getPlataformaData($plataforma, $estados)
    {
        $data = [];
        $query = Linea::query();

        if ($plataforma) {
            $query->where('plataforma', $plataforma);
        }

        foreach ($estados as $estado) {
            $key = strtolower(str_replace(' ', '', $estado));
            $data[$key] = (clone $query)->where('estado', $estado)->count();
        }

        $data['total'] = $query->count();

        return $data;
    }

    private function getDepositosData()
    {
        $ubicaciones = ['Cortijos', 'Nea'];
        $estados = ['Deposito', 'Instalado', 'Por Reparar', 'Por Desincorporar', 'Desincorporado'];

        $depositosData = [];

        foreach ($ubicaciones as $ubicacion) {
            $depositosData[strtolower($ubicacion)] = $this->getUbicacionData($ubicacion, $estados);
        }

        return $depositosData;
    }

    private function getUbicacionData($ubicacion, $estados)
    {
        $data = [];
        $query = Deposito::where('ubicacion', $ubicacion);

        foreach ($estados as $estado) {
            $key = strtolower(str_replace(' ', '', $estado));
            $data[$key] = (clone $query)->where('estado', $estado)->count();
        }

        $data['total'] = $query->count();

        return $data;
    }
}