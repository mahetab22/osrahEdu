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
use App\StudentActivity;
use App\StudStreaming;
use Illuminate\Support\Str; 
use App\Notifications\commentNotify;
use Notification;
use App\MarketeInfo;
use URL;
use App\Mail\MarketerMail;
use Illuminate\Support\Facades\Mail;
use QrCode;
use App\AttendingCourse;
use App\StudentApp;
class CourseSubscriptionController extends HomeController
{
  public function attending_course($user_course){
    $subscripe=StuSubscriptionCourse::find($user_course);
    if($subscripe){
      $att=AttendingCourse::where('student_course',$subscripe->id)->where('created_at','like',Carbon::now()->format('Y-m-d').'%')->first();
      if(!$att){
    $attend=new AttendingCourse;
    $attend->student_course=$user_course;
    $attend->save();
    }
    return redirect()->route('getmycourse',$subscripe->course_id);
    }else{
      return redirect('/');
    }
}
    
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
          $countlessons=(count(Auth::user()->stulessons->where('course_id',$course->id))/$countlessonns)*100;
          $student_course=Auth::user()->stusubscriptioncourses->where('course_id',$course->id)->first();
  
  if($student_course){
            //qr code
$url=env('APP_DOMAIN').'/attending/course/'.$student_course->id;
$qr= QrCode::format('svg')
->size(200)->errorCorrection('H')
->color(4, 115, 192)
->generate($url);
//end qr
	                return view('profile.studcourse',compact('course','countlessons','streamings','qr'));
	    		
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

    if(!empty($request->message) and ($request->message == 'APPROVED' || $request->message=="Succeeded!") and !empty($request->status) and $request->status == 'paid'){
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
          
          }else{
            return back()->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
          }
         
         if(request()->has('coupon') and request('coupon')!=null){
            $marketer=MarketeInfo::where('code',request('coupon'))->first();
            $marketer->amount+=($course->price*($marketer->discount/100));
            $marketer->sales+=1;
           $marketer->save();
           $data->code=request('coupon');
        
        }
           $data->save();
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
     public function uniquerandom(){
         $unique = false;

        // Store tested results in array to not test them again
        $tested = [];

        do{

            // Generate random string of characters
            $random = str::random(10);

            // Check if it's already testing
            // If so, don't query the database again
            if( in_array($random, $tested) ){
                continue;
            }

            // Check if it is unique in the database
            $count = DB::table('markete_infos')->where('code', '=', $random)->count();

            // Store the random character in the tested array
            // To keep track which ones are already tested
            $tested[] = $random;

            // String appears to be unique
            if( $count == 0){
                // Set unique to true to break the loop
                $unique = true;
            }

            // If unique is still false at this point
            // it will just repeat all the steps until
            // it has generated a random string of characters

        }
        while(!$unique);
         return $random;
    }     
public function supervactive($id)
  {
  //  echo dd($id);
    $file = User::find($id);
    
    
    if (!empty($file)) {
        if($file->role_id==5){
            $code=$this->uniquerandom();
            $markter=MarketeInfo::create([
                'user_id'=>$file->id,
                'code'=>$code,
                'url'=>env('APP_DOMAIN').'?code='.$code,
                ]);
                  Mail::to($file['email'])->send(new MarketerMail($file));
        }
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
   
 public function student_upload_activity(Request $request){
   $activity=StudentActivity::where('student_id',auth::user()->id)->where('activity_id',$request['activity'])->first();
   if(!$activity){
   $activity=new StudentActivity;
   $activity->course_id=$request['course_id'];

   $activity->student_id=auth::user()->id;
   $activity->activity_id=$request['activity'];
   }
   if ($request->hasFile('file')) {
    $image = $request->file('file');
    $image->extension();
    $imageName = time() . rand(10, 10000) . '.' . $image->extension();
    $image->move(public_path().'/storage/student_activity', $imageName);
    $activity->activity = 'storage/student_activity/'. $imageName;
    }
    $activity->notes=$request->notes;
    $activity->save();
    return redirect()->back()->with(['success' => 'تم الرفع بنجاح!']);

 }
 public function student_upload_app(Request $request){
        $app=StudentApp::where('student_id',auth::user()->id)->where('app_id',$request['app'])->first();
        if(!$app){
        $app=new StudentApp;
        
        $app->student_id=auth::user()->id;
        $app->app_id=$request['app'];
        $app->course_id=$request['course_id'];
        }
        if ($request->hasFile('file')) {
        $image = $request->file('file');
        $image->extension();
        $imageName = time() . rand(10, 10000) . '.' . $image->extension();
        $image->move(public_path().'/storage/student_app', $imageName);
        $app->app = 'storage/student_app/'. $imageName;
        }
        $app->notes=$request->notes;
        $app->save();
        return redirect()->back()->with(['success' => 'تم الرفع بنجاح!']);

      }

      
}
