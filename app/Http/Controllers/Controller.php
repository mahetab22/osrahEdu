<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Slide;
//Use Visitor;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public $slide_img;
    public function __construct()
    {
	    $slide_img =[];
	    $slides = Slide::Where('more','index')->get();
	    foreach ($slides as $slide) {
	          $slide_img[]=json_encode(url('/').'/public/storage/'.$slide->slide);
	    }
		$this->slide_img = $slide_img;
		//Visitor::log();
    }
}
