<?php

use App\Http\Controllers\ProfileController;
//Admin Controllers
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AddProductController;
use App\Http\Controllers\Admin\ProductCategoryController;

//Laravel
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
Admin Routes
*/
 Route::get('adminHome', [HomeController::class, 'admin'])->name('admin.show');
 Route::get('adminProduct', [ProductController::class, 'view'])->name('product.show');
 Route::get('addProduct', [AddProductController::class, 'view'])->name('addproduct.show');
 Route::post('addProduct', [AddProductController::class, 'store'])->name('products.store');
 Route::delete('addProduct/{id}', [AddProductController::class, 'delete'])->name('product.delete');
 Route::get('categories', [ProductCategoryController::class, 'view'])->name('category.show');
 Route::post('categories', [ProductCategoryController::class, 'store'])->name('category.store');
 Route::delete('categories/{id}', [ProductCategoryController::class, 'delete'])->name('category.delete');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
