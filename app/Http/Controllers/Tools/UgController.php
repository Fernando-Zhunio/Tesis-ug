<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class UgController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
    }

    /**
     * @param Boolean $success
     * @param Array $data
     * @param Integer $code
     *  @return \Illuminate\Http\JsonResponse
     */
    public function responseJson($success, $data,$code = 200){
        return response()->json([
            'success' => $success,
            'data' => $data
        ], $code);
    }
}
