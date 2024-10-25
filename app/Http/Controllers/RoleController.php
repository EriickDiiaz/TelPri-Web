<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('permissions')->get();
        $totalRoles = $roles->count();
        return view('roles.index', compact('roles', 'totalRoles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateRole($request);
        $role = Role::create($validatedData);
        $this->syncPermissions($role, $request->input('permissions', []));

        return redirect()->route('roles.index')->with('mensaje', 'Rol guardado con éxito.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $this->validateRole($request, $role->id);
        $role->update($validatedData);
        $this->syncPermissions($role, $request->input('permissions', []));
        
        return redirect()->route('roles.index')->with('mensaje', 'Rol actualizado con éxito.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('mensaje', 'Rol eliminado con éxito.');
    }

    protected function validateRole(Request $request, $id = null)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($id)],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,id'],
        ], [
            'name.required' => 'El nombre del rol es obligatorio.',
            'name.unique' => 'Este nombre de rol ya está en uso.',
            'permissions.array' => 'Los permisos deben ser una lista.',
            'permissions.*.exists' => 'Uno o más permisos seleccionados no existen.',
        ]);
    }

    protected function syncPermissions(Role $role, array $permissions)
    {
        $permissionModels = Permission::whereIn('id', $permissions)->get();
        $role->syncPermissions($permissionModels);
    }
}