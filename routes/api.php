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

Route::post('register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('login', 'App\Http\Controllers\Api\AuthController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('user','App\Http\Controllers\Api\AuthController@getAuthenticatedUser');
    
    Route::post('create_team','App\Http\Controllers\Api\TeamController@createTeam');
    Route::post('update_team','App\Http\Controllers\Api\TeamController@updateTeam');
    Route::post('delete_team','App\Http\Controllers\Api\TeamController@deteleTeam');
    Route::post('edit_team','App\Http\Controllers\Api\TeamController@editTeam');
    Route::post('get_team','App\Http\Controllers\Api\TeamController@getTeam');
    Route::get('get_all_teams','App\Http\Controllers\Api\TeamController@getAllTeams');

   
    Route::post('create_player','App\Http\Controllers\Api\PlayerController@createPlayer');
    Route::post('update_player','App\Http\Controllers\Api\PlayerController@updatePlayer');
    Route::post('delete_player','App\Http\Controllers\Api\PlayerController@detelePlayer');
    Route::post('edit_player','App\Http\Controllers\Api\PlayerController@editPlayer');
    Route::post('get_player','App\Http\Controllers\Api\PlayerController@getPlayer');
    Route::get('get_all_players','App\Http\Controllers\Api\PlayerController@getAllPlayers');


});