@extends('layouts.app')

@section('content')

        
        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
            <div class="container">
                <h2>@lang("site.courses")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                            @lang("site.Main")
                        </a>
                    </li>
                    <li>
                        <span>
                            @lang("site.courses")
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title -->
        
        <!-- Start Courses-inner -->
        <section class="courses-inner body-inner">
            <div class="container">
              
                <div class="col-xs-12 style-nav">
                    <div class="scroller scroller-left"><i class="fa fa-angle-left"></i></div>
                      <div class="scroller scroller-right"><i class="fa fa-angle-right"></i></div>
                      <div class="wrapper">
                        <ul class="nav nav-tabs list" id="myTab">
                         @if(app()->getLocale() == 'ar') 
                        <li class="active"><a data-toggle="tab" href="#cu1">{{ $serv->title_ar }}</a></li>
                        @foreach($services as $service)
                        <li><a data-toggle="tab" href="#cu{{ $service->id }}">{{ $service->title_ar }}</a></li>
                         @endforeach
                         @else
                        <li class="active"><a data-toggle="tab" href="#cu1">{{ $serv->title_en }}</a></li>
                        @foreach($services as $service)
                        <li><a data-toggle="tab" href="#cu{{ $service->id }}">{{ $service->title_en }}</a></li>
                         @endforeach
                        @endif
                    </ul>
                </div>
             </div>
                <div class="col-xs-12 padding">
                    @if(app()->getLocale() == 'ar') 
                    <div class="tab-content">

                        <!-- Start Cu1 -->
                        <div id="cu1" class="tab-pane fade in active">
                            <!-- Start Col -->
                        @foreach($cours as $course)
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn">
                                @auth
                                <a href="{{ url('/') }}/coursed/{{ $course->id }}/view" class="block-section">
                                @else
                                <a href="{{ url('/') }}/course/{{ $course->id }}/view" class="block-section">
                                @endauth
                                    <div class="icon">
                                        <img src="{{ url('/') }}/public/storage/{{ $course->logo }}" />
                                    </div>
                                    <div class="details-block">
                                        <h3>{{ $course->title_ar }}</h3>
                                        <p>
                                           {{ $course->description_ar }}
                                        </p>  
                                    </div>
                                    <div class="hover-btn">
                                        <span class="readMore">@lang("site.Go_now")</span>
                                    </div>
                                </a>
                            </div>
                            <!-- End -->
                         @endforeach
                            <!-- End -->

                        </div>
                        <!-- End -->

                        <!-- Start Cu1 -->
                        
                        @foreach($services as $service)
                        <div id="cu{{ $service->id }}" class="tab-pane fade in active">

                                <?php   
                                $courses = DB::table('courses')->where('service_id',$service->id)->get();
                                ?>
                        @foreach($courses as $course)
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" >
                                @auth
                                <a href="{{ url('/') }}/coursed/{{ $course->id }}/view" class="block-section">
                                @else
                                <a href="{{ url('/') }}/course/{{ $course->id }}/view" class="block-section">
                                @endauth
                                    <div class="icon">
                                        <img src="{{ url('/') }}/public/storage/{{ $course->logo }}" />
                                    </div>
                                    <div class="details-block">
                                        <h3>{{ $course->title_ar }}</h3>
                                        <p>
                                           {{ $course->description_ar }}
                                        </p>  
                                    </div>
                                    <div class="hover-btn">
                                        <span class="readMore">@lang("site.Go_now")</span>
                                    </div>
                                </a>
                            </div>
                            <!-- End -->
                         @endforeach
                        </div>
                         @endforeach
                        <!-- End -->
                    </div>
                         @else
                    <div class="tab-content">

                        <!-- Start Cu1 -->
                        <div id="cu1" class="tab-pane fade in active">
                            <!-- Start Col -->
                        @foreach($cours as $course)
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" >
                                 @auth
                                <a href="{{ url('/') }}/coursed/{{ $course->id }}/view" class="block-section">
                                @else
                                <a href="{{ url('/') }}/course/{{ $course->id }}/view" class="block-section">
                                @endauth
                                    <div class="icon">
                                        <img src="{{ url('/') }}/public/storage/{{ $course->logo }}" />
                                    </div>
                                    <div class="details-block">
                                        <h3>{{ $course->title_en }}</h3>
                                        <p>
                                           {{ $course->description_en }}
                                        </p>  
                                    </div>
                                    <div class="hover-btn">
                                        <span class="readMore">@lang("site.Go_now")</span>
                                    </div>
                                </a>
                            </div>
                            <!-- End -->
                         @endforeach
                            <!-- End -->

                        </div>
                        <!-- End -->

                        <!-- Start Cu1 -->
                        
                        @foreach($services as $service)
                        <div id="cu{{ $service->id }}" class="tab-pane fade in active">

                                <?php   
                                $courses = DB::table('courses')->where('service_id',$service->id)->get();
                                ?>
                        @foreach($courses as $course)
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn">
                                @auth
                                <a href="{{ url('/') }}/coursed/{{ $course->id }}/view" class="block-section">
                                @else
                                <a href="{{ url('/') }}/course/{{ $course->id }}/view" class="block-section">
                                @endauth
                                    <div class="icon">
                                        <img src="{{ url('/') }}/public/storage/{{ $course->logo }}" />
                                    </div>
                                    <div class="details-block">
                                        <h3>{{ $course->title_en }}</h3>
                                        <p>
                                           {{ $course->description_en }}
                                        </p>  
                                    </div>
                                    <div class="hover-btn">
                                        <span class="readMore">@lang("site.Go_now")</span>
                                    </div>
                                </a>
                            </div>
                            <!-- End -->
                         @endforeach
                        </div>
                         @endforeach
                        <!-- End -->
                    </div>
                        @endif
                </div>
            </div>
        </section>
        <!-- End Courses-inner -->
       

@endsection