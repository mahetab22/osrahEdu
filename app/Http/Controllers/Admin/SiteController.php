<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InfoRequest;
use App\Info;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index($word){
        $input = [
            'info' => Info::first(),
            'key' => $word
        ];
        return view('admin.site_infos.info',$input);
    }

    public function update(InfoRequest $request){

        $info = Info::first();
        if($request->key_word == 'basic'){

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $imageName = time() . rand(10, 10000) . '.' . $image->extension();
                $image->move(public_path().'/storage/site-info', $imageName);
                $info->logo = 'public/storage/site-info/'. $imageName;
            }

            if ($request->hasFile('favicon')) {
                $image = $request->file('favicon');
                $imageName = time() . rand(10, 10000) . '.' . $image->extension();
                $image->move(public_path().'/storage/site-info', $imageName);
                $info->favicon = 'public/storage/site-info/'. $imageName;
            }

            $info->name_ar =$request->name_ar;
            $info->name_en =$request->name_en ?? $request->name_ar;
            $info->name2_ar =$request->name2_ar;
            $info->name2_en =$request->name2_en ?? $request->name2_ar;
            $info->hint_ar =$request->hint_ar;
            $info->hint_en =$request->hint_en ?? $request->hint_ar;
            $info->hint2_ar =$request->hint2_ar;
            $info->hint2_en =$request->hint2_en ?? $request->hint2_ar;
            $info->whatsapp_male =$request->whatsapp_male;
            $info->whatsapp_female =$request->whatsapp_female;
        }elseif($request->key_word == 'social'){
            $info->fb = $request->fb;
            $info->tw = $request->tw;
            $info->inst = $request->insta;
            $info->google = $request->google;
        }elseif($request->key_word == 'pages'){
            $info->aboutus_ar = $request->aboutus_ar;
            $info->aboutus_en = $request->aboutus_en ?? $request->aboutus_ar;
            $info->our_vision_ar = $request->our_vision_ar;
            $info->our_vision_en = $request->our_vision_en ?? $request->our_vision_ar;
            $info->ourmessage_ar = $request->ourmessage_ar;
            $info->ourmessage_en = $request->ourmessage_en;
            $info->assembly_classification_ar = $request->assembly_classification_ar;
            $info->assembly_classification_en = $request->assembly_classification_en;
            $info->goal1_ar = $request->goal1_ar;
            $info->goal2_ar = $request->goal2_ar;
            $info->goal3_ar = $request->goal3_ar;
            $info->goal1_en = $request->goal1_en ?? $request->goal1_ar;
            $info->goal2_en = $request->goal2_en ?? $request->goal2_ar;
            $info->goal3_en = $request->goal3_en ?? $request->goal3_ar;
            $info->script1 = $request->script1;
            $info->script2 = $request->script2;
            $info->start_year = $request->year;
        }
        $info->save();

        return redirect()->back()->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.info updated successfully'),
            ]]);
    }
}
