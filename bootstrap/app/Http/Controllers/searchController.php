<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Course;
use DB;

class searchController extends Controller
{

    public function search(Request $request)
    {
        $controller = New Controller();
        $slide_img = $controller->slide_img;
    	$search = $request->search;
        $service = null;
        $service = Service::orwhere('title_ar', 'LIKE', '%' . $search . '%')->orwhere('title_en', 'LIKE', '%' . $search . '%')->first();
        if(!empty($service)){
          $service =$service->id;
        }
        $results = Course::orwhere('title_ar', 'LIKE', '%' . $search . '%')->orwhere('title_en', 'LIKE', '%' . $search . '%')->orwhere('service_id',$service)->latest()->paginate(20);
        foreach($results as $res){
	         DB::table('courses')->where('id', $res->id)
	            ->update([
	                'num_of_search' => $res->num_of_search + 1
	         ]);
        }
 $topcourses = Course::orderBy('num_of_search','desc')->paginate(6);
// echo dd($courses);
        return view('search', compact('results','search','topcourses','slide_img'));

    }//end of index

}
