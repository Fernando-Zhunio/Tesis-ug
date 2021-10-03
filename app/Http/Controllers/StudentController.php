<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Tools\UgController;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends UgController
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
        $page = request('page', 1);
        $size = request('size', 10);
        $students = Student::paginate($size, ['*'], 'page', $page);
        return $this->responseJson(200, $students);
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
            'semester_id'=>'required|numeric',
            'career_id'=>'required|numeric',
            'password'=>'required'
        ];
        $this->validate($request, $ruler);

        $studentData = collect($request->all())->only('first_name','last_name','semester_id','career_id');

        $userData = collect([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ])->only('email','password');
        DB::transaction(function () use ($studentData,$userData) {
            $user = User::create($userData->all());
            $studentData->put('user_id',$user->id);
            $teacher = Student::create($studentData->all());
            return $this->responseJson(true,[collect($user)->concat($teacher)->all()]);
        });
        return $studentData->all();
    //     return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
