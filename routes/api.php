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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 *
 * Controllers Inside API Folder
 *
 */

Route::prefix('v1')->namespace('API')->group(function ($router) {

    Route::get('/', function () {
        return response()->json(['success' => 'Conexão com API bem sucedida!'], 200);
    });

    //cron
    Route::get('/convenios', 'ConveniosController@index');
    Route::get('/instituicoes', 'InstituicoesController@instituicoes');
    Route::get('/taxas_instituicoes', 'TaxasInstituicoesController@taxas_instituicoes');
    Route::post('/simulacao', 'SimulacaoController@simulacao');

});