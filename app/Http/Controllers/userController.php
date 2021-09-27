<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Department;
use App\Service;
use App\Course;
use App\User;
use App\SupervisorInfo;
use App\Supervisor_Course;
use App\SupervisorAchievement;
use App\Level;
use App\Comment;
use Carbon\Carbon;
use Validator;
use DB;
Use Alert;

class userController extends HomeController
{
   

    public function profile()
    {
        //$rr = Auth::user()->reccomments;
        
        //where('user_id',$user['id'])->
        return view('profile.profile');
    }

    public function supervprofile()
    {
      //echo dd(Auth::user()->supervisorcourses[0]->course->title_ar);
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        if(Auth::user()->role_id == 3){           
        $supervisor_info = SupervisorInfo::where('user_id',Auth::user()->id)->first();
        $service = Service::where('id','!=',1)->where('parent_id',1)->where('id',$supervisor_info->service_id)->first();
        $services = Service::where('id','!=',$supervisor_info->service_id)->get();
      //  echo dd(Auth::user()->supervisorcourses[0]->course->comments->orderBy('id','asc')->first()->replay);
        return view('profile.supervprofile',compact('supervisor_info','service','services','slide_img'));
        }else{
           // echo dd(Auth::user()->id);
            return redirect()->back()->with(['success' => ' نأسف  فلست مدرب!! !']);
        }
    }
    public function marketerProfile(){
          if(Auth::user()->role_id == 5){ 
        return view('profile.markterProfile');
          }else{
              return redirect()->back()->with(['success' => ' نأسف  فلست مسوق!! !']); 
          }
    }
    
    // ----------------- star achievement
    public function addachievement(Request $request)
      {
        $today = Carbon::today();
          $rules =[
            'user_id'     => ['required','exists:users,id'],
            'achievement'     => ['required','string','max:255'],
          //  'order'     => ['required'],
            'radio'     => ['required'],
          ];
    
          $validate = Validator::make($request->all(), $rules);
          if ($validate->fails()) {
            return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
          }else{
    
              $data = new SupervisorAchievement;
              $data->user_id = $request['user_id'];
              $data->achievement = $request['achievement'];
              $data->type = $request['radio'];
             // $su=SupervisorAchievement::find($request['order']);
             // $data->order = $su->order;
              $data->save();
    
              return redirect()->back()->with(['success' => 'تم أضافة انجازك بنجاح']);
        }
      }
      
      // ----------------- end achievement
      
    public function updateProfile(Request $request)
    { 
    $today = Carbon::today();
  //  echo dd($request);
    if(Auth::user()->role_id == 3){    
      $rules =[
        'name'     => ['required'],
        'avatar'     => ['file'],
        'Educational'     => ['required'],
        // 'service_id'     => ['required','exists:services,id'],
        'achievement'     => ['array'],
        //'skill1'     => ['required'],
       // 'skill2'     => ['required'],
       // 'skill3'     => ['required'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{

				$avatar =Auth::user()->avatar;
      	          if($request->hasFile('avatar')) 
                    {
                     $license_img=$request['avatar'];
  	                  if($license_img)
  	                  {
  	                    $img_name ='user_img'.rand(0,999). '.' . $license_img->getClientOriginalExtension();
  	                    $license_img->move(base_path('/public/storage/users/'.$today->isoFormat('Y').'/'), $img_name);
  	                    $avatar = 'users/'.$today->isoFormat('Y').'/'.$img_name;
  	                  }
                    }

      	   // $serv= Service::orderBy('id','asc')->first();
			
			if(empty($request->note_profile)){
			$note_profile= SupervisorInfo::where('user_id', Auth::user()->id)->orderBy('id','asc')->first()->profile;
			}else{
				$note_profile=$request->note_profile;
			}
        	DB::table('users')->where('id', Auth::user()->id)
	            ->update([
	                'name' => $request->name ,
	                //'email'  => $request->email ,
                  'avatar'  => $avatar ,    
	                'phone'  => $request->phone ,    
	         ]);
        	DB::table('supervisor_infos')->where('user_id', Auth::user()->id)
	            ->update([
	                'profile' => $note_profile ,
	                'skill1'  => $request->skill1 ,
	                'skill2'  => $request->skill2 ,
	                'skill3'  => $request->skill3 ,
	                'fb' 	  => $request->fb ,
	                'tw' 	  => $request->tw ,
	                'inst' 	  => $request->inst ,
	                'google'  => $request->google ,
	                'Educational'  => $request->Educational ,
	                // 'service_id'  => $request->service_id ,
	         ]);
             if(!empty($request->achievement))
             {
                foreach ($request->achievement as $kay=>$achievement) {
                  if(empty($achievement)){
                   DB::table('supervisor_achievements')->where('id',$kay)
                    ->delete();
                  }else{
                    
    	        DB::table('supervisor_achievements')->where('id',$kay)
	            ->update([
	                'achievement' => $achievement,
	               ]);
                  }
                }
             }
		return redirect()->back()->with(['success' => 'تم تعديل بياناتك بنجاح !']);

		}

    }elseif(Auth::user()->role_id == 4||Auth::user()->role_id == 5){

      $rules =[
        'name'     => ['required'],
        'avatar'     => ['file'],
        'email'     => ['email'],
      ];

      $validate = Validator::make($request->all(), $rules);
      if ($validate->fails()) {
        return back()->with('toast_error', $validate->messages()->all()[0])->withInput();
      }else{

        $avatar =Auth::user()->avatar;
                  if($request->hasFile('avatar')) 
                    {
                     $license_img=$request['avatar'];
                    if($license_img)
                    {

                      $img_name ='user_img'.rand(0,999). '.' . $license_img->getClientOriginalExtension();
                      $license_img->move(base_path('/public/storage/users/'.$today->isoFormat('Y').'/'), $img_name);
                      $avatar = 'users/'.$today->isoFormat('Y').'/'.$img_name;
                    }
                    }

           // $serv= Service::orderBy('id','asc')->first();
          DB::table('users')->where('id', Auth::user()->id)
              ->update([
                  'name' => $request->name ,
                  'email'  => $request->email ,
                  'avatar'  => $avatar ,
                  'phone'  => $request->phone ,    
           ]);
    return redirect()->back()->with(['success' => 'updated Successfully!']);

    }    
    }
    }


}
