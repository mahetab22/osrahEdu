@extends('layouts.app')

@section('content')

        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
            <div class="container">
                <h2>@lang("site.common_questions")</h2>
                <ul>
                    <li>
                        <a href="index.html">
                            @lang("site.Main")
                        </a>
                    </li>
                    <li>
                        <span>
                            @lang("site.common_questions")
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title -->
        
        <!-- Start Qu-inner -->
        <section class="qu-inner body-inner">
            <div class="container">
                <div class="col-md-1 col-xs-12"></div>
                <div class="col-md-10 col-xs-12">
                    <div class="panel-group" id="accordion">

                    @if(!empty($commonquestion))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $commonquestion->id }}" aria-expanded="true">
                                        {{ $commonquestion->question }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{ $commonquestion->id }}" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    {{ $commonquestion->solution }}
                                </div>
                            </div>
                        </div>
                    @endif


                        @foreach($questions as $question)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $question->id }}" >
                                        {{ $question->question }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{ $question->id }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    {{ $question->solution }}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    
                    </div>
                </div>
                <div class="col-md-1 col-xs-12"></div>
            </div>
        </section>
        <!-- End Qu-inner -->

@endsection