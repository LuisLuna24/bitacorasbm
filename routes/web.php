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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/bitacoras', function () {
        return view('bitacoras.dashboard');
    })->name('dashboard');

    Route::get('/inventarios', function () {
        if (auth()->user()->nivel != 2){
            abort(403);
        }else{
            return view('inventarios.index');   
        }
        
    })->name('inventarios.index');

    Route::get('/catalogos', function () {
        if (auth()->user()->nivel != 2){
            abort(403);
        }else{
            return view('catalogos.index');
        }
    })->name('catalogos.index');

    Route::get('/configuracion',function () {
        if (auth()->user()->nivel != 2){
            abort(403);
        }else{
            return view('configuracion.index');
        }
    })->name('configuracion.index');
});

//-------------------------------------------------------Inventarios
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/inventarios/equipos', function () {
        if (auth()->user()->nivel != 2){
            abort(403);
        }else{
            return view('inventarios.equipos');
        }
    })->name('inventarios.equipos');
    Route::get('/inventarios/reactivos', function () {
        if (auth()->user()->nivel != 2){
            abort(403);
        }else{
            return view('inventarios.reactivos');
        }
    })->name('inventarios.reactivos');
});

//-------------------------------------------------------Catalogos
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/catalogos/especies', function () {
        if (auth()->user()->nivel != 2){
            abort(403);
        }else{
            return view('catalogos.especies');
        }
    })->name('catalogos.especies');
    Route::get('/catalogos/analisis', function () {
        if (auth()->user()->nivel != 2){
            abort(403);
        }else{
            return view('catalogos.analises');
        }
    })->name('catalogos.analises');
    Route::get('/catalogos/metodos', function () {
        if (auth()->user()->nivel != 2){
            abort(403);
        }else{
            return view('catalogos.metodos');
        }
    })->name('catalogos.metodos');
});

//-------------------------------------------------------Bitacoras
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/bitacoras/pcr', function () {
        return view('bitacoras.pcr');
    })->name('bitacoras.pcr');
    Route::get('/bitacoras/pcr_tiemporeal', function () {
        return view('bitacoras.pcreal');
    })->name('bitacoras.pcreal');
    Route::get('/bitacoras/extraccion', function () {
        return view('bitacoras.extraccion');
    })->name('bitacoras.extraccion');
    Route::get('/bitacoras/reactivos', function () {
        return view('bitacoras.reactivos');
    })->name('bitacoras.reactivos');
});
