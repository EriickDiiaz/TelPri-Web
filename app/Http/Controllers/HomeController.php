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
        $accordions = [
            [
                'id' => 'acordeonLineas',
                'title' => 'Resumen de Líneas Telefónicas',
                'icon' => 'fa-phone',
                'data' => $this->getLineasData(),
                'sections' => ['axe', 'cisco', 'ericsson', 'externo', 'total'],
                'items' => [
                    'asignada' => ['icon' => 'fa-check', 'color' => '#63E6BE', 'label' => 'Asignadas'],
                    'disponible' => ['icon' => 'fa-arrow-up', 'color' => '#397ef3', 'label' => 'Disponibles'],
                    'bloqueada' => ['icon' => 'fa-ban', 'color' => '#fc883b', 'label' => 'Bloqueadas'],
                    'porverificar' => ['icon' => 'fa-exclamation', 'color' => '#FFD43B', 'label' => 'Por Verificar'],
                    'poreliminar' => ['icon' => 'fa-xmark', 'color' => '#f53246', 'label' => 'Por Eliminar'],
                    'total' => ['icon' => 'fa-hashtag', 'color' => '#d158e9', 'label' => 'Total']
                ]
            ],
            [
                'id' => 'acordeonDeposito',
                'title' => 'Resumen de Equipos en Depósito',
                'icon' => 'fa-warehouse',
                'data' => $this->getDepositosData(),
                'sections' => ['cortijos', 'nea'],
                'items' => [
                    'deposito' => ['icon' => 'fa-archive', 'color' => '#63E6BE', 'label' => 'En Depósito'],
                    'instalado' => ['icon' => 'fa-check-circle', 'color' => '#397ef3', 'label' => 'Instalados'],
                    'porreparar' => ['icon' => 'fa-tools', 'color' => '#fc883b', 'label' => 'Por Reparar'],
                    'pordesincorporar' => ['icon' => 'fa-trash-alt', 'color' => '#FFD43B', 'label' => 'Por Desincorporar'],
                    'desincorporado' => ['icon' => 'fa-times-circle', 'color' => '#f53246', 'label' => 'Desincorporados'],
                    'total' => ['icon' => 'fa-hashtag', 'color' => '#d158e9', 'label' => 'Total']
                ]
            ],
            [
                'id' => 'acordeonRedes',
                'title' => 'Resumen Redes Corporativas',
                'icon' => 'fa-network-wired',
                'data' => [],
                'sections' => [],
                'items' => []
            ]
        ];

        return view('home', compact('accordions'));
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