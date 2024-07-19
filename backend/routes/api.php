<?php

use Illuminate\Support\Facades\Route;
use App\Interfaces\Http\Controllers\ProductController;
use App\Interfaces\Http\Controllers\CustomerController;

Route::prefix('/products')->name('api.products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');
    Route::post('/', [ProductController::class, 'store'])->name('store');
    Route::patch('/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');
});

Route::prefix('/customers')->name('api.customers.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/{id}', [CustomerController::class, 'show'])->name('show');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::patch('/{id}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('destroy');
});