<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $product = DB::table('products')->get();
    $pic = DB::table('product_pics')->get();
    return view('dashboard',compact('product','pic'));
})->name('dashboard');

Route::get('product',[ProductController::class,'index'])->name('product');
Route::get('product/add',[ProductController::class,'add'])->name('addProduct');
Route::post('product/add_to_db',[ProductController::class,'add_to_db'])->name('add_to_db');

Route::get('product/edit/{id}',[ProductController::class,'edit']);
Route::post('product/edit_to_db',[ProductController::class,'edit_to_db'])->name('edit_to_db');

Route::get('product/delete/{id}',[ProductController::class,'delete']);
Route::post('product/status',[ProductController::class,'change_status']);

Route::get('product/add_img/{id}',[ProductController::class,'add_img']);
Route::post('product/add_img_to_db',[ProductController::class,'add_img_to_db'])->name('add_img_to_db');

