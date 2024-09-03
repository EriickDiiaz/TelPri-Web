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

        return redirect()->route('marcas.show', $marca->id)->with('mensaje', 'Modelo de equipo agregado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscar la marca por su ID
        $marca = Marca::findOrFail($id);

        // Obtener todos los modelos asociados a la marca
        $modelos = $marca->modelos()->orderBy('nombre')->get();

        // Retornar la vista de detalles de la marca con los modelos asociados
        return view('depositos/marcas.show', compact('marca', 'modelos'));
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

        return redirect()->route('marcas.show', $marca->id)->with('mensaje', 'Modelo de equipo agregado con éxito.');
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
