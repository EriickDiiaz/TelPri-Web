<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::withCount('modelos')->orderBy('nombre')->get();
        $totalMarca = Marca::count();
        return view('depositos/marcas.index', compact('marcas','totalMarca'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('depositos/marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $errors = [
            'nombre.required' => 'El Nombre de la Marca es obligatorio.',
        ];

        $request->validate([
            'nombre' =>'required',
        ],$errors);

        $marca = new Marca();
        $marca->nombre = Str::title($request->input('nombre'));
        $marca->save();

        return redirect ('depositos')->with('mensaje','La Marca de equipo ha sido guardada con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $marca = Marca::find($id);
        return view('depositos/marcas.edit',['marca'=>$marca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $errors = [
            'nombre.required' => 'El Nombre de la Marca es obligatorio.',
        ];
        
        $request->validate([
            'nombre' =>'required',
        ], $errors);

        $marca = Marca::find($id);
        $marca->nombre = $request->input('nombre');        
        $marca->save();

        return redirect ('depositos')->with('mensaje','La Marca de equipo ha sido actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $marca = Marca::find($id);
        $marca->delete();

        return redirect('depositos')->with('mensaje','La marca ha sido eliminada con exito.');
    }
}
