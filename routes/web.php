<?php

use App\Http\Controllers\ZapatoController;
use Illuminate\Support\Facades\Route;

// La página principal redirige al catálogo
Route::redirect('/', '/zapatos');

// Ruta de prueba: muestra "Hola mundo"
Route::get('/ariana', fn () => 'Hola mundo')->name('ariana');

// Rutas CRUD: index, create, store, show, edit, update, destroy
Route::resource('zapatos', ZapatoController::class)
    ->parameters(['zapatos' => 'zapato']);
