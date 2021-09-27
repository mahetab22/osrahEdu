<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Course;
use App\Slide;
class servicesController extends Controller
{

     // show service
      public function getservice(service $service) 
      {
        $services_test= Service::where('parent_id',$service->id)->orderBy('id','asc')->first();
        $myservice= Service::with('course')->where('id',$service->id)->whereHas('course')->first();
        if(empty($services_test) and empty($myservice)){
            return redirect()->back()->with('toast_error', 'هذا القسم لا يحتوي علي أي دورات حاليا')->withInput();
        }
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $serv = $service;
        $services= Service::where('id','!=',1)->where('parent_id',$service->id)->where('id','!=',$service->id)->orderBy('id','asc')->get();
        if(empty($services[0])){
        $services= Service::with('course')->where('id','!=',1)->whereHas('course')->where('id','!=',$service->id)->orderBy('id','asc')->get();
        $cours=Course::where('service_id',$service->id)->orderBy('id','asc')->get();
        $slide = Slide::Where('more', 'LIKE', '%' . 'courses' . '%')->first();
        if(!empty($slide)){
            $slide_image=json_encode(url('/').'/public/storage/'.$slide->slide);
        }
        return view('courses',compact('cours','serv','services','slide_img','slide_image'));
        }else{
        $slide = Slide::Where('more', 'LIKE', '%' . 'services' . '%')->first();
        if(!empty($slide)){
            $slide_image=json_encode(url('/').'/public/storage/'.$slide->slide);
        }
          $toggel = 1 ; // toggel : To switch between the contents of two pages
          return view('services',compact('services','slide_img','toggel','slide_image'));
        }
      }
      
      // unused function  show service
      public function getunusedservice(service $service) 
      {
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $serv = $service;
        $services= Service::where('id','!=',1)->where('parent_id',$service->id)->where('id','!=',$service->id)->orderBy('id','asc')->get();
        if(empty($services[0])){
        $services= Service::where('id','!=',1)->where('parent_id',1)->where('id','!=',$service->id)->orderBy('id','asc')->get();
        $cours=Course::where('service_id',$service->id)->orderBy('id','asc')->get();
                $slide = Slide::Where('more', 'LIKE', '%' . 'courses' . '%')->first();
        if(!empty($slide)){
            $slide_image=json_encode(url('/').'/public/storage/'.$slide->slide);
        }
        return view('courses',compact('cours','serv','services','slide_img','slide_image'));
        }else{
          $toggel = 1 ; // toggel : To switch between the contents of two pages
                  $slide = Slide::Where('more', 'LIKE', '%' . 'services' . '%')->first();
        if(!empty($slide)){
            $slide_image=json_encode(url('/').'/public/storage/'.$slide->slide);
        }
          return view('services',compact('services','slide_img','toggel','slide_image'));
        }
      }

      public function getallservice() 
      {
        $slide_image = 0;
        $toggel = 2 ; // toggel : To switch between the contents of two pages
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $services= Service::where('id','!=',1)->where('parent_id',1)->orderBy('id','asc')->get();
        $slide = Slide::Where('more', 'LIKE', '%' . 'services' . '%')->first();
        if(!empty($slide)){
            $slide_image=json_encode(url('/').'/public/storage/'.$slide->slide);
        }
        return view('services',compact('services','slide_img','toggel','slide_image'));
      }

      public function specializedServices() 
      {
        $slide_image = 0;
        $toggel = 2 ; // toggel : To switch between the contents of two pages
        $controller = New Controller();
        $slide_img = $controller->slide_img;
        $specializedServices= Department::orderBy('id','asc')->get();
        $slide = Slide::Where('more', 'LIKE', '%' . 'services' . '%')->first();
        if(!empty($slide)){
            $slide_image=json_encode(url('/').'/public/storage/'.$slide->slide);
        }
        return view('specializedServices',compact('specializedServices','slide_img','toggel','slide_image'));
      }
 
    public function getspecializedServices(department $department)
    {
                  return view('profile.afterauthspecializedServices',compact('department')); 

    }
         
}
