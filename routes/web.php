<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
//index
Route::get('/categories',[CategoryController::class,'index'])->name('category.index');
//create
Route::get('/categories/create',[CategoryController::class,'create'])->name('category.create');
//store
Route::post('/categories/store',[CategoryController::class,'store'])->name('category.store');
//view
//edit
Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
//update
Route::put('/categories/update/{id}',[CategoryController::class,'update'])->name('category.update');
//delete
Route::delete('/categories/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
Route::get('/categories/change-status',[CategoryController::class,'change_status'])->name('category.change_status');


