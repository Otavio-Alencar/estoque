<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\File;
Route::get('/', [MenuController::class, 'index'])->name('home');






Route::prefix('produtos')->controller(ProductController::class)->group(function () {
    Route::get('/', 'products')->name('products');
    Route::get('/adicionar', 'showAddProduct')->name('addProduct');
    Route::post('/adicionar', 'addProducts')->name('storeProduct');
    Route::get('/editar', 'showEditProductCode')->name('productCodeEdit');
    Route::post('/editar/form', 'showEditProducts')->name('productEditForm');
    Route::post('/editar', 'editProducts')->name('productEdit');
    Route::get('/excluir', 'showDeleteProductCode')->name('productCodeDelete');
    Route::post('/excluir', 'deleteProduct')->name('delete');
});

Route::prefix('estoque')->controller(SaleController::class)->group(function(){
    Route::get('/',[SaleController::class,'sales'])->name('sales');
    Route::post('/',[SaleController::class,'saleRegister'])->name('saleRegister');
});

Route::get('/fornecedores',[ManufacturerController::class,'manufacturers'])->name('manufacturers');

Route::get('/perfil',[ProfileController::class,'getProfile'])->name('profile');
Route::post('/perfil/editar',[ProfileController::class,'updateProfile'])->name('editProfile');

Route::get('entrar', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('entrar', [LoginController::class, 'login']);

Route::post('/sair', [LoginController::class, 'logout'])->name('logout');

Route::get('cadastro', [LoginController::class, 'showLogupForm'])->name('logup');
Route::post('cadastro', [LoginController::class, 'logup']);

Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/comprovante/{filename}', function ($filename) {
    $path = storage_path('app/public/comprovantes/' . $filename);

    if (!File::exists($path)) {
        abort(404, 'Arquivo não encontrado');
    }

    return response()->download($path);
})->name('comprovante.download');


