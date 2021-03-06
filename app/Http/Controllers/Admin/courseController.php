<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Http\Request\CourseRequestl;
use App\Http\Requests\Admin\CourseRequest;
use App\Lesson;
use App\Level;
use App\Activity;
use App\Supervisor_Course;
use App\SupervisorInfo;
use App\Stusubscriptioncourse;
use App\AttendingCourse;
use App\ApplicationsForCourse;
use Auth;
use App\Widgets\Supervisor;
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
        // dd($request);
        $course = new Course ;
        $course->title_ar = $request->title_ar;
        $course->title_en = $request->title_en ?? $request->title_ar;
        $course->description_ar = $request->desc_ar;
        $course->description_en = $request->desc_en ?? $request->desc_ar;
        $course->duration = $request->duration;
        $course->service_id = $request->service;
        $course->from_date = $request->to_date;
        $course->feature1_en = $request->feature1_en ?? $request->feature1_ar;
        $course->feature2_en = $request->feature2_en ?? $request->feature2_ar;
        $course->feature3_en = $request->feature3_en ?? $request->feature3_ar;
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
            foreach($request->supervisor_id as $visor){
                $supervisor = new Supervisor_Course;
                $supervisor->user_id = auth()->user()->id;
                $supervisor->supervisor_id = $visor;
                $supervisor->course_id = $course->id;
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
            'supervisors'=>SupervisorInfo::get(),
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
    public function update(CourseRequest $request, $id)
    {
        //

        $course =  Course::find($id) ;
        $course->title_ar = $request->title_ar;
        $course->title_en = $request->title_en ?? $request->title_ar;
        $course->description_ar = $request->desc_ar;
        $course->description_en = $request->desc_en ?? $request->desc_ar;
        $course->duration = $request->duration;
        $course->service_id = $request->service;
        $course->from_date = $request->to_date;
        $course->feature1_en = $request->feature1_en ?? $request->feature1_ar;
        $course->feature2_en = $request->feature2_en ?? $request->feature2_ar;
        $course->feature3_en = $request->feature3_en ?? $request->feature3_ar;
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
       $course->whatsapp=$request->whatsapp;
       $course->telegram=$request->telegram;
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
                foreach($request->supervisor_id as $super){
                $supervisor = Supervisor_Course::where('course_id',$id)->where('supervisor_id',$super)->first();
              if(!$supervisor){
                $supervisor = new Supervisor_Course;
                $supervisor->course_id=$id;
                $supervisor->supervisor_id = $super;
                $supervisor->user_id =auth::user()->id;
                $supervisor->save();
              }
            }
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
        
        if(!is_null($course)){
        //-----Exams-----
        $exams = Exam::where('course_id',$id)->get(['id']);
        $subscriptions::destroy($exams->toArray());
        //-----Levels-----
        $levels = Level::where('course_id',$id)->get(['id']);
        Level::destroy($levels->toArray());
        //-----Lessons-----
        $lessons = Lesson::where('course_id',$id)->get(['id']);
        Lesson::destroy($lessons->toArray());
        //-----Supervisores-----
        $subscriptions = Supervisor_Course::where('course_id',$id)->get(['id']);
        Supervisor_Course::destroy($subscriptions->toArray());
        //-----Avtivities-----
        $activities = Activity::where('course_id',$id)->get(['id']);
        Activity::destroy($activities->toArray());
        //-----Applications-----
        $apps = ApplicationsForCourse::where('course_id',$id)->get(['id']);
        ApplicationsForCourse::destroy($apps->toArray());
        $course->delete();
            
            
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
                //-----Exams-----
                $exams = Exam::where('course_id',$id)->get(['id']);
                $subscriptions::destroy($exams->toArray());
                //-----Levels-----
                $levels = Level::where('course_id',$id)->get(['id']);
                Level::destroy($levels->toArray());
                //-----Lessons-----
                $lessons = Lesson::where('course_id',$id)->get(['id']);
                Lesson::destroy($lessons->toArray());
                //-----Supervisores-----
                $subscriptions = Supervisor_Course::where('course_id',$id)->get(['id']);
                Supervisor_Course::destroy($subscriptions->toArray());
                //-----Avtivities-----
                $activities = Activity::where('course_id',$id)->get(['id']);
                Activity::destroy($activities->toArray());
                //-----Applications-----
                $apps = ApplicationsForCourse::where('course_id',$id)->get(['id']);
                ApplicationsForCourse::destroy($apps->toArray());
                $course->delete();
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

    public function delete_all_student(Request $request){

        try{
            if (is_array($request->ids)){
                Stusubscriptioncourse::destroy($request->ids);
              
            }else{
                $course=Stusubscriptioncourse::find($request->ids)->delete();
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

    public function attend_students(Request $request){
        try{
            if (is_array($request->ids)){
               $students= Stusubscriptioncourse::whereIn('id',$request->ids)->get();
               foreach($students as $st){
                $att=AttendingCourse::where('student_course',$st->id)->where('created_at','like',Carbon::now()->format('Y-m-d').'%')->first();
                if(!$att){
                $attend=new AttendingCourse;
                $attend->student_course=$st->id;
                $attend->save();
                }
               }
            
            }else{
                $st=Stusubscriptioncourse::find($request->ids);
                $att=AttendingCourse::where('student_course',$st->id)->where('created_at','like',Carbon::now()->format('Y-m-d').'%')->first();
                if(!$att){
                $attend=new AttendingCourse;
                $attend->student_course=$st->id;
                $attend->save();
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

      public function student_report($id){
        $attends=AttendingCourse::where('student_course',$id)->get();
        return view('admin.courses.reports',compact('attends'));
      }

}
