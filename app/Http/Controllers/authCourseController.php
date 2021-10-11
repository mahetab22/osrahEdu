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
class authCourseController extends HomeController
{

    public function add_certificate_all(Request $request){

        $input=$request->all();
//dd($request);
        foreach($input['attendee_cer'] as $attendee) {
            $dataa = Certificate::where('course_id', $request['course_id'])->where('user_id', $attendee)->first();
            if (!empty($dataa)) {
                $dataa->view = 1;
                $dataa->save();
            } else {

                $data = new Certificate;
                $data->super_id = Auth::user()->id;
                $data->course_id = $request['course_id'];
                $data->user_id = $attendee;
                $data->save();
            }
                  }
        return redirect()->back()->with(['success' => 'تم أضافة شهادة اتمام الدورة للطلاب']);

    }

    public function geteditsuperprofile(user $user)
    {
      return view('profile.editsuperprofile',compact('user'));
    }

    public function geteditprofile(user $user)
    {
      return view('profile.editprofile',compact('user'));
    }

    public function addcomment(Request $request)
      {
          $rules =[
            'comment'     => ['required','string','max:255'],
            'course_id'     => ['required','exists:courses,id'],
            'title'     => ['required'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
    
              $data = new Comment;
              $data->comment = $request['comment'];
              $data->title = $request['title'];
              $data->course_id = $request['course_id'];
              if(!empty(Auth::user()->id)) {          
              $data->user_id = Auth::user()->id;
              $data->save();
              }else{
                return back()->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
              }
              $user = Auth::user();
              //echo dd($data->course->supervisorcourses->supervisor);
              $supervisor = $data->course->supervisorcourses->supervisor;

              //$user->notify(new commentNotify($data));

              Notification::send($supervisor, new commentNotify($data));

              return redirect()->back()->with(['success' => 'تم عمل التعليق!']);
        }
      }
    
    public function replaycomment(Request $request)
      {
          $rules =[
            'comment_id'     => ['required','exists:comments,id','max:255'],
            'course_id'     => ['required','exists:courses,id'],
            'replay'     => ['required'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
                $course = Course::find($request['course_id']);
                if($course->supervisorcourse->supervisor_id != Auth::user()->id){
                    return back()->with('toast_error', 'غير مسموح لك بهذا الأجراء')->withInput();
                }
              $data = Comment::where('id',$request->comment_id)->where('course_id',$request->course_id)->first();
              $data->replay = $request['replay'];
              if (!empty(Auth::user()->id)) {          
             // $data->user_id = Auth::user()->id;
              $data->save();

              $user = User::find($data['user_id']);
              Notification::send($user, new commentNotify($data));

              }else{
                return back()->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
              }
    
              return redirect()->back()->with(['success' => 'تم عمل التعليق!']);
        }
      }
    
    
    
    //  _____________    _________________
    
    public function certificate(Request $request)
      {
          $rules =[
            'course_id'     => ['required','exists:courses,id'],
            'certificate_id'     => ['required','exists:certificates,id'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
                $course = Course::find($request['course_id']);
                $certificate = Certificate::find($request['certificate_id']);
  //  echo dd();
              return view('certificate',compact('course','certificate'));
              // return redirect()->back()->with(['success' => 'تم عمل التعليق!']);
        }
      }
        
    public function addcertificate(Request $request)
      {
        $today = Carbon::today();
          $rules =[
            'file'     => ['file'],
            'course_id'     => ['required','exists:courses,id'],
            'user_id'     => ['required','exists:users,id'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
              $dataa = Certificate::where('course_id',$request['course_id'])->where('user_id',$request['user_id'])->first();
              if(!empty($dataa)){               
              $dataa->view = 1;
              $dataa->save();
              return redirect()->back()->with(['success' => 'تم إظهار النتيجة للطالب']);
              }else{

              $data = new Certificate;
              $data->super_id = Auth::user()->id;
              $data->course_id = $request['course_id'];
              $data->user_id = $request['user_id'];
                    if($request->hasFile('file')) 
                        {
                         $license_img=$request['file'];
                      if($license_img)
                      {
                        $img_name ='course_file'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->file = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
    
              $data->save();
    
              //  Mail::to($data['email'])->send(new WelcomeMail($data));
    
                return redirect()->back()->with(['success' => 'تم أضافة شهادة اتمام الدورة للطالب']);
                }
           // return redirect()->back()->with(['success' => 'تم اضافة الحساب بنجاح  !']);
        }
      } 
  
    public function hiddencertificate(Request $request)
      {
        $today = Carbon::today();
          $rules =[
            'course_id'     => ['required','exists:courses,id'],
            'user_id'     => ['required','exists:users,id'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
              $data = Certificate::where('course_id',$request['course_id'])->where('user_id',$request['user_id'])->first();
              $data->view = 0;
              $data->save();
    
              //  Mail::to($data['email'])->send(new WelcomeMail($data));
    
                return redirect()->back()->with(['success' => 'تم إخفاء الشهادة']);
           // return redirect()->back()->with(['success' => 'تم اضافة الحساب بنجاح  !']);
        }
      } 

    public function addcourse(Request $request)
      {
        $today = Carbon::today();
          $rules =[
            'logo'     => ['required','file'],
            'file'     => ['file'],
            'title_ar'     => ['required','string','max:255'],
            'title_en'     => ['required','string','max:255'],
            'description_ar'     => ['required','string'],
            'description_en'     => ['required','string'],
            'duration'     => ['required','string','max:255'],
            'from_date'     => ['required','date'],
            'to_date'     => ['required','date'],
            'service_id'     => ['required','exists:services,id'],
            'feature1_en'     => ['required','string','max:255'],
            'feature2_en'     => ['required','string','max:255'],
            'feature3_en'     => ['required','string','max:255'],
            'feature1'     => ['required','string','max:255'],
            'feature2'     => ['required','string','max:255'],
            'feature3'     => ['required','string','max:255'],
            'link'     => ['required','string'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
    
              $supervisorcourses = new Supervisor_Course;
              if (!empty(Auth::user()->id)) {          
              $supervisorcourses->supervisor_id = Auth::user()->id;
              }else{
                return back()->with('toast_error', 'يجب ان تسجيل الدخول وان تكون مدرب أولا')->withInput();
              }
              $data = new Course;
              $data->title_ar = $request['title_ar'];
              $data->title_en = $request['title_en'];
              $data->description_ar = $request['description_ar'];
              $data->description_en = $request['description_en'];
              $data->duration = $request['duration'];
              $data->from_date = $request['from_date'];
              $data->to_date = $request['to_date'];
              $data->service_id = $request['service_id'];
              $data->feature1_en = $request['feature1_en'];
              $data->feature2_en = $request['feature2_en'];
              $data->feature3_en = $request['feature3_en'];
              $data->feature1 = $request['feature1'];
              $data->feature2 = $request['feature2'];
              $data->feature3 = $request['feature3'];
              $data->link = $request['link'];
              $data->online = $request['online'];
              if($request['price']){
                $data->price = $request['price'];
              }

              
                    if($request->hasFile('logo')) 
                        {
                      $license_img=$request['logo'];
                      if($license_img)
                      {
    
                        $img_name ='course_img'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->logo = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
                    if($request->hasFile('file')) 
                        {
                         $license_img=$request['file'];
                      if($license_img)
                      {
    
                        $img_name ='course_file'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->file = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
    
              $data->save();
              $supervisorcourses->course_id = $data->id;
              $supervisorcourses->save();
    
              
    
              //  Mail::to($data['email'])->send(new WelcomeMail($data));
    
                return redirect()->route('/')->with(['success' => 'تم أضافة الكورس !']);
           // return redirect()->back()->with(['success' => 'تم اضافة الحساب بنجاح  !']);
        }
      } 
   //  _____________  start edit  _________________
    
    public function updatecourse(Request $request)
      {
        $today = Carbon::today();
          $rules =[
            'logo'     => ['file'],
            'file'     => ['file'],
            'title_ar'     => ['string'],
            'title_en'     => ['string'],
            'description_ar'     => ['string'],
            'description_en'     => ['string'],
            'duration'     => ['string','max:255'],
            'from_date'     => ['date'],
            'to_date'     => ['date'],
            'service_id'     => ['exists:services,id'],
            'course_id'     => ['exists:courses,id'],
            'feature1_en'     => ['string','max:255'],
            'feature2_en'     => ['string','max:255'],
            'feature3_en'     => ['string','max:255'],
            'feature1'     => ['string','max:255'],
            'feature2'     => ['string','max:255'],
            'feature3'     => ['string','max:255'],
            'link'     => ['string'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
    
              $supervisorcourses = new Supervisor_Course;
              if (!empty(Auth::user()->id)) {          
              $supervisorcourses->supervisor_id = Auth::user()->id;
              }else{
                return back()->with('toast_error', 'يجب ان تسجيل الدخول وان تكون مدرب أولا')->withInput();
              }
              $data = Course::find($request['course_id']);
              $data->title_ar = $request['title_ar'];
              $data->title_en = $request['title_en'];
              $data->description_ar = $request['description_ar'];
              $data->description_en = $request['description_en'];
              $data->duration = $request['duration'];
              $data->from_date = $request['from_date'];
              $data->to_date = $request['to_date'];
              $data->service_id = $request['service_id'];
              $data->feature1_en = $request['feature1_en'];
              $data->feature2_en = $request['feature2_en'];
              $data->feature3_en = $request['feature3_en'];
              $data->feature1 = $request['feature1'];
              $data->feature2 = $request['feature2'];
              $data->feature3 = $request['feature3'];
              $data->price = $request['price'];
              $data->link = $request['link'];
              $data->online = $request['online'];
                    if($request->hasFile('logo')) 
                        {
                      $license_img=$request['logo'];
                      if($license_img)
                      {
    
                        $img_name ='course_img'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->logo = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
                    if($request->hasFile('file')) 
                        {
                         $license_img=$request['file'];
                      if($license_img)
                      {
    
                        $img_name ='course_file'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->file = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
    
              $data->save();
    
              
    
              //  Mail::to($data['email'])->send(new WelcomeMail($data));
    
                return back()->with(['success' => 'تم تعديل الكورس بنجاح !']);
           // return redirect()->back()->with(['success' => 'تم اضافة الحساب بنجاح  !']);
        }
      }  
    //  _____________  end edit  _________________

public function uploadimg(Request $request)
  {
    $today = Carbon::today();
      $rules =[
        'img' => ['required','file'],
        'course_id' => ['required','exists:courses,id'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{

          $data = new Bankfile;
          $data->user_id = Auth::user()->id;
          $data->course_id = $request['course_id'];
                if($request->hasFile('img')) 
                    {
                     $license_img=$request['img'];
                      if($license_img)
                      {

                        $img_name ='user_img'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/subusers/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->img = 'subusers/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                    }
           $data->save();
            return redirect()->back()->with(['success' => 'تم ارسال الايصال وفي انتظار التأكيد من المشرف']);
       // return redirect()->back()->with(['success' => 'تم اضافة الحساب بنجاح  !']);
    }
  } 
  
    public function adddiscount(Request $request)
      {
        $today = Carbon::today();
          $rules =[
            'course_id'     => ['required','exists:courses,id'],
            'code'     => ['required','string','max:255'],
            'amount'     => ['required','numeric'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
    
              $data = new Discount;
              $data->course_id = $request['course_id'];
              $data->code = $request['code'];
              $data->amount = $request['amount'];
              $data->save();
    
              return redirect()->back()->with(['success' => 'تم أضافة الكود بنجاح']);
        }
      }
         
    public function addcode(Request $request)
      {
        $today = Carbon::today();
          $rules =[
            'course_id'     => ['required','exists:courses,id'],
            'code'     => ['required','string','max:255'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
    
              $data = new ExamCode;
              $data->course_id = $request['course_id'];
              $data->code = $request['code'];
              $data->save();
    
              return redirect()->back()->with(['success' => 'تم أضافة الكود بنجاح']);
        }
      }

    public function addpubliccode(Request $request)
      {
        $today = Carbon::today();
          $rules =[
          'exam_id'     => ['required','exists:exams,id'],
            'code'     => ['required','string','max:255'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
    
              $data = Exam::find( $request['exam_id']);
              $data->code = $request['code'];
              $data->save();
    
              return redirect()->back()->with(['success' => 'تم أضافة الكود بنجاح']);
        }
      }
      
        public function update_examcode(examcode $examcode)
        {
           $data = ExamCode::find($examcode->id);
           $data->used = 1;
           $data->save();
          //\DB::table('exam_codes')->where('id', $examcode->id)->delete();
          return redirect()->back()->with(['success' =>'تم أستخدام الكود ! ']);
        }
   
        public function delete_examcode(examcode $examcode)
        {
          \DB::table('exam_codes')->where('id', $examcode->id)->delete();
          return redirect()->back()->with(['success' =>' تم حذف الكود ! ']);
        }
         
        public function discountcode(discount $discount)
        {
          \DB::table('discounts')->where('id', $discount->id)->delete();
          return redirect()->back()->with(['success' =>' تم حذف الكود ! ']);
        }

    public function checkcodediscount(Request $request)
      {
          $rules =[
            'code'     => ['required','max:255'],
            'course_id'     => ['required','exists:courses,id'],
          ];
        
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
             return Response()->json($validate->messages());
          }else{
                $course = Course::find($request['course_id']);
                // $discount = Discount::where('course_id',$request['course_id'])->where('code',$request['code'])->first();
                
                // if (empty($discount)){
                //     $price = $course->price ;
                //     return Response()->json($price);
                // }
                // if (!empty(Auth::user()->id)) { 
                //   $discount->num_of_used =  $discount->num_of_used +1;
                //   $discount->save();
                //     $price = $course->price - $discount->amount ;
                //     return Response()->json($price);
                //   }
                
                $marketer=MarketeInfo::where('code',$request['code'])->first();
                $setting=Info::first();
                $com=$setting->marketerComission;
                if($marketer){
                   
                   $price = $course->price - (($course->price*$course->studentDiscount)/100) ;
                    return Response()->json($price);
                }else{
                            $price = $course->price ;
                    return Response()->json($price);
                }
                    $price = $course->price ;
                    return Response()->json($price);
       // return redirect('/examcourse/'.$request['course_id'])->with(['success' => 'تم التأكد من الكود !']);
      }
    }

        public function remove(Request $request)
        {
          $rules =[
           'type'     => ['required'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            // echo dd($request['level']);
            if($request['type']=="level"){
                 \DB::table('levels')->where('id', $request['level_id'])->delete();
            }elseif($request['type']=="lesson"){
                 \DB::table('lessons')->where('id', $request['lesson_id'])->delete();
            }elseif($request['type']=="exam"){
                 \DB::table('exams')->where('id', $request['exam_id'])->delete();
            }
            
          return redirect()->back()->with(['success' =>'تم الحذف بنجاح ! ']);
        }
          
        }
        
        public function deletequestion(question $question)
        {
          \DB::table('questions')->where('id', $question->id)->delete();
          return redirect()->back()->with(['success' =>' تم حذف السؤال! ']);
        }
        
         public function deleteexam(exam $exam)
        {
          \DB::table('exams')->where('id', $exam->id)->delete();
          return redirect()->back()->with(['success' =>'تم حذف الإختبار بنجاح']);
        }
               
        public function heddinexam(exam $exam)
        {
           $data = Exam::find($exam->id);
           $data->view = 0;
           $data->save();
          //\DB::table('exam_codes')->where('id', $examcode->id)->delete();
          return redirect()->back()->with(['success' =>'تم إخفاء الاختبار ']);
        }
        
        public function viewexam(exam $exam)
        {
           $data = Exam::find($exam->id);
           $data->view = 1;
           $data->save();
          //\DB::table('exam_codes')->where('id', $examcode->id)->delete();
          return redirect()->back()->with(['success' =>'تم إظهار الإختبار ']);
        }
    //  _____________    _________________
    
    
    public function addlevel(Request $request)
      {
        $today = Carbon::today();
          $rules =[
          //  'logo'     => ['required','file'],
            'course_id'     => ['required','exists:courses,id'],
            'file'     => ['file'],
            'title_ar'     => ['required','string','max:255'],
            'title_en'     => ['required','string','max:255'],
            'description_ar'     => ['string','max:255'],
            'description_en'     => ['string','max:255'],
            'link'     => ['string'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            $course = Course::find($request['course_id']);
            if($course->supervisorcourse->supervisor_id != Auth::user()->id){
                return back()->with('toast_error', 'غير مسموح لك بهذا الأجراء')->withInput();
            }
              $data = new Level;
              $data->course_id = $request['course_id'];
              $data->title_ar = $request['title_ar'];
              $data->title_en = $request['title_en'];
              $data->description_ar = $request['description_ar'];
              $data->description_en = $request['description_en'];
              $data->link = $request['link'];
                    if($request->hasFile('file')) 
                        {
                         $license_img=$request['file'];
                      if($license_img)
                      {
    
                        $img_name ='course_file'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->file = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
    
              $data->save();
    
              return redirect()->back()->with(['success' => 'تم اضافة المستوي بنجاح']);
        }
      }
    
      //  _____________    _________________
    
    
    public function addlesson(Request $request)
      {
        $today = Carbon::today();
          $rules =[
            //'logo'     => ['required','file'],
            //'course_id'     => ['required','exists:courses,id'],
            'level_id'     => ['required','exists:levels,id'],
            'file'     => ['file'],
            'title_ar'     => ['required','string','max:255'],
            'title_en'     => ['required','string','max:255'],
            'description_ar'     => ['string','max:255'],
            'description_en'     => ['string','max:255'],
            //'link'     => ['string'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            $level = Level::find($request['level_id']);
            if($level->course->supervisorcourse->supervisor_id != Auth::user()->id){
                return back()->with('toast_error', 'غير مسموح لك بهذا الأجراء')->withInput();
            }
              $data = new Lesson;
              $data->level_id = $request['level_id'];
              $data->title_ar = $request['title_ar'];
              $data->title_en = $request['title_en'];
              $data->duration = $request['time'];
              $data->description_en = $request['description_en'];
              $data->link = $request['link'];
                    if($request->hasFile('file')) 
                        {
                         $license_img=$request['file'];
                      if($license_img)
                      {
    
                        $img_name ='course_file'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->file = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
    
              $data->save();
    
              return redirect()->back()->with(['success' => 'تم أضافة الدرس بنجاح']);
        }
      }
    
      public function addexamcc(Request $request)
      {
      //  echo dd($request);
        $today = Carbon::today();
          $rules =[
            'course_id'     => ['exists:courses,id'],
            'lesson_id'     => ['exists:lessons,id'],
            'level_id'     => ['exists:levels,id'],
            'publicexam'     => ['required'],
            'questions'     => ['required','array'],
            'answers'     => ['required','array'],
            'checkboxs'     => ['required','array'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
                $questions=$request->questions;
                $answers=$request->answers;
                $checkboxs=$request->checkboxs;
                if(count($checkboxs) != count($questions)){
                    echo dd('غير متساويين');
                }
                $exam = new Exam;
                if(!empty($request->course_id)){
                    $exam->course_id = $request['course_id'];
                    $exam->publicexam = $request['publicexam'];
                }elseif(!empty($request->level_id)){
                    $exam->level_id = $request['level_id'];
                    $exam->publicexam = $request['publicexam'];
                }elseif(!empty($request->lesson_id)){
                    $exam->lesson_id = $request['lesson_id'];
                    $exam->publicexam = $request['publicexam'];
                }
                $exam->save();
                
                $x=0;
               for ($i = 0; $i < count($questions) ; $i++) {
                   $question = new Question;
                   $question->question = $questions[$i];
                   $question->exam_id = $exam->id;
                   $question->save();
                   $y=0;
                   for ($j = 0; $j < count($answers)/count($questions) ; $j++) {
                       $answer = new Answer;
                       $answer->answer = $answers[$j+$x];
                       $answer->question_id = $question->id;
                       /* if($checkboxs[$j]==$j and $y==0){
                        $y=1;
                         $answer->true = 1;
                       }else{
                         $answer->true = 0;
                       }*/
                       $answer->true = 0;
                       $answer->save();
                   } 
                   $y=0;
                   $x=$x+3;
               } 
            //   echo dd(count($exam->questions));
               foreach ($exam->questions as $key => $qu){
                for ($r = 0; $r < count($exam->questions) ; $r++) {
                    if($checkboxs[$r]==$key ){
                            if(!empty($qu->answers[$r])){
                                $qu->answers[$r]->true = 1;
                                $qu->answers[$r]->save();   
                            }
                        }
                    }
                
               }

                   
              return redirect()->back()->with(['success' => 'تم أضافة الأختبار بنجاح']);
        }
      }

    public function addtoexam(Request $request)
      {
      // echo dd($request);
        $today = Carbon::today();
          $rules =[
            'exam_id'     => ['required','exists:exams,id'],
            'publicexam'     => ['required'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            if($request->Qtype == 'first'){
                                             $rules =[
                                                'question'     => ['required'],
                                                'answers'     => ['required','array'],
                                                'checkboxs'     => ['required','array'],
                                              ];
                                        
                                              $validate = Validator::make($request->all(), $rules);
                                              if ($validate->fails()) {
                                                return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
                                              }
                $answers=$request->answers;
                $checkboxs=$request->checkboxs;
                   $question = new Question;
                   $question->question = $request->question;
                   $question->exam_id = $request->exam_id;
                   $question->save();

                   for ($j = 0; $j <= 3 ; $j++) {
                       $answer = new Answer;
                       if($checkboxs[0] == $j){
                       $answer->true = 1;
                       }else{
                        $answer->true = 0;
                       }
                       $answer->question_id = $question->id;
                       $answer->answer = $answers[$j];
                       $answer->save();
                   } 
                    }elseif($request->Qtype == 'secound'){
                                             $rules =[
                                                'questionn'     => ['required'],
                                              ];
                                        
                                              $validate = Validator::make($request->all(), $rules);
                                              if ($validate->fails()) {
                                                return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
                                              }
                                           $question = new Question;
                                           $question->question = $request->questionn;
                                           $question->exam_id = $request->exam_id;
                                           $question->type = 1;
                                           $question->sol = $request->checck;
                                           $question->save();
                }
              return redirect()->back()->with(['success' => 'تم أضافة سؤال']);
        }
      }

    public function addtonewpublicexam(Request $request)
      {
      // echo dd($request);
        $today = Carbon::today();
          $rules =[
            'publicexam'     => ['required'],
            'title'     => ['required'],
            'logo'     => ['required','file'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            if($request->Qtype == 'first'){
            $rules =[
            'question'     => ['required'],
            'answers'     => ['required','array'],
            'checkboxs'     => ['required','array'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }
          
                $answers=$request->answers;
                $checkboxs=$request->checkboxs;
                       $exam = new Exam;
                       if($request->hasFile('logo')) 
                        {
                      $license_img=$request['logo'];
                      if($license_img)
                      {
    
                        $img_name ='course_img'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $exam->logo = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
                       $exam->title = $request['title'];
                       $exam->user_id = Auth::user()->id;
                       $exam->publicexam = $request['publicexam'];
                       $exam->save();
                   $question = new Question;
                   $question->question = $request->question;
                   $question->exam_id = $exam->id;
                   $question->type = 0;
                   $question->save();

                   for ($j = 0; $j <= 3 ; $j++) {
                       $answer = new Answer;
                       if($checkboxs[0] == $j){
                       $answer->true = 1;
                       }else{
                        $answer->true = 0;
                       }
                       $answer->question_id = $question->id;
                       $answer->answer = $answers[$j];
                       $answer->save();
                   } 
                    }elseif($request->Qtype == 'secound'){
                         $rules =[
                            'questionn'     => ['required'],
                          ];
                    
                          $validate = Validator::make($request->all(), $rules);
                          if ($validate->fails()) {
                            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
                          }
                       $exam = new Exam;
                       if($request->hasFile('logo')) 
                        {
                      $license_img=$request['logo'];
                      if($license_img)
                      {
    
                        $img_name ='course_img'.time(). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/courses/'.$today->isoFormat('Y').'/'), $img_name);
                        $exam->logo = 'courses/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                        }
                       $exam->title = $request['title'];
                       $exam->user_id = Auth::user()->id;
                       $exam->publicexam = $request['publicexam'];
                       $exam->save();
                       $question = new Question;
                       $question->question = $request->questionn;
                       $question->exam_id = $exam->id;
                       $question->type = 1;
                       $question->sol = $request->checck;
                       $question->save();
                    }
              return redirect('editexamcourseby/'.$exam->id)->with(['success' => 'تم أضافة سؤال']);
        }
      }
      
    public function addtonewexam(Request $request)
      {
      // echo dd($request);
        $today = Carbon::today();
          $rules =[
            'course_id'     => ['exists:courses,id'],
            'lesson_id'     => ['exists:lessons,id'],
            'level_id'     => ['exists:levels,id'],
            'publicexam'     => ['required'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            if($request->Qtype == 'first'){
            $rules =[
            'question'     => ['required'],
            'answers'     => ['required','array'],
            'checkboxs'     => ['required','array'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }
          
                $answers=$request->answers;
                $checkboxs=$request->checkboxs;
                $exam = new Exam;
                if($request->radio1 == "lesson" ){
                    $exam->lesson_id = $request['lesson_id'];
                    $exam->content=2;
                }elseif($request->radio1 == "level" ){
                    $exam->level_id = $request['level_id'];
                    $exam->content=1;

                }elseif($request->radio1 == "course" ){
                    $exam->course_id = $request['course_id'];
                    $exam->content=0;
                }
                $exam->publicexam = $request['publicexam'];
                $exam->save();
                   $question = new Question;
                   $question->question = $request->question;
                   $question->exam_id = $exam->id;
                   $question->type = 0;
                   $question->save();

                   for ($j = 0; $j <= 3 ; $j++) {
                       $answer = new Answer;
                       if($checkboxs[0] == $j){
                       $answer->true = 1;
                       }else{
                        $answer->true = 0;
                       }
                       $answer->question_id = $question->id;
                       $answer->answer = $answers[$j];
                       $answer->save();
                   } 
                    }elseif($request->Qtype == 'secound'){
                         $rules =[
                            'questionn'     => ['required'],
                          ];
                    
                          $validate = Validator::make($request->all(), $rules);
                          if ($validate->fails()) {
                            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
                          }
                       $exam = new Exam;
                        if($request->radio1 == "lesson" ){
                            $exam->lesson_id = $request['lesson_id'];
                            $exam->content=2;
                        }elseif($request->radio1 == "level" ){
                            $exam->level_id = $request['level_id'];
                            $exam->content=1;
                        }elseif($request->radio1 == "course" ){
                            $exam->course_id = $request['course_id'];
                            $exam->content=2;
                        }
                       $exam->publicexam = $request['publicexam'];
                       $exam->save();
                       $question = new Question;
                       $question->question = $request->questionn;
                       $question->exam_id = $exam->id;
                       $question->type = 1;
                       $question->sol = $request->checck;
                       $question->save();
                    }
              return redirect('editexamcourseby/'.$exam->id)->with(['success' => 'تم أضافة سؤال']);
        }
      }
      

    public function addexam(Request $request)
      {
      // echo dd($request);
        $today = Carbon::today();
          $rules =[
            'course_id'     => ['exists:courses,id'],
            'lesson_id'     => ['exists:lessons,id'],
            'level_id'     => ['exists:levels,id'],
            'publicexam'     => ['required'],
            'questions'     => ['required','array'],
            'answers'     => ['required','array'],
            'checkboxs'     => ['required','array'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
                $questions=$request->questions;
                $answers=$request->answers;
                $checkboxs=$request->checkboxs;
                if(count($checkboxs) != count($questions)){
                    echo dd('غير متساويين');
                }
                $exam = new Exam;
                if(!empty($request->level_id)){
                    $exam->level_id = $request['level_id'];
                }elseif(!empty($request->lesson_id)){
                    $exam->lesson_id = $request['lesson_id'];
                }elseif(!empty($request->course_id)){
                    $exam->course_id = $request['course_id'];
                }
                $exam->publicexam = $request['publicexam'];
                $exam->save();
                
                $x=0;
               for ($i = 0; $i < count($questions) ; $i++) {
                   $question = new Question;
                   $question->question = $questions[$i];
                   $question->exam_id = $exam->id;
                   $question->save();
                   $y=0;
                   for ($j = 0; $j < count($answers)/count($questions) ; $j++) {
                       $answer = new Answer;
                       $answer->answer = $answers[$j+$x];
                       $answer->question_id = $question->id;
                       /* if($checkboxs[$j]==$j and $y==0){
                        $y=1;
                         $answer->true = 1;
                       }else{
                         $answer->true = 0;
                       }*/
                       $answer->true = 0;
                       $answer->save();
                   } 
                   $y=0;
                   $x=$x+3;
               } 
            //   echo dd(count($exam->questions));
               foreach ($exam->questions as $key => $qu){
                //echo dd(count($qu->answers));
                for ($r = 0; $r < count($exam->questions) ; $r++) {
                    if($checkboxs[$r]==$key){
                            if(!empty($qu->answers[$r])){
                                $qu->answers[$r]->true = 1;
                                $qu->answers[$r]->save();   
                            }
                        }
                    }
                
               }

                   
              return redirect()->back()->with(['success' => 'تم أضافة الأختبار بنجاح']);
        }
      }
   
     public function getexambyid(exam $exam) 
      {
            $StuExam =[];
            $ExamStuAch =[];
        if(!empty($exam)){
                  $question=Question::where('exam_id',$exam->id)->first();
                   if (empty($question)){
                  return back()->with('toast_error', 'الإختبار في مرحلة الإعداد')->withInput();
                  }

          $StuExam=StuExam::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->first();
        }else{
            $StuExam =[];
            $ExamStuAch =[];
        }
        
		if(!empty($StuExam) ){
		$ExamStuAch=ExamStuAch::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->get();
        return view('examcourse',compact('ExamStuAch','StuExam','exam'));	
		}
        
        if(empty($exam)){
            return back()->with('toast_error', 'الأختبار لم يكتمل بعد من فضلك تواصل مع المدرب')->withInput();
        }
        if(empty($StuExam)){
          $dataa = new StuExam;
          $dataa->exam_id = $exam->id;
		  $dataa->user_id = Auth::user()->id;          
          //$dataa->total = $total;
          $dataa->save();
          }
        //  echo dd($StuExam->total >= 0);
        //echo dd($exam->questions);
        return view('examcourse',compact('exam','StuExam','ExamStuAch'));
      }    
         
      public function getexamcourse(course $course) 
      {
        $exam=Exam::where('course_id',$course->id)->where('publicexam',1)->first();
        if(!empty($exam)){
          $StuExam=StuExam::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->first();
        }else{
            $StuExam =[];
        }
        
		if(!empty($StuExam) ){
		$ExamStuAch=ExamStuAch::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->get();
        return view('examcourse',compact('ExamStuAch','StuExam','exam'));	
		}
        
        if(empty($exam)){
            return back()->with('toast_error', 'الأختبار لم يكتمل بعد من فضلك تواصل مع المدرب')->withInput();
        }
        if(empty($StuExam)){
          $dataa = new StuExam;
          $dataa->exam_id = $exam->id;
		  $dataa->user_id = Auth::user()->id;          
          //$dataa->total = $total;
          $dataa->save();
          }
        //  echo dd($StuExam->total >= 0);
        //echo dd($exam->questions);
        return view('examcourse',compact('exam','StuExam','ExamStuAch'));
      }    

      public function geteditexamcourseexam($exam) 
      {
        $exam = Exam::find($exam);
        $course = $exam->course;
        if(empty($exam)){
            return back()->with('toast_error', 'لم يتم أنشاء الاختبار بعد')->withInput();
        }
        return view('provexamcourse',compact('exam','course'));
      } 

      public function geteditexamcourse(course $course) 
      {
        $exam=Exam::where('course_id',$course->id)->where('publicexam',1)->first();
      //  echo dd($exam->id);
        if(empty($exam)){
            return back()->with('toast_error', 'لم يتم أنشاء الاختبار بعد')->withInput();
        }
        return view('provexamcourse',compact('exam','course'));
      }    

      public function getaddexamcourse(course $course) 
      {
        $exam=Exam::where('course_id',$course->id)->where('publicexam',1)->first();
        $StuExam=StuExam::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->first();
    if(!empty($StuExam) and !empty($StuExam->total)){
    $ExamStuAch=ExamStuAch::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->get();
        return view('provexamcourse',compact('ExamStuAch','StuExam','exam')); 
    }
        
        if(empty($exam)){
            return back()->with('toast_error', 'الأختبار لم يكتمل بعد من فضلك تواصل مع المدرب')->withInput();
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

      public function examResults($exam) 
      {
        $exam=Exam::where('id',$exam)->first();
        $StuExam=StuExam::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->first();
		if(!empty($StuExam) and !empty($StuExam->total)){
		$ExamStuAch=ExamStuAch::where('exam_id',$exam->id)->where('user_id',Auth::user()->id)->get();
        return view('examcourse',compact('ExamStuAch','StuExam','exam'));	
		}
        
        if(empty($exam)){
            return back()->with('toast_error', 'الاختبار لم يكتمل بعد من فضلك تواصل مع المدرب')->withInput();
        }
        if(empty($StuExam)){
            return back()->with('toast_error', 'لم يتم تجاوز الاختبار بعد')->withInput();
          $dataa = new StuExam;
          $dataa->exam_id = $exam->id;
		  $dataa->user_id = Auth::user()->id;          
          //$dataa->total = $total;
          $dataa->save();
          }
        //echo dd($exam->questions);examResults
        return view('examcourse',compact('exam'));
      }     
           

    public function getcommentnotification($notification)
    {
      foreach (Auth::user()->notifications as $noti) {
        if($noti->id == $notification){
          $noti->markAsRead();
           $notification = $noti;
        }
      }
      $course = Course::find($notification->data['course_id']);
      if(Auth::user()->role_id == 3){
        $user=Auth::user();
        $controller = New Controller();
        $slide_img = $controller->slide_img;
      // echo dd($user);
        return view('profile.superprofilereview',compact('user'));
      }
    }


    public function getnotification($notification)
    {
      // $notification = Notification::find($notification);
      // echo dd($notification);
     // $notification->markAsRead();
      foreach (Auth::user()->notifications as $noti) {
        if($noti->id == $notification){
          $noti->markAsRead();
           $notification = $noti;
        }
      }
     // echo dd($notification);
      if(empty(Auth::user()->notifications[0]) or empty($notification)){
           return redirect('/')->with('toast_error', 'تم فقد صفحة  الشات')->withInput();
      }

      $notifications=Auth::user()->notifications;
     // echo dd($notification->data['conversation_id']);
      $comments=Comment::where('conversation_id',$notification->data['conversation_id'])->where('commentORmassage',1)->orderBy('created_at','asc')->get();
      return view('profile.chatClient',compact('notifications','comments'));
    }


    public function getstudconversation(user $user,course $course)
    {
     // echo dd($conversation_id);
      $hascomment = Comment::where('received_id',$user['id'])->where('user_id',Auth::user()->id)->where('commentORmassage',1)->first();
      $hascommentt = Comment::where('user_id',$user['id'])->where('received_id',Auth::user()->id)->where('commentORmassage',1)->first();

      if(empty($hascomment) and empty($hascommentt)){
                $rand = rand(0,99999);
        }
      if(empty($rand)){
                if(!empty($hascomment) and !empty($hascomment->conversation_id)){
                  $rand = $hascomment->conversation_id; 
                 }elseif(!empty($hascommentt) and !empty($hascommentt->conversation_id)){
                  $rand = $hascommentt->conversation_id;
                 }
      }

      $notifications=Auth::user()->notifications;
      $comments=Comment::where('conversation_id',$rand)->where('conversation_id','!=',Null)->where('commentORmassage',1)->orderBy('created_at','asc')->get();
      return view('profile.chatClient',compact('notifications','comments','user','course'));
    }

    public function getconversation($conversation_id)
    {
     // echo dd($conversation_id);
      Auth::user()->notifications->markAsRead();
      $notifications=Auth::user()->notifications;
      $comments=Comment::where('conversation_id',$conversation_id)->where('commentORmassage',1)->orderBy('created_at','asc')->get();
      return view('profile.chatClient',compact('notifications','comments'));
    }

    public function addmassage(Request $request)
      {
          $rules =[
            'comment'     => ['required','string','max:255'],
            'course_id'     => ['required','exists:courses,id'],
            'received_id'     => ['required','exists:users,id'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
            $hascomment = Comment::where('received_id',$request['received_id'])->where('user_id',Auth::user()->id)->where('commentORmassage',1)->first();
            $hascommentt = Comment::where('user_id',$request['received_id'])->where('received_id',Auth::user()->id)->where('commentORmassage',1)->first();
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
              $data = new Comment;
              $data->comment = $request['comment'];
              $data->title = $request['comment'];
              $data->course_id = $request['course_id'];
              $data->received_id = $request['received_id'];
              $data->conversation_id = $rand;
              $data->commentORmassage = 1;
              if(!empty(Auth::user()->id)) {          
              $data->user_id = Auth::user()->id;
              $data->save();
              }else{
                return back()->with('toast_error', 'يجب تسجيل الدخول أولا')->withInput();
              }
              $user = Auth::user();
              $supervisor = User::find($request['received_id']);
              Notification::send($supervisor, new commentNotify($data));

             // if(empty($hascomment) and empty($hascomment)){
               $comments=Comment::where('conversation_id',$rand)->where('commentORmassage',1)->orderBy('created_at','asc')->get();
               //return view('profile.chatClient',compact('comments'));
          //    }
              // $this->getconversation($rand);
               if($request['super']==1){
                 $request['super']=0;
                  return redirect('/conversation/'.$rand.'/show');
               }
              return redirect()->back();
        }
      }

}
