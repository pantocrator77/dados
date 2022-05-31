<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller\Api\GamesController;
use App\Models\User;
use App\Models\Game;

class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function Store (request $request) {  //store new player from request
      $request -> validate([
      'nickname'=> 'required|max:50',
      'password'=> 'required|max:50',
      'email'=> 'required|max:80',
      ]);
      $user = new User();
      $user->nickname = "anonim";
      $user->nickname = $request->nickname;
      $user->password = $request->password;
      $user->email = $request->email;
      $user->total_games =0;
      $user->wins =0;
      $user->rate=0;
      $user->save();  
      return response()->json(
       ["user $user->nickname has been created!"],
        200); 
 
   }
   public function Update (request $request, $id) { //update player
    $request -> validate([
      'nickname'=> 'required|max:50',
      'password'=> 'required|max:50',
      'email'=> 'required|max:80',
    ]);

    $user =  User::find($id);
    $user->nickname = $request->nickname;
    $user->password = $request->password;
    $user->email = $request->email;
    $user->save(); 
    return response()->json(
        ["user $user->nickname has been updated!"],
        200);

   }
public function AddRate ($id) {
   $users =  User::all();
   $calculate = ($users->wins*100)/$users->total_games;
   $rate= round($calculate, 2);
   }
   public function AllPlayers () {   //list all players
    $users =  User::all('nickname', 'created_at', 'total_games');
    return response()->json([
      'message' => 'All players',
      'data' => $users
      ],200);

   }
   public function RankAll () {   //list all players
      $users =  User::all('nickname', 'rate');
      return response()->json([
        'message' => 'Players ranking',
        'data' => $users
        ],200);
  
     }
     public function Winner () {   //get player with highest rate
      $winner = User::orderBy('rate', 'desc')->first(); // gets the best rate
      //$users =  User::max('rate', 'nickname');
      return response()->json([
        'message' => 'The winner is:',
        'data' => [$winner->nickname, $winner->rate]
        ],200);
  
     }
     public function Loser () {   //get player with highest rate
      $winner = User::orderBy('rate', 'asc')->first(); // gets the best rate
      //$users =  User::max('rate', 'nickname');
      return response()->json([
        'message' => 'The loser is:',
        'data' => [$winner->nickname, $winner->rate]
        ],200);
  
     }
}
   /* public function Rate(){      //find rate for players
     $games = User::withCount('games')->get();
   
     foreach ($games as $game){
        echo ("<b>").$game->nickname.("</b>");
        echo (" total partidas jugadas: ");
        echo $game->games_count;
        echo ("     total ganadas: ");
        $win=Game::where('user_id', $game->id)->sum('result');
        $rate=($win*100)/$game->games_count;
        $game->rate = $rate;
        echo $win;
        if ($game->games_count != 0){
        $rate= round(($win*100)/$game->games_count, 2);
        echo (". El porcentaje de victoria es:").("<b>").$rate.("</b>");
        } 
        elseif ($game->games_count === 0){
         echo ". El jugador todavia no ha jugado.";
        }
       
        echo ("<br>");
     } 
      */

  /* 
   public function Winner($user_id){
      $win=Game::where('user_id', $user_id)->sum('result'); 
      dd($win); */
      /* $games = Game::withCount('users')->where(->get(); // find all games from single player 
      foreach ($games as $game){
         $win=Game::where('user_id', $game->id)->sum('result'); //get all games
         $sorted = $games->sortBy(function ($rate) {
            return $user['nickname'].$user['rate'];
        });
         $rate=round(($win*100)/$game->games_count, 2); //find win rate
         echo ("esto es el porcentaje: ").$rate;
         echo ("<br>"); */
      
     /*  $winner= User::query()
      ->where () */
   


