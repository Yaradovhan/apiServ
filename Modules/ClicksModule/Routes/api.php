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

//Route::middleware('auth:api')->get('/clicksmodule', function (Request $request) {
//    return $request->user();
//});

Route::post('/bad_domain','BadDomainController@create');
Route::delete('/bad_domain/{id}','BadDomainController@destroy');
Route::put('/bad_domain/{id}','BadDomainController@update');
