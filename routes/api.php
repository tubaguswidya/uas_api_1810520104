<?php

use Illuminate\Http\Request;

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
Route::get('password',function (){
    return bcrypt('bagus');
});
Route::get('/jabatan', 'API\JabatanController@index');
Route::get('/jabatan/{jabatan}', 'API\JabatanController@show');
Route::delete('/jabatan/{jabatan}', 'API\JabatanController@destroy');
Route::post('/jabatan/', 'API\JabatanController@store');
Route::patch('/jabatan/{jabatan}', 'API\JabatanController@update');

Route::get('/golongan', 'API\GolonganController@index');
Route::get('/golongan/{golongan}', 'API\GolonganController@show');
Route::delete('/golongan/{golongan}', 'API\GolonganController@destroy');
Route::post('/golongan/', 'API\GolonganController@store');
Route::patch('/golongan/{golongan}', 'API\GolonganController@update');

Route::get('/pegawai', 'API\PegawaiController@index');
Route::get('/pegawai/{pegawai}', 'API\PegawaiController@show');
Route::delete('/pegawai/{pegawai}', 'API\PegawaiController@destroy');
Route::post('/pegawai/', 'API\PegawaiController@store');
Route::patch('/pegawai/{pegawai}', 'API\PegawaiController@update');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});