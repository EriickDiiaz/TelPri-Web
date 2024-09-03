<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::orderBy('nombre')->get();
        return view('depositos/modelos.create',compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $errors = [
            'nombre.required' => 'El nombre del modelo es obligatorio.',
            'marca_id.required' => 'Debes seleccionar la Marca a la que pertenece este Modelo.',
        ];

        $request->validate([
            'nombre' =>'required',
            'marca_id' => 'required'
        ], $errors);

        $modelo = new Modelo();
        $modelo->nombre = $request->input('nombre');
        $modelo->marca_id = $request->input('marca_id');
        $modelo->save();

        // Obtener la localidad a la que pertenece el piso recién creado
        $marca = Marca::findOrFail($modelo->marca_id);

        // Redirigir al método show de la sección Localidades para la localidad correspondiente
        return redirect()->route('marcas.show', $marca->id)->with('mensaje', 'Modelo de equipo agregado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Modelo $modelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $marcas = Marca::orderBy('nombre')->get();
        $modelo = Modelo::find($id);
        return view('depositos/modelos.edit',compact ('modelo', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $errors = [
            'nombre.required' => 'El nombre del modelo es obligatorio.',
            'marca_id.required' => 'Debes seleccionar la Marca a la que pertenece este Modelo.',
        ];

        $request->validate([
            'nombre' =>'required',
            'marca_id' => 'required'
        ],$errors);

        $modelo = Modelo::find($id);
        $modelo->nombre = $request->input('nombre');
        $modelo->marca_id = $request->input('marca_id');
        $modelo->save();

        // Obtener la localidad a la que pertenece el piso recién creado
        $marca = Marca::findOrFail($modelo->marca_id);

        // Redirigir al método show de la sección Localidades para la localidad correspondiente
        return redirect()->route('marcas.show', $marca->id)->with('mensaje', 'Modelo de equipo actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelo $modelo)
    {
        $modelo = Modelo::find($id);
        $modelo->delete();

        return redirect('depositos')->with('mensaje','El Modelo ha sido eliminado con exito.');
    }
}
