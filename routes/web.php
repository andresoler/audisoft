<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/sitios');

Route::get('/sitios', [SiteController::class, 'index'])->name('sites.index');
Route::post('/sitios', [SiteController::class, 'store'])->name('sites.store');
Route::delete('/sitios/{site}', [SiteController::class, 'destroy'])->name('sites.destroy');

Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categorias', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categorias/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
