<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

use App\Models\Deposito;
use App\Models\Linea;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
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


//BreadCrumbs Depósitos

// Home > Depósitos
Breadcrumbs::for('depositos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Depósitos', route('depositos.index'));
});
// Home > Depósitos > Crear
Breadcrumbs::for('depositos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('depositos.index');
    $trail->push('Agregar', route('depositos.create'));
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
    $trail->push('Modificar', route('depositos.edit', $id));
});