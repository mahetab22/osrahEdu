<?php

namespace App\Http\Controllers;

use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\StuLesson;
use App\Bankfile;
use App\User;
use App\StuSubscriptionCourse;
use Carbon\Carbon;
use Auth;
use Validator;
use DB;
use App\Streaming;
use App\Comment;

use App\StudStreaming;

use App\Notifications\commentNotify;
use Notification;


class CourseSubscriptionController extends HomeController
{
    
   public function geteditcourse(course $course)
    {
    	if(Auth::user()->role_id == 3){
        	foreach (Auth::user()->supervisorcourses as $supervisorcourse) {
        		if($supervisorcourse->course->id == $course->id) {
                    return view('profile.editcourse',compact('course'));	
        		}
        	}
    	}

    }
    
    public function getmycourse(course $course)
    {
$allowed=false;

          $countlessonns=0;
          foreach($course->levels as $levels){
           // echo dd($levels->lessons);
            $countlessonns=$countlessonns+count($levels->lessons);
          }
          if($countlessonns == 0){
             $countlessonns = 1 ; 
          }
//echo dd($countlessonns);
    	if(Auth::user()->role_id == 3){
    	foreach (Auth::user()->supervisorcourses as $supervisorcourse) {
    		if ($supervisorcourse->course->id == $course->id) {
    		    ///echo dd(empty($course->streamings_zoom[0]));
                return view('profile.supervcourse',compact('course','countlessonns'));	
    		}
    	}
    	}else{

            $data=StudStreaming::where('course_id',$course->id)->where('stud_id',auth()->id())->pluck('class_id')->toArray();
$streamings=Streaming::whereIn('class_id',$data)->orderby('created_at','desc')->get();

//dd($streamings);
//$ids=$data->get()->pluck('class_id')->toArray();
//$stream=Streaming::whereIn('class_id',$data)->orderby('created_at','desc')->first();
 //return $streams[0]->;
          $countlessons=(count(Auth::user()->stulessons->where('course_id',$course->id))/$countlessonns)*100;
          //echo dd(Auth::user()->stulessons);
    		foreach (Auth::user()->stusubscriptioncourses as $stusubscriptioncourse) {

	    		if ($stusubscriptioncourse->course->id == $course->id) {
	                return view('profile.studcourse',compact('course','countlessons','streamings'));
	    		}
    	    }

    	}
       return redirect('/mycourseafter/'.$course->id);

    }
    
public function subscribemag(course $course)
  {
    if($course->price > 0)
    {
        return back()->with('toast_error', 'لا يمكنك التسجيل في الدورة بهذة الطريقة')->withInput();
    }
    $subscribe=StuSubscriptionCourse::where('user_id',Auth::user()->id)->where('course_id',$course->id)->first();
    if (empty($subscribe)) {
          $data = new StuSubscriptionCourse;
          $data->course_id = $course->id;
          if (!empty(Auth::user())) {          
          $data->user_id = Auth::user()->id;
          $data->save();
          }else{
            return back()->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
          }
          return redirect('/mycourse/'.$course->id)->with(['success' => 'تم التسجيل بنجاح!']);
        }else{
          return redirect('/mycourse/'.$course->id);
        }
    }
    
public function subscribe(course $course,Request $request)
  {
  // echo dd($request);
    if(!empty($request->message) and $request->message == 'APPROVED' and !empty($request->status) and $request->status == 'paid'){
        $subscribe=StuSubscriptionCourse::where('user_id',Auth::user()->id)->where('course_id',$course->id)->first();
    if (empty($subscribe)) {
          $data = new StuSubscriptionCourse;
          $data->course_id = $course->id;
          if (!empty(Auth::user())) {          
          $data->user_id = Auth::user()->id;
          $data->amount = $request->amount;
          $data->payment_id = $request->id;
          $data->message = $request->message;
          $data->status = $request->status;
          $data->save();
          }else{
            return back()->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
          }
          return redirect('/mycourse/'.$course->id)->with(['success' => 'تم التسجيل بنجاح!']);
        }else{
          return redirect('/mycourse/'.$course->id);
        }
    }else{
        return back()->with('toast_error', 'فشلت عملية الاشتراك')->withInput();
    }
    
    }

public function stusubscriptioncourse($id)
  {
    //echo dd($user_id);
    $file = Bankfile::find($id);
    $subscribe=StuSubscriptionCourse::where('user_id',$file['user_id'])->where('course_id',$file['course_id'])->first();
    if (empty($subscribe)) {
          $data = new StuSubscriptionCourse;
          $data->course_id = $file['course_id'];
          if (!empty(Auth::user())) {          
          $data->user_id = $file['user_id'];
          $data->save();
          $file->done = 1 ;
          $file->save();
          }else{
            return back()->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
          }
          return redirect()->back()->with(['success' => 'تم التسجيل بنجاح!']);
        }else{
          return redirect()->back();
        }
    }

public function subscripe_meeting(Request $request){
    $request->validate([
    'attendee' => 'required',
   
]);
 //  dd($request);
$input=$request->all();

    $course=Course::find($input['course_id']);
//StudStreaming::create([''])
    $stream=Streaming::where('class_id',$input['class_id'])->first();
  //  return $stream;
   // dd($stream);

   //dd($request);
foreach ($input['attendee'] as $attendee) {
    if (!StudStreaming::where('stud_id', $attendee)->where('class_id', $input['class_id'])->first())
        StudStreaming::create(['class_id' => $input['class_id'], 'attendee_url' => $stream->join_url, 'stud_id' => $attendee, 'course_id' => $input['course_id'], 'stream_id' => $stream->id]);


    /*$hascomment = Comment::where('received_id', $attendee)->where('user_id', Auth::user()->id)->where('commentORmassage', 1)->first();
    $hascommentt = Comment::where('user_id',$attendee)->where('received_id',Auth::user()->id)->where('commentORmassage',1)->first();

    if(empty($hascomment) and empty($hascommentt)){
        $rand = rand(0,99999);
    }
    // echo dd(!empty($hascommentt) and !empty($hascomment->conversation_id));
    if(empty($rand)){
        if(!empty($hascomment) and !empty($hascomment->conversation_id)){
            $rand = $hascomment->conversation_id;
        }elseif(!empty($hascommentt) and !empty($hascommentt->conversation_id)){
            $rand = $hascommentt->conversation_id;
        }
    }
   /* echo($rand);
    echo"<br>";
    $data = new Comment;
    $data->comment = 'تم اضافه بث مباشر';
    $data->title = 'تم اضافه بث مباشر '  ;
    $data->course_id = $course->id;
    $data->received_id = $attendee;
    $data->user_id = auth()->user()->id;
    $data->conversation_id =$rand;
    $data->commentORmassage = 1;
    $data->stream_url = $stream->join_url;
    $data->save();
    $user = User::find($attendee);
   // echo $data;
    Notification::send($user, new commentNotify($data));*/




}


  /*$users=  array_unique($course->subscriptioncourses->pluck('user_id')->toArray());
    foreach ($users as $subscriper)
    {
       /* $data->comment =  'تم اضافه بث مباشر';
        $data->title =  'تم اضافه بث مباشر '.$data->topic;
        $data->course_id = $course->id;
        $data->received_id =$subscriper ;
        $data->user_id=auth()->id();
        $data->conversation_id = rand(0,99999);
        $data->commentORmassage = 1;
      $data->stream_url=$stream->join_url;
        $data->save();
        $user=User::find($subscriper);*/

























//$data['url']=$stream->join_url;
   // Notification::send(User::find($users), new commentNotify($data));

return  redirect()->back();
}
      
public function supervactive($id)
  {
  //  echo dd($id);
    $file = User::find($id);
    if (!empty($file)) {
          $file->s = 1 ;
          $file->save();
           return redirect()->back()->with(['success' => 'تم التسجيل بنجاح!']);
          }else{
            return back()->with('error', 'المستخدم غير موجود')->withInput();
          }
    }

public function courseactive($id)
  {
  //  echo dd($id);
    $file = Course::find($id);
    if (!empty($file)) {
        if($file->activate == 1){
            $file->activate = 0 ;
        }else{
           $file->activate = 1 ; 
        }
          
          $file->save();
           return redirect()->back()->with(['success' => 'تم التسجيل بنجاح!']);
          }else{
            return back()->with('error', 'المستخدم غير موجود')->withInput();
          }
    }
  
public function stop_subscription($id)
  {
  //  echo dd($id);
    $file = Course::find($id);
    if (!empty($file)) {
        if($file->stop_subscription == 1){
            $file->stop_subscription = 0 ;
        }else{
           $file->stop_subscription = 1 ; 
        }
          
          $file->save();
           return redirect()->back()->with(['success' => 'تم تعديل الحاله!']);
          }else{
            return back()->with('error', 'المستخدم غير موجود')->withInput();
          }
    }
    
public function studcourse($id)
  {
   // echo dd($course);
    $course = Course::find($id);
    return view('export-stud-course',compact('course')); 
  }
      
}

    // public function getmycourse(course $course)
    // {
    //   //Auth::user()->supervisorcourses[0]->course
    //   //$course->levels[0]->lessons
    //   //$course->supervisorcourse
    //   //$course  = Course::find(2);
    //   // echo dd($course->levels[0]->lessons);
    //   //$course->levels[2]->exam->questions[0]->answers
    //   // echo dd($course->supervisorcourse->supervisor->supervisorinfo);
    //      //  $examm=Exam::where('id',2)->first();
    //   //echo dd($course->id);
    //   // $xx = Lesson::find(1);
    //   // $xx = Lesson::find(1);
    //   // echo dd($xx->level->lessons->take(2)->last());
    //  //  if($xx->level->lessons->take(2)->last() > Auth::user()->stulessons[count(Auth::user()->stulessons)-1]->lesson_id){

    //  //  }

    //   if(Auth::user()->role_id == 3){
    //   foreach (Auth::user()->supervisorcourses as $supervisorcourse) {
    //     if ($supervisorcourse->course->id == $course->id) {
    //             return view('profile.supervcourse',compact('course'));  
    //     }
    //   }
    //   }else{
    //     //echo dd(Auth::user()->stulessons[count(Auth::user()->stulessons)-1]->lesson_id);
    //     foreach (Auth::user()->stusubscriptioncourses as $stusubscriptioncourse) {
    //       if ($stusubscriptioncourse->course->id == $course->id) {
    //               return view('profile.studcourse',compact('course'));  
    //       }
    //       }
    //           //  return view('profile.studcourse',compact('course'));
    //   }
    //    echo dd(Auth::user());

    // }