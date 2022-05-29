<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
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
   public function Store (request $request) {
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
      $user->save();  
      return response()->json(
       ["user $user->nickname has been created!"],
        200); 
 
   }
   public function Update (request $request, $id) {
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
   public function AllPlayers () {
    $users =  User::all('nickname', 'created_at');
    return response()->json([
      'message' => 'todos jugadores',
      'data' => $users
      ],200);

   }
  

   public function Rate(){
     $games = User::withCount('games')->get();
   
     foreach ($games as $game){
        echo ("<b>").$game->nickname.("</b>");
        echo (" total partidas jugadas: ");
        echo $game->games_count;
        echo ("     total ganadas: ");
        $win=Game::where('user_id', $game->id)->sum('result');
        echo $win;
        if ($game->games_count != 0){
        echo (". El porcentaje de victoria es:").("<b>").($win*100)/$game->games_count.("</b>");
        } 
        elseif ($game->games_count == 0){
         echo ". El jugador todavia no ha jugado.";
        }
       
        echo ("<br>");
     } 
     
   }
   public function Winner(){
      $games = User::withCount('games')->get()->sortByDesc('$rate');
      foreach ($games as $game){
         echo ("<b>").$game->nickname.("</b>");
         echo (" total partidas jugadas: ");
         echo $game->games_count;
         echo ("     total ganadas: ");
         $win=Game::where('user_id', $game->id)->sum('result');
         echo $win;
         if ($game->games_count != 0){
            $rate=($win*100)/$game->games_count;
         echo (". El porcentaje de victoria es:").("<b>").$rate.("</b>");
         } 
         elseif ($game->games_count == 0){
          echo ". El jugador todavia no ha jugado.";
         }
         $winner = User::max('$win');
         echo ('el ganador es :').$winner;
        
         echo ("<br>");
      } 
   
   }
}
