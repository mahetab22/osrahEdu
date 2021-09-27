<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;
use App\SupervisorInfo;
use App\Http\Requests\Admin\TeacherRequest;
use App\Supervisor_Course;
use App\User;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $input =[
            'teachers'=> SupervisorInfo::all(),
        ];

        return view('admin.teachers.index',$input);
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
            'users' => User::where('role_id','3')->get(),
            'services' => Service::all()
        ];
        return view('admin.teachers.create',$input);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        //

        $teacher = new SupervisorInfo;
        $teacher->user_id = $request->user_id;
        $teacher->educational = $request->educational;
        $teacher->name  = $request->name_ar;
        // $teacher->name_en  = $request->name_en; //When using multilanguage add in migrate first
        $teacher->service_id = $request->service_id;
        $teacher->fb = $request->facebook;
        $teacher->tw = $request->twitter;
        $teacher->inst = $request->instagram;
        $teacher->google = $request->google;
        $teacher->profile = $request->curriculum_ar;
        // $teacher->profile_en = $request->profile_en; / /When using multilanguage add in migrate first
        $teacher->skill1 = $request->skill1_ar;
        // $teacher->skill1 = $request->skill1_en; //When using multilanguage add in migrate first
        $teacher->skill2 = $request->skill2_ar;
        // $teacher->skill2 = $request->skill2_en; / /When using multilanguage add in migrate first
        $teacher->skill3 = $request->skill3_ar;
        // $teacher->skill3 = $request->skill3_en; When using multilanguage add in migrate first
        $teacher->save();

        return redirect('admin/teachers')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.teacher add successfully'),
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
        $input = [
            'teacher' => SupervisorInfo::find($id),
            'services' => Service::all(),
            'users' => User::all()
        ];

        return view('admin.teachers.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherRequest $request, $id)
    {
        //
        $teacher = SupervisorInfo::find($id);
        $teacher->user_id = $request->user_id;
        $teacher->educational = $request->educational;
        $teacher->name  = $request->name_ar;
        // $teacher->name_en  = $request->name_en; //When using multilanguage add in migrate first
        $teacher->service_id = $request->service_id;
        $teacher->fb = $request->facebook;
        $teacher->tw = $request->twitter;
        $teacher->inst = $request->instagram;
        $teacher->google = $request->google;
        $teacher->profile = $request->curriculum_ar;
        // $teacher->profile_en = $request->profile_en; / /When using multilanguage add in migrate first
        $teacher->skill1 = $request->skill1_ar;
        // $teacher->skill1 = $request->skill1_en; //When using multilanguage add in migrate first
        $teacher->skill2 = $request->skill2_ar;
        // $teacher->skill2 = $request->skill2_en; / /When using multilanguage add in migrate first
        $teacher->skill3 = $request->skill3_ar;
        // $teacher->skill3 = $request->skill3_en; When using multilanguage add in migrate first
        $teacher->save();

        return redirect('admin/teachers')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.teacher updated successfully'),
            ]]);
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
        $teacher=SupervisorInfo::find($id);
        if(!is_null($teacher)){
            $teacher->delete();
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
                SupervisorInfo::destroy($request->ids);
            }else{
                $teacher=SupervisorInfo::find($request->ids);
                $teacher->delete();
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
