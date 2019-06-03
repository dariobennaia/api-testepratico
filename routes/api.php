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

Route::group(['prefix' => 'refrigerantes'], function () {
    Route::get(
        '/tipos-refrigerantes',
        'Refrigerantes\TiposRefrigerantesController@obterTodosOsRefrigerantes'
    );
    Route::get(
        '/litragem-refrigerantes',
        'Refrigerantes\LitragensRefrigerantesController@obterTodasAsLitragensRefrigerantes'
    );
    Route::get('/', 'Refrigerantes\RefrigerantesController@obterTodosOsRefrigerantes');
    Route::get(
        '/paginacao/{total_paginas?}',
        'Refrigerantes\RefrigerantesController@obterTodosOsRefrigerantesEmPaginacao'
    );
    Route::get('/{id_refrigerante}', 'Refrigerantes\RefrigerantesController@obterRefrigerantePorId');
    Route::post('/', 'Refrigerantes\RefrigerantesController@cadastrarRefrigerante');
    Route::patch('/{id_refrigerante}', 'Refrigerantes\RefrigerantesController@atualizarRefrigerante');
    Route::delete('/', 'Refrigerantes\RefrigerantesController@excluirRefrigerantes');
    Route::delete('/{id_refrigerante}', 'Refrigerantes\RefrigerantesController@excluirRefrigerante');
});
