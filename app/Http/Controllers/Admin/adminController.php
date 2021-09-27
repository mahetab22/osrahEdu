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

}