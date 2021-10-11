<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Exam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamQuestionRequest;
use App\Question;
use Illuminate\Http\Request;

class ExamQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $input=[
            'questions' => Question::where('exam_id',$id)->get(),
            'exam' => Exam::find($id),
        ];

        return view('admin.examQuestions.index',$input);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $input = [
            'exam_id' => $id
        ];

        return view('admin.examQuestions.create',$input);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamQuestionRequest $request, $id)
    {
        //
        try{

        $question = new Question();
        $question->exam_id = $id;
        $question->question = $request->question;
        $question->type = $request->q_type;
        $question->sol = $request->co;
        $question->save();
        $x = $request->q_type == 0 ? 4 : 2 ;
        for($i = 1 ; $i <= $x ; $i++){
            $answer = new Answer();
            $answer->answer = $request->a[$i - 1];
            $answer->true = $i == $request->co ? 1 : 0 ;
            $answer->question_id = $question->id;
            $answer->save();
        }

        } catch(Exception $e) {
        return redirect()->back()->with([
                'alert'=>[
                    'icon'=>'error',
                    'title'=>__('site.alert_failed'),
                    'text'=>__('site.question_failed_add'),
                ]]);
        }
        return redirect('admin/exam/'.$id.'/questions')->with([
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
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $question_id)
    {
        $input = [
            'question' => Question::find($question_id),
            'answers' => Answer::where('question_id',$question_id)->take(Question::find($question_id)->type == 0 ? 4 : 2)->get(),
            'exam_id' => $id
        ];
        return view('admin.examQuestions.edit',$input);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamQuestionRequest $request, $id, $question_id)
    {
        //
        try{
            $question = Question::find($question_id);
            $question->question = $request->question;
            $question->type = $request->q_type;
            $question->sol = $request->co;
            $question->save();


            $x = $request->q_type == 0 ? 4 : 2 ;
            $answers = Answer::where('question_id',$question_id)->take($x)->get();
            foreach($answers as $i => $answer){
                $answer->answer = $request->a[$i];
                $answer->true = $i == $request->co ? 1 : 0 ;
                $answer->save();
            }

            } catch(Exception $e) {
            return redirect()->back()->with([
                    'alert'=>[
                        'icon'=>'error',
                        'title'=>__('site.alert_failed'),
                        'text'=>__('site.question_failed_updated'),
                    ]]);
            }
            return redirect('admin/exam/'.$id.'/questions')->with([
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
    public function destroy($id, $question_id)
    {
        //
        $question = Question::find($question_id);
        $answers = Answer::where('question_id',$question->id)->get();
        try{
            if(!is_null($answers)){
                foreach($answers as $answer){
                    $answer->delete();
                }
            $question->delete();
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
                'text'=>__('site.question deleted successfully'),
            ]]);
    }

    public function delete_all(Request $request){
        try{
            if (is_array($request->ids)){
                Question::destroy($request->ids);
                $answers = Answer::whereIn('question_id',$request->ids)->get();
                foreach($answers as $answer){
                    $answer->delete();
                }
            }else{
                $question = Question::find($request->ids);
                $answers = Answer::where('question_id',$request->ids)->get();
                foreach($answers as $answer){
                    $answer->delete();
                }
                $question->delete();
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
