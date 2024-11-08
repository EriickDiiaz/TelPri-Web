<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocalidadController extends Controller
{
    public function index()
    {
        $localidades = Localidad::withCount(['pisos', 'lineas'])->orderBy('nombre')->get();
        $totalLocalidad = $localidades->count();
        return view('localidades.index', compact('localidades', 'totalLocalidad'));
    }

    public function create()
    {
        return view('localidades.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateLocalidad($request);
        Localidad::create($validatedData);

        return redirect()->route('localidades.index')->with('mensaje', 'Localidad guardada con éxito.');
    }

    public function show($id)
    {
        $localidad = Localidad::findOrFail($id);
        $pisos = $localidad->pisos()->withCount('lineas')->orderBy('nombre')->get();

        return view('localidades.show', compact('localidad', 'pisos'));
    }

    public function edit($id)
    {
        $localidad = Localidad::findOrFail($id);
        return view('localidades.edit', compact('localidad'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateLocalidad($request, $id);
        $localidad = Localidad::findOrFail($id);
        $localidad->update($validatedData);

        return redirect()->route('localidades.index')->with('mensaje', 'La Localidad ha sido actualizada con éxito.');
    }

    public function destroy($id)
    {
        $localidad = Localidad::findOrFail($id);
        $localidad->delete();

        return redirect()->route('localidades.index')->with('mensaje', 'Localidad eliminada con éxito.');
    }

    protected function validateLocalidad(Request $request, $id = null)
    {
        $rules = [
            'nombre' => ['required', 'string', 'max:255', Rule::unique('localidades')->ignore($id)],
        ];

        $messages = [
            'nombre.required' => 'El Nombre de la Localidad es obligatorio.',
            'nombre.unique' => 'Esta Localidad ya existe.',
        ];

        return $request->validate($rules, $messages);
    }
}