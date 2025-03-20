<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/{id}', function (Request $request) {

        return $request->user();
    })->middleware('auth:sanctum')->whereNumber('id');
});

