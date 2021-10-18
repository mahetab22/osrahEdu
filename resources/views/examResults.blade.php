@extends('layouts.app')

@section('content')

   <!--==================== Start exam page =======================-->
   <section class="exam_page result_exam_page">
        <div class="container">
            <div class="container_exam">
                <div class="questions_content">
                    <div class="heading">
                        <h5> {{$exam->exam->title}} مراجعة الأسئلة والإجابات</h5>
                        <p>موعد  الاختبار <span>{{$exam->created_at}}</span></p>
                        <!-- <p>موعد تسليم الإجابة <span>3:09:34</span></p> -->
                    </div>
                    @foreach($exam->exam->questions as $q=>$question)
                    <div class="question_single">
                        <div class="question_text">
                            <h6>{{$exam->exam->title}}</h6>
                            <!-- <span class="question_degree">نقطة واحد</span> -->
                        </div>
                        <?php 
                        
                        $stQuestion=$exam->answers->where('question_id',$question->id)->first(); ?>
                        
                        <div class="chooses_questions">
                            @if($question->type==0)
                                @foreach($question->answers as $a=>$answer)
                        
                                <label for="choose_{{$q}}{{$a}}">
                                    <input type="radio" class="answer_input {{$answer->true==1?'true':''}} {{$stQuestion->flag==0 && $answer->id==$stQuestion->answer_id?'false':''}}" name="question_{{$q}}" id="choose_{{$q}}{{$a}}">
                                    <span class="checkmark">{{$a+1}}</span>
                                    <span class="text">{{$answer->answer}}</span>
                                </label>
                                @endforeach
                            @else
    
                                <label for="choose_{{$q}}0">
                                    <input type="radio" class="answer_input {{$question->sol==1?'true':''}} {{$stQuestion->flag==0 && $stQuestion->sol==1?'false':''}}" name="question_{{$q}}" id="choose_{{$q}}0">
                                    <span class="checkmark">1</span>
                                    <span class="text">صح</span>
                                </label>
                                
                                <label for="choose_{{$q}}1">
                                    <input type="radio" class="answer_input {{$question->sol==0?'true':''}} {{$stQuestion->flag==0 && $stQuestion->sol==0?'false':''}}" name="question_{{$q}}" id="choose_{{$q}}1">
                                    <span class="checkmark">2</span>
                                    <span class="text">خطأ</span>
                                </label>
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="result_exam">
                    <h6>نتيجة الاختبار :</h6>
                    <span> {{($exam->answers->where('flag',1)->count()/$exam->exam->questions->count())*100}} %</span>
                </div>
            </div>

        </div>
    </section>
    <!--==================== End exam page =======================-->



@endsection