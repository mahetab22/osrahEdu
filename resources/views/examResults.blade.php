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
        @if(!empty($ExamStuAch[0]) and !empty($StuExam))
        <!-- Start Ex-inner<input type="checkbox" name="answers['+[i]+']" value="'+response.answers[i][j].id+'"> -->
        <section class="ex-inner body-inner">
            <div class="container">
                <div class="col-md-3 col-xs-12"></div>
                <div class="col-md-6 col-xs-12">
                    <div class="exam-block">
                        <div class="col-md-12">
        					<div class="title wow fadeInUp">
        						<h3>@lang("site.Review the questions and answers")</h3>
        					</div>
				         </div>
                         
                        <div class="title"><p>@lang("site.The exam started at"): {{$StuExam->created_at->format('H:i:s a')}}</p> <p>@lang("site.And I finish at the hour"):{{$ExamStuAch->last()->created_at->format('H:i:s a')}}</p></div>
                         @foreach($exam->questions as $question)
                         <?php $x=0; ?>                         
                            <div class="form-group">
                                <p>
                                    {{$question->question}}
                                </p>
                                @foreach($question->answers as $answer)                             
                                @if(!empty($ExamStuAch->where('answer_id',$answer->id)->first()))
                                @if($answer->true == 1 and $x==0)
                                <?php $x=1; ?>                                
                                <label class="excheck correct" > {{$answer->answer}}
                                    <input type="checkbox" name="answers[{{$question->id}}]" value="{{$answer->id}}" checked="checked" disabled/>
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
                    <div class="exam-block">
                        <form action="{{ route('postpublicexam')}}"  method="post">
                        @csrf
                         <div class="col-md-12">
        					<div class="title wow fadeInUp">
        						<h3>@lang("site.Answer the following question")</h3>
        					</div>
				         </div>
                         @foreach($exam->questions as $question)
                            <div class="form-group">
                                <p>
                                    {{$question->question}}
                                </p>
                                @foreach($question->answers as $answer)
                                <label class="excheck"> {{$answer->answer}}
                                    <input type="radio" name="answers[{{$question->id}}]" value="{{$answer->id}}" />
                                    <span class="checkmarkEx"></span>
                                </label>
                                @endforeach
                            </div>
                         @endforeach

                            <div class="form-group">
                                <input type="submit" value="إرسال" class="form-control btn-style" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
            </div>
        </section>
        <!-- End Ex-inner -->
        @endif

@endsection