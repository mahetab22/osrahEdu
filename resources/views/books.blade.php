@extends('layouts.app')
@section('title')
<title>@lang('site.library')</title>
@endsection
@section('content')
  <!--======================== Start page header =============================-->
  <section class="page_header" style="background-image: url({{url('/')}}/public/src_website/assets/img/hero.png);">
        <div class="container">
            <div class="content">
                <h4 class="title">@lang('site.library')</h4>
                <div class="history">
                    <a href="{{url('/')}}" class="home">@lang('site.Main')</a>
                    <span class="break"></span>
                    <h5 class="page_name">@lang('site.library')</h5>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End page header =============================-->

    <!--==================== Start library =======================-->
    <section class="library_section library_page">
        <div class="container">
            <div class="row">
                @foreach($books as $book)
                <div class="col-lg-4 col-md-6">
                    <div class="box_lib">
                        <div class="image">
                        <a href="{{url('/')}}/single/{{$book->id}}/books">    
                        <img src="{{url('/')}}/{{$book->image}}" alt="{{$book->title}}">
                       </a>
                        </div>
                        <div class="info">
                            <div class="details_book">
                                <span class="item"><i class="fal fa-calendar-alt"></i>{{$book->created_at->year}}/{{$book->created_at->month}}/{{$book->created_at->day}}</span>
                                <span class="item"><i class="fal fa-eye"></i>({{$book->show}})</span>
                                <span class="item"><a href="{{url('/')}}/{{$book->pdf}}" download><i class="fal fa-download"></i>تحميل الكتاب </a></span>
                            </div>
                            <h5 class="name">{{$book->title}}</h5>
                            <p class="desc text-ellipsis">{{$book->desc}}</p>
                        </div>
                    </div>
                </div>
           
               @endforeach
            </div>
        </div>
    </section>
    <!--==================== End library =======================-->


@endsection
