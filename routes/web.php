<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;
use App\Models\Empleados;

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


Route::post('/empleados', [EmpleadoController::class, 'store'])->name('empleados.store');
Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
Route::delete('/empleados/eliminar/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');
Route::put('/empleados/actualizar/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');




