<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('administrador.panel');
})->name('administrador.panel');


//^=====================================================================Catalogos
Route::get('/catalogos/analisis', function () {
    return view('administrador.catalogos.analisis');
})->name('catalogos.analisis');

Route::get('/catalogos/metodos', function () {
    return view('administrador.catalogos.metodos');
})->name('catalogos.metodos');

Route::get('/catalogos/especies', function () {
    return view('administrador.catalogos.especies');
})->name('catalogos.especies');

//^=====================================================================Inventarios

Route::get('/inventarios/equipos', function () {
    return view('administrador.inventarios.equipos');
})->name('inventarios.equipos');

Route::get('/inventarios/reactivos', function () {
    return view('administrador.inventarios.reactivos');
})->name('inventarios.reactivos');

//^=====================================================================Bitacora

//~===============================================PCR
Route::get('/bitacoras/pcr', function () {
    return view('administrador.bitacoras.pcr');
})->name('bitacoras.pcr');

Route::get('/bitacoras/pcr/nuevo', function () {
    return view('administrador.bitacoras.pcr.create');
})->name('pcr.create');

Route::get('/bitacoras/pcr/{id}/editar', function ($id) {
    return view('administrador.bitacoras.pcr.edit', compact('id'));
})->name('pcr.edit');

//~===============================================PCR Tiempo Real
Route::get('/bitacoras/pcr_tiempo_real', function () {
    return view('administrador.bitacoras.pcreal');
})->name('bitacoras.pcreal');

//~===============================================Extraccion
Route::get('/bitacoras/extraccion', function () {
    return view('administrador.bitacoras.extraccion');
})->name('bitacoras.extraccion');

//~===============================================Reactivos
Route::get('/bitacoras/bitacora_de_reactivos', function () {
    return view('administrador.bitacoras.bit_reactivo');
})->name('bitacoras.bit_reactivo');

Route::get('/bitacoras/bitacora_de_reactivos/nuevo', function () {
    return view('administrador.bitacoras.bit_reactivos.create');
})->name('bit_reactivos.create');

//^=====================================================================Registros

Route::get('/registros/empleados', function () {
    return view('administrador.registros.empleados');
})->name('registros.empleados');

Route::get('/registros/empleados/nuevo', function () {
    return view('administrador.registros.empleados.create');
})->name('empleados.create');

Route::get('/registros/empleados/{id}/editar', function ($id) {
    return view('administrador.registros.empleados.edit', compact('id'));
})->name('empleados.edit');
