<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::get('/',[ProductController::class,'products']);
Route::view('/productForm','productForm');
Route::post('/addProduct',[ProductController::class,'addProduct']);
Route::post('/searchProduct',[ProductController::class,'searchProduct']);
Route::get('/deleteProduct/{id}',[ProductController::class,'deleteProduct']);
Route::get('/editProduct/{id}',[ProductController::class,'getProduct']);
Route::post('/updateProduct',[ProductController::class,'updateProduct']);
Route::get('/download/{file}',[ProductController::class,'download']);
