<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\EntrgasDetalleController;


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
    return view('principal');
});


Route::get('/prueba', function () {
    return view('prueba');
})->name('prueba');

//rutas para la creacin de una entrega 
Route::get('/entrega', [EntregaController::class, 'index'])->name('entrega.mostrar');
Route::POST('/entrega', [EntregaController::class, 'store'])->name('entrega.crear');

//rutas de creacion de lista de dispositivos para dispositivos 
Route::get('/dispositivo', [EntrgasDetalleController::class, 'index'])->name('dispositivos.mostrar');
Route::POST('/dispositivo', [EntrgasDetalleController::class, 'store'])->name('dispositivos.store');
//Route::delete('/dispositivo/{articulo}', [EntrgasDetalleController::class, 'destroy'])->name('dispositivos.destroy');

