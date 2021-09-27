@extends('layouts.app')

@section('stylelinks')
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endsection
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

        @if(!empty($ExamStuAch[0]) and !empty($StuExam))
        <!-- Start Ex-inner<input type="checkbox" name="answers['+[i]+']" value="'+response.answers[i][j].id+'"> -->
        <section class="ex-inner body-inner">
            <div class="container">
                <div class="col-md-3 col-xs-12"></div>
                <div class="col-md-6 col-xs-12">
                    <div class="exam-block editexam">
                        <div class="col-md-12">
        					<div class="title wow fadeInUp">
        						<h3>@lang("site.Review the questions and answers")</h3>
        					</div>
				         </div>
                         
                        <div class="title"><p>@lang("site.The exam started at"): {{$StuExam->created_at->format('H:i:s a')}}</p> <p>@lang("site.And I finish at the hour"):{{$ExamStuAch->last()->created_at->format('H:i:s a')}}</p></div>
                         @foreach($exam->questions as $question)
                         @if($question->type == 0)
                         <?php $x=0; ?>                         
                            <div class="form-group row">
                                <p>
                                    {{$question->question}}
                                </p>
                                @foreach($question->answers as $answer)                             
                                @if(!empty($ExamStuAch->where('answer_id',$answer->id)->first()))
                                @if($answer->true == 1 and $x==0)
                                <?php $x=1; ?>                                
                                <label class="excheck correct" > {{$answer->answer}}
                                    <input type="checkbox" name="answers[{{$question->id}}]" value="{{$answer->id}}" checked="checked" disabled />
                                    <span class="checkmarkEx"></span>
                                </label>
                                @else
                                <label class="excheck false"> {{$answer->answer}}
                                    <input type="checkbox" name="answers[{{$question->id}}]" value="{{$answer->id}}" checked="checked" disabled/>
                                    <span class="checkmarkEx"></span>
                                </label>
                                @endif
                                @else
                                @if($answer->true == 1 and $x==0)
                                <?php $x=1; ?>
                                <label class="excheck correct" > {{$answer->answer}}
                                    <input type="checkbox" name="answers[{{$question->id}}]" value="{{$answer->id}}" checked="checked" disabled/>
                                    <span class="checkmarkEx"></span>
                                </label>
                                @else                                
                                <label class="excheck"> {{$answer->answer}}
                                    <input type="checkbox" name="answers[{{$question->id}}]" value="{{$answer->id}}" disabled=""/>
                                    <span class="checkmarkEx"></span>
                                </label>
                                @endif
                                @endif                                
                                @endforeach
                            </div>
                            @else
                            <div class="form-group row">
                              <span class="col-md-8 col-xs-8">
                                 <p class="form-group"> 
                                     <input type="text" name="questionns[]" value="{{$question->question}}" class="form-control" required>
                                 </p>
                              </span>
                              @if(!empty($ExamStuAch->where('question_id',$question->id)->where('sol',1)->first()))
                                            <span class="col-md-1 col-xs-2 true">
                                                <label class="exam-ch ">
                                                    <input type="checkbox" name="checck[{{$question->id}}]"  checked="checked">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span> 
                              @else
                                            <span class="col-md-1 col-xs-2 false">
                                                <label class="exam-ch ">
                                                    <input type="checkbox" name="checck[{{$question->id}}]"  checked="checked" >
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                              @endif
                             </div>
                            @endif
                         @endforeach
                         
                         <div class="title"><h3>@lang("site.test result") : {{$StuExam->total}} %</h3></div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
            </div>
        </section>
        <!-- End Ex-inner -->
        @else
        <!-- Start Ex-inner<input type="checkbox" name="answers['+[i]+']" value="'+response.answers[i][j].id+'"> -->
        <section class="ex-inner body-inner">
            <div class="container">
                <div class="col-md-3 col-xs-12"></div>
                <div class="col-md-6 col-xs-12">
                    <div class="exam-block editexam">
                        <form class="bb" action="{{ route('postpublicexam')}}"  method="post" id="formm">
                        @csrf
                         <div class="col-md-12">
        					<div class="title wow fadeInUp">
        						<h3>@lang("site.Answer the following question")</h3>
        					</div>
				         </div>
                         @foreach($exam->questions as $question)
                         @if($question->type == 0)
                            <div class="form-group row">
                                <p>
                                    {{$question->question}}
                                </p>
                                @foreach($question->answers as $answer)
                                <label class="excheck"> {{$answer->answer}}
                                    <input type="radio" name="answers[{{$question->id}}]" value="{{$answer->id}}" {{ (old('answers'.$question->id) == $answer->id) ? 'checked' : '' }} required />
                                    <span class="checkmarkEx"></span>
                                </label>
                                @endforeach
                            </div>
                            @else
                            <div class="form-group row">
                              <span class="col-md-8 col-xs-8">
                                 <p class="form-group"> 
                                     <input type="text" name="questionns[]" value="{{$question->question}}" class="form-control" required>
                                 </p>
                              </span>
                                            <span class="col-md-1 col-xs-2 false">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck[{{$question->id}}]" value="0" required />
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                            <span class="col-md-1 col-xs-2 true">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck[{{$question->id}}]" value="1" required />
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span> 
                             </div>
                            @endif
                         @endforeach

                            <div class="form-group">
                                <input type="submit" id="checkBtn" value="إرسال" class="form-control btn-style" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
            </div>
        </section>
        <!-- End Ex-inner -->
        @endif

<script type="text/javascript">
// $(document).ready(function () {
//     $('#checkBtn').click(function(e) {
//       checked = $(".bb input[type=radio]:checked").length;
//       if(!checked) {
//         Swal.fire({
//           title: 'بيانات ناقصة!',
//           text: 'يجب إختيار اهتمام واحد علي الأقل من الاهتمامات',
//           icon: 'error',
//           confirmButtonText: 'موافق'
//         })
//       }else{
//         e.preventDefault();
//            $('#formm').submit(); 
//         }
//     });
// });
</script>
@endsection