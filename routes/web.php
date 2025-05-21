<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [DemoController::class, 'demo'])->name('home');


//login route
Route::get('/login', [UserController::class,'showLoginForm'])->name('login');
Route::post('/login', [UserController::class,'login'])->name('user.login');

//logout route
Route::get('/logout', [UserController::class,'logout'])->name('logout');


Route::middleware([TokenVerificationMiddleware::class])
    ->prefix('super-admin')
    ->group(function () {
        Route::get('/', [AdminController::class,'MainAdmin'])->name('super-admin');
        Route::get('/add-user', [AdminController::class,'Register'])->name('super-admin.add-user');
        Route::post('/add-user', [UserController::class,'AddUser'])->name('super-admin.new-user');
        Route::get('/all-users', [UserController::class,'getUser'])->name('super-admin.all-users');
        Route::patch('/all-users', [UserController::class,'updateUser'])->name('super-admin.update-users');
        Route::get('/delete-user/{id}', [UserController::class,'deleteUser'])->name('super-admin.delete-users');
        Route::get('/add-product', [AdminController::class,'AddProduct'])->name('super-admin.add-product');

        //category route
        Route::get('/category', [CategoryController::class,'getCategory'])->name('super-admin.category');
        Route::post('/add-category', [CategoryController::class,'addCategory'])->name('super-admin.add-category');
        Route::put('/update-category/{id}', [CategoryController::class,'updateCategory'])->name('super-admin.update-category');
        Route::get('/delete-category/{id}', [CategoryController::class,'deleteCategory'])->name('super-admin.delete-category');

        //sub category route
        Route::get('/sub-category', [CategoryController::class,'getSubCategory'])->name('super-admin.sub-category');
        Route::post('/add-sub-category', [CategoryController::class,'addSubCategory'])->name('super-admin.add-sub-category');
        Route::put('/update-sub-category/{id}', [CategoryController::class,'updateSubCategory'])->name('super-admin.update-sub-category');
        Route::get('/delete-sub-category/{id}', [CategoryController::class,'deleteSubCategory'])->name('super-admin.delete-sub-category');

    });
//users routes


