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
    Route::get('/{id_refrigerante}', 'Refrigerantes\RefrigerantesController@getRefrigerantesById');
    Route::post('/paginate/{total_page?}', 'Refrigerantes\RefrigerantesController@getAllRefrigerantessPaginate');
    Route::post('/', 'Refrigerantes\RefrigerantesController@createRefrigerantes');
    Route::patch('/{id_refrigerante}', 'Refrigerantes\RefrigerantesController@updateRefrigerantes');
    Route::patch('/{id_refrigerante}/enable', 'Refrigerantes\RefrigerantesController@enableRefrigerantes');
    Route::patch('/{id_refrigerante}/disable', 'Refrigerantes\RefrigerantesController@disableRefrigerantes');
});
