<?php

namespace App\Http\Controllers;

use App\Models\Hatillo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class HatilloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hatillo = Hatillo::all();

        return view('hatillo.index', compact('hatillo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hatillo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateHatillo($request);
        $hatillo = Hatillo::create($validatedData);

        return redirect()->route('hatillo.show', $hatillo->id)->with('mensaje', 'Línea agregada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hatillo = Hatillo::findOrFail($id);
        return view('hatillo.show', compact('hatillo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hatillo = Hatillo::findOrFail($id);
        return view('hatillo.edit', compact('hatillo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateHatillo($request, $id);
        $hatillo = Hatillo::findOrFail($id);
        $hatillo->update($validatedData);

        return redirect()->route('hatillo.show', $hatillo->id)->with('mensaje', 'Línea modificada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hatillo = Hatillo::findOrFail($id);
        $hatillo->delete();

        return redirect()->route('hatillo.index')->with('mensaje', 'Línea eliminada con éxito.');
    }

    protected function validateHatillo(Request $request, $id = null)
    {
        $rules = [
            'linea' => ['required', 'max:10', Rule::unique('hatillo')->ignore($id)],
            'estado' => 'required|max:20',
            'titular' => 'nullable|max:100',
            'inventario' => 'nullable|max:50',
            'serial' => 'nullable|max:50',
            'mac' => 'nullable|max:50',
            'piso' => 'nullable|max:15',
            'ephone' => ['nullable', 'max:3', Rule::unique('hatillo')->ignore($id)],
            'dn' => ['nullable', 'max:3', Rule::unique('hatillo')->ignore($id)],
            'observacion' => 'nullable|max:255',
            'modificado' => 'nullable|max:50',
        ];

        $messages = [
            'linea.required' => 'El campo línea es obligatorio.',
            'linea.unique' => 'La línea ya está en uso.',
            'linea.max' => 'La línea no puede tener más de 10 caracteres.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.max' => 'El estado no puede tener más de 20 caracteres.',
            'titular.max' => 'El titular no puede tener más de 100 caracteres.',
            'inventario.max' => 'El inventario no puede tener más de 50 caracteres.',
            'serial.max' => 'El serial no puede tener más de 50 caracteres.',
            'mac.max' => 'La mac address no puede tener más de 50 caracteres.',
            'piso.max' => 'El piso no puede tener más de 15 caracteres.',
            'ephone.max' => 'El e-phone no puede tener más de 2 caracteres.',
            'ephone.unique' => 'Este e-phone ya está en uso.',
            'dn.max' => 'El dn no puede tener más de 2 caracteres.',
            'dn.unique' => 'Este dn ya está en uso.',
            'usuario.unique' => 'Este usuario ya está en uso.',
            'observacion.max' => 'Las observaciones no pueden tener más de 255 caracteres.',
        ];

        return $request->validate($rules, $messages);
    }
}
