<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthControllerApi extends Controller
{
    use AuthenticatesUsers;

    public function logout(){}

    public function register(Request $request){
        $ruler = [
            'email'=>'required|email|unique:users,email|exists',
            'password'=>'required'
        ];
        $this->validate($request, $ruler);

        return response()->json($request);
    }

    protected function sendLoginResponse(Request $request)    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'success'=>true,
            'data'=>[
                'token'=>$tokenResult->accessToken,
                'token_type'=>'Bearer',
                'expires_at'=>Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'user'=>$user
            ]

        ]);
    }

    public function dataForLogin(){
        $semester = Semester::all();
        $career = Career::all();

        return response()->json([
            'success'=>true,
            'data'=>[
                'semester'=>$semester,
                'career'=>$career
            ]
        ]);
    }

}
