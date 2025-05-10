<?php

use App\Http\Controllers\AdminController;
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
    });
//users routes


