<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use DB;
use DateTime;
use Carbon\Carbon;
use App\CommonQuestion;
use App\Contact;
use App\New_email;
use App\Notifications\InvoicePaid;
use App\Notifications\commentNotify;
use Notification;
use App\User;
use App\Info;
use App\ContactType;
class contactController extends Controller
{

    public function contact()
    {
      $controller = New Controller();
      $slide_img = $controller->slide_img;
    	$questions  = CommonQuestion::orderBy('num_of_view','DESC')->paginate(15);
      $info=Info::first();
      $types=ContactType::get();
        return view('contact',compact('questions','slide_img','info','types'));
    }

    public function getcontactsnotification($notification)
    {
        if(Auth::check() and Auth::user()->role_id == 1){
      foreach (Auth::user()->notifications as $noti) {
        if($noti->id == $notification){
          $noti->markAsRead();
           $notification = $noti;
        }
      }
      return redirect('admin/contacts');
      }else{
        return back();
      }
    }
    
public function Registercontacts(Request $request)
  {
      $rules =[
        'name'     => ['required','string','max:255'],
        'phone'     => ['required'],
        'email'     => ['required','email','unique:users'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{

              $info = new Contact;
              $info->name = $request['name'];
              $info->phone = $request['phone'];
              $info->email = $request['email'];
              $info->title = 'أشتراك في خدمة';
              $info->Suggestions_and_Complaints = 'أود الاشتراك في الخدمة التخصصية' . $request['department'];
              $info->course_link = $request['department'];
              $info->details = 'أود الاشتراك في الخدمة التخصصية' . $request['department'] ;
              $supervisor = User::find(1);
              Notification::send($supervisor, new InvoicePaid($info));
              $info->save();

       return redirect()->back()->with(['success' => 'تم تسجيل طلبك وسيتم التواصل معك قريبا']);
      }

  }
  
public function addcontacts(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'name'     => ['required','string','max:255'],
        'email'     => ['required','email','unique:users'],
        'topic'     => ['required','string','max:255'],
        'message'=>['required'],
      ]);

      
      if ($validator->fails()) {
        return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
      }else{

              $info = new Contact;
              $info->name = $request['name'];
              $info->email = $request['email'];
              $info->title = $request['topic'];
              $info->details	 = $request['message'];
              $info->type_id  = $request['type'];
             
              $info->save();

       return redirect()->back()->with(['success' => 'تم  تسجيل شكوتك   وسيتم التواصل معك شكرا !! !']);
      }

  }

    public function addnewemail(Request $request)
    {
      $rules =[
        'email'     => ['required','email'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
       //return redirect()->back()->with(['fail' => $validate->messages()]);
      }else{
      	$info = new New_email;
        $info->email = $request['email'];
        $info->save();
        return redirect()->back()->with(['success' => 'سيتم التواصل معك  قريبا !']);
      }
    }

}
