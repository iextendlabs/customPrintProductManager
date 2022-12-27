<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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
Route::view('/','home');

// Product Route
Route::get('/productList',[ProductController::class,'products']);
Route::view('/productForm','product.productForm');
Route::post('/addProduct',[ProductController::class,'addProduct']);
Route::post('/searchProduct',[ProductController::class,'searchProduct']);
Route::get('/deleteProduct/{id}',[ProductController::class,'deleteProduct']);
Route::get('/editProduct/{id}',[ProductController::class,'getProduct']);
Route::post('/updateProduct',[ProductController::class,'updateProduct']);
Route::get('/download/{file}',[ProductController::class,'download']);
Route::post('/filterProduct',[ProductController::class,'filterProduct']);

// Order Route

Route::get('/orderList',[OrderController::class,'orders']);
Route::get('/todayOrderList',[OrderController::class,'todayOrders']);
Route::view('/orderForm','order.orderForm');
Route::post('/addOrder',[OrderController::class,'addOrder']);
Route::get('/deleteOrder/{id}',[OrderController::class,'deleteOrder']);
Route::get('/viewOrder/{id}',[OrderController::class,'viewOrder']);
Route::get('/downloadInvoice/{file}',[OrderController::class,'downloadInvoice']);
Route::get('/updateOrder/{id}/{status}',[OrderController::class,'updateOrder']);
