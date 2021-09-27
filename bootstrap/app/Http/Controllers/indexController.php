<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Condition;
use App\Course;
Use Alert;
Use Visitor;

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
  
}
