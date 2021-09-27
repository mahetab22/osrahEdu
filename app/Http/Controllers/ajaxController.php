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
use App\Comment;
use App\ExamStuAch;
use App\StuExam;
use App\ExamCode;
use Carbon\Carbon;
use Auth;
use Validator;
use DB;

class ajaxController extends HomeController
{

    
    public function slesson(Request $request)
    {
     // $lesson_id=$request->lesson_id;
        $lesson=Lesson::where('id',$request->lesson_id)->first();
      //return $lesson;
       return Response()->json($lesson);
    }

    public function sexam(Request $request)
    { 
        $examm=Exam::where('id',$request->exam_id)->first();
         foreach ($examm->questions as $question) {
         $answers[] = $question->answers;
         }
         $exam['questions']=$examm->questions;
         $exam['answers']=$answers;
       return Response()->json($exam);
    }

    public function lesson(Request $request)
    {
     // echo dd($request->lesson_id);
         $lesson=Lesson::where('id',$request->lesson_id)->first();
         $level = Level::where('id',$lesson->level_id)->first();
         $lesson['status'] = 'true';
        if($lesson['status'] == 'true'){
            $stulesson=StuLesson::where('lesson_id',$request->lesson_id)->where('user_id',Auth::user()->id)->first();
            if(empty($stulesson)){
              $data = new StuLesson;
              $data->lesson_id = $request->lesson_id;        
              $data->user_id = Auth::user()->id;
              $data->course_id = $level->course_id;
              $data->save();
            }
          }

          
        
       return Response()->json($lesson);
    }

    public function exam(Request $request)
    {
        $examm=Exam::where('id',$request->exam_id)->first();
        $exam['status']='false';
        $exam['total']='0';
         foreach ($examm->questions as $question) { 
         $answers[] = $question->answers;
         }
          if($examm->lesson_id != null){
            foreach (Auth::user()->stulessons as $stulesson) {
              if ($examm->lesson_id == $stulesson->lesson_id) { 
                  $exam['status']='true';
              }
            }
          }elseif ($examm->level_id != null) {
              foreach (Auth::user()->stulessons as $stulesson) {
                if ($examm->levels->lessons->last()->id == $stulesson->lesson_id) { 
                  $exam['status']='true';
                }
              }  
          }elseif ($examm->course_id != null) {
            $course = Course::find($examm->course_id);;
              foreach (Auth::user()->stulessons as $stulesson) {
                if ($course->levels->last()->lessons->last()->id == $stulesson->lesson_id) { 
                  $exam['status']='true';
                }
              }  
          }
         $StuExam=StuExam::where('exam_id',$examm->id)->where('user_id',Auth::user()->id)->first();
         if(!empty($StuExam)){
           $exam['status']='have';
           $exam['total']=$StuExam->total;
         }
         $exam['questions']=$examm->questions;
         $exam['answers']=$answers;
       return Response()->json($exam);
    }

}
