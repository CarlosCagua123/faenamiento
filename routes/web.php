<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\CerdoController;
use App\Http\Controllers\FaenaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReporteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ir siempre al login
Route::get('/', fn () => redirect()->route('login'));

// (Opcional) Dashboard por si alguna vista lo referencia
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Módulos operativos
    Route::resource('lotes',  LoteController::class)->names('lotes');
    Route::resource('cerdos', CerdoController::class)->names('cerdos');
    Route::resource('faenas', FaenaController::class)
        ->only(['index','create','store','show'])
        ->names('faenas');

    // Reportes (acceso para todo usuario autenticado)
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('reportes/faenas', [ReporteController::class, 'faenas'])->name('reportes.faenas');
    Route::get('reportes/faenas/csv', [ReporteController::class, 'faenasCsv'])->name('reportes.faenas.csv');
    Route::get('reportes/faenas/pdf', [ReporteController::class, 'faenasPdf'])->name('reportes.faenas.pdf');
    Route::get('reportes/lote/{lote}', [ReporteController::class, 'reportePorLote'])->name('reportes.lote');

    // Gestión de usuarios (solo admin)
    Route::middleware('can:admin')->group(function () {
        Route::resource('usuarios', UserController::class)->names('usuarios');
    });
});

require __DIR__.'/auth.php';
