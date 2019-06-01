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
    Route::get('/paginacao/{total_page?}', 'Refrigerantes\RefrigerantesController@getAllRefrigerantessPaginate');
    Route::get('/{id_refrigerante}', 'Refrigerantes\RefrigerantesController@getRefrigerantesById');
    Route::post('/', 'Refrigerantes\RefrigerantesController@createRefrigerantes');
    Route::patch('/{id_refrigerante}', 'Refrigerantes\RefrigerantesController@updateRefrigerantes');
    Route::delete('/', 'Refrigerantes\RefrigerantesController@deleteRefrigerantes');
    Route::delete('/{id_refrigerante}', 'Refrigerantes\RefrigerantesController@deleteRefrigerante');
});
