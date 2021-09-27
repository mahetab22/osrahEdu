@extends('layouts.app')
@section('title')
<title>{{$book->title}}</title>
@endsection
@section('content')
    <!--======================== Start page header =============================-->
    <section class="page_header" style="background-image: url({{url('/')}}/{{$book->image}});">
        <div class="container">
            <div class="content">
                <h4 class="title">{{$book->title}}</h4>
                <div class="history">
                    <a href="{{url('/')}}" class="home">@lang('site.Main')</a>
                    <span class="break"></span>
                    <a href="{{url('/')}}/books" class="home">@lang('site.library')</a>
                    <span class="break"></span>
                    <h5 class="page_name">{{$book->title}}</h5>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End page header =============================-->

    <!--==================== Start library =======================-->
    <section class="single_book_page">
        <div class="container">
            <div class="book_details">
                <h5 class="title">{{$book->title}}</h5>
                <div class="image"><img src="{{url('/')}}/{{$book->image}}" alt="{{$book->title}}"></div>
                <div class="details_book">
                    <span class="item"><i class="fal fa-calendar-alt"></i>{{$book->created_at->year}}/{{$book->created_at->month}}/{{$book->created_at->day}}</span>
                    <span class="item"><i class="fal fa-eye"></i>({{$book->show}})</span>
                    <span class="item"><a href="{{url('/')}}/{{$book->pdf}}" download><i class="fal fa-download"></i>تحميل الكتاب </a></span>
                </div>
                <div class="info">
                    <p>{{$book->desc}}</p>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End library =======================-->


@endsection