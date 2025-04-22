<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DemoController::class, 'demo'])->name('home');
Route::get('/super-admin', [AdminController::class,'MainAdmin'])->name('super-admin');
Route::get('/super-admin/add-user', [AdminController::class,'Register'])->name('super-admin.add-user');
Route::post('/super-admin/add-user', [AdminController::class,'AddUser'])->name('super-admin.new-user');
Route::get('/super-admin/all-users', [UserController::class,'getUser'])->name('super-admin.all-users');
Route::patch('/super-admin/all-users', [UserController::class,'updateUser'])->name('super-admin.update-users');
Route::get('/super-admin/add-product', [AdminController::class,'AddProduct'])->name('super-admin.add-product');

