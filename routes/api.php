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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


    Route::post('list', 'API\UserController@index');
    Route::post('login', 'API\UserController@login');
    Route::post('register', 'API\UserController@register');
    Route::delete('delete/{id}', 'API\UserController@delete');
    Route::post('update/{id}', 'API\UserController@update');

    Route::post('listGroup', 'API\GroupRegController@index');
    Route::post('storeGroup', 'API\GroupRegController@store');
    Route::post('updateGroup/{id}', 'API\GroupRegController@update');
    Route::get('showGroup/{id}', 'API\GroupRegController@show');
    Route::delete('deleteGroup/{id}', 'API\GroupRegController@destroy');

    Route::post('listMember', 'API\MemberRegController@index');
    Route::post('storeMember', 'API\MemberRegController@store');
    Route::post('updateMember/{id}', 'API\MemberRegController@update');
    Route::get('showMember/{id}', 'API\MemberRegController@show');
    Route::delete('deleteMember/{id}', 'API\MemberRegController@destroy');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('details', 'API\UserController@details');

        // Route::post('listGroup', 'API\GroupRegController@index');
	    // Route::post('storeGroup', 'API\GroupRegController@store');
	    // Route::put('updateGroup/{id}', 'API\GroupRegController@update');
	    // Route::get('showGroup/{id}', 'API\GroupRegController@show');
	    // Route::delete('deleteGroup/{id}', 'API\GroupRegController@destroy');
    });

 //    Route::middleware('auth:api')->group( function () {
	//     Route::get('listGroup', 'API\GroupRegController@index');
	//     Route::post('storeGroup', 'API\GroupRegController@store');
	//     Route::put('updateGroup/{id}', 'API\GroupRegController@update');
	//     Route::get('showGroup/{id}', 'API\GroupRegController@show');
	//     Route::delete('deleteGroup/{id}', 'API\GroupRegController@destroy');
	// });