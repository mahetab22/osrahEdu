<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Course;
use App\Exam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamRequest;
use App\Lesson;
use App\Level;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $input = [
            'exams'=> Exam::all()
        ];

        return view('admin.exams.index',$input);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $input = [
            'courses'=> Course::all(),
            'users' => User::where('role_id','3')->get()
        ];

        return view('admin.exams.create',$input);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {

        //---- Save Exam Details ----
        $exam = new Exam();
        $exam->title = $request->title;
        $exam->code = $request->code;
        $exam->course_id = $request->course_id;
        $exam->content = $request->content; //New Column
        $exam->level_id = $request->level_id ?? null;
        $exam->lesson_id = $request->lesson_id ?? null;
        $exam->user_id = auth()->user()->id;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/exam', $imageName);
            $exam->logo = 'public/storage/exam/'. $imageName;
        }
        $exam->save();

        //---- Save Exam Questions Details ----
        try{
            foreach($request->q as $i => $question){
                $question = new Question();
                $question->exam_id = $exam->id;
                $question->question = $request->q[$i];
                $question->type = $request->q_type.$i;
                $m='q'.$i;
                $question->sol = $request->{$m};
                $question->save();
                //---- Save Questions Answers Details ----
                $x = $question->type == 0 ? 4 : 2;
                    for( $j = 1 ; $j <= $x; $j++){
                        $answer = new Answer();
                        $a ='a'.$j ;
                        $answer->answer = $request->{$a}[$i];
                        $answer->true = $request->{$m} == $j ? 1 : 0;
                        $answer->question_id = $question->id;
                        $answer->save();
                    }
            }
        } catch(Exception $e) {
        return redirect()->back()->with([
                'alert'=>[
                    'icon'=>'error',
                    'title'=>__('site.alert_failed'),
                    'text'=>__('site.exam cna\'t be add'),
                ]]);
        }
        return redirect('admin/exams')->with([
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
        $input = [
            'exam' => Exam::find($id),
            'courses'=> Course::all(),
            'levels'=> Level::all(),
            'lessons'=> Lesson::all()
        ];

        return view('admin.exams.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, $id)
    {
        //
        try{
        $exam = Exam::find($id);
        $exam->title = $request->title;
        $exam->code = $request->code;
        $exam->course_id = $request->course_id;
        $exam->content = $request->content; //New Column
        $exam->level_id = $request->level_id ?? null;
        $exam->lesson_id = $request->lesson_id ?? null;
        $exam->user_id = auth()->user()->id;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . rand(10, 10000) . '.' . $image->extension();
            $image->move(public_path().'/storage/exam', $imageName);
            $exam->logo = 'public/storage/exam/'. $imageName;
        }
        $exam->save();
        } catch(Exception $e) {
        return redirect()->back()->with([
                'alert'=>[
                    'icon'=>'error',
                    'title'=>__('site.alert_failed'),
                    'text'=>__('site.exam not found'),
                ]]);
        }
        return redirect('admin/exams')->with([
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
        $exam = Exam::Find($id);
        $questions = Question::where('exam_id',$id)->get();
        try{
            if(!is_null($questions)){
                foreach($questions as $question){
                    $answers = Answer::where('question_id',$question->id)->get();
                    if(!is_null($answers)){
                        foreach($answers as $answer){
                            $answer->delete();
                        }
                    }
                    $question->delete();
                }
            $exam->delete();
            }
        } catch(Exception $e) {
            return  response()->json([ 'err'=>'1',
                'alert'=>[
                    'icon'=>'error',
                    'title'=>__('site.alert_failed'),
                    'text'=>__('site.error in delete'),
                ]]);
        }

        return  response()->json(['err'=>'0',
            'alert'=>[
                'icon'=>'success',
                'title'=>__('site.done'),
                'text'=>__('site.exam deleted successfully'),
            ]]);


    }

    public function delete_all(Request $request){

        try{
            if (is_array($request->ids)){
                Exam::destroy($request->ids);
                $questions = Question::whereIn('exam_id',$request->ids)->get();
                foreach($questions as $question){
                    $answers = Answer::where('question_id',$question->id)->get();
                    if(!is_null($answers)){
                        foreach($answers as $answer){
                            $answer->delete();
                        }
                    }
                    $question->delete();
                }
            }else{
                $exam=Exam::find($request->ids);
                $questions = Question::where('exam_id',$request->ids)->get();
                foreach($questions as $question){
                    $answers = Answer::where('question_id',$question->id)->get();
                    if(!is_null($answers)){
                        foreach($answers as $answer){
                            $answer->delete();
                        }
                    }
                    $question->delete();
                }
                $exam->delete();
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


    public function levels(Request $request, $id){
        $input = [
            'levels' => Level::where('course_id',$id)->get(),
            'level_id' => Level::find($request->level_id)
        ];

        return view('admin.exams.levels',$input);
    }

    public function lessons(Request $request,$id){
        $input = [
            'lessons' => Lesson::where('level_id',$id)->get(),
            'lesson_id' => Lesson::find($request->lesson_id)
        ];

        return view('admin.exams.lessons',$input);
    }
}
