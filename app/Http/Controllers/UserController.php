<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(){
        /**
        * @var $user \App\User
        */
        // $user = auth()->user();
        $user = User::find(6);

        $user->load('more');
        return response()->json(['success'=>true, 'data'=>$user]);
    }
}
