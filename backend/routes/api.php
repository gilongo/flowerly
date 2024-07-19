<?php

use Illuminate\Support\Facades\Route;
use App\Interfaces\Http\Controllers\ProductController;
use App\Interfaces\Http\Controllers\CustomerController;

// Display a list of products
Route::get('/products', [ProductController::class, 'index'])->name('api.products.index');

// Store a newly created product
Route::post('/products', [ProductController::class, 'store'])->name('api.products.store');

// Show a specific product
Route::get('/products/{id}', [ProductController::class, 'show'])->name('api.products.show');

// Update a specific product
Route::put('/products/{id}', [ProductController::class, 'update'])->name('api.products.update');

// Delete a specific product
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('api.products.destroy');


Route::post('/customers', [CustomerController::class, 'store'])->name('api.customers.store');