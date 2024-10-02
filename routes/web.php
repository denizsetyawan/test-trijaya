<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('welcome');

Route::get('/', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index']);
Route::get('/showRawResponse/{id}', [App\Http\Controllers\InvoiceController::class, 'showRawResponse']);