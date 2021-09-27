<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamStuAch;
use App\StuExam;
use App\Exam;
use App\Question;
use App\Answer;
use Carbon\Carbon;
use Auth;
use Validator;
use DB;

class examController extends Controller
{

    public function exam()
    {
        return view('exam');
    }

    public function postexamtest(Request $request)
    {
      $rules =[
        'questions'     => ['required','array'],
        'answers'     => ['required','array'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{
      	//echo dd($request->answers);
		  $question=Question::where('id',$request->questions[0])->first();
		  $questions=Question::where('exam_id',$question->exam_id)->get();
		$StuExam=StuExam::where('exam_id',$question->exam_id)->where('user_id',Auth::user()->id)->first();
		if (!empty($StuExam)) {
      	return back()->with('toast_error', 'قمت بأجتياز الأمتحان من قبل وتم اعتماد النتيجة')->withInput();
			
		}
      	if(count($request->questions) == count($request->answers)){
          $total=0;

			for ($i = 0; $i < count($request->questions) ; $i++) {
				  $data = new ExamStuAch;
		          $data->question_id = $request->questions[$i];
		          $data->answer_id = $request->answers[$i];
          		  $data->exam_id = $question->exam_id;
		          $data->user_id = Auth::user()->id;          
		          $data->save();

				$answer=Answer::where('question_id',$request->questions[$i])->where('true',1)->first();
				if (!empty($answer) and $answer->id == $request->answers[$i]) {
					$total++;
				}
			}
		  $total = $total/count($questions);
		  $total = $total*100;
          $dataa = new StuExam;
          $dataa->exam_id = $question->exam_id;
		  $dataa->user_id = Auth::user()->id;          
          $dataa->total = $total;
          $dataa->save();
          
          return redirect()->back()->with(['success' => 'أجتزت الأمتحان  درجتك التي حصلت عليها &nbsp;: &nbsp;'.$total.'%']);
      }else{
      	return back()->with('toast_error', 'تأكد من أدخال كل الأجابات')->withInput();
      }
  }
    }

    public function postexam(Request $request)
    {
      $rules =[
        'questions'     => ['required','array'],
        'answers'     => ['required','array'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{
        $question=Question::where('id',$request->questions[0])->first();
        $exam=Exam::find($question->exam_id);
      	//echo dd($request->answers);
		  
		  $questions=Question::where('exam_id',$question->exam_id)->get();
		$StuExam=StuExam::where('exam_id',$question->exam_id)->where('user_id',Auth::user()->id)->first();
		if (!empty($StuExam)) {
		 return Redirect()->to('/examResults/'.$exam->id)->with('toast_error', 'قمت بأجتياز الأمتحان من قبل وتم اعتماد النتيجة')->withInput();
		 // return $this->examResults($exam);
         // return redirect('/examResults/'.$exam)->with('toast_error', 'قمت بأجتياز الأمتحان من قبل وتم اعتماد النتيجة')->withInput();
			
		}
      	if(count($request->questions) == count($request->answers)){
          $total=0;
			for ($i = 0; $i < count($request->questions) ; $i++) {
				  $data = new ExamStuAch;
		          $data->question_id = $request->questions[$i];
		          $data->answer_id = $request->answers[$i];
          		  $data->exam_id = $question->exam_id;
		          $data->user_id = Auth::user()->id;          
		          $data->save();

				$answer=Answer::where('question_id',$request->questions[$i])->where('true',1)->first();
				if (!empty($answer) and $answer->id == $request->answers[$i]) {
					$total++;
				}
			}
		  $total = $total/count($questions);
		  $total = $total*100;
          $dataa = new StuExam;
          $dataa->exam_id = $question->exam_id;
		  $dataa->user_id = Auth::user()->id;          
          $dataa->total = $total;
          $dataa->save();
          
          return  Redirect()->to('/examResults/'.$exam->id)->with(['success' => 'أجتزت الأمتحان  درجتك التي حصلت عليها &nbsp;: &nbsp;'.$total.'%']);
      }else{
      	return back()->with('toast_error', 'تأكد من أدخال كل الأجابات')->withInput();
      }
  }
    }



      
    public function postpublicexam(Request $request)
    {
      $rules =[
        'answers'     => ['array'],
        'checck'     => ['array'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{
        
        $arr=$request->answers;
        $checck=$request->checck;
        if($arr){
        $question=Question::where('id',array_key_first($arr))->first();
        }elseif($checck){
          $question=Question::where('id',array_key_first($checck))->first();  
        }
        if(empty($question)){
          return back()->with('toast_error', 'لم يتم الإجابة علي أي سؤال')->withInput();
        }else{
            $questions=Question::where('exam_id',$question->exam_id)->get();
            if(!empty($request['answers']) and !empty($request['checck'])){
                if(count($request['answers'])+count($request['checck'])!=count($questions)){
               return back()->with('toast_error', 'يجب الإجابة علي جميع الأسئلة')->withInput(); 
            }  
            }elseif(!empty($request['answers'])and empty($request['checck'])){
            if(count($request['answers'])!=count($questions)){
               return back()->with('toast_error', 'يجب الإجابة علي جميع الأسئلة')->withInput(); 
            } 
            }elseif(empty($request['answers'])and !empty($request['checck'])){
            if(count($request['checck'])!=count($questions)){
               return back()->with('toast_error', 'يجب الإجابة علي جميع الأسئلة')->withInput(); 
            } 
            }
        }
  		
        $dataa = StuExam::where('exam_id',$question->exam_id)->where('user_id',Auth::user()->id)->first();   
        $total=0;
        if(!empty($arr)){
        foreach ($arr as $question_id => $answer_id) {
				  $data = new ExamStuAch;
		          $data->question_id = $question_id;
		          $data->answer_id = $answer_id;
          		  $data->exam_id = $question->exam_id;
                  $data->stu_exam_id = $dataa->id;
		          $data->user_id = Auth::user()->id;          
		          $data->save();            
        }
        }
        if(!empty($checck)){
        foreach ($checck as $question_id => $answer_id) {
				  $data = new ExamStuAch;
		          $data->question_id = $question_id;
		          $data->flag = $answer_id;
          		  $data->exam_id = $question->exam_id;
                  $data->stu_exam_id = $dataa->id;
		          $data->user_id = Auth::user()->id;          
		          $data->save();            
        }  
      }
      if(!empty($arr)){
			foreach ($arr as $question_id => $answer_id) {
				$answer=Answer::where('question_id',$question_id)->where('true',1)->first();
				if (!empty($answer) and $answer->id == $answer_id) {
					$total++;
                    $an=ExamStuAch::where('exam_id',$question->exam_id)->where('question_id',$question_id)->where('user_id', Auth::user()->id)->first();
                    $an->sol = 1 ;//true
                    $an->save();
				}
			}
            }
   if(!empty($checck)){
            foreach ($checck as $question_id => $answer_id) {
				$answerr=Question::where('id',$question_id)->where('sol',$answer_id)->first();
				if (!empty($answerr)) {
					$total++;
                    $an=ExamStuAch::where('exam_id',$question->exam_id)->where('question_id',$question_id)->where('user_id', Auth::user()->id)->first();
                    $an->sol = 1 ;//true
                    $an->save();  
				}
			}
            }
		  $total = $total/count($questions);
		  $total = $total*100;   
          $dataa->total = $total;
          $dataa->save();
          
          return redirect()->back()->with(['success' => 'تم اعتماد النتيجة ونسبتك &nbsp;: &nbsp;'.$total.'%']);

      }
    }
    
    
           // ----      unused 
      public function examResults($exam) 
      {
        $exam=Exam::where('id',$exam->id)->first();
        $StuExam=StuExam::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->first();
		if(!empty($StuExam) and !empty($StuExam->total)){
		$ExamStuAch=ExamStuAch::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->get();
        return view('examResults',compact('ExamStuAch','StuExam','exam'));	
		}
        
        if(empty($exam)){
            return back()->with('toast_error', 'الاختبار لم يكتمل بعد من فضلك تواصل مع المدرب')->withInput();
        }
        if(empty($StuExam)){
          $dataa = new StuExam;
          $dataa->exam_id = $exam->id;
		  $dataa->user_id = Auth::user()->id;          
          //$dataa->total = $total;
          $dataa->save();
          }
        //echo dd($exam->questions);
        return view('examcourse',compact('exam'));
      }    
      // ----      unused 
      
    
}
