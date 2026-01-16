<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UbicacionController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacion::withCount('lineas')->orderBy('nombre')->get();
        $totalUbicacion = $ubicaciones->count();

        return view('ubicaciones.index', compact('ubicaciones', 'totalUbicacion'));
    }

    public function create()
    {
        return view('ubicaciones.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateUbicacion($request);
        Ubicacion::create($validatedData);

        return redirect()->route('ubicaciones.index')->with('mensaje', 'Ubicacion guardada con éxito.');
    }

    public function show($id)
    {
        $ubicacion = Ubicacion::with(['lineas' => function($q){ $q->orderBy('linea'); }])->withCount('lineas')->findOrFail($id);
        return view('ubicaciones.show', compact('ubicacion'));
    }

    public function edit($id) 
    {
        $ubicacion = Ubicacion::findOrFail($id);
        return view('ubicaciones.edit', compact('ubicacion'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateUbicacion($request, $id);
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($validatedData);

        return redirect()->route('ubicaciones.index')->with('mensaje', 'La Ubicación ha sido actualizada con éxito.');
    }

    public function destroy($id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->delete();

        return redirect()->route('ubicaciones.index')->with('mensaje', 'Ubicación eliminada con éxito.');
    }


    protected function validateUbicacion(Request $request, $id = null)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:255', Rule::unique('ubicaciones')->ignore($id)],
            'descripcion' => 'required|string',
        ];

        $messages = [
            'nombre.required' => 'El Nombre de la ubicación es obligatorio.',
            'nombre.unique' => 'Este nombre de la ubicación ya está en uso.',
            'descripcion.required' => 'La Descripción de la ubicación es obligatoria.',
        ];

        return $request->validate($rules, $messages);
    }
}