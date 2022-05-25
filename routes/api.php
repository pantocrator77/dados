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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('players', [UserController::class, 'NewPlayer']);//create player with a new ID
Route::put('players/{id}', [UserController::class, 'UpdatePlayer']);//modify player with id
Route::post('players/{id}/games', [UserController::class, 'Play']);// player with specific ID make new game
Route::delete('players/{id}/games', [UserController::class, 'DeletePlayer']);//delete all games from single player
Route::get('players', [UserController::class, 'all_players']);// return all players with medium success rate
Route::get('players/{id}/games', [GamesController::class, 'AllGames']);// all games from player with specific ID
Route::get('players/ranking', [GamesController::class, 'RankAll']);// list all players with medium success rate
Route::get('players/ranking/loser', [GamesController::class, 'RankLoser']);// list the player with lower success rate
Route::get('players/ranking/winner', [GamesController::class, 'RankWinner']);// list the player with higher success rate





