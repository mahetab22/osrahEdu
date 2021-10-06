@extends('layouts.app')
@section('title')
<title>@lang('site.news')</title>
@endsection
@section('content')
   <!--======================== Start page header =============================-->
   <section class="page_header" style="background-image: url({{url('/')}}/public/src_website/assets/img/hero.png);">
        <div class="container">
            <div class="content">
                <h4 class="title">@lang('site.news')</h4>
                <div class="history">
                    <a href="{{url('/')}}" class="home">@lang('site.Main')</a>
                    <span class="break"></span>
                    <h5 class="page_name">@lang('site.news')</h5>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End page header =============================-->

    <!--==================== Start news =======================-->
    <section class="new_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="news_side">
                        @foreach($news->take(4) as $new)
                        <div class="box">
                            <a href="{{url('/')}}/single/{{$new->id}}/news" class="new_link">
                                <div class="image"><img src="{{url('/')}}/{{$new->logo}}" alt="{{$new->title}}"></div>
                                <div class="info">
                                    <h6 class="text-ellipsis">{{$new->title}}</h6>
                                    <div class="date">
                                        <i class="fal fa-calendar-alt"></i>
                                        <span>{{$new->created_at->year}}/{{$new->created_at->month}}/{{$new->created_at->day}}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                         @endforeach
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="main_news owl-carousel owl-theme">
                    @foreach($news->take(10) as $new)
                        <div class="item">
                            <a href="{{url('/')}}/single/{{$new->id}}/news" class="box_new">
                                <img src="{{url('/')}}/{{$new->logo}}" alt="{{$new->title}}">
                                <div class="info">
                                    <h5>{{$new->title}}</h5>
                                    <p class="text-ellipsis">{{$new->short_desc}}</p>
                                </div>
                            </a>
                        </div>
                      @endforeach  
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End news =======================-->
 <!--==================== Start similar news =======================-->
 <section class="other_news">
        <div class="slick-slider">
            @foreach($news as $new)
            <div class="item_carousel">
                <a href="{{url('/')}}/single/{{$new->id}}/news" class="box">
                    <div class="image"><img src="{{url('/')}}/{{$new->logo}}" alt="{{$new->title}}"></div>
                    <h6>{{$new->title}} </h6>
                </a>
            </div>
         @endforeach
        </div>
    </section>
    <!--==================== End similar news =======================-->


@endsection