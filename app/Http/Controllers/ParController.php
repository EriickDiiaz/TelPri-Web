<?php

namespace App\Http\Controllers;

use App\Models\Par;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class ParController extends Controller
{
    /**
     * Muestra una lista de los pares.
     */
    public function index()
    {
        $pares = Par::with('ubicacion')->paginate(20);
        return view('pares.index', compact('pares'));
    }

    /**
     * Muestra el formulario para crear un nuevo par.
     */
    public function create()
    {
        $ubicaciones = Ubicacion::all();
        return view('pares.create', compact('ubicaciones'));
    }

    /**
     * Almacena un nuevo par en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|string|max:4',
            'estado' => 'required|string|max:20',
            'plataforma' => 'nullable|string|max:20',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'observaciones' => 'nullable|string|max:255',
        ]);

        Par::create($request->all());

        return redirect()->route('pares.index')->with('success', 'Par creado correctamente.');
    }

    /**
     * Muestra la información de un par específico.
     */
    public function show(Par $par)
    {
        return view('pares.show', compact('par'));
    }

    /**
     * Muestra el formulario para editar un par.
     */
    public function edit(Par $par)
    {
        $ubicaciones = Ubicacion::all();
        return view('pares.edit', compact('par', 'ubicaciones'));
    }

    /**
     * Actualiza un par en la base de datos.
     */
    public function update(Request $request, Par $par)
    {
        $request->validate([
            'numero' => 'required|string|max:4',
            'estado' => 'required|string|max:20',
            'plataforma' => 'nullable|string|max:20',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'observaciones' => 'nullable|string|max:255',
        ]);

        $par->update($request->all());

        return redirect()->route('pares.index')->with('success', 'Par actualizado correctamente.');
    }

    /**
     * Elimina un par de la base de datos.
     */
    public function destroy(Par $par)
    {
        $par->delete();
        return redirect()->route('pares.index')->with('success', 'Par eliminado correctamente.');
    }
}
