<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Http\Controllers\UserController;
use Http\Controllers\UserAuthController;

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
/* 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

/* Route::post('login',[UserController:class, 'login'])->name('user.login'); ejemplo 
Route::resource('users', 'App\Http\Controllers\UserController', ['except' => ['create', 'edit']]);
*/ 


Route::post('players', [App\Http\Controllers\Api\UserController::class, 'Store']);//create player with a new ID
Route::put('players/{id}', [App\Http\Controllers\Api\UserController::class, 'Update']);//modify player with id
Route::post('players/{id}/games', [App\Http\Controllers\Api\GamesController::class, 'Play']);// player with specific ID make new game
Route::delete('players/{id}/games', [App\Http\Controllers\Api\GamesController::class, 'Destroy']);//delete all games from single player
Route::get('players', [App\Http\Controllers\Api\UserController::class, 'Rate']);// return all players with medium success rate
Route::get('players/{id}/games', [App\Http\Controllers\Api\GamesController::class, 'AllGames']);// all games from player with specific ID
Route::get('players/ranking', [App\Http\Controllers\Api\GamesController::class, 'RankAll']);// list all players with medium success rate
Route::get('players/ranking/loser', [App\Http\Controllers\Api\GamesController::class, 'Loser']);// list the player with lower success rate
Route::get('players/ranking/winner', [App\Http\Controllers\Api\UserController::class, 'Winner']);// list the player with higher success rate





