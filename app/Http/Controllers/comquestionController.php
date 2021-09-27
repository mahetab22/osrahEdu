<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CommonQuestion;
use DB;

class comquestionController extends Controller
{

    public function comquestion()
    {
    	$questions  = CommonQuestion::orderBy('num_of_view','DESC')->get();
        return view('questions',compact('questions'));
    }

       public function getcommonQuestion(commonquestion $commonquestion) 
      {

      	$questions  = CommonQuestion::where('id','!=',$commonquestion->id)->orderBy('num_of_view','DESC')->get();
         DB::table('common_questions')->where('id',$commonquestion->id)
            ->update([
                'num_of_view' => $commonquestion->num_of_view + 1
         ]);
        return view('questions',compact('questions','commonquestion'));
      }

}
