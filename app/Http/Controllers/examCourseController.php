<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Notifications\Notification;
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
use App\ExamCode;
use App\ExamStuAch;
use App\StuExam;
use App\Exam;
use App\Question;
use App\Answer;
use App\Comment;
use App\Discount;
use App\Bankfile;
use App\Certificate;
use App\Info;
use Carbon\Carbon;
use App\Notifications\InvoicePaid;
use App\Notifications\commentNotify;
use Notification;
use Auth;
use Validator;
use DB;
use App\MarketeInfo;
class examCourseController extends HomeController
{
 
  public function exam_check_code(Request $request){
      $exam=Exam::find($request['exam']);
      if($exam && $exam->code==$request['code']){
          return Redirect()->route('get_student_exam',$exam->id);
      }else{
          return redirect()->back()->with('toast_error', 'تأكد من كود الأختبار')->withInput();
      }
  }

    public function get_student_exam($id){
        $ex=Exam::find($id);
		$exam=StuExam::where('exam_id',$id)->where('user_id',Auth::user()->id)->first();
        if($exam){
             if($ex->view==1){
            return view('examResults',compact('exam'));
             }else{
                return back()->with('toast_error', 'الاختبار لم يكتمل بعد من فضلك تواصل مع المدرب')->withInput();
             }
        }else{
            $exam=Exam::find($id);
            return view('examcourse',compact('exam'));
        }
    }

    public function postExamStudent(Request $request){
        $ex=Exam::find($request['exam']);
        $exam=StuExam::where('exam_id',$request['exam'])->where('user_id',auth::user()->id)->first();
        if(!$exam){
         $exam=new StuExam;
         $exam->user_id=auth::user()->id;
         $exam->exam_id=$request['exam'];
         $exam->save();
        }
        foreach($ex->questions as $question){
            $q=$question->id;
            $aQ='question_'.$q;
            $f=0;
            $st=new ExamStuAch;
            $st->exam_id=$request['exam'];
            $st->user_id=auth::user()->id;
            $st->question_id=$question->id;
            $st->stu_exam_id =$exam->id;
            
            if($question->type==0){
                $st->answer_id=$request->{$aQ};
                $answer=Answer::where('question_id',$question->id)->where('true',1)->first();
                if($answer->id==$request->{$aQ}){
                    $flag=1;
                    $f=$f+1;
                }else{
                    $flag=0;
                }
            }else{
                $st->sol=$request->{$aQ};
                if($question->sol==$request->{$aQ}){
                    $flag=1;
                    $f=$f+1;
                }else{
                    $flag=0;
                }
            }

            $st->flag=$flag;
            $st->save();
        }
            $exam->total=$f/count($ex->questions);
            $exam->save();
            return redirect()->route('get_student_exam',$ex->id);
        }

    

}