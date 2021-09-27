<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
class contactController extends Controller
{

    public function contact()
    {
      $controller = New Controller();
      $slide_img = $controller->slide_img;
    	$questions  = CommonQuestion::orderBy('num_of_view','DESC')->paginate(15);
        return view('contact',compact('questions','slide_img'));
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
      $rules =[
        'name'     => ['required','string','max:255'],
        'email'     => ['required','email','unique:users'],
        'title_problem'     => ['required','string','max:255'],
        'Suggestions_and_Complaints'     => ['required'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{

              $info = new Contact;
              $info->name = $request['name'];
              $info->phone = $request['phone'];
              $info->email = $request['email'];
              $info->title = $request['title_problem'];
              $info->Suggestions_and_Complaints = $request['Suggestions_and_Complaints'];
              $info->course_link = $request['course_link'];
              $info->details = $request['details'];
               if($request->hasFile('file')){
    				$today = Carbon::today();
                     $license_img=$request['file'];
                  if($license_img)
                  {

                    $img_name ='user_img'.rand(0,999). '.' . $license_img->getClientOriginalExtension();
                    $license_img->move(base_path('/public/storage/contacts/'.$today->isoFormat('MMMMY').'/'), $img_name);
                    $info->file = 'contacts/'.$today->isoFormat('MMMMY').'/'.$img_name;
                  }
                    }
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
