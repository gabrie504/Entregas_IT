<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\EntrgasDetalleController;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\ListaEquipoController;
use App\Http\Controllers\HistorialController;



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

//************************************************************************************************************************** */
//**********************************RUTAS DE CREACION DE ENTREGAS*********************************************************** */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // your authenticated routes here
    Route::get('/', function () {
        return view('principal');
    })->name('home');
    
    
    Route::get('/prueba', function () {
        return view('prueba');
    })->name('prueba');
    
    //rutas para la creacin de una entrega 
    Route::get('/entrega1/{id}', [EntregaController::class, 'index'])->name('entrega.mostrar');
    Route::POST('/entrega', [EntregaController::class, 'store'])->name('entrega.crear');
    
    //rutas de creacion de lista de dispositivos para dispositivos 
    Route::get('/dispositivo1', [EntrgasDetalleController::class, 'index'])->name('dispositivos.mostrar');
    Route::POST('/dispositivo', [EntrgasDetalleController::class, 'store'])->name('dispositivos.store');
    Route::get('/dispositivos2', [EntrgasDetalleController::class, 'searchArticulos']);
    //Route::delete('/dispositivo/{articulo}', [EntrgasDetalleController::class, 'destroy'])->name('dispositivos.destroy');
    
    
    Route::get('/firma', [FirmaController::class, 'index'])->name('firma.mostrar');
    Route::POST('/firma1', [FirmaController::class, 'store'])->name('firma.store');;
    
});



//************************************************************************************************************************** */
//**********************************RUTAS PARA VER EQUIPOS AGREGADOS*********************************************************** */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/listaequipo', [ListaEquipoController::class, 'index'])->name('lista.equipo');

    
});


//************************************************************************************************************************** */
//**********************************RUTAS PARA VER ENTREGAS*********************************************************** */
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/historial' , [HistorialController::class, 'index'])->name('historial');
    Route::get('/historialedit/{id}', [HistorialController::class, 'show']);
    Route::get('/historialeps' , function(){
        return view('historial.historialeps');
    });

    Route::get('/calendario' , function(){
        return view('historial.calendario');
    });
});












Route::get('/offline', function(){
    return view('vendor.laravelpwa.offline');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home1');