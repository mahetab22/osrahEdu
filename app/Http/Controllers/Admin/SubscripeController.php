<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Supervisor_Course;
use App\SupervisorInfo;
use App\User;
use Validator;
use Illuminate\Http\Request;

class SubscripeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $input = [
            'supervisor'=>$id,
            'subscriptions' => Supervisor_Course::where('supervisor_id',$id)->get(),
        ];

        return view('admin.teachers.courses',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $input =[
            'supervisor'=>SupervisorInfo::find($id),
            'courses' => Course::all(),
            'users' => User::where('role_id','3')->get(),
        ];
        return view('admin.teachers.create_subscripe',$input);

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

        $validate = Validator::make($request->all(),[
            'user_id'=>'required',
            'course_id'=>'required',
        ],[
            'user_id.required'=>__('site.user required'),
            'course_id.required'=>__('site.course required'),
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors())->withInput();
        }

        $subscripe = new Supervisor_Course;
        $subscripe->user_id = $request->user_id;
        $subscripe->supervisor_id = $request->supervisor_id;
        $subscripe->course_id = $request->course_id;
        $subscripe->save();

        return redirect('admin/teacher/courses/'.$request->supervisor_id)->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.course subscriped successfully'),
            ]]);

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
        $subscription= Supervisor_Course::find($id);
        if(!is_null($subscription)){
            $subscription->delete();
            return response()->json(['err'=>'0','alert' =>[
                'icon'=>'success',
                'title'=>__('site.alert_success'),
                'text'=>__('site.deleted_successfully')
                ]]);
        }else{
            return response()->json(['err'=>'1','alert' =>[
                'icon'=>'error',
                'title'=>__('site.alert_failed'),
                'text'=>__('site.deleted_failed')
                ]]);
        }
    }
}
