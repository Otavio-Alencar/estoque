<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', [MenuController::class, 'index'])->name('home');
Route::get('/produtos', [MenuController::class, 'products'])->name('products');
Route::get('/produtos/adicionar', [MenuController::class, 'addproducts'])->name('addProduct');
Route::get('entrar', [LoginController::class, 'showLoginForm'])->name('login');


Route::post('entrar', [LoginController::class, 'login']);


Route::get('cadastro', [LoginController::class, 'showLogupForm'])->name('logup');


Route::post('cadastro', [LoginController::class, 'logup']);

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
