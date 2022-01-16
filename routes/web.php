<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('/index', [HomeController::class, 'index'])->name('home');
    // category
    Route::get('/categories/list', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/store-ajax', [CategoryController::class, 'storeAjax'])->name('categories.storeAjax');
    Route::post('/categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // brand
    Route::get('/brands/list', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('brands.store');
    Route::post('/brands/store-ajax', [BrandController::class, 'storeAjax'])->name('brands.storeAjax');
    Route::post('/brands/update/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::get('/brands/delete/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

    // unit
    Route::get('/units/list', [UnitController::class, 'index'])->name('units.index');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units/store', [UnitController::class, 'store'])->name('units.store');
    Route::post('/units/store-ajax', [UnitController::class, 'storeAjax'])->name('units.storeAjax');
    Route::post('/units/update/{unit}', [UnitController::class, 'update'])->name('units.update');
    Route::get('/units/delete/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');

    // product
    Route::get('/products/list', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
    Route::get('/products/restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
    Route::get('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

});

