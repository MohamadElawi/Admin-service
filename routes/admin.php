<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;



Route::get('login', [LoginController::class, 'getLogin'])->name('admin.getlogin')->withoutMiddleware('auth:admin');
Route::post('login', [LoginController::class, 'login'])->name('admin.login')->withoutMiddleware('auth:admin');
Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

Route::get('users/block/{user}', [UserController::class, 'blocked']);
Route::get('users/restore/{user}', [UserController::class, 'restore']);
Route::get('users/getData', [UserController::class, 'getData']);
Route::resource('users', UserController::class);


Route::get('admins/getData',[AdminController::class,'getData']);
Route::get('admins/change-status/{admin}',[AdminController::class,'changeStatus']);
Route::resource('admins',AdminController::class);


Route::get('profile', [ProfileController::class, 'profileShow'])->name('profile.show');
Route::post('profile-edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
Route::post('profile-edit-pass', [ProfileController::class, 'editPassword'])->name('profile.edit.pass');



Route::get('roles/getData',[RoleController::class,'getData']);
Route::get('roles/change-status/{role}',[RoleController::class,'changeStatus']);
Route::resource('roles',RoleController::class);



Route::get('category/getData',[CategoryController::class ,'getData']);
Route::get('category/change-status/{category}',[CategoryController::class,'changeStatus']);
Route::resource('category',CategoryController::class);


Route::get('product/getData',[ProductController::class ,'getData']);
Route::get('product/change-status/{category}',[ProductController::class,'changeStatus']);
Route::resource('product',ProductController::class);


Route::get('order/getData',[OrderController::class ,'getData']);
Route::resource('order',OrderController::class);