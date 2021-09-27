<?php

namespace App\Http\Controllers\Admin;
use App\HTTP\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Condition;
use App\Course;
use App\User;
Use Alert;
use App\Exam;
Use Visitor;
use App\MarketeInfo;
use App\Models\Info;
use Session;
use DB;
use Illuminate\Support\Facades\File;
use App\Http\Request\CourseRequestl;
use App\Http\Requests\Admin\CourseRequest;
use App\Lesson;
use App\Level;
use App\Supervisor_Course;
use App\SupervisorInfo;

class courseController extends Controller
{
  public function index()
  {

    $input = [
      'courses' => Course::get(),
      'info' => DB::table('infos')->first()
    ];

    return view('admin.courses.index',$input);
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
            'services' => Service::all(),
            'supervisors'=>SupervisorInfo::all(),
        ];

        return view('admin.courses.create',$input);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        //

        $course = new Course ;
        $course->title_ar = $request->title_ar;
        $course->title_en = $request->title_en;
        $course->description_ar = $request->desc_ar;
        $course->description_en = $request->desc_en;
        $course->duration = $request->duration;
        $course->service_id = $request->service;
        $course->from_date = $request->to_date;
        $course->feature1_en = $request->feature1_en;
        $course->feature2_en = $request->feature2_en;
        $course->feature3_en = $request->feature3_en;
        $course->feature1= $request->feature1_ar;
        $course->feature2= $request->feature2_ar;
        $course->feature3= $request->feature3_ar;
        $course->link = $request->link;
        $course->price = $request->price;
        $course->from_date = $request->start_date;
        $course->to_date = $request->end_date;
        $course->online = $request->type;
        $course->link_url = $request->type == 0 ? $request->link_url : $request->google_map;// if course is online insert link url
        $course->link_name = $request->type == 0 ? $request->link_name : $request->address_name;// if course is online insert link url
        $course->studentDiscount = $request->discount ?? 0;
        $course->activate = 0;
        $course->stop_subscription = 1;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/courses', $imageName);
            $course->logo = 'public/storage/courses/'. $imageName;
        }
        $course->save();
        try{
            if($request->supervisor_id)
            $supervisor = new Supervisor_Course;
            $supervisor->user_id = auth()->user()->id;
            $supervisor->supervisor_id = $request->supervisor_id;
            $supervisor->course_id = $course->id;
            $supervisor->save();
        } catch(Exception $e) {
            return redirect()->back()->with([
                'alert'=>[
                    'icon'=>'error',
                    'title'=>__('site.alert_failed'),
                    'text'=>__('site.superivsor not found'),
                ]]);
        }

        return redirect('admin/courses')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.added successfully'),
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
        $input = [
            'course' => Course::find($id),
        ];

        return view('admin.courses.show',$input);
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
            'course' => Course::find($id),
            'services'=>Service::all(),
            'supervisors'=>SupervisorInfo::all(),
        ];

        return view('admin.courses.edit',$input);
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

        $course =  Course::find($id) ;
        $course->title_ar = $request->title_ar;
        $course->title_en = $request->title_en;
        $course->description_ar = $request->desc_ar;
        $course->description_en = $request->desc_en;
        $course->duration = $request->duration;
        $course->service_id = $request->service;
        $course->from_date = $request->to_date;
        $course->feature1_en = $request->feature1_en;
        $course->feature2_en = $request->feature2_en;
        $course->feature3_en = $request->feature3_en;
        $course->feature1= $request->feature1_ar;
        $course->feature2= $request->feature2_ar;
        $course->feature3= $request->feature3_ar;
        $course->link = $request->link;
        $course->price = $request->price;
        $course->from_date = $request->start_date;
        $course->to_date = $request->end_date;
        $course->online = $request->type;
        $course->studentDiscount = $request->discount ?? 0;
        $course->link_url = $request->type == 0 ? $request->link_url : $request->google_map;// if course is online insert link url
        $course->link_name = $request->type == 0 ? $request->link_name : $request->address_name;// if course is online insert link url
        $course->save();

        if ($request->hasFile('logo')) {
            $image_path=public_path().'/storage/courses'.$course->logo;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image = $request->file('logo');
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();;
            $image->move(public_path().'/storage/courses', $imageName);
            $course->logo = 'public/storage/courses/'. $imageName;
        }

        try{

            if($request->supervisor_id){
                $supervisor = Supervisor_Course::where('course_id',$id)->first();
                $supervisor->supervisor_id = $request->supervisor_id;
                $supervisor->save();
            }

        } catch(Exception $e) {
            return redirect()->back()->with([
                'alert'=>[
                    'icon'=>'error',
                    'title'=>__('site.alert_failed'),
                    'text'=>__('site.superivsor not found'),
                ]]);
        }



        return redirect('admin/courses')->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.course updated successfully'),
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
        $course = Course::find($id);
        $levels = Level::where('course_id',$id)->get();
        $lessons = Lesson::where('course_id',$id)->get();
        $exams = Exam::where('course_id',$id)->get();
        if(!is_null($course)){
            $course->delete();
                foreach($levels as $level){
                    $level->delete();
                }
                foreach($lessons as $lesson){
                    $lesson->delete();
                }
                foreach($exams as $exam){
                    $exam->delete();
                }

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
                Course::destroy($request->ids);
                $levels = Level::whereIn('course_id',$request->ids)->get();
                $lessons = Lesson::whereIn('course_id',$request->ids)->get();
                $exams = Exam::whereIn('course_id',$request->ids)->get();
                foreach($levels as $level){
                    $level->delete();
                }
                foreach($lessons as $lesson){
                    $lesson->delete();
                }
                foreach($exams as $exam){
                    $exam->delete();
                }
            }else{
                $course=Course::find($request->ids);
                $levels=Level::where('course_id',$request->ids)->get();
                $lessons=Lesson::where('course_id',$request->ids)->get();
                $exams=Exam::where('course_id',$request->ids)->get();
                $course->delete();
                foreach($levels as $level){
                    $level->delete();
                }
                foreach($lessons as $lesson){
                    $lesson->delete();
                }
                foreach($exams as $exam){
                    $exam->delete();
                }
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

    public function course_active(Request $request){
        $course=Course::find($request['id']);
        if($course->activate==0){
        $course->activate=1;
        }else{
          $course->activate=0;
        }
        $course->save();
        return $course->activate;
      }

      public function course_students($id){
             $input = [
                'course' => Course::find($id),
              ];

             return view('admin.courses.students',$input);
      }

}
