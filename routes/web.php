<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // your authenticated routes here
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
    //Route::delete('/dispositivo/{articulo}', [EntrgasDetalleController::class, 'destroy'])->name('dispositivos.destroy');
    
    
    Route::get('/firma', [FirmaController::class, 'index'])->name('firma.mostrar');
    Route::POST('/firma1', [FirmaController::class, 'store'])->name('firma.store');;
    
});

require __DIR__.'/auth.php';
