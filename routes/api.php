<?php

use App\Http\Controllers\Api\CategoryController;

/*
Route::get('categories', [CategoryController::class, 'index'] );
Route::post('categories', [CategoryController::class, 'store'] );
Route::put('categories/{id}', [CategoryController::class, 'update'] );
Route::delete('categories/{id}', [CategoryController::class, 'delete'] );
 */

Route::apiResource('categories', CategoryController::class);
