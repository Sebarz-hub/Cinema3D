<?php

use App\Http\Controllers\RegistroController;

Route::get('/', [RegistroController::class, 'index']);
Route::post('/registros', [RegistroController::class, 'store']);
