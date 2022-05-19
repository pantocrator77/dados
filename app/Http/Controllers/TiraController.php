<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TiraController extends Controller
{
    public function tira(){
        $valor1= rand(1,6);
        $valor2= rand(1,6);
        dd($valor1,$valor2);
        }
}
