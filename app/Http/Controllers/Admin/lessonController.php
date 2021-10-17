<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServicesRequest;
use Illuminate\Http\Request;
use App\Department;
use App\Service;
use App\Condition;
use App\Course;
use App\User;
Use Alert;
use App\Exam;
Use Visitor;
use App\MarketeInfo;
use App\Models\Info;
use App\UserRole;
use Session;
use DB;
use Validator;
use App\Level;
use App\Lesson;

class lessonController extends Controller
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
            'level'=>Level::find($id)
          ];

          return view('admin.courses.lessons',$input);
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
        $level = Level::find($id);
        $lesson = new Lesson;
        $lesson->title_ar = $request->title_ar;
        $lesson->title_en = $request->title_en;
        $lesson->description_ar = $request->desc_ar;
        $lesson->description_en = $request->desc_en;
        $lesson->level_id = $id;
        $lesson->course_id = $level->course_id;
        $lesson->link = $request->link;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/lesson', $imageName);
            $lesson->file = 'storage/lesson/'. $imageName;
        }

        $lesson->save();

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

        $lesson = Lesson::find($id);
        $lesson->title_ar = $request->title_ar;
        $lesson->title_en = $request->title_en;
        $lesson->description_ar = $request->desc_ar;
        $lesson->description_en = $request->desc_en;
        $lesson->link = $request->link;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $image->extension();
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/lesson', $imageName);
            $lesson->file = 'storage/lesson/'. $imageName;
        }

        $lesson->save();

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
        $lesson=Lesson::find($id);
        $exams = Exam::where('lesson_id',$id)->get();
        if(!is_null($lesson)){
            $lesson->delete();
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
                Lesson::destroy($request->ids);
                $exams = Exam::whereIn('lesson_id',$request->ids)->get();
                foreach($exams as $exam){
                    $exam->delete();
                }
            }else{
                $lesson=Lesson::find($request->ids);
                $exams = Exam::where('lesson_id',$request->ids)->get();
                foreach($exams as $exam){
                    $exam->delete();
                }
                $lesson->delete();
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
