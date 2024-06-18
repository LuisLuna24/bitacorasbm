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



/*Route::get('/', function () {
    return view('auth.login');
});*/
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->nivel != 0){
            return view('bitacoras.dashboard');
        }else{
            abort(403);
        }
    })->name('dashboard');

    Route::get('/inventarios', function () {
        if (auth()->user()->nivel >= 2){
            return view('inventarios.index'); 
        }else{
            abort(403);
        }
        
    })->name('inventarios.index');

    Route::get('/catalogos', function () {
        if (auth()->user()->nivel >= 2){
            return view('catalogos.index');
        }else{
            abort(403);
        }
    })->name('catalogos.index');

    Route::get('/registro', function () {
        if (auth()->user()->nivel >= 2){
            return view('auth.register');
        }else{
            abort(403);
        }
    })->name('registrar');

    Route::get('/configuracion',function () {
        if (auth()->user()->nivel >= 2){
            return view('configuracion.index');
        }else{
            abort(403);
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
        if (auth()->user()->nivel >= 2){
            return view('inventarios.equipos');
        }else{
            abort(403);
        }
    })->name('inventarios.equipos');
    Route::get('/inventarios/reactivos', function () {
        if (auth()->user()->nivel >= 2){
            return view('inventarios.reactivos');
        }else{
            abort(403);
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
        if (auth()->user()->nivel >= 2){
            return view('catalogos.especies');
        }else{
            abort(403);
        }
    })->name('catalogos.especies');

    Route::get('/catalogos/analisis', function () {
        if (auth()->user()->nivel >= 2){
            return view('catalogos.analises');
        }else{
            abort(403);
        }
    })->name('catalogos.analises');

    Route::get('/catalogos/metodos', function () {
        if (auth()->user()->nivel >= 2){
            return view('catalogos.metodos');
        }else{
            abort(403);
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
        if (auth()->user()->nivel >= 1){
            return view('bitacoras.pcr');
        }else{
            abort(403);
        }
    })->name('bitacoras.pcr');

    Route::get('/bitacoras/pcr_tiemporeal', function () {
        if (auth()->user()->nivel >= 1){
            return view('bitacoras.pcreal');
        }else{
            abort(403);
        }
    })->name('bitacoras.pcreal');

    Route::get('/bitacoras/extraccion', function () {
        if (auth()->user()->nivel >= 1){
            return view('bitacoras.extraccion');
        }else{
            abort(403);
        }
    })->name('bitacoras.extraccion');

    Route::get('/bitacoras/reactivos/pcr', function () {
        if (auth()->user()->nivel >= 1){
            return view('bitacoras.reactivopcrs');
        }else{
            abort(403);
        }
    })->name('bitacoras.reactivopcrs');
});
