<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirmaController; 
use App\Http\Controllers\FuncionesGeneralesController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ReporteFirmasController;

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
    //return view('welcome');
    return view('auth.login');
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

    // Para Gestión de Empresas
    Route::get('/administrador/empresas', [EmpresaController::class, 'index']) -> middleware('auth')->name('empresas.index');
    Route::get('/administrador/obtener_listado_empresas', [EmpresaController::class, 'obtener_listado_empresas'])->middleware('auth')->name('admin.obtener_listado_empresas');
    Route::post('/admiminstrador/registrar_empresa', [EmpresaController::class, 'registrar_empresa'])->middleware('auth')->name('admin.registrar_empresa');
    Route::get('/administrador/empresas/{id}', [EmpresaController::class, 'obtenerDatosEmpresa'])->middleware('auth')->name('admin.obtenerDatosEmpresa');
    Route::post('/administrador/empresa/modificar_empresa', [EmpresaController::class, 'modificar_empresa'])->middleware('auth')->name('admin.modificar_empresa');
    
    //Para Manejo de Firmas
    Route::get('/administrador/firmas', [FirmaController::class, 'index'])->middleware('auth')->name('firmas.index'); 
    Route::get('/administrador/obtener_listado_firmas', [FirmaController::class, 'obtener_listado_firmas'])->middleware('auth')->name('admin.obtener_listado_firmas');
    Route::post('/administrador/registrar_firma', [FirmaController::class, 'registrar_firma'])->middleware('auth')->name('admin.registrar_firma');

    // Para Reporte de Firmas Electrónicas
    Route::get('/administrador/reportes', [ReporteFirmasController::class, 'index'])->middleware('auth')->name('reportes.index');
    Route::get('/administrador/obtener_listado_firmas_emitidas', [ReporteFirmasController::class, 'obtener_listado_firmas_emitidas'])->middleware('auth')->name('admin.obtener_listado_firmas_emitidas');

    // Para Exportación de archivos (Empresas/Firmas/Reportes)

        // Empresas
        Route::get('/administrador/reportes/exportar_pdf_empresas', [ReportesController::class, 'exportar_pdf_empresas'])->middleware('auth')->name('admin.exportar_pdf_empresas');
        Route::get('/administrador/reportes/exportar_excel_empresas', [ReportesController::class, 'exportar_excel_empresas'])->middleware('auth')->name('admin.exportar_excel_empresas');
        Route::get('/administrador/reportes/exportar_csv_empresas', [ReportesController::class, 'exportar_csv_empresas'])->middleware('auth')->name('admin.exportar_csv_empresas');
        Route::get('/administrador/reportes/imprimir_pdf_empresas', [ReportesController::class, 'imprimir_pdf_empresas'])->middleware('auth')->name('admin.imprimir_pdf_empresas');

        // Firmas
        Route::get('/administrador/reportes/exportar_pdf_firmas', [ReportesController::class, 'exportar_pdf_firmas'])->middleware('auth')->name('admin.exportar_pdf_firmas');
        Route::get('/administrador/reportes/exportar_excel_firmas', [ReportesController::class, 'exportar_excel_firmas'])->middleware('auth')->name('admin.exportar_excel_firmas');
        Route::get('/administrador/reportes/exportar_csv_firmas', [ReportesController::class, 'exportar_csv_firmas'])->middleware('auth')->name('admin.exportar_csv_firmas');
        Route::get('/administrador/reportes/imprimir_pdf_firmas', [ReportesController::class, 'imprimir_pdf_firmas'])->middleware('auth')->name('admin.imprimir_pdf_firmas');
 
        // Reporte Firmas
        Route::get('/administrador/reportes/exportar_pdf_firmas_emitidas', [ReportesController::class, 'exportar_pdf_firmas_emitidas'])->middleware('auth')->name('admin.exportar_pdf_firmas_emitidas');
        Route::get('/administrador/reportes/exportar_excel_firmas_emitidas', [ReportesController::class, 'exportar_excel_firmas_emitidas'])->middleware('auth')->name('admin.exportar_excel_firmas_emitidas');
        Route::get('/administrador/reportes/exportar_csv_firmas_emitidas', [ReportesController::class, 'exportar_csv_firmas_emitidas'])->middleware('auth')->name('admin.exportar_csv_firmas_emitidas');
        Route::get('/administrador/reportes/imprimir_pdf_firmas_emitidas', [ReportesController::class, 'imprimir_pdf_firmas_emitidas'])->middleware('auth')->name('admin.imprimir_pdf_firmas_emitidas');

});

require __DIR__.'/auth.php';
