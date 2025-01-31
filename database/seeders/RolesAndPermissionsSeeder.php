<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'Menu Lineas']);
        Permission::create(['name' => 'Crear Lineas']);
        Permission::create(['name' => 'Editar Lineas']);
        Permission::create(['name' => 'Eliminar Lineas']);
        Permission::create(['name' => 'Ver Lineas']);
        Permission::create(['name' => 'Menu CallCenters']);
        Permission::create(['name' => 'Crear Usuario CallCenter']);
        Permission::create(['name' => 'Editar Usuario CallCenter']);
        Permission::create(['name' => 'Eliminar Usuario CallCenter']);
        Permission::create(['name' => 'Menu Hatillo']);
        Permission::create(['name' => 'Crear Hatillo']);
        Permission::create(['name' => 'Editar Hatillo']);
        Permission::create(['name' => 'Eliminar Hatillo']);
        Permission::create(['name' => 'Menu Deposito']);
        Permission::create(['name' => 'Agregar Equipo Deposito']);
        Permission::create(['name' => 'Editar Equipo Deposito']);
        Permission::create(['name' => 'Eliminar Equipo Deposito']);
        Permission::create(['name' => 'Agregar Marca-Modelo']);
        Permission::create(['name' => 'Editar Marca-Modelo']);
        Permission::create(['name' => 'Eliminar Marca-Modelo']);
        Permission::create(['name' => 'Menu Localidades']);
        Permission::create(['name' => 'Crear Localidades']);
        Permission::create(['name' => 'Editar Localidades']);
        Permission::create(['name' => 'Eliminar Localidades']);
        Permission::create(['name' => 'Crear Pisos']);
        Permission::create(['name' => 'Editar Pisos']);
        Permission::create(['name' => 'Eliminar Pisos']);
        Permission::create(['name' => 'Crear Campos']);
        Permission::create(['name' => 'Editar Campos']);
        Permission::create(['name' => 'Eliminar Campos']);
        Permission::create(['name' => 'Menu Usuarios']);
        Permission::create(['name' => 'Crear Usuarios']);
        Permission::create(['name' => 'Editar Usuarios']);
        Permission::create(['name' => 'Eliminar Usuarios']);
        Permission::create(['name' => 'Menu Sistema']);
        Permission::create(['name' => 'Crear Roles']);
        Permission::create(['name' => 'Editar Roles']);
        Permission::create(['name' => 'Eliminar Roles']);
        Permission::create(['name' => 'Crear Permisos']);
        Permission::create(['name' => 'Editar Permisos']);
        Permission::create(['name' => 'Eliminar Permisos']);
        Permission::create(['name' => 'Asignar Roles']);
        Permission::create(['name' => 'Agregar Equipos']);
        Permission::create(['name' => 'Editar Equipos']);
        Permission::create(['name' => 'Eliminar Equipos']);
        // Añade aquí más permisos según sea necesario

        // Create roles and assign created permissions
        $role = Role::create(['name' => 'Administrador'])
            ->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Lider'])
        ->givePermissionTo([
            'Menu Lineas', 'Crear Lineas', 'Editar Lineas', 'Eliminar Lineas', 'Ver Lineas', 
            'Menu CallCenters', 'Crear Usuario CallCenter', 'Editar Usuario CallCenter', 'Eliminar Usuario CallCenter',
            'Menu Hatillo', 'Crear Hatillo', 'Editar Hatillo', 'Eliminar Hatillo', 
            'Menu Deposito', 'Agregar Equipo Deposito', 'Editar Equipo Deposito', 'Eliminar Equipo Deposito', 
            'Agregar Marca-Modelo', 'Editar Marca-Modelo', 'Eliminar Marca-Modelo', 
            'Menu Localidades', 'Crear Localidades', 'Editar Localidades', 'Eliminar Localidades', 
            'Crear Pisos', 'Editar Pisos', 'Eliminar Pisos', 
            'Crear Campos', 'Editar Campos', 'Eliminar Campos', 
            'Menu Usuarios', 'Crear Usuarios', 'Editar Usuarios', 'Eliminar Usuarios'
        ]);

        $role = Role::create(['name' => 'Consultor'])
            ->givePermissionTo([
                'Menu Lineas', 'Crear Lineas', 'Editar Lineas', 'Ver Lineas', 
                'Menu CallCenters', 'Crear Usuario CallCenter', 'Editar Usuario CallCenter',
                'Menu Hatillo', 'Crear Hatillo', 'Editar Hatillo',
                'Menu Deposito', 'Editar Equipo Deposito',
                'Editar Usuarios'
            ]);

        $role = Role::create(['name' => 'Invitado'])
            ->givePermissionTo(['Menu Lineas', 'Crear Lineas']);
        
    }
}