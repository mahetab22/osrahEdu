<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Course;
use App\User;
use App\SupervisorInfo;
use App\Supervisor_Course;
use App\Level;
use App\Notifications\InvoicePaid;
use DB;

class VisionController extends Controller
{

    public function testnotiphy()
    {
        $user = Auth::user();
        $user->notify(new InvoicePaid());
        echo 'success';
    }

    public function test()
    {
    	//Auth::user()->supervisorcourses[0]->course
    	//$course->levels[0]->lessons
    	//$course->supervisorcourse
     	//$course  = Course::find(2);
    	// echo dd($course->levels[0]->lessons);
        return view('profile.studcourse');
    }

    // public function lesson()
    // {
    //     return view('profile.lesson');
    // }

    public function lesson(Request $request)
    { 
        $auction=User::where('id',$request->name)->first();
       return Response()->json($auction);
    }

      public function getstudcourse(user $user,course $course) 
      {
        $cours=Course::where('department_id',$depart->id)->orderBy('id','asc')->get();
        return view('courses',compact('cours','depart','departments','slide_img'));
      }

}
