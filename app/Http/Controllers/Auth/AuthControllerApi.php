<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthControllerApi extends Controller
{

    public function login(Request $request){
        return "fernando";
        return response()->json($request->all());
    }
}
