<?php

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;

/*
Route::get('categories', [CategoryController::class, 'index'] );
Route::post('categories', [CategoryController::class, 'store'] );
Route::put('categories/{id}', [CategoryController::class, 'update'] );
Route::delete('categories/{id}', [CategoryController::class, 'delete'] );
 */

$this->group(['prefix' => env('v1'), function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
}]);
