<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class PermisoController extends Controller
{
    public function index()
    {
        $permisos = Permission::all();
        $totalPermisos = $permisos->count();
        return view('permisos.index', compact('permisos', 'totalPermisos'));
    }

    public function create()
    {
        return view('permisos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePermiso($request);
        $permiso = Permission::create($validatedData);

        return redirect()->route('permisos.index')->with('mensaje', 'Permiso guardado con éxito.');
    }

    public function edit(Permission $permiso)
    {
        return view('permisos.edit', compact('permiso'));
    }

    public function update(Request $request, Permission $permiso)
    {
        $validatedData = $this->validatePermiso($request, $permiso->id);
        $permiso->update($validatedData);
        
        return redirect()->route('permisos.index')->with('mensaje', 'Permiso actualizado con éxito.');
    }

    public function destroy(Permission $permiso)
    {
        $permiso->delete();

        return redirect()->route('permisos.index')->with('mensaje', 'Permiso eliminado con éxito.');
    }

    protected function validatePermiso(Request $request, $id = null)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($id)],
        ], [
            'name.required' => 'El nombre del permiso es obligatorio.',
            'name.string' => 'El nombre del permiso debe ser una cadena de texto.',
            'name.max' => 'El nombre del permiso no puede tener más de 255 caracteres.',
            'name.unique' => 'Este nombre de permiso ya está en uso.',
        ]);
    }
}