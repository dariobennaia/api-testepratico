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

Route::group(['prefix' => 'refrigerantes'], function () {
    Route::get('/', 'Refrigerantes\RefrigerantesController@getAllRefrigerantess');
    Route::get('/{id}', 'Refrigerantes\RefrigerantesController@getRefrigerantesById');
    Route::post('/paginate/{totalPage?}', 'Refrigerantes\RefrigerantesController@getAllRefrigerantessPaginate');
    Route::post('/', 'Refrigerantes\RefrigerantesController@createRefrigerantes');
    Route::patch('/{id}', 'Refrigerantes\RefrigerantesController@updateRefrigerantes');
    Route::patch('/{id}/enable', 'Refrigerantes\RefrigerantesController@enableRefrigerantes');
    Route::patch('/{id}/disable', 'Refrigerantes\RefrigerantesController@disableRefrigerantes');
});
