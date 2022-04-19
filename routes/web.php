<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitasController;
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
//Creamos un grupo de rutas que contiene un middleware para las políticas de CORS
Route::group(['middleware' => ['cors']], function () {
    Route::post('agendarCita', [CitasController::class, 'agendarCita']);
    Route::get('obtenerCitas/{curp}', [CitasController::class, 'obtenerCitas']);
    Route::put('cancelarCita/{id}', [CitasController::class, 'cancelarCita']);
});

