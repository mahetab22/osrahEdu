<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;
use App\HTTP\Controllers\Controller;
use App\Http\Requests\Admin\ServicesRequest;
use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Condition;
use App\Course;
use App\User;
Use Alert;
use App\Exam;
use App\Lesson;
Use Visitor;
use App\MarketeInfo;
use App\Models\Info;
use App\UserRole;
use Session;
use DB;
use Validator;
use App\Level;

class levelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $input = [
            'info' => DB::table('infos')->first(),
            'course'=>Course::find($id)
          ];

          return view('admin.courses.levels',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //
        $level = new Level;
        $level->title_ar = $request->title_ar;
        $level->title_en = $request->title_en;
        $level->description_ar = $request->desc_ar;
        $level->description_en = $request->desc_en;
        $level->course_id=$id;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/level', $imageName);
            $level->logo = 'storage/level/'. $imageName;
        }

        $level->save();

        return redirect()->back()->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.added successfully'),
            ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $level = Level::find($id);
        $level->title_ar = $request->title_ar;
        $level->title_en = $request->title_en;
        $level->description_ar = $request->desc_ar;
        $level->description_en = $request->desc_en;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/level', $imageName);
            $level->logo = 'storage/level/'. $imageName;
        }

        $level->save();

        return redirect()->back()->with([
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.updated successfully'),
            ]]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $level=Level::find($id);
        $lessons=Lesson::where('level_id',$id)->get();
        $exams=Exam::where('level_id',$id)->get();
        if(!is_null($level)){
            $level->delete();
            foreach($lessons as $lesson){
                $lesson->delete();
            }
            foreach($exams as $exam){
                $exam->delete();
            }
            return response()->json(['err'=>'0','alert' =>[
                'icon'=>'success',
                'title'=>__('site.alert_success'),
                'text'=>__('site.deleted_successfully')
                ]]);
        }else{
            return response()->json(['err'=>'1','alert' =>[
                'icon'=>'error',
                'title'=>__('site.alert_failed'),
                'text'=>__('site.deleted_failed')
                ]]);
        }
    }

    public function delete_all(Request $request){
        try{
            if (is_array($request->ids)){
                Level::destroy($request->ids);
                $lessons=Lesson::whereIn('level_id',$request->ids)->get();
                $exams=Exam::whereIn('level_id',$request->ids)->get();
                foreach($lessons as $lesson){
                    $lesson->delete();
                }
                foreach($exams as $exam){
                    $exam->delete();
                }
            }else{
                $level = Level::find($request->ids);
                $lessons = Lesson::where('level_id',$request->ids)->get();
                $exams = Exam::where('level_id',$request->ids)->get();
                foreach($lessons as $lesson){
                    $lesson->delete();
                }
                foreach($exams as $exam){
                    $exam->delete();
                }
                $level->delete();
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
