<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With, X-XSRF-TOKEN, Authorization');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE');
use Illuminate\Http\Request;
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

Route::get('/password/{password}' , function($password) {
    return bcrypt($password);
});

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

Route::group(["prefix" => 'api'], function() {
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('login','api\UserController@login');
    Route::get('getKitab','api\AlkitabController@getKitab');
    Route::get('getPasalAyat/{kitab}','api\AlkitabController@getPasalAyat');
    Route::get('getFirman/{kitab}/{pasal}/{ayat}','api\AlkitabController@getFirman');
});
