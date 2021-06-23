<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticulosController;

// Route::view('/','home')->name('home');
Route::view('/','home')->name('home')->middleware(['auth']);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/', [ArticulosController::class, 'store'])->name('crearArticulos');

// Route::get('articulos', '\App\Http\Controllers\Auth\ArticulosController@crearArticulos');
// Route::get('App/Http/Controllers',[ArticulosController::class, 'crearArticulos'])
// ->name('crearArticulos');
Auth::routes();