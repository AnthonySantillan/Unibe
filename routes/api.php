<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CellarsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesNotesController;
use App\Http\Controllers\SalesNotesProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/user', [UsersController::class, 'auth']);
Route::get('auth/user', [UsersController::class, 'getauth']);
Route::apiResource('users',UsersController::class);
Route::apiResource('clients',CustomersController::class);
Route::apiResource('address',AddressController::class);
Route::apiResource('cellars',CellarsController::class);
Route::apiResource('products',ProductsController::class);
Route::apiResource('salesNotes',SalesNotesController::class);
Route::apiResource('salesNotesProducts',SalesNotesProductsController::class);


