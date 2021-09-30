@extends('layouts.app')

@section('content')

        <!-- Start Title -->
        @if(!empty($slide_image))
        <section class="title-s" style="background-image: url({{ $slide_image }})">
        @else
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
        @endif
            <div class="container">
                <h2>@lang("site.Training_Programs")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                            @lang("site.Main")
                        </a>
                    </li>
                    <li>
                        <span>
                            @lang("site.Training_Programs")
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
                        <ul class="nav nav-tabs list" id="myTab" role="tablist">
                         @if(app()->getLocale() == 'ar') 
                        @foreach($services as $service)
                        <li role="presentation"><a data-toggle="tab" href="#cu{{ $service->id }}">{{ $service->title_ar }}</a></li>
                         @endforeach
                         @else
                        @foreach($services as $service)
                        <li role="presentation"><a data-toggle="tab" href="#cu{{ $service->id }}">{{ $service->title_en }}</a></li>
                         @endforeach
                        @endif
                    </ul>
                </div>
             </div>
                <div class="col-xs-12 padding">
                    @if(app()->getLocale() == 'ar') 
                    <div class="tab-content">

                        <!-- Start Cu1 -->
                        
                        @foreach($services as $service)
                        <div role="tabpanel" id="cu{{ $service->id }}" class="tab-pane fade in active">

                                <?php   
                                $courses = DB::table('courses')->where('service_id',$service->id)->where('activate',1)->get();
                                ?>
                        @foreach($courses as $course)
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" >
                                @auth
                                <a href="{{ url('/') }}/mycourse/{{ $course->id }}" class="block-section">
                                @else
                                <a href="{{ url('/') }}/mycourseafter/{{ $course->id }}" class="block-section">
                                @endauth
                                    <div class="icon">
                                        <img src="{{ url('/') }}/public/storage/{{ $course->logo }}" />
                                        <div class="live">
                                        @if($course->online == 1)
                                            <span>مباشر</span>
                                            @else
                                            <span>تعلم ذاتي</span>
                                            @endif
                                        </div>
                                        @if($course->price == 0)
                                        <div class="price-n">مجاني</div>
                                        @else
                                        <div class="price-n">{{$course->price}}&nbsp; ريال</div>
                                        @endif
                                        
                                    </div>
                                    <div class="details-block">
                                        <div class="date-block">
                                           <span>
                                           @lang("site.date") : {{ $course->from_date }}
                                        </span>
                                        </div>
                                        <div class="time-cour">
                                            <span>مدة الدورة: <b>{{$course->duration}}</b></span>
                                        </div>
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
                        
                        @foreach($services as $service)
                        <div role="tabpanel" id="cu{{ $service->id }}" class="tab-pane fade in active">

                                <?php   
                                $courses = DB::table('courses')->where('service_id',$service->id)->where('activate',1)->get();
                                ?>
                        @foreach($courses as $course)
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn">
                                @auth
                                <a href="{{ url('/') }}/mycourse/{{ $course->id }}" class="block-section">
                                @else
                                <a href="{{ url('/') }}/mycourseafter/{{ $course->id }}" class="block-section">
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