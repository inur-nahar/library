<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
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

