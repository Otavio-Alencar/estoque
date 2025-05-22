<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
Route::get('/', [MenuController::class, 'index'])->name('home');
Route::get('/estoque',[SaleController::class,'sales'])->name('sales');
Route::get('/produtos', [ProductController::class, 'products'])->name('products');
Route::post('/estoque',[SaleController::class,'saleRegister'])->name('saleRegister');

Route::get('/produtos/adicionar', [ProductController::class, 'showAddProduct'])->name('addProduct');
Route::post('/produtos/adicionar', [ProductController::class, 'addProducts'])->name('storeProduct');


Route::get('/produtos/editar', [ProductController::class, 'showEditProductCode'])->name('productCodeEdit');
Route::post('/produtos/editar', [ProductController::class, 'showEditProducts'])->name('productEditForm');
Route::post('/editar', [ProductController::class, 'editProducts'])->name('productEdit');

Route::get('/produtos/excluir', [ProductController::class, 'showDeleteProductCode'])->name('productCodeDelete');
Route::post('/produtos/excluir', [ProductController::class, 'deleteProduct'])->name('delete');

Route::get('entrar', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('entrar', [LoginController::class, 'login']);


Route::get('cadastro', [LoginController::class, 'showLogupForm'])->name('logup');
Route::post('cadastro', [LoginController::class, 'logup']);

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
