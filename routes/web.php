<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\FormController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FormController::class,'index']);

Route::post('/submit',[FormController::class,'submit'])->name('submitForm');

Route::post('/insert/{json}',[ProductController::class,'insert'])->name('insertProduct');

Route::get('/product/{id}',[ProductController::class,'index'])->name('product');
