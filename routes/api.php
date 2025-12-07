<?php

use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ProductController;

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::apiResource('departments', DepartmentController::class);
        Route::apiResource('products', ProductController::class);
    });
