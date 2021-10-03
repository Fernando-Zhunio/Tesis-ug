<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth:api','role:Super Admin']);
    }

    public function index(){
        $user = auth()->user();
        $page = request('page',1);
        $events = Event::paginate(10, ['*'], 'page', $page);
        $count_events = 0;
        //  $user()->events()->count();

        return response()->json([
            'success'=>true,
            'data'=>['events'=>$events,'count_events'=>$count_events]]
        );
    }
}
