<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UnitController;
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
    Route::post('/categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/delete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // brand
    Route::get('/brands/list', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands/store', [BrandController::class, 'store'])->name('brands.store');
    Route::post('/brands/update/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::get('/brands/delete/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

    // unit
    Route::get('/units/list', [UnitController::class, 'index'])->name('units.index');
    Route::get('/units/create', [UnitController::class, 'create'])->name('units.create');
    Route::post('/units/store', [UnitController::class, 'store'])->name('units.store');
    Route::post('/units/update/{unit}', [UnitController::class, 'update'])->name('units.update');
    Route::get('/units/delete/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');

});

