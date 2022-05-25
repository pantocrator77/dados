<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function Store (request $request) {

    dd($request);
/* 
            $user = new User();
            $user->nickname = $request->nickname;
            $user->email = $request->email;
            
            $user->save();
 */

   }
   public function all_players (request $request) {
       echo ("hola");
   }
}
