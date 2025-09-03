<?php

namespace App\Http\Controllers;

use App\Models\Par;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParController extends Controller
{

    public function index()
    {
        $pares = Par::with('ubicacion')->paginate(20);
        return view('pares.index', compact('pares'));
    }

    public function create()
    {
        $ubicaciones = Ubicacion::all();
        return view('pares.create', compact('ubicaciones'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePar($request);
        
        $par = Par::create($validatedData);

        return redirect()->route('pares.show', $par->id)->with('mensaje', 'Par agregado con éxito.');
    }

    public function show($id)
    {
        $par = Par::findOrFail($id);
        $activities = $par->activities()->with('causer')->latest()->get();
        return view('pares.show', compact('par', 'activities'));
    }

    public function edit($id)
    {
        $ubicaciones = Ubicacion::all();
        $par = Par::findOrFail($id);
        return view('pares.edit', compact('par', 'ubicaciones'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validatePar($request, $id);

        $par = Par::findOrFail($id);
        $par->update($validatedData);

        return redirect()->route('pares.show', $par->id)->with('mensaje', 'Par actualizado con éxito.');
    }

    public function destroy($id)
    {
        $par = Par::findOrFail($id);
        $par->delete();

        return redirect()->route('pares.index')->with('mensaje', 'Par eliminado con éxito.');
    }

    protected function validatePar(Request $request, $id = null)
    {
        $rules = [
            'numero' => [
                'required',
                'string',
                'max:4',
                Rule::unique('pares')->where(fn ($q) => $q->where('ubicacion_id', $request->ubicacion_id))->ignore($id),
            ],
            'estado' => 'required|string|max:20',
            'plataforma' => 'nullable|string|max:20',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'observaciones' => 'nullable|string|max:255',
        ];

        $messages = [
            'numero.required' => 'Debes colocar el número, es obligatorio.',
            'numero.string' => 'El número debe ser una cadena de texto.',
            'numero.max' => 'El número no puede tener más de 4 caracteres.',
            'numero.unique' => 'Este número ya existe en la ubicación seleccionada.',
            'estado.required' => 'Debes seleccionar el estado, es obligatorio.',
            'estado.string' => 'El estado debe ser una cadena de texto.',
            'estado.max' => 'El estado no puede tener más de 20 caracteres.',
            'plataforma.string' => 'La plataforma debe ser una cadena de texto.',
            'plataforma.max' => 'La plataforma no puede tener más de 20 caracteres.',
            'ubicacion_id.required' => 'Debes seleccionar una ubicación.',
            'ubicacion_id.exists' => 'La ubicación seleccionada no es válida.',
            'observaciones.string' => 'Las observaciones deben ser una cadena de texto.',
            'observaciones.max' => 'Las observaciones no pueden tener más de 255 caracteres.',
        ];

        return $request->validate($rules, $messages);
    }
}
