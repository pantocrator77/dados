<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Game;

class GamesController extends Controller
{
    public function Play ($id) {

      $value1=rand(1,6);
      $value2=rand(1,6);
      $score = $value1+$value2;
      $user =  User::find($id);
      $user->total_games++; 
      $user -> save();
     
      if ($score==7){   //score is 7 so player wins
        $game = new game();
        $game -> value1 = $value1;
        $game -> value2 = $value2;
        $game -> result = 1;
        $game -> user_id = $id;
        $game -> save();
        $user->wins ++;
        $calculate = ($user->wins*100)/$user->total_games;
        $rate= round($calculate, 2);
        $user->rate=$rate;
        $user -> save();
        return response()->json(
            ["Total score is ".$score.", the player has won!"],
            200);
      }
     elseif ($score!=7){ //score is different from 7 so player have lost
        $game = new game();
        $game -> value1 = $value1;
        $game -> value2 = $value2;
        $game -> result = 0;
        $game -> user_id = $id;
        $game -> save();
        $calculate = ($user->wins*100)/$user->total_games;
        $rate= round($calculate, 2);
        $user->rate=$rate;
        $user -> save();
        return response()->json(
            ["Total score is ".$score.", the player has lost!"],
            200);

      }
   }
   public function Destroy ($id) {

      $deleted=Game::where('user_id',$id)->delete();
      $user =  User::find($id);
      $user->total_games = 0;
      $user->wins = 0;
      $user->rate= 0;
      $user->save();
        return response()->json(
          "all games from user have been deleted",
          200);
    }
   public function AllGames($id) {
        $games=Game::where('user_id', $id)->get();
        return response()->json(
          $games,
          200);
      }
     /*  public function RankAll() {
        $games=Game::all($id)->get();
        return response()->json(
          $games,
          200);
      } */


}
