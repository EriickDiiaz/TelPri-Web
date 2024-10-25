<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::withCount(['modelos', 'depositos'])->orderBy('nombre')->get();
        $totalMarca = $marcas->count();
        return view('depositos.marcas.index', compact('marcas', 'totalMarca'));
    }

    public function create()
    {
        return view('depositos.marcas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateMarca($request);
        $validatedData['nombre'] = Str::title($validatedData['nombre']);
        
        $marca = Marca::create($validatedData);

        return redirect()->route('marcas.show', $marca->id)
            ->with('mensaje', 'Marca agregada con éxito.');
    }

    public function show($id)
    {
        $marca = Marca::findOrFail($id);
        $modelos = $marca->modelos()->orderBy('nombre')->get();

        return view('depositos.marcas.show', compact('marca', 'modelos'));
    }

    public function edit($id)
    {
        $marca = Marca::findOrFail($id);
        return view('depositos.marcas.edit', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateMarca($request, $id);
        $validatedData['nombre'] = Str::title($validatedData['nombre']);

        $marca = Marca::findOrFail($id);
        $marca->update($validatedData);

        return redirect()->route('marcas.show', $marca->id)
            ->with('mensaje', 'Marca actualizada con éxito.');
    }

    public function destroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();

        return redirect()->route('depositos.index')
            ->with('mensaje', 'La marca ha sido eliminada con éxito.');
    }

    protected function validateMarca(Request $request, $id = null)
    {
        return $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('marcas')->ignore($id),
            ],
        ], [
            'nombre.required' => 'El Nombre de la Marca es obligatorio.',
            'nombre.unique' => 'Esta Marca ya existe.',
        ]);
    }
}