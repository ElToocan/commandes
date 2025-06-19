<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class,'blank']);

Route::get('/view/{state?}', [DashboardController::class,'view'])->name('view');

Route::get('/kitchen-view/{state?}', [DashboardController::class,'kitchen_view'])->name('kitchen-view');


Route::get('/add', [DashboardController::class,'add'])->name('add');

Route::get('/finish', [DashboardController::class,'finish'])->name('finish');

Route::put('/orders/{order}', [DashboardController::class, 'update'])->name('orders.update');

Route::delete('/orders/destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::post('/orders/{order}/validate', [OrderController::class, 'validateOrder'])->name('orders.validate');

//Route::get('/', function () {
//    return view('welcome');
//});
