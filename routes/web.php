<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\EntrgasDetalleController;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\ListaEquipoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\PrestamoDetalleController;
use App\Http\Controllers\FirmaPrestamoController;
use App\Http\Controllers\HistorialPrestamoController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\EmployeeController;

// En tu modelo Subscription o un archivo de configuración
const PLANS = ['3_months', '6_months', '12_months'];


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
    });


    Route::get('/prueba', function () {
        return view('prueba');
    })->name('prueba');

    //rutas para la creacion de una entrega
    Route::get('/entrega1/{id}', [EntregaController::class, 'index'])->name('entrega.mostrar');
    Route::POST('/entrega', [EntregaController::class, 'store'])->name('entrega.crear');




    //rutas de creacion de lista de dispositivos para dispositivos
    Route::get('/dispositivo1', [EntrgasDetalleController::class, 'index'])->name('dispositivos.mostrar');
    Route::POST('/dispositivo', [EntrgasDetalleController::class, 'store'])->name('dispositivos.store');
    Route::get('/dispositivos2', [EntrgasDetalleController::class, 'searchArticulos']);
    //Route::delete('/dispositivo/{articulo}', [EntrgasDetalleController::class, 'destroy'])->name('dispositivos.destroy');


    Route::get('/firma', [FirmaController::class, 'index'])->name('firma.mostrar');
    Route::POST('/firma1', [FirmaController::class, 'store'])->name('firma.store');;

    //************************************************************************************************************************** */
//**********************************RUTAS DE CREACION DE PRESTAMOS*********************************************************** */


Route::POST('/prestamo', [PrestamoController::class, 'store'])->name('prestamo.crear');
Route::POST('/prestamodis', [PrestamoDetalleController::class, 'store']);
Route::get('/firmacontroller', [FirmaPrestamoController::class, 'index']);
Route::POST('/firmacontroller1', [FirmaPrestamoController::class, 'store']);
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
        return view('historial.historialEPS');
    });

    Route::get('/historialprestamo' , [HistorialPrestamoController::class, 'index']);
    Route::get('/historialeditprestamo/{id}', [HistorialPrestamoController::class, 'show']);
    Route::get('/cerrarprestamo/{id}', [HistorialPrestamoController::class, 'notaupdate']);
    Route::POST('/devuelveprestamo/{id}', [HistorialPrestamoController::class, 'update']);

    Route::get('/calendario' , function(){
        return view('historial.calendario');
    });


    /* RUTAS PARA SUSCRIPCIONES  */
    
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])
        ->name('subscriptions.index');

    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])
        ->name('subscriptions.subscribe');

        /* CANCELAR SUSCRPCION */
        Route::POST('/cancel-suscription', [SubscriptionController::class, 'cancel']);

        /* RUTA PARA ACTUALIZAR LA SUSCRIPCION */
        
Route::get('/subscriptions/change', [SubscriptionController::class, 'showChangeSubscriptionForm'])->name('subscriptions.change');
Route::post('/subscriptions/change', [SubscriptionController::class, 'changeSubscription'])->name('subscriptions.change.post');

        /* RUTAS MODULO INVENTARIO */
        Route::get('/equipos' , [EmployeeController::class, 'indexMenu']);

        /* RUTAS MODULO EMPLEADOS */

        Route::get('/empleados' , [EmployeeController::class, 'indexMenu']);
        Route::get('/empleados/agregar' , [EmployeeController::class, 'index'])->name('Empleados.agregar');
        Route::POST('/empleados/agregar' , [EmployeeController::class, 'store']);
        Route::get('/empleados/listaEmpleados' , [EmployeeController::class, 'mostrarLista'])->name('Empleados.lista');
        Route::delete('empleados/eliminar/{id}', [EmployeeController::class, 'destroy']);
        Route::get('/empleados/editar/{id}', [EmployeeController::class, 'edit']);
        Route::put('/empleados/{id}' , [EmployeeController::class, 'update']);
       
       
        Route::get('/empleados/departamento', [EmployeeController::class, 'indexDepartamento']);
        Route::get('/empleados/departamentos/agregar', [EmployeeController::class, 'agregarDepartamento']);
        Route::POST('/empleados/departamentos/agregar' , [EmployeeController::class, 'storeDepartamento'])->name('Departamentos.agregar');
        Route::get('/empleados/listadepartamentos' , [EmployeeController::class, 'mostrarListaDepto'])->name('Departamentos.lista');
        Route::delete('empleados/departamentos/eliminar/{id}', [EmployeeController::class, 'destroyDepto']);
        Route::get('/empleados/departyamentos/editar/{id}', [EmployeeController::class, 'editDepto']);
        Route::put('/empleados/departamentos/{id}' , [EmployeeController::class, 'updateDepto']);




});


/* RUTA PARA ACTUALIZAR EL REPOSITORIO EN PRODUCCION DE MANERA AUTOMATICA */
Route::post('/webhook', [WebhookController::class , 'handle']);










Route::get('/offline', function(){
    return view('vendor.laravelpwa.offline');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
