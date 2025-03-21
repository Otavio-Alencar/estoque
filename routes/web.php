<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('entrar', [LoginController::class, 'showLoginForm'])->name('login');


Route::post('entrar', [LoginController::class, 'login']);


Route::get('cadastro', [LoginController::class, 'showLogupForm'])->name('logup');


Route::post('cadastro', [LoginController::class, 'logup']);
