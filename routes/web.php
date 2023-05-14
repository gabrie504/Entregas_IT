<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\EntrgasDetalleController;
use App\Http\Controllers\FirmaController;


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

// ***************************************************************************************
// ******************************** RUTAS DE ENTREGA ***********************************
Route::get('/', function () {
    return view('principal');
})->name('home');


Route::get('/prueba', function () {
    return view('prueba');
})->name('prueba');

//rutas para la creacin de una entrega 
Route::get('/entrega1', [EntregaController::class, 'index'])->name('entrega.mostrar');
Route::POST('/entrega', [EntregaController::class, 'store'])->name('entrega.crear');

//rutas de creacion de lista de dispositivos para dispositivos 
Route::get('/dispositivo1', [EntrgasDetalleController::class, 'index'])->name('dispositivos.mostrar');
Route::POST('/dispositivo', [EntrgasDetalleController::class, 'store'])->name('dispositivos.store');
Route::get('/dispositivos2', [EntrgasDetalleController::class, 'searchArticulos']);

//Route::delete('/dispositivo/{articulo}', [EntrgasDetalleController::class, 'destroy'])->name('dispositivos.destroy');


Route::get('/firma', [FirmaController::class, 'index'])->name('firma.mostrar');
Route::POST('/firma1', [FirmaController::class, 'store'])->name('firma.store');;

//*****************************************************************************************************
// ******************************** RUTAS DE DISPOSITIVO ***********************************
