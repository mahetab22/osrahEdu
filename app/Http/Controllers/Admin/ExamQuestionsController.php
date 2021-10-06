<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
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
            'exam_id' => $id
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
            $answer->answer = $request->a[$i];
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
    public function destroy($id)
    {
        //
    }
}
