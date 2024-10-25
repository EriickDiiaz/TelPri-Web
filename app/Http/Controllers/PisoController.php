<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PisoController extends Controller
{
    public function index(Request $request)
    {
        $localidades = Localidad::all();
        $busqueda = $request->busqueda;
        
        $pisosQuery = Piso::with('localidad')->withCount('lineas')->orderBy('localidad_id');

        if ($busqueda) {
            $pisosQuery->where('localidad_id', $busqueda);
        }

        $pisos = $pisosQuery->get();
        $totalPiso = $pisos->count();

        return view('pisos.index', compact('pisos', 'totalPiso', 'localidades', 'busqueda'));
    }

    public function create()
    {
        $localidades = Localidad::orderBy('nombre')->get();
        return view('pisos.create', compact('localidades'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePiso($request);
        $piso = Piso::create($validatedData);

        return redirect()->route('localidades.show', $piso->localidad_id)
            ->with('mensaje', 'Piso agregado con éxito.');
    }

    public function edit($id)
    {
        $localidades = Localidad::orderBy('nombre')->get();
        $piso = Piso::findOrFail($id);
        return view('pisos.edit', compact('piso', 'localidades'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validatePiso($request);
        $piso = Piso::findOrFail($id);
        $piso->update($validatedData);

        return redirect()->route('localidades.show', $piso->localidad_id)
            ->with('mensaje', 'Piso actualizado con éxito.');
    }

    public function destroy($id)
    {
        $piso = Piso::findOrFail($id);
        $localidad_id = $piso->localidad_id;
        $piso->delete();

        return redirect()->route('localidades.show', $localidad_id)
            ->with('mensaje', 'Piso eliminado con éxito.');
    }

    protected function validatePiso(Request $request)
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'localidad_id' => ['required', 'exists:localidades,id'],
        ], [
            'nombre.required' => 'El nombre del piso es obligatorio.',
            'localidad_id.required' => 'Debes seleccionar la Localidad a la que pertenece este Piso.',
            'localidad_id.exists' => 'La Localidad seleccionada no existe.',
        ]);
    }
}