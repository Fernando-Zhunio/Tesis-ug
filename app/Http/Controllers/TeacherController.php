<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tools\UgController;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends UgController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(['auth:api','role:student|Super Admin'])->except('store');

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ruler = [
            'email'=>'required|email|unique:users,email',
            'first_name'=>'required',
            'last_name'=>'required',
            'password'=>'required'
        ];
        $this->validate($request, $ruler);

        $teacherData = collect($request->all())->only('first_name','last_name');
        $userData = collect([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ])->only('email','password');
       return DB::transaction(function () use ($teacherData,$userData) {
            $user = User::create($userData->all());
            $teacherData->put('user_id',$user->id);
            $teacher = Teacher::create($teacherData->all());
            return $this->responseJson(true,[collect($user)->concat($teacher)->all()]);
        });

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
