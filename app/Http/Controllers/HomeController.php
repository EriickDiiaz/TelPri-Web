<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Linea;
use App\Models\Deposito;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Resumen de Lineas Axe
        $axeAsig = Linea::where('plataforma', 'Axe')->where('estado', 'Asignada')->count();
        $axeDisp = Linea::where('plataforma', 'Axe')->where('estado', 'Disponible')->count();
        $axeBloq = Linea::where('plataforma', 'Axe')->where('estado', 'Bloqueada')->count();
        $axeVeri = Linea::where('plataforma', 'Axe')->where('estado', 'Por Verificar')->count();
        $axeElim = Linea::where('plataforma', 'Axe')->where('estado', 'Por Eliminar')->count();
        $totalAxe = Linea::where('plataforma', 'Axe')->count();

        // Resumen de Lineas Cisco
        $ciscoAsig = Linea::where('plataforma', 'Cisco')->where('estado', 'Asignada')->count();
        $ciscoDisp = Linea::where('plataforma', 'Cisco')->where('estado', 'Disponible')->count();
        $ciscoBloq = Linea::where('plataforma', 'Cisco')->where('estado', 'Bloqueada')->count();
        $ciscoVeri = Linea::where('plataforma', 'Cisco')->where('estado', 'Por Verificar')->count();
        $ciscoElim = Linea::where('plataforma', 'Cisco')->where('estado', 'Por Eliminar')->count();
        $totalCisco = Linea::where('plataforma', 'Cisco')->count();

        // Resumen de Lineas Ericsson
        $ericssonAsig = Linea::where('plataforma', 'Ericsson')->where('estado', 'Asignada')->count();
        $ericssonDisp = Linea::where('plataforma', 'Ericsson')->where('estado', 'Disponible')->count();
        $ericssonBloq = Linea::where('plataforma', 'Ericsson')->where('estado', 'Bloqueada')->count();
        $ericssonVeri = Linea::where('plataforma', 'Ericsson')->where('estado', 'Por Verificar')->count();
        $ericssonElim = Linea::where('plataforma', 'Ericsson')->where('estado', 'Por Eliminar')->count();
        $totalEricsson = Linea::where('plataforma', 'Ericsson')->count();

        // Resumen de Lineas Externo
        $externoAsig = Linea::where('plataforma', 'Externo')->where('estado', 'Asignada')->count();
        $externoDisp = Linea::where('plataforma', 'Externo')->where('estado', 'Disponible')->count();
        $externoBloq = Linea::where('plataforma', 'Externo')->where('estado', 'Bloqueada')->count();
        $externoVeri = Linea::where('plataforma', 'Externo')->where('estado', 'Por Verificar')->count();
        $externoElim = Linea::where('plataforma', 'Externo')->where('estado', 'Por Eliminar')->count();
        $totalExterno = Linea::where('plataforma', 'Externo')->count();

        // Totales generales
        $totalAsig = Linea::where('estado', 'Asignada')->count();
        $totalDisp = Linea::where('estado', 'Disponible')->count();
        $totalBloq = Linea::where('estado', 'Bloqueada')->count();
        $totalVeri = Linea::where('estado', 'Por Verificar')->count();
        $totalElim = Linea::where('estado', 'Por Eliminar')->count();
        $totalLineas = Linea::count();

        // Resumen de Deposito Cortijos
        $depCrtDep = Deposito::where('ubicacion', 'Cortijos')->where('estado', 'Deposito')->count();
        $depCrtIns = Deposito::where('ubicacion', 'Cortijos')->where('estado', 'Instalado')->count();
        $depCrtPRep = Deposito::where('ubicacion', 'Cortijos')->where('estado', 'Por Reparar')->count();
        $depCrtPDes = Deposito::where('ubicacion', 'Cortijos')->where('estado', 'Por Desincorporar')->count();        
        $depCrtDes = Deposito::where('ubicacion', 'Cortijos')->where('estado', 'Desincorporado')->count();
        $totalDepCrt = Deposito::where('ubicacion', 'Cortijos')->count();

        // Resumen de Deposito Nea
        $depNeaDep = Deposito::where('ubicacion', 'Nea')->where('estado', 'Deposito')->count();
        $depNeaIns = Deposito::where('ubicacion', 'Nea')->where('estado', 'Instalado')->count();
        $depNeaPRep = Deposito::where('ubicacion', 'Nea')->where('estado', 'Por Reparar')->count();
        $depNeaPDes = Deposito::where('ubicacion', 'Nea')->where('estado', 'Por Desincorporar')->count();        
        $depNeaDes = Deposito::where('ubicacion', 'Nea')->where('estado', 'Desincorporado')->count();
        $totalDepNea = Deposito::where('ubicacion', 'Nea')->count();

        return view('home', compact('axeAsig', 'axeDisp', 'axeBloq', 'axeVeri', 'axeElim', 'totalAxe',
                'ciscoAsig', 'ciscoDisp', 'ciscoBloq', 'ciscoVeri', 'ciscoElim', 'totalCisco', 
                'ericssonAsig', 'ericssonDisp', 'ericssonBloq', 'ericssonVeri', 'ericssonElim', 'totalEricsson', 
                'externoAsig', 'externoDisp', 'externoBloq', 'externoVeri', 'externoElim', 'totalExterno',
                'totalAsig', 'totalDisp', 'totalBloq', 'totalVeri', 'totalElim', 'totalLineas', 
                'depCrtDep', 'depCrtIns', 'depCrtPDes', 'depCrtPRep', 'depCrtDes', 'totalDepCrt',
                'depNeaDep', 'depNeaIns', 'depNeaPDes', 'depNeaPRep', 'depNeaDes', 'totalDepNea',
            ));
    }

}
