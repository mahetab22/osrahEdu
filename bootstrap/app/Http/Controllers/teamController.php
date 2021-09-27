<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SupervisorInfo;
use App\Service;
use DB;

class teamController extends Controller
{

    public function team()
    {
    	$controller = New Controller();
        $slide_img = $controller->slide_img;
        
      $users = User::where('role_id',3)->get();
    	// $users = DB::table('users')
     //        ->join('supervisor_infos', 'users.id', '=', 'supervisor_infos.user_id')
     //        ->join('services', 'services.id', '=', 'supervisor_infos.service_id')
     //        ->get();
          //  echo dd($users);
      //  $supervisorinfos = SupervisorInfo::Orderby('id','asc')->get();
        //echo dd($supervisorinfos[1]->supervisor);
       // $users = Super::Orderby('id','asc')->get();
          //  echo dd($users);
        return view('team',compact('users','slide_img'));
    }
    
    public function superprofile(user $user)
    {
        $controller = New Controller();
        $slide_img = $controller->slide_img;
       // echo dd($user);
        return view('profile.superprofilereview',compact('user'));
    }

}
