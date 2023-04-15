<?php

use App\Http\Controllers\api\midtranscontrol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/home', [UserController::class, 'home']);

Route::get('paket-laundry', 'App\Http\Controllers\PaketLaundryController@index');
Route::post('paket-laundry', 'App\Http\Controllers\PaketLaundryController@store');
Route::get('paket-laundry/{paketLaundry}', 'App\Http\Controllers\PaketLaundryController@edit');
Route::post('paket-laundry/{paketLaundry}/update','App\Http\Controllers\PaketLaundryController@update');
Route::delete('paket-laundry/{paketLaundry}','App\Http\Controllers\PaketLaundryController@destroy');

Route::get('/request_barang', 'App\Http\Controllers\RequestBarangController@index');
Route::post('/request_barang', 'App\Http\Controllers\RequestBarangController@store');
Route::get('/request_barang/{id}', 'App\Http\Controllers\RequestBarangController@show');
Route::put('/request_barang/{id}', 'App\Http\Controllers\RequestBarangController@update');
Route::delete('/request_barang/{id}', 'App\Http\Controllers\RequestBarangController@destroy');
