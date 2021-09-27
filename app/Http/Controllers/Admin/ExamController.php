<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Exam;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\Level;
use App\User;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $input = [
            'exams'=> Exam::all()
        ];

        return view('admin.exams.index',$input);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $input = [
            'courses'=> Course::all(),
            'users' => User::where('role_id','3')->get()
        ];
        return view('admin.exams.create',$input);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function levels($id){

        $input = [
            'levels' => Level::where('course_id',$id)->get()
        ];

        return view('admin.exams.levels',$input);
    }

    public function lessons($id){

        $input = [
            'lessons' => Lesson::where('level_id',$id)->get()
        ];

        return view('admin.exams.lessons',$input);
    }
}
