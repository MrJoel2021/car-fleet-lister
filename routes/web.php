<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Items CRUD routes
// This one line creates all 7 CRUD routes for ItemsController
Route::resource('/items', ItemsController::class);

// Low stock filter route
// Example: /items/lowstock/5 shows vehicles with quantity less than 5
Route::get('/items/lowstock/{threshold}', [ItemsController::class, 'lowStock'])
    ->name('items.lowstock');