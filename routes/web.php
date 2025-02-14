<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirmaController; 
use App\Http\Controllers\FuncionesGeneralesController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     //Funciones Generales
     Route::get('/get-provincias', [FuncionesGeneralesController::class, 'get_provincias'])->middleware('auth')->name('funciones_generales.get_provincias');
     Route::get('/get-cantones', [FuncionesGeneralesController::class, 'get_cantones'])->middleware('auth')->name('funciones_generales.get_cantones');
     Route::get('/get-parroquias', [FuncionesGeneralesController::class, 'get_parroquias'])->middleware('auth')->name('funciones_generales.get_parroquias');

    //Para Manejo de Firmas
    Route::get('/firmas', [FirmaController::class, 'index'])->middleware('auth')->name('firmas.index'); 
    Route::get('/administrador/obtener_listado_firmas', [FirmaController::class, 'obtener_listado_firmas'])->middleware('auth')->name('admin.obtener_listado_firmas');
     
});

require __DIR__.'/auth.php';
