<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Condition;
use App\Course;
Use Alert;
Use Visitor;
use App\MarketeInfo;
use Session;
class indexController extends Controller
{
    public function index()
    {
    $controller = New Controller();
    $slide_img = $controller->slide_img;
    $departments=Department::orderBy('id','asc')->get();
    $services=Service::where('id','!=',1)->whereNull('parent_id')->orderBy('id','asc')->get(); 
   // $services=Service::where('id','!=',1)->where('parent_id',1)->orderBy('id','asc')->get(); 
    $topcourses = Course::orderBy('num_of_search','asc')->paginate(5);
     if (!Session::has('codeMarketer')){
   session()->forget('codeMarketer');
     }
    if(request()->has('code')){
        $marketer=MarketeInfo::where('code',request('code'))->first();
        if($marketer){
            $marketer->visitors+=1;
            $marketer->save();
                if (!Session::has('codeMarketer'))
            {
                Session::put('codeMarketer', $marketer->code);
            }else{
                  session(['codeMarketer' => $marketer->code]);
            }
        }
    
    }
    return view('index',compact('services','departments','topcourses','slide_img'));

    }

  public function getservice(service $service) 
  {

    return view('services',compact('service'));
  }

  public function conditions() 
  {
   $conditions=Condition::orderBy('id','asc')->first();
    return view('conditions',compact('conditions'));
  }
  
  public function payMarketer($id){
      $m=MarketeInfo::where('user_id',$id)->first();
      $m->amount=0;
      $m->save();
        return redirect()->back()->with(['success' => 'تم الدفع بنجاح!']);
  }
  
}
