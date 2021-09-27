@extends('layouts.app')

@section('content')

        
        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
                <div class="container">
                    <h2>  @lang("site.Test Center")</h2>
                    <ul>
                        <li>
                            <a href="{{ route('/') }}">
                               @lang("site.Main")
                            </a>
                        </li>
                        <li>
                            <span>
                                @lang("site.Test Center")
                            </span>
                        </li>
                    </ul>
                </div>
            </section>
        <!-- End Title -->

        <section class="ex-inner body-inner">
            <div class="container">
                <div class="col-md-3 col-xs-12"></div>
                <div class="col-md-6 col-xs-12">
                    <div class="exam-block editexam">
                         <div class="col-md-12">
        					<div class="title wow fadeInUp">
        						<h3>تعديل وإضافة للاختبار</h3>
        					</div>
				         </div>
                         @foreach($exam->questions as $question)
                         
                            @if($question->type == 0)
                            <div class="form-group row">
                                <p>
                                    {{$question->question}}
                                </p>
                                @foreach($question->answers as $answer)
                                @if($answer->true == 1)
                                <label class="excheck"> {{$answer->answer}}
                                    <input type="radio"  checked="checked" name="answers[{{$question->id}}]" value="{{$answer->id}}" />
                                    <span class="checkmarkEx" ></span>
                                </label>

                                @else
                                <label class="excheck"> {{$answer->answer}}
                                    <input type="radio" name="answers[{{$question->id}}]" value="{{$answer->id}}" />
                                    <span class="checkmarkEx"></span>
                                </label>
                                @endif

                                @endforeach

                                <a href="{{ url('/') }}/deletequestion/{{$question->id}}/delete" class="on-default btn btn-default" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></a>

                            </div>
                            @elseif($question->type == 1)
                            <div class="form-group row">
                                            <span class="col-md-8 col-xs-8">
                                                <p class="form-group"> 
                                                    <input type="text" name="questionn" value="{{$question->question}}" class="form-control" required>
                                                </p>
                                            </span>
                                            @if($question->sol == 0)
                                            <span class="col-md-1 col-xs-2 false">
                                                <label class="exam-ch">
                                                    <input type="radio" checked="checked" name="checck[{{$question->id}}]" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                            <span class="col-md-1 col-xs-2 true">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck[{{$question->id}}]" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span> 
                                            @elseif($question->sol == 1)
                                            <span class="col-md-1 col-xs-2 false">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck[{{$question->id}}]" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                            <span class="col-md-1 col-xs-2 true">
                                                <label class="exam-ch">
                                                    <input type="radio" checked="checked" name="checck[{{$question->id}}]" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span> 
                                            @endif
                                            


                                <a  href="{{ url('/') }}/deletequestion/{{$question->id}}/delete" class="on-default btn btn-default" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></a>
                             
                            </div>
                            
                            @endif
                            <hr style="display: block;
                                          margin-top: 0.5em;
                                          margin-bottom: 0.5em;
                                          margin-left: auto;
                                          margin-right: auto;
                                          border-style: inset;
                                          border-width: 1px;">
                         @endforeach

                    

                       <div class="form-group row all-buttons">
                               <a class="add-btn" data-toggle="modal" data-target="#edit-exam">إضافة سؤال</a>
                      
                       @if($exam->view == 1)
                       
                               <a class="add-btn"  href="{{ url('/') }}/exam/{{$exam->id}}/heddinexam">إخفاء من الموقع</a>
                       
                       @else
                       
                               <a class="add-btn"  href="{{ url('/') }}/exam/{{$exam->id}}/viewexam">نشر للموقع</a>
                       
                       @endif
                       </div>

                       
                       </div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
            </div>
        </section>

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
                                        <span class="col-xs-12 padding">
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
                                        <span class="col-xs-12 padding">
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
                                        <span class="col-xs-12 padding">
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
                                        
                                        <span class="col-xs-12 padding">
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
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-10 col-xs-8">
                                                <p class="form-group">
                                                    <label>السؤال</label>
                                                    <input type="text" name="questionn" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2 false">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                            <span class="col-md-1 col-xs-2 true">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>                                            
                                        </span>

                                    </div>
                                </div>  
                                <p>
                                    <input type="submit" name="submit1" class="btn-style" value="إضافة">
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