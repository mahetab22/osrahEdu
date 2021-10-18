@extends('layouts.app')

@section('content')
  <!--==================== Start exam page =======================-->
  <section class="exam_page result_exam_page">
        <div class="container">
            <div class="container_exam">
                <div class="questions_content">
                    <div class="heading">
                        <h5>تعديل وإضافة للاختبار</h5>
                     
                    </div>
                    @foreach($exam->questions as $q=>$question)
                    <div class="question_single">
                        <div class="question_text">
                            <h6>  {{$question->question}}</h6>
                            <a  href="{{ url('/') }}/deletequestion/{{$question->id}}/delete" data-toggle="modal" data-target="#del{{$q}}" class="on-default btn btn-default" type="submit"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                        </div>
                        <div class="chooses_questions">
                            @if($question->type == 0)
                            @foreach($question->answers as $i=>$answer)
                                <label for="choose_{{$i}}">
                                    <input type="radio" class="answer_input {{$answer->true == 1?'true':''}}" name="answers[{{$question->id}}]" id="choose_{{$i}}">
                                    <span class="checkmark">{{$i+1}}</span>
                                    <span class="text">{{$answer->answer}}</span>
                                </label>
                            @endforeach
                            @else
                            <label for="choose_0">
                                    <input type="radio" class="answer_input {{$question->sol == 1?'true':''}}" name="answers[{{$question->id}}]" id="choose_0">
                                    <span class="checkmark">1</span>
                                    <span class="text">صح</span>
                                </label>
                                <label for="choose_1">
                                    <input type="radio" class="answer_input {{$question->sol == 0?'false':''}}" name="answers[{{$question->id}}]" id="choose_1">
                                    <span class="checkmark">2</span>
                                    <span class="text">خطأ</span>
                                </label>
                            @endif
                      
                        </div>
                    </div>
                    <div id="del{{$q}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="add-qu form-contact">
                                        <h3>حذف السؤال {{$question->question}}</h3>
                                        <form action="{{ url('/') }}/deletequestion/{{$question->id}}/delete"  method="get" role="form"  enctype="multipart/form-data">                        
                                            
                                                <input type="submit" name="submit1" class="btn btn-danger" value="حذف">
                                                <button class="btn btn-primary" type="button" class="close" data-dismiss="modal">إلغاء</button>
                                            
                                        </form>
                                        <!-- Template -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    @endforeach
                   <a class="btn btn-primary text-white" data-toggle="modal" data-target="#edit-exam">إضافة سؤال</a>
                    @if($exam->view == 1)                       
                    <a class="btn btn-info"  href="{{ url('/') }}/exam/{{$exam->id}}/heddinexam">إخفاء من الموقع</a>
                    @else
                        <a class="btn btn-info"  href="{{ url('/') }}/exam/{{$exam->id}}/viewexam">نشر للموقع</a>
                    
                    @endif
                </div>
               
            </div>

        </div>
    </section>
    <!--==================== End exam page =======================-->
    <div id="edit-exam" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="add-qu form-contact">
                            <h3>@lang("site.Add an exam")</h3>
                              <form action="{{ route('addtoexam')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                @csrf
                                         <div class="text3">                                          
                                         <input name="publicexam" value="1" hidden="" />
                                         <input name="exam_id" value="{{$exam->id}}" hidden="" />
                                         </div>
                                       <div class="form-group">
                                         <input type="radio" name="Qtype" id="first" value="first" >أختيار من متعدد
                                         <label></label>
                                         <input type="radio" name="Qtype" id="secound" value="secound">صح - خطأ
                                       </div>                                     
                                <div class="first">
                                    <div class="add-section">
                                        <span class="col-xs-12">
                                            <p class="form-group">                                                
                                                <label>السؤال</label>
                                                <input type="text" name="question" value="" class="form-control" >
                                            </p>
                                        </span>
                                        <span class="col-xs-12 row padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الأجابة الأولي</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checkboxs[]" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                        <span class="col-xs-12 row padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الأجابة الثانية</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checkboxs[]" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                        <span class="col-xs-12 row padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الأجابة الثالثة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio"  name="checkboxs[]" value="2">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                        
                                        <span class="col-xs-12 row padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الإجابة الرابعة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio"  name="checkboxs[]" value="3">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span> 
                                    </div>
                                </div>
                                
                                 <div  class="secound">
                                    <div class="add-section truefalse">
                                        <span class="col-xs-12 row padding">
                                            <span class="col-md-10 col-xs-8">
                                                <p class="form-group">
                                                    <label>السؤال</label>
                                                    <input type="text" name="questionn" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2 false">
                                                <label class="exam-ch">
                                                    false
                                                    <input type="radio" name="checck" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                            <span class="col-md-1 col-xs-2 true">
                                                <label class="exam-ch">
                                                    true
                                                    <input type="radio" name="checck" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>                                            
                                        </span>

                                    </div>
                                </div>  
                                <p>
                                    <input type="submit" name="submit1" class="btn btn-success" value="إضافة">
                                  
                                </p>
                            </form>
                            <!-- Template -->

                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
@section('script')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
   
  <script>      
        $(document).ready(function () {
    $(".first").hide();
    $(".secound").hide();    

        $("#first").click(function () {
        $(".first").show();
        $(".secound").hide();
    });
    $("#secound").click(function () {
        $(".first").hide();
        $(".secound").show();
    });    
});
</script>

@endsection