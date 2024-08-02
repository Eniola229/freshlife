<?php

use App\Http\Controllers\ProfileController;
//Admin Controllers
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AddProductController;
use App\Http\Controllers\Admin\ProductCategoryController;

//User Controllers
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\CartController;

//Laravel
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
Users Routes
*/
 Route::get('product', [UserController::class, 'view']);
 Route::get('productDetails/{id}', [UserController::class, 'productDetails'])->name('productDetails.show');
 Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
 Route::get('cart', [CartController::class, 'viewCart'])->name('cart.view');
 Route::delete('cart/{id}', [CartController::class, 'delete'])->name('cart.delete');

/*
Admin Routes
*/
 Route::get('adminHome', [HomeController::class, 'admin'])->name('admin.show');
 Route::get('adminProduct', [ProductController::class, 'view'])->name('product.show');
 Route::get('addProduct', [AddProductController::class, 'view'])->name('addproduct.show');
 Route::post('addProduct', [AddProductController::class, 'store'])->name('products.store');
 Route::put('addProduct/{id}', [AddProductController::class, 'update'])->name('products.update');
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
