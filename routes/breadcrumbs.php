<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use App\Models\Callcenter;
use App\Models\Deposito;
use App\Models\Hatillo;
use App\Models\Linea;
use App\Models\Marca;

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
    $trail->push($linea->inventario, route('lineas.show', $id));
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
