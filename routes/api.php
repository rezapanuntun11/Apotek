<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/check', 'Auth\RegisterController@check')->name('api-register-check');
Route::get('provinces', 'API\LocationController@provinces')->name('api-provinces');
Route::post('/check-ongkir', 'RajaOngkirController@check')->name('check-ongkir');
Route::get('regencies/{provinces_id}', 'API\LocationController@regencies')->name('api-regencies');
Route::get('/get-provinces', 'RajaOngkirController@provinces')->name('get-provinces');
Route::get('/get-cities/{id}', 'RajaOngkirController@cities')->name('get-cities');
Route::get('/get-courier', 'RajaOngkirController@courier')->name('get-courier');
Route::POST('/rajaongkir/checkOngkir', 'Api\LocationController@checkOngkir')->name('api-checkOngkir');