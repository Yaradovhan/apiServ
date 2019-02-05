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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/bad/all', 'BadDomainController@index');
Route::get('/bad/{id}', 'BadDomainController@show');

Route::get('/click/{id}', 'ClickController@show');

// http://local.dev/click/?param1=some_value&param2=some_value
//Route::get('/click/param1={param1}&param2={param2}', 'ClickController@trackLink');
Route::get('/click', 'ClickController@trackLink');
Route::get('/success/{id_click}','ClickController@success')->name('idSuccess');
Route::get('/error/{id_click}','ClickController@error')->name('idError');

//Route::get('/click', function(Request $request){
//    dd([$request->param1,$request->param2]);
//});
