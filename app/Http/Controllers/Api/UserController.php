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
       ["user has been created!"],
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
        ["user has been updated!"],
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
     return response()->json([
      'message' => 'todos los jugadores',
      'data' => $games
      ],200);
    /*  return response()->json([
      dd($games->games_count),200
      ]);  */
/*    
     foreach ($games as $Game) {
      dd($games->games_count) ;
  } */
   /*  return response()->json([
      'name' => 'Abigail',
      'state' => 'CA',
      ]); */
   }
}
