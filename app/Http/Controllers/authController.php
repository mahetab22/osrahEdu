<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Service;
use App\Course;
use App\SupervisorInfo;
// use PDF;
use Validator;
use DB;
use DateTime;
use Carbon\Carbon;
use \Crypt;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use abdullahobaid\mobilywslaraval\Mobily;


class authController extends Controller
{

    public function registerStudent()
    {
        return view('register-student');
    }

    public function registerSupervisor()
    {
       $controller = New Controller();
        $slide_img = $controller->slide_img;
        $services  = Service::where('id','!=',1)->whereNull('parent_id')->orderBy('id','asc')->get();
        return view('register-supervisor',compact('services','slide_img'));
    }

    public function registerMarketer()
    {
        return view('register-marketer');
    }
    
    public function registerorlogin()
    {
        return view('register-login');
    }



//  _____________    _________________


public function Register(Request $request)
  {
    //echo dd($request);
    $today = Carbon::today();
    //echo dd(base_path('/users/').$today->isoFormat('MMMMD'));
    $validator = Validator::make($request->all(), [
        'name'     => ['required','string','max:255'],
        'role_id'     => ['required'],
        'email'     => ['required','email','unique:users'],
        'phone'     => ['required','min:10','numeric','unique:users'],
        'password' => ['required','string','min:6'],
        'password_confirmation' => ['required','same:password','string','min:4'],
      ]);

      
      if ($validator->fails()) {
        return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
      }
      else{

          $data = new User;
          $data->name = $request['name'];
          $data->phone = $request['phone'];
          $data->role_id = $request['role_id'];
          $data->supervisor = $request['role_id'];
          $data->email = $request['email'];
          $data->Age = $request['Age'];
          $data->gender = $request['gender'];
          //$data->password = Hash::make($data['password']);
          $data->password = bcrypt($request->password);
                if($request->hasFile('avatar')) 
                    {
                     $license_img=$request['avatar'];
                      if($license_img)
                      {

                        $img_name ='user_img'.rand(0,999). '.' . $license_img->getClientOriginalExtension();
                        $license_img->move(base_path('/public/storage/users/'.$today->isoFormat('Y').'/'), $img_name);
                        $data->avatar = 'users/'.$today->isoFormat('Y').'/'.$img_name;
                      }
                    }
           $token = Str::random(60);
           $data->remember_token = $token;
           $data->save();
           if($request['role_id'] == 3){
              $info = new SupervisorInfo;
              $info->name = $request['name'];
              $info->fb = $request['fb'];
              $info->tw = $request['tw'];
              $info->inst = $request['inst'];
              $info->google = $request['google'];
              $info->service_id = $request['service_id'];
              $info->user_id = $data->id;
              $info->Educational = $request['Educational'];
              $info->save();
           }         
           auth()->login($data);


/*$to_name = $request['name'];
$to_email = $request['email'];
$dataa = array('name'=>"nahl team", "body" => "A test mail");
Mail::send("welcome_mail", $dataa, function($message) use ($to_name, $to_email) {
$message->to($to_email, $to_name)
->subject("Laravel Test Mail");
$message->from("team@nhledu.com","Test Mail");
});*/

            // Mail::to($data['email'])->send(new WelcomeMail($data));

            return redirect()->route('/')->with(['success' => 'Sign Up successfully !']);
       // return redirect()->back()->with(['success' => 'تم اضافة الحساب بنجاح  !']);
    }
  } 



    public function changepassword(Request $request)
    {         
      $rules =[
        'oldpassword' => ['required','string','min:4'],
        'password' => ['required','string','min:4'],
        'password_confirmation' => ['required','same:password','string','min:4'],
      ];
      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{
            if (Hash::check($request['oldpassword'], Auth::user()->password, []))
            {
               DB::table('users')->where('id', Auth::user()->id)
                  ->update([
                      'password' => bcrypt($request->password)
               ]);
                return redirect()->route('/')->with(['success' => 'updated successfully !']);
            }else {
                return redirect()->back()->with(['fail' => 'Re-enter the old password']);
            }

          }
    }


    public function getmycourse(course $course)
    {

                  return view('profile.afterauthcourse',compact('course')); 

    }

}
