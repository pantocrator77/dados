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
      if ($score==7){   //score is 7 so player wins
        $game = new game();
        $game -> value1 = $value1;
        $game -> value2 = $value2;
        $game -> result = 1;
        $game -> user_id = $id;
        $game -> save();
        return response()->json(
            ["Total score is ".$score.", the player has won!"],
            200);
      }
     elseif ($score!=7){ //score is different from 7 so player loses
        $game = new game();
        $game -> value1 = $value1;
        $game -> value2 = $value2;
        $game -> result = 0;
        $game -> user_id = $id;
        $game -> save();
        return response()->json(
            ["Total score is ".$score.", the player has lost!"],
            200);

      }
   }
   public function Destroy ($id) {
      $games=Game::where('user_id', $id)->delete();
        return response()->json(
          "all games have been deleted",
          200);
    }
   public function AllGames($id) {
        $games=Game::where('user_id', $id)->get();
        return response()->json(
          $games,
          200);
      }
      public function RankAll() {
        $games=Game::all($id)->get();
        return response()->json(
          $games,
          200);
      }


}
