<?php

namespace App\Http\Controllers;

use App\Models\localidad;
use App\Models\Piso;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $localidades = Localidad::withCount('pisos')->orderBy('nombre')->get();
        $totalLocalidad = Localidad::count();
        return view('localidades.index', compact('localidades','totalLocalidad'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('localidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $errors = [
            'nombre.required' => 'El campo localidad es obligatorio.',
        ];

        $request->validate([
            'nombre' =>'required',
        ],$errors);

        $localidad = new Localidad();
        $localidad->nombre = $request->input('nombre');
        $localidad->save();

        return redirect ('localidades')->with('mensaje','Localidad guardada con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscar la localidad por su ID
        $localidad = Localidad::findOrFail($id);

        // Obtener todos los pisos asociados a la localidad
        $pisos = $localidad->pisos()->orderBy('nombre')->get();

        // Retornar la vista de detalles de la localidad con los pisos asociados
        return view('localidades.show', compact('localidad', 'pisos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $localidad = Localidad::find($id);
        return view('localidades.edit',['localidad'=>$localidad]);
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
        $localidad = Localidad::find($id);
        $localidad->delete();

        return redirect('localidades')->with('mensaje','Localidad eliminada con exito.');
    }

}
