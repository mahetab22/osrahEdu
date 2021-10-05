<?php

namespace App\Http\Controllers\Admin;

use App\ApplicationsForCourse;
use Illuminate\Http\Request;
use App\Course;
use App\Http\Controllers\Controller;
class ApplicationsForCourseController extends Controller
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
        return view('admin.courses.apps',compact('course'));
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
        $app=new ApplicationsForCourse;
        $app->course_id=$request['course_id'];
        $app->title=$request['title'];
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/app', $imageName);
            $app->app = 'storage/app/'. $imageName;
        }
        $app->save();
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
     * @param  \App\ApplicationsForCourse  $applicationsForCourse
     * @return \Illuminate\Http\Response
     */
    public function show(ApplicationsForCourse $applicationsForCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApplicationsForCourse  $applicationsForCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationsForCourse $applicationsForCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApplicationsForCourse  $applicationsForCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $app=ApplicationsForCourse::find($id);
        $app->course_id=$request['course_id'];
        $app->title=$request['title'];
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/app', $imageName);
            $app->app = 'storage/app/'. $imageName;
        }
        $app->save();
        return redirect()->back()->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.added successfully'),
            ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApplicationsForCourse  $applicationsForCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $app=ApplicationsForCourse::find($id);
         if(!is_null($app)){
            $app->delete();
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
                ApplicationsForCourse::destroy($request->ids);
                
            }else{
                $app=ApplicationsForCourse::find($request->ids);
                $app->delete();
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
    //--------------student apps-----------------
    public function student_apps($id){
        $app=ApplicationsForCourse::find($id);
        return view('admin.courses.student_apps',compact('app'));
    }
    public function delete_all_student_apps(Request $request){

        try{
            if (is_array($request->ids)){
                StudentApp::destroy($request->ids);
                
            }else{
                $app=StudentApp::find($request->ids);
                $app->delete();
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
