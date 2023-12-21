<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CategoryController;

//Guest Route Group
Route::middleware(['guest'])->group(function () {
    // Admin Auth Route
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/authenticate', 'authenticate')->name('authenticate');
        Route::get('/forgot-password', 'forgot_password')->name('forgot_password');
    });
});

//Authenticated Admin Route
Route::middleware(['admin:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('/categories')->controller(CategoryController::class)->name('category.')->group(function(){

        //index
        Route::get('/','index')->name('index');
        //create
        Route::get('/categories/create',[CategoryController::class,'create'])->name('category.create');
        //store
        Route::post('/store','store')->name('store');
        //edit
        Route::get('/edit/{id}','edit')->name('edit');
        //update
        Route::put('/update/{id}','update')->name('update');
        //delete
        Route::delete('/delete/{id}','delete')->name('delete');
        Route::get('/change-status','change_status')->name('change_status');
        });


});
