<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Course;
use App\User;
use App\SupervisorInfo;
use App\Supervisor_Course;
use App\Level;
use App\Lesson;
use App\StuLesson;
use App\StuLevel;
use App\Exam;
use App\Question;
use App\Comment;
use App\ExamStuAch;
use App\StuExam;
use App\ExamCode;
use Carbon\Carbon;
use Auth;
use Validator;
use DB;

class courseController extends Controller
{

    public function course()
    {
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $services= Service::with('course')->whereHas('course')->orderBy('id','asc')->get();
        return view('courses',compact('services','slide_img'));
    }


    public function add_link(Request $request){
        $input=$request->all();

        $course=Course::find($input['course_id']);

        $course->link_name=$input['link_name'];
        $course->link_url=$input['link_url'];
        $course->save();

        return redirect()->back();




    }

      public function getdepartment(department $department) 
      {
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $depart = $department;
        $departments= Department::where('id','!=',$depart->id)->orderBy('id','asc')->get();
        $cours=Course::where('department_id',$depart->id)->orderBy('id','asc')->get();
        return view('courses',compact('cours','depart','departments','slide_img'));
      }

      public function getalldepartment() 
      {
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $depart = $department;
        $departments= Department::orderBy('id','asc')->get();
        return view('services',compact('cours','depart','departments','slide_img'));
      }
 


    public function courseSingle()
    {
        return view('course-single');
    }

    public function coursedSingle()
    {
        return view('course-single2');
    }

      public function getcoursedSingle(course $course) 
      {
       // visits($course)->increment();
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $cour=DB::table('courses')
        ->join('supervisor__courses', 'courses.id', '=', 'supervisor__courses.course_id')
        ->join('supervisor_infos', 'supervisor_infos.user_id', '=', 'supervisor__courses.supervisor_id')
        ->join('users', 'users.id', '=', 'supervisor_infos.user_id')
        ->where('course_id',$course->id)
        ->first();
        
        if(!empty($cour)){
        $service= Service::where('id','!=',1)->where('parent_id',1)->where('id',$cour->service_id)->orderBy('id','asc')->first();
         $levels= Level::where('course_id',$course->id)->orderBy('id','asc')->get();
        }else{
         return redirect()->back()->with('toast_error', 'محتويات الكورس لم تكتمل بعد وجاري العمل عليها')->withInput();
         $levels=[];
         $service=null;
       }
        //echo dd($cour);
        return view('course-single2',compact('cour','levels','service','slide_img'));
      }

      public function getcourrsedSingle(course $course) 
      {
     //   visits($course)->increment();
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $cour=DB::table('courses')
        ->where('id',$course->id)
        ->first();
        if(!empty($cour)){
         $levels= Level::where('course_id',$cour->id)->orderBy('id','asc')->get();
        }else{
         $levels=[];
       }
        return view('course-single2',compact('cour','levels','slide_img'));
      }
     public function getcourseSingle(course $course) 
      {
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $cour=DB::table('courses')
        ->join('supervisor__courses', 'courses.id', '=', 'supervisor__courses.course_id')
        ->join('supervisor_infos', 'supervisor_infos.user_id', '=', 'supervisor__courses.supervisor_id')
        ->join('users', 'users.id', '=', 'supervisor_infos.user_id')
        ->where('course_id',$course->id)
        ->first();
        $service= Service::where('id','!=',1)->where('parent_id',1)->where('id',$cour->service_id)->orderBy('id','asc')->first();
        // echo dd($cour);
        return view('course-single',compact('cour','service','slide_img'));
      }

    public function checkcode(Request $request)
      {
          $rules =[
            'code'     => ['required','max:255'],
            'course_id'     => ['required','exists:courses,id'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            if(empty(Auth::user()->id)){
              return redirect('login')->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
            }
                $examcode = ExamCode::where('course_id',$request['course_id'])->where('code',$request['code'])->where('used',1)->first();

                if (empty($examcode)){
                  return back()->with('toast_error', 'كود غير صحيح')->withInput();
                }else{
                  $exam=Exam::where('course_id',$request['course_id'])->where('publicexam',1)->first();
                 if (!empty($exam)){
                  $question=Question::where('exam_id',$exam->id)->first();
                   if (empty($question)){
                  return back()->with('toast_error', 'الإختبار في مرحلة الإعداد')->withInput();
                  }
                }

                }
                     if(!empty($examcode->user_id) and $examcode->user_id!=Auth::user()->id){
                        return back()->with('toast_error', 'لا يحق لك أستخدام هذا الكود')->withInput();
                    }
                  $examcode->user_id = Auth::user()->id;
                  $examcode->save();

        return redirect('/examcourse/'.$request['course_id'])->with(['success' => 'تمت التأكد من الكود وسيتم تحويلك لصفحة الأمتحان!']);
      }
    }
  
    public function checkpubliccode(Request $request)
      {
          $rules =[
            'code'     => ['required','max:255'],
            'exam_id'     => ['required','exists:exams,id'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            if(empty(Auth::user()->id)){
              return redirect('login')->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
            }
                $examcode = Exam::where('id',$request['exam_id'])->where('code',$request['code'])->first();
                if (empty($examcode)){
                  return back()->with('toast_error', 'كود غير صحيح')->withInput();
                }else{
                 $question=Question::where('exam_id',$request['exam_id'])->first();
                   if (empty($question)){
                  return back()->with('toast_error', 'الإختبار في مرحلة الإعداد')->withInput();
                  }

                }

                  $examcode->counter =$examcode->counter+1;
                  $examcode->save();

        return redirect('/exambyid/'.$request['exam_id'])->with(['success' => 'تمت التأكد من الكود وسيتم تحويلك لصفحة الأمتحان!']);
      }
    }

}

