@extends('layouts.app')

@section('content')

    <!--======================== Start page header =============================-->
    <section class="page_header" style="background-image: url({{url('/')}}/public/src_website/assets/img/hero.png);">
        <div class="container">
            <div class="content">
                <h4 class="title"> @lang("site.common_questions")</h4>
                <div class="history">
                    <a href="{{url('/')}}" class="home">@lang('site.Main')</a>
                    <span class="break"></span>
                    <h5 class="page_name">@lang("site.common_questions") </h5>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End page header =============================-->
    <!-- ==================== Start common questions page =================== -->
    <section class="advices_page">
        <div class="container">
            <div class="advices_content">
            @if(!empty($commonquestion))
                <div class="box">
                    <div class="head">
                        <h5>{{$commonquestion->question}}</h5>
                        <span class="chevron"><i class="fal fa-plus"></i></span>
                    </div>
                    <div class="content">
                        <p>
                        {{$commonquestion->solution}}
                        </p>
                    </div>
                </div>
             @endif
             @foreach($questions as $question)
                <div class="box">
                    <div class="head">
                        <h5>{{$question->question}}</h5>
                        <span class="chevron"><i class="fal fa-plus"></i></span>
                    </div>
                    <div class="content">
                        <p>
                        {{$question->solution}}
                        </p>
                    </div>
                </div>
             @endforeach
              
            </div>
        </div>
        <div class="animate-group">
            <img class="shape-1 move-1" src="{{url('/')}}/public/src_website/assets/img/shapes/01.png" alt="">
            <img class="shape-2 move-2" src="{{url('/')}}/public/src_website/assets/img/shapes/02.png" alt="">
            <img class="shape-3 rotate" src="{{url('/')}}/public/src_website/assets/img/shapes/03.png" alt="">
            <img class="shape-4 move-3" src="{{url('/')}}/public/src_website/assets/img/shapes/04.png" alt="">
            <img class="shape-5 move-2" src="{{url('/')}}/public/src_website/assets/img/shapes/05.png" alt="">
        </div>
    </section>
    <!-- ==================== End common questions page =================== -->



@endsection