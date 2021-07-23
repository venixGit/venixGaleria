<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\FotografiasController;

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('', [FotografiasController::class, 'mostrarFotos'])->name('home')->middleware(['auth']);
Route::post('/savefotos', [FotografiasController::class, 'guardarFotos'])->name('guardarFotos');
Route::get('/mostrarImg', [FotografiasController::class, 'mostrarImg'])->name('mostrarImg');
Route::post('/detalle',[FotografiasController::class,'mostrarDetalle'])->name('mostrarDetalle');
Route::post('/editarDetalle',[FotografiasController::class,'mostrarEditarDetalle'])->name('mostrarEditarDetalle');
Route::post('/updateFoto', [FotografiasController::class, 'editarFotos'])->name('editarFotos');
Route::post('/deleteFoto', [FotografiasController::class, 'eliminarFoto'])->name('eliminarFoto');
Auth::routes();
