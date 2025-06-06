<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/pending', [DashboardController::class,'index'])->name('pending');

Route::get('/add', [DashboardController::class,'add'])->name('add');

Route::get('/finish', [DashboardController::class,'finish'])->name('finish');

Route::get('/finish/update/{id}', [DashboardController::class,'update'])->name('update');

Route::delete('/orders/destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::put('/orders/validate/{id}', [OrderController::class, 'validateOrder'])->name('orders.validate');


//Route::get('/', function () {
//    return view('welcome');
//});
