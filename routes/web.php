<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\EmpresaController;

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


    Route::get('/firmas', [FirmaController::class, 'index'])->name('firmas.index');

    Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');
    Route::get('/obtener_listado_empresas', [EmpresaController::class, 'obtener_listado_empresas'])->name('admin.obtener_listado_empresas');
    Route::post('/registrar_empresa', [EmpresaController::class, 'registrar_empresa'])->name('admin.registrar_empresa');

});

require __DIR__.'/auth.php';
