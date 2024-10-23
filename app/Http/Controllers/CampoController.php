<?php

namespace App\Http\Controllers;

use App\Models\Campo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CampoController extends Controller
{
    public function index()
    {
        $campos = Campo::withCount('lineas')->orderBy('nombre')->get();
        $totalCampo = $campos->count();

        return view('campos.index', compact('campos', 'totalCampo'));
    }

    public function create()
    {
        return view('campos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateCampo($request);
        Campo::create($validatedData);

        return redirect()->route('campos.index')->with('mensaje', 'Campo guardado con éxito.');
    }

    public function edit(Campo $campo)
    {
        return view('campos.edit', compact('campo'));
    }

    public function update(Request $request, Campo $campo)
    {
        $validatedData = $this->validateCampo($request, $campo->id);
        $campo->update($validatedData);

        return redirect()->route('campos.index')->with('mensaje', 'Campo actualizado con éxito.');
    }

    public function destroy(Campo $campo)
    {
        $campo->delete();

        return redirect()->route('campos.index')->with('mensaje', 'Campo eliminado con éxito.');
    }

    protected function validateCampo(Request $request, $id = null)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:255', Rule::unique('campos')->ignore($id)],
            'descripcion' => 'required|string',
        ];

        $messages = [
            'nombre.required' => 'El Nombre del campo es obligatorio.',
            'nombre.unique' => 'Este nombre de campo ya está en uso.',
            'descripcion.required' => 'La Descripción del campo es obligatoria.',
        ];

        return $request->validate($rules, $messages);
    }
}