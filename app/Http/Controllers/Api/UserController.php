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
      $user->rate =0;
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
   public function AllPlayers () {   //list all players
    $users =  User::all('nickname', 'created_at');
    return response()->json([
      'message' => 'todos jugadores',
      'data' => $users
      ],200);

   }
  

   public function Rate(){      //find rate for players
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
        //$users->rate = $rate; // assign rate to user.rate
        echo (". El porcentaje de victoria es:").("<b>").$rate.("</b>");
        } 
        elseif ($game->games_count == 0){
         echo ". El jugador todavia no ha jugado.";
        }
       
        echo ("<br>");
     } 
     
   }
   public function Winner(){
      $games = User::withCount('games')->get(); // find all games from single player
      foreach ($games as $game){
         $win=Game::where('user_id', $game->id)->sum('result'); //get all games
         $rate=($win*100)/$game->games_count; //find win rate
         echo("esto es el porcentaje: ").$rate;
         echo ("<br>");
      } 
     /*  $winner= User::query()
      ->where () */
   }
}

