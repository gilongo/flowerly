<?php

use Illuminate\Support\Facades\Route;
use App\Interfaces\Http\Controllers\ProductController;
use App\Interfaces\Http\Controllers\CustomerController;
use App\Interfaces\Http\Controllers\OrderController;

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

Route::prefix('/orders')->name('api.orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::patch('/{id}', [OrderController::class, 'update'])->name('update');
    Route::delete('/{id}', [OrderController::class, 'destroy'])->name('destroy');
});