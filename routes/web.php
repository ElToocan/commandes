<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/pending', [DashboardController::class,'index'])->name('pending');

Route::get('/add', [DashboardController::class,'add'])->name('add');

//Route::get('/', function () {
//    return view('welcome');
//});
