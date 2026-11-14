
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

Route::get('/animales', [AnimalController::class, 'index']);
Route::post('/animales', [AnimalController::class, 'store']);
Route::get('/animales/{id}', [AnimalController::class, 'show']);
Route::put('/animales/{id}', [AnimalController::class, 'update']);
Route::delete('/animales/{id}', [AnimalController::class, 'destroy']);
