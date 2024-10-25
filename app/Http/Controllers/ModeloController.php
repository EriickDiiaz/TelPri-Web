<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModeloController extends Controller
{
    public function index()
    {
        $modelos = Modelo::with('marca')->withCount('depositos')->orderBy('nombre')->get();
        $totalModelos = $modelos->count();
        return view('depositos.modelos.index', compact('modelos', 'totalModelos'));
    }

    public function create()
    {
        $marcas = Marca::orderBy('nombre')->get();
        return view('depositos.modelos.create', compact('marcas'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateModelo($request);
        $modelo = Modelo::create($validatedData);

        return redirect()->route('marcas.show', $modelo->marca_id)
            ->with('mensaje', 'Modelo de equipo agregado con éxito.');
    }

    public function edit($id)
    {
        $marcas = Marca::orderBy('nombre')->get();
        $modelo = Modelo::findOrFail($id);
        return view('depositos.modelos.edit', compact('modelo', 'marcas'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateModelo($request);
        $modelo = Modelo::findOrFail($id);
        $modelo->update($validatedData);

        return redirect()->route('marcas.show', $modelo->marca_id)
            ->with('mensaje', 'Modelo de equipo actualizado con éxito.');
    }

    public function destroy($id)
    {
        $modelo = Modelo::findOrFail($id);
        $marca_id = $modelo->marca_id;
        $modelo->delete();

        return redirect()->route('marcas.show', $marca_id)
            ->with('mensaje', 'El Modelo ha sido eliminado con éxito.');
    }

    protected function validateModelo(Request $request)
    {
        return $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('modelos')->where(function ($query) use ($request) {
                    return $query->where('marca_id', $request->marca_id);
                }),
            ],
            'marca_id' => 'required|exists:marcas,id',
        ], [
            'nombre.required' => 'El nombre del modelo es obligatorio.',
            'nombre.unique' => 'Este modelo ya existe para esta marca.',
            'marca_id.required' => 'Debes seleccionar la Marca a la que pertenece este Modelo.',
            'marca_id.exists' => 'La marca seleccionada no existe.',
        ]);
    }
}