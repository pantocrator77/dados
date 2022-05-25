<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class UserController extends Controller
{
   public function NewPlayer (request $request) {

        $user = user::create([
            'nickname'=> $request->input('nickname'),
            'email'=> $request->input('email')            
        ]);
       /* $User = new User;
       ($request->nickname)? $User->nickname = $request->nickname : $User->name="jugador anonimo"; */
   }
}
