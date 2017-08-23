<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With, X-XSRF-TOKEN, Authorization');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE');
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

Route::post('login','api\UserController@login');
Route::get('getKitab','api\AlkitabController@getKitab');
Route::get('getPasalAyat/{kitab}','api\AlkitabController@getPasalAyat');
