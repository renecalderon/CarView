<?php

use App\Http\Controllers\Admin\ReparacionController;
use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('web.index');

/*Exemplo de Mailabel */
Route::get('/bemvindos', function(){
    $email = new WelcomeMailable;
    Mail::to('noreply@galpha.co')->send($email);
});

//Route Hooks - Do not delete//
	Route::view('talleres', 'livewire.talleres.index')->middleware('auth');
	Route::view('eventos', 'livewire.eventos.index')->middleware('auth');
	Route::view('reparaciones', 'livewire.reparaciones.index')->middleware('auth');
	/* Route::view('reparaciones', 'livewire.reparaciones.index')->middleware('auth'); */
	Route::view('estados', 'livewire.estados.index')->middleware('auth');
	Route::view('situaciones', 'livewire.situaciones.index')->middleware('auth');
	Route::view('categorias', 'livewire.categorias.index')->middleware('auth');
	Route::view('status', 'livewire.status.index')->middleware('auth');
	Route::view('semaforos', 'livewire.semaforos.index')->middleware('auth');
	//Route::view('refacciones', 'livewire.refacciones.index')->middleware('auth');
	Route::view('propuestas', 'livewire.propuestas.index')->middleware('auth');
	Route::view('tipos', 'livewire.tipos.index')->middleware('auth');

    Route::view('refacciones', 'livewire.refacciones.index')->middleware('can:refacciones.index');
    Route::view('tecnicos', 'livewire.tecnicos.index')->middleware('can:tecnicos.index');
    Route::view('seguridad', 'livewire.seguridad.index')->middleware('can:seguridad.index');
    Route::view('citas', 'livewire.citas.index')->middleware('can:citas.index');
	/* Route::view('reparaciones', 'livewire.reparaciones.index')->middleware('can:reparaciones.index'); */
	Route::view('users', 'livewire.users.index')->middleware('can:sucursales.index');
	Route::view('sucursales', 'livewire.sucursales.index')->middleware('can:sucursales.index');
    Route::view('empresas', 'livewire.empresas.index')->middleware('can:empresas.index');
    Route::view('marcas', 'livewire.marcas.index')->middleware('can:empresas.index');
   /*  Route::view('talleres', 'livewire.talleres.index')->middleware('can:empresas.index'); */

    /* Route::resource('reparaciones', ReparacionController::class)->names('admin.reparaciones')->middleware('can:reparaciones.index'); */



