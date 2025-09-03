<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use App\Models\Callcenter;
use App\Models\Ubicacion;
use App\Models\Deposito;
use App\Models\Hatillo;
use App\Models\Linea;
use App\Models\Localidad;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Par;
use App\Models\Piso;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});


//BreadCrumbs Callcenter
// Home > Callcenter
Breadcrumbs::for('callcenters.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Callcenters', route('callcenters.index'));
});
// Home > Callcenter > Crear
Breadcrumbs::for('callcenters.create', function (BreadcrumbTrail $trail) {
    $trail->parent('callcenters.index');
    $trail->push('Agregar Usuario', route('callcenters.create'));
});
// Home > Callcenter > Editar
Breadcrumbs::for('callcenters.edit', function (BreadcrumbTrail $trail, $id) {
    $callcenter = Callcenter::findOrFail($id);
    $trail->parent('callcenters.index', $id);
    $trail->push('Modificar', route('callcenters.edit', $id));
});


//BreadCrumbs Ubicaciones
// Home > Ubicaciones
Breadcrumbs::for('ubicaciones.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Ubicaciones', route('ubicaciones.index'));
});
// Home > Ubicaciones > Crear
Breadcrumbs::for('ubicaciones.create', function (BreadcrumbTrail $trail) {
    $trail->parent('ubicaciones.index');
    $trail->push('Agregar Ubicacion', route('ubicaciones.create'));
});
// Home > Ubicaciones > Editar
Breadcrumbs::for('ubicaciones.edit', function (BreadcrumbTrail $trail, $id) {
    $ubicacion = Ubicacion::findOrFail($id);
    $trail->parent('ubicaciones.index', $id);
    $trail->push('Modificar Ubicacion', route('ubicaciones.edit', $id));
});

//BreadCrumbs Pares
// Home > Pares
Breadcrumbs::for('pares.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Pares', route('pares.index'));
});
// Home > Pares > Crear
Breadcrumbs::for('pares.create', function (BreadcrumbTrail $trail) {
    $trail->parent('pares.index');
    $trail->push('Agregar Par', route('pares.create'));
});
// Home > Pares > Ver
Breadcrumbs::for('pares.show', function (BreadcrumbTrail $trail, $id) {
    $par = Par::findOrFail($id);
    $trail->parent('pares.index');
    $trail->push($par->numero, route('pares.show', $id));
});
// Home > Pares > Editar
Breadcrumbs::for('pares.edit', function (BreadcrumbTrail $trail, $id) {
    $par = Par::findOrFail($id);
    $trail->parent('pares.index', $id);
    $trail->push('Modificar Par', route('pares.edit', $id));
});


//BreadCrumbs Depósitos
// Home > Depósitos
Breadcrumbs::for('depositos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Depósitos', route('depositos.index'));
});
// Home > Depósitos > Crear
Breadcrumbs::for('depositos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('depositos.index');
    $trail->push('Agregar Equipo', route('depositos.create'));
});
// Home > Depósitos > Ver
Breadcrumbs::for('depositos.show', function (BreadcrumbTrail $trail, $id) {
    $deposito = Deposito::findOrFail($id);
    $trail->parent('depositos.index');
    $trail->push($deposito->inventario, route('depositos.show', $id));
});
// Home > Depósitos > Editar
Breadcrumbs::for('depositos.edit', function (BreadcrumbTrail $trail, $id) {
    $deposito = Deposito::findOrFail($id);
    $trail->parent('depositos.show', $id);
    $trail->push('Modificar Equipo', route('depositos.edit', $id));
});


//BreadCrumbs DataCenter El Hatillo
// Home > Hatillo
Breadcrumbs::for('hatillo.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('DC Hatillo', route('hatillo.index'));
});
// Home > Hatillo > Crear
Breadcrumbs::for('hatillo.create', function (BreadcrumbTrail $trail) {
    $trail->parent('hatillo.index');
    $trail->push('Agregar Línea DC Hatillo', route('hatillo.create'));
});
// Home > Hatillo > Ver
Breadcrumbs::for('hatillo.show', function (BreadcrumbTrail $trail, $id) {
    $hatillo = Hatillo::findOrFail($id);
    $trail->parent('hatillo.index');
    $trail->push($hatillo->linea, route('hatillo.show', $id));
});
// Home > Hatillo > Editar
Breadcrumbs::for('hatillo.edit', function (BreadcrumbTrail $trail, $id) {
    $hatillo = Hatillo::findOrFail($id);
    $trail->parent('hatillo.show', $id);
    $trail->push('Modificar Línea DC Hatillo', route('hatillo.edit', $id));
});


//BreadCrumbs Líneas
// Home > Líneas
Breadcrumbs::for('lineas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Líneas', route('lineas.index'));
});
// Home > Líneas > Crear
Breadcrumbs::for('lineas.create', function (BreadcrumbTrail $trail) {
    $trail->parent('lineas.index');
    $trail->push('Agregar Línea', route('lineas.create'));
});
// Home > Líneas > Ver
Breadcrumbs::for('lineas.show', function (BreadcrumbTrail $trail, $id) {
    $linea = Linea::findOrFail($id);
    $trail->parent('lineas.index');
    $trail->push($linea->linea, route('lineas.show', $id));
});
// Home > Líneas > Editar
Breadcrumbs::for('lineas.edit', function (BreadcrumbTrail $trail, $id) {
    $linea = Linea::findOrFail($id);
    $trail->parent('lineas.show', $id);
    $trail->push('Modificar Línea', route('lineas.edit', $id));
});
// Home > Líneas > Búsqueda Avanzada
Breadcrumbs::for('lineas.avanzada', function (BreadcrumbTrail $trail) {
    $trail->parent('lineas.index');
    $trail->push('Búsqueda Avanzada', route('lineas.avanzada'));
});


//BreadCrumbs Depósito-Marcas
// Home > Marcas
Breadcrumbs::for('marcas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('depositos.index');
    $trail->push('Marcas', route('marcas.index'));
});
// Home > Marcas > Crear
Breadcrumbs::for('marcas.create', function (BreadcrumbTrail $trail) {
    $trail->parent('marcas.index');
    $trail->push('Agregar Marca', route('marcas.create'));
});
// Home > Marcas > Ver
Breadcrumbs::for('marcas.show', function (BreadcrumbTrail $trail, $id) {
    $marca = Marca::findOrFail($id);
    $trail->parent('marcas.index');
    $trail->push($marca->nombre, route('marcas.show', $id));
});
// Home > Marcas > Editar
Breadcrumbs::for('marcas.edit', function (BreadcrumbTrail $trail, $id) {
    $marca = Marca::findOrFail($id);
    $trail->parent('marcas.show', $id);
    $trail->push('Modificar Marca', route('marcas.edit', $id));
});


//BreadCrumbs Depósito-Modelos
// Home > Modelos
Breadcrumbs::for('modelos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('marcas.index');
    $trail->push('Modelos', route('modelos.index'));
});
// Home > Modelos > Crear
Breadcrumbs::for('modelos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('modelos.index');
    $trail->push('Agregar Modelo', route('modelos.create'));
});
// Home > Modelos > Ver
Breadcrumbs::for('modelos.show', function (BreadcrumbTrail $trail, $id) {
    $modelo = Modelo::findOrFail($id);
    $trail->parent('modelos.index');
    $trail->push($modelo->nombre, route('modelos.show', $id));
});
// Home > Modelos > Editar
Breadcrumbs::for('modelos.edit', function (BreadcrumbTrail $trail, $id) {
    $modelo = Modelo::findOrFail($id);
    $trail->parent('modelos.show', $id);
    $trail->push('Modificar Modelo', route('modelos.edit', $id));
});

//BreadCrumbs Localidades
// Home > Localidades
Breadcrumbs::for('localidades.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Localidades', route('localidades.index'));
});
// Home > Localidades > Crear
Breadcrumbs::for('localidades.create', function (BreadcrumbTrail $trail) {
    $trail->parent('localidades.index');
    $trail->push('Agregar Localidad', route('localidades.create'));
});
// Home > Localidades > Ver
Breadcrumbs::for('localidades.show', function (BreadcrumbTrail $trail, $id) {
    $localidad = Localidad::findOrFail($id);
    $trail->parent('localidades.index');
    $trail->push($localidad->nombre, route('localidades.show', $id));
});
// Home > Localidades > Editar
Breadcrumbs::for('localidades.edit', function (BreadcrumbTrail $trail, $id) {
    $localidad = Localidad::findOrFail($id);
    $trail->parent('localidades.show', $id);
    $trail->push('Modificar Localidad', route('localidades.edit', $id));
});

//BreadCrumbs Pisos
// Home > Pisos
Breadcrumbs::for('pisos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('localidades.index');
    $trail->push('Pisos', route('pisos.index'));
});
// Home > Pisos > Crear
Breadcrumbs::for('pisos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('pisos.index');
    $trail->push('Agregar Piso', route('pisos.create'));
});
// Home > Pisos > Editar
Breadcrumbs::for('pisos.edit', function (BreadcrumbTrail $trail, $id) {
    $piso = Piso::findOrFail($id);
    $trail->parent('pisos.index', $id);
    $trail->push('Modificar Piso', route('pisos.edit', $id));
});

//BreadCrumbs Permisos
// Home > Permisos
Breadcrumbs::for('permisos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Permisos', route('permisos.index'));
});
// Home > Permisos > Crear
Breadcrumbs::for('permisos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('permisos.index');
    $trail->push('Crear Nuevo Permiso', route('permisos.create'));
});
// Home > Permisos > Editar
Breadcrumbs::for('permisos.edit', function (BreadcrumbTrail $trail, Permission $permiso) {
    $trail->parent('permisos.index');
    $trail->push($permiso->name, route('permisos.index', $permiso));
    $trail->push('Editar', route('permisos.edit', $permiso));
});


//BreadCrumbs Roles
// Home > Roles
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
});
// Home > Roles > Crear
Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Agregar Rol', route('roles.create'));
});
// Home > Roles > Editar
Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('roles.index');
    $trail->push($role->name, route('roles.index', $role));
    $trail->push('Modificar Rol', route('roles.edit', $role));
});


//BreadCrumbs Usuarios
// Home > Usuarios
Breadcrumbs::for('usuarios.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Usuarios', route('usuarios.index'));
});
// Home > Usuarios > Crear
Breadcrumbs::for('usuarios.create', function (BreadcrumbTrail $trail) {
    $trail->parent('usuarios.index');
    $trail->push('Agregar Usuario', route('usuarios.create'));
});
// Home > Usuarios > Ver
Breadcrumbs::for('usuarios.show', function (BreadcrumbTrail $trail, $id) {
    $usuario = User::findOrFail($id);
    $trail->parent('usuarios.index');
    $trail->push($usuario->name, route('usuarios.show', $id));
});
// Home > Usuarios > Editar
Breadcrumbs::for('usuarios.edit', function (BreadcrumbTrail $trail, $id) {
    $usuario = User::findOrFail($id);
    $trail->parent('usuarios.show', $id);
    $trail->push('Modificar Usuario', route('usuarios.edit', $id));
});