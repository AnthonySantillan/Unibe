<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CellarsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesNotesController;
use App\Http\Controllers\SalesNotesProductsController;
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

Route::apiResource('users',UsersController::class);
Route::apiResource('address',AddressController::class);
Route::apiResource('cellars',CellarsController::class);
Route::apiResource('products',ProductsController::class);
Route::apiResource('salesNotes',SalesNotesController::class);
Route::apiResource('salesNotesProducts',SalesNotesProductsController::class);
