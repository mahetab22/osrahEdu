<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudentActivity;
class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
         $course=Course::find($id);
        return view('admin.courses.actitvities',compact('course'));
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
        //
        $activity=new Activity;
        $activity->course_id=$request['course_id'];
        $activity->title=$request['title'];
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/activity', $imageName);
            $activity->acivity = 'storage/activity/'. $imageName;
        }
        $activity->save();
        return redirect()->back()->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.added successfully'),
            ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity,$id)
    {
        //
        $activity=Activity::find($id);
        $activity->course_id=$request['course_id'];
        $activity->title=$request['title'];
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/activity', $imageName);
            $activity->acivity = 'storage/activity/'. $imageName;
        }
        $activity->save();
        return redirect()->back()->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.updated successfully'),
            ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $activity=Activity::find($id);
         if(!is_null($activity)){
            $activity->delete();
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

    public function delete_all(Request $request){

        try{
            if (is_array($request->ids)){
                Activity::destroy($request->ids);
                
            }else{
                $activity=Activity::find($request->ids);
                $activity->delete();
            }
            return response()->json(['err'=>'0','alert' =>[
                'icon'=>'success',
                'title'=>__('site.alert_success'),
                'text'=>__('site.deleted_successfully')
                ]]);

        } catch(Exception $e) {

            return response()->json(['err'=>'1','alert' =>[
                'icon'=>'error',
                'title'=>__('site.alert_failed'),
                'text'=>__('site.deleted_failed')
                ]]);
        }
    }

    //---------student_activity/=-----------
    public function student_activity($id){
        $activity=Activity::find($id);
        return view('admin.courses.student_activity',compact('activity'));
    }
    public function delete_all_student_activity(Request $request){

        try{
            if (is_array($request->ids)){
                StudentActivity::destroy($request->ids);
                
            }else{
                $activity=StudentActivity::find($request->ids);
                $activity->delete();
            }
            return response()->json(['err'=>'0','alert' =>[
                'icon'=>'success',
                'title'=>__('site.alert_success'),
                'text'=>__('site.deleted_successfully')
                ]]);

        } catch(Exception $e) {

            return response()->json(['err'=>'1','alert' =>[
                'icon'=>'error',
                'title'=>__('site.alert_failed'),
                'text'=>__('site.deleted_failed')
                ]]);
        }
    }

}
