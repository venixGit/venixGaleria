<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticulosController;

// Route::view('/','home')->name('home');
// Route::view('/','home')->name('home')->middleware(['auth']);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/', [ArticulosController::class, 'mostrarArticulos'])->name('home')->middleware(['auth']);
Route::post('/articulos', [ArticulosController::class, 'guardarArticulos'])->name('crearArticulos');
Route::post('/detalle', [ArticulosController::class, 'mostrarDetalle']);
Route::get('/mostrarImg', [ArticulosController::class, 'mostrarImg'])->name('fotos');


// Route::get('/imagen/{$filename}', [ArticulosController::class, 'mostrarImg'])->name('mostrarImg');
// Route::get('articulos', '\App\Http\Controllers\Auth\ArticulosController@crearArticulos');
// Route::get('App/Http/Controllers',[ArticulosController::class, 'crearArticulos'])
// ->name('crearArticulos');
Auth::routes();