@extends('layouts.app')

@section('stylelinks')
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
@section('content')
    <!--==================== Start exam page =======================-->
    <section class="exam_page ">
        <div class="container">
            <div class="container_exam">
                <div class="header_exam">
                    <h5 class="title">اجب عن الاسئلة الأتية</h5>
                
                </div>
                <form action="{{ route('postExamStudent')}}"  method="post">
                    @csrf
                    <input type="hidden" value="{{$exam->id}}" name="exam"/>
                <div class="questions_content">
                    @foreach($exam->questions as $q=>$question)
                        <div class="question_single {{$q==0?'active':''}}">
                            <div class="question_text">
                                <h6>{{$question->question}}</h6>
                            </div>
                            <div class="chooses_questions">
                                @if($question->type==0)
                                    @foreach($question->answers as $a=>$answer)
                                        <label for="choose_{{$q}}{{$a}}">
                                            <input type="radio" value="{{$answer->id}}" class="answer_input" name="question_{{$question->id}}" id="choose_{{$q}}{{$a}}">
                                            <span class="checkmark">{{$a+1}}</span>
                                            <span class="text">{{$answer->answer}}</span>
                                        </label>
                                    @endforeach
                                @else
                                <label for="choose_{{$q}}1">
                                            <input type="radio" class="answer_input" value="1" name="question_{{$question->id}}" id="choose_{{$q}}1">
                                            <span class="checkmark">1</span>
                                            <span class="text">صح</span>
                                </label>
                                <label for="choose_{{$q}}2">
                                    <input type="radio" class="answer_input" value="0" name="question_{{$question->id}}" id="choose_{{$q}}2">
                                    <span class="checkmark">2</span>
                                    <span class="text">خطأ</span>
                                </label>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    <div class="btn-wrapp">
                        <div class="must_answer">
                            <p class="note red">يجب الإجابة اولا</p>
                        </div>
                        <div class="controls_slider">
                            <button type="button" class="main-btn main" id="next"><i class="fal fa-chevron-double-right"></i>التالي</button>
                            <button type="submit" class="send-answers d-none" id="send-answers">عرض النتيجة</button>
                            <button type="button" class="main-btn main" id="prev">السابق<i class="fal fa-chevron-double-left"></i></button>
                        </div>
                    </div>
                </div>
               </form>
            </div>

        </div>
    </section>
    <!--==================== End exam page =======================-->
@endsection
@section('script')

<script>
        /* slider exam */
        var currentIndex = 0,
            items = $('.exam_page .container_exam .questions_content .question_single'),
            itemAmt = items.length;

        function cycleItems() {
            if (currentIndex > itemAmt - 1) {
                currentIndex = itemAmt - 1;
            } else {
                var item = $('.exam_page .container_exam .questions_content .question_single').eq(currentIndex);
                items.hide().removeClass('active');;
                item.css('display', 'block').addClass('active');
            }
        }

        $('#next').click(function() {

            if ($('.question_single.active .answer_input').is(':checked')) {
                if (currentIndex < itemAmt - 2) {
                    currentIndex += 1;

                } else if (currentIndex < itemAmt - 1) {
                    currentIndex += 1;
                    $(this).addClass('d-none')
                    $('#send-answers').removeClass('d-none')
                }
                cycleItems();
                $('.btn-wrapp .note').removeClass('show')
            } else {
                $('.btn-wrapp .note').addClass('show')
            }
        });

        $('#prev').click(function() {
            if (currentIndex <= 0) {
                currentIndex = 0;

            } else if (currentIndex > 0) {
                $('#next').removeClass('d-none')
                $('#send-answers').addClass('d-none')
                currentIndex -= 1;
            }
            cycleItems();
        });
    </script>

@endsection