<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth','admin']], function () {

    Route::get('/dashboard',[App\Http\Controllers\AdminController::class, 'index']);

    Route::group(['prefix' => 'user'], function () {
        //user crud
        Route::get('/list',[App\Http\Controllers\UserController::class, 'index'])->name('user.list');
        Route::post('/store',[App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}',[App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}',[App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
    });
    //supplier routes
    Route::group(['prefix' => 'supplier'], function () {
       
        Route::get('/list',[App\Http\Controllers\SupplierController::class, 'index'])->name('supplier.list');
        Route::post('/store',[App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit/{id}',[App\Http\Controllers\SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('/update/{id}',[App\Http\Controllers\SupplierController::class, 'update'])->name('supplier.update');
        Route::get('/delete/{id}',[App\Http\Controllers\SupplierController::class, 'delete'])->name('supplier.delete');
    });
    //customer routes
    Route::group(['prefix' => 'customer'], function () {
       
        Route::get('/list',[App\Http\Controllers\CustomerController::class, 'index'])->name('customer.list');
        Route::post('/store',[App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
        Route::get('/edit/{id}',[App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('/update/{id}',[App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
        Route::get('/delete/{id}',[App\Http\Controllers\CustomerController::class, 'delete'])->name('customer.delete');
    });
    //Unit routes
    Route::group(['prefix' => 'unit'], function () {
        
        Route::get('/list',[App\Http\Controllers\UnitController::class, 'index'])->name('unit.list');
        Route::post('/store',[App\Http\Controllers\UnitController::class, 'store'])->name('unit.store');
        Route::get('/edit/{id}',[App\Http\Controllers\UnitController::class, 'edit'])->name('unit.edit');
        Route::post('/update/{id}',[App\Http\Controllers\UnitController::class, 'update'])->name('unit.update');
        Route::get('/delete/{id}',[App\Http\Controllers\UnitController::class, 'delete'])->name('unit.delete');
    });
    
    //Category routes
    Route::group(['prefix' => 'category'], function () {
        
        Route::get('/list',[App\Http\Controllers\CategoryController::class, 'index'])->name('category.list');
        Route::post('/store',[App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}',[App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}',[App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}',[App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
        
    });

    //Product routes
    Route::group(['prefix' => 'product'], function () {
        
        Route::get('/list',[App\Http\Controllers\ProductController::class, 'index'])->name('product.list');
        Route::post('/store',[App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}',[App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update/{id}',[App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
        Route::get('/delete/{id}',[App\Http\Controllers\ProductController::class, 'delete'])->name('product.delete');

    });
    //Purchase routes
    Route::group(['prefix' => 'purchase'], function () {

        Route::get('/list',[App\Http\Controllers\PurchaseController::class, 'index'])->name('purchase.list');
        Route::get('/add',[App\Http\Controllers\PurchaseController::class, 'add'])->name('purchase.add');
        Route::post('/store',[App\Http\Controllers\PurchaseController::class, 'store'])->name('purchase.store');
        Route::get('/edit/{id}',[App\Http\Controllers\PurchaseController::class, 'edit'])->name('purchase.edit');
        Route::post('/update/{id}',[App\Http\Controllers\PurchaseController::class, 'update'])->name('purchase.update');
        Route::get('/delete/{id}',[App\Http\Controllers\PurchaseController::class, 'delete'])->name('purchase.delete');

    });
    //robot routes
    Route::get('/Robotlist',[App\Http\Controllers\RobotController::class, 'index'])->name('robot.list');
    Route::post('/RobotStore',[App\Http\Controllers\RobotController::class, 'store'])->name('robot.store');



    //ajax route
    Route::get('/get_category',[App\Http\Controllers\DefaultController::class, 'get_category'])->name('get-category');
    Route::get('/get-product',[App\Http\Controllers\DefaultController::class, 'get_product'])->name('get-product');

});
