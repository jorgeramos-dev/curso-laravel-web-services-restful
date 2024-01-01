<?php

use App\Http\Controllers\Api\CategoryController;

Route::get('categories', [CategoryController::class, 'index'] );
Route::post('categories', [CategoryController::class, 'store'] );