<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Info;
use App\Slide;

class aboutController extends Controller
{
    public function about()
    {
	    $slide = Slide::Where('more', 'LIKE', '%' . 'aboutUs' . '%')->first();
        //echo dd($slide);
        if(!empty($slide)){
            $slide_imgabout=json_encode(url('/').'/public/storage/'.$slide->slide);
        }

        
         $Info=Info::orderBy('id','asc')->first();
        return view('about',compact('Info','slide_imgabout'));
    }
}
