<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('administrador.panel');
})->name('administrador.panel');


//^=====================================================================Catalogos
Route::get('/catalogo/analisis', function () {
    return view('administrador.catalogos.analisis');
})->name('catalogos.analisis');

Route::get('/catalogo/metodos', function () {
    return view('administrador.catalogos.metodos');
})->name('catalogos.metodos');

Route::get('/catalogo/especies', function () {
    return view('administrador.catalogos.especies');
})->name('catalogos.especies');