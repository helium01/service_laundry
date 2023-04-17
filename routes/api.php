<?php

use App\Http\Controllers\api\midtranscontrol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KuponController;
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

Route::resource('pelanggans', PelangganController::class);

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
Route::get('/request_barang/valid/{id}', 'App\Http\Controllers\RequestBarangController@valid');
Route::get('/pembayaran/{id}', 'App\Http\Controllers\api\midtranscontrol@postmidtrans');

Route::get('kupon', [KuponController::class, 'index']);
Route::post('kupon', [KuponController::class, 'store']);
Route::get('kupon/{kupon}', [KuponController::class, 'show']);
Route::put('kupon/{kupon}', [KuponController::class, 'update']);
Route::delete('kupon/{kupon}', [KuponController::class, 'destroy']);



