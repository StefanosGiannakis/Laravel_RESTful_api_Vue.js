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
// Get All Users - Testing purposes
Route::get('users','UserController@index');
// Create new User or Update
Route::post('user','UserController@store'); 
// Retrive a User
Route::get('user/{param}','UserController@show');
