<?php

namespace App\Http\Controllers;

use App\Models\Deposito;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Modelo;

class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('depositos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::orderBy('nombre')->get();
        return view('depositos.create',compact('marcas'));
    }

    public function getModelosByMarcas($marca_id)
    {
        $modelos = Modelo::where('marca_id', $marca_id)->orderBy('id')->get();
        return response()->json($modelos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Deposito $deposito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposito $deposito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deposito $deposito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposito $deposito)
    {
        //
    }

}