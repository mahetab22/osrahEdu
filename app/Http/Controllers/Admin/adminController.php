<?php

namespace App\Http\Controllers\Admin;
use App\HTTP\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Condition;
use App\Course;
use App\User;
Use Alert;
Use Visitor;
use App\MarketeInfo;
use App\Models\Info;
use Session;
use DB;
use App\Survey;
class adminController extends Controller
{
  public function index(){
    
    
    $ipnut = [
      'visitors' => DB::table('visitor_registry')->count(),
      'users' => User::count(),
      'courses' => Course::count(),
      'coaches' => User::where('role_id',3)->count(),
      'students' => User::where('role_id',4)->count(),
      'specials' => Service::count()
    ];
    
    return view('admin.index',$ipnut);
  }
  public function survey(){
    $survey=Survey::get();
    return view('admin.survey',compact('survey'));
  }
  public function delete_all_student_activity(Request $request){

    try{
        if (is_array($request->ids)){
          Survey::destroy($request->ids);
            
        }else{
            $Survey=Survey::find($request->ids);
            $Survey->delete();
        }
        return response()->json(['err'=>'0','alert' =>[
            'icon'=>'success',
            'title'=>__('site.alert_success'),
            'text'=>__('site.deleted_successfully')
            ]]);

    } catch(Exception $e) {

        return response()->json(['err'=>'1','alert' =>[
            'icon'=>'error',
            'title'=>__('site.alert_failed'),
            'text'=>__('site.deleted_failed')
            ]]);
    }
}


}