<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServicioDeSpaController;
use App\Http\Controllers\ReservaServicioController;

Route::get('/', function () {
    return view('welcome');
});

// // servicios
// Route::get('/servicios/{lang?}', [ServicioDeSpaController::class, 'index']);
// // reservas
// Route::post('/reservas', [ReservaServicioController::class, 'store'])->withoutMiddleware(['csrf'])->name('reservas.store');