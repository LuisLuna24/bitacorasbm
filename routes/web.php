<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/inventarios', function () {
        return view('inventarios.index');
    })->name('inventarios.index');
    Route::get('/catalogos', function () {
        return view('catalogos.index');
    })->name('catalogos.index');
});

//-------------------------------------------------------Inventarios
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/inventarios/equipos', function () {
        return view('inventarios.equipos');
    })->name('inventarios.equipos');
    Route::get('/inventarios/reactivos', function () {
        return view('inventarios.reactivos');
    })->name('inventarios.reactivos');
});

//-------------------------------------------------------Catalogos
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/catalogos/especies', function () {
        return view('catalogos.especies');
    })->name('catalogos.especies');
    Route::get('/catalogos/analisis', function () {
        return view('catalogos.analises');
    })->name('catalogos.analises');
    Route::get('/catalogos/metodos', function () {
        return view('catalogos.metodos');
    })->name('catalogos.metodos');
});
