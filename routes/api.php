<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServicioDeSpaController;
use App\Http\Controllers\HorarioServicioController;
use App\Http\Controllers\ReservaServicioController;

// servicios
Route::get('/servicios/{lang?}', [ServicioDeSpaController::class, 'index']);
// Horario servicio
Route::get('/horas-disponibles/{servicio_id}/{fecha}', [HorarioServicioController::class, 'index']);
// reservas
Route::post('/reservas', [ReservaServicioController::class, 'store'])->name('reservas.store');
