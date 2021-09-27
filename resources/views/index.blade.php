@extends('layouts.app')

@section('content')
<?php $topmenus = DB::table('topmenus')->get(); ?>
        <!-- Start Slider -->
        <section class="slider-n">
            <div class="slider-home owl-carousel owl-theme">
            @for ($i = 0; $i <count($slide_img); $i++)
                <div class="item">
                    <div class="img" style="background-image: url({{ $slide_img[$i] }})"></div>
                </div>
            @endfor
            </div>
        </section>
        <!-- End Slider -->
        
        <!-- Start Search -->
        <section class="search-n">
            <div class="container">
                <div class="col-md-6 col-xs-12">
                    <div class="text-search">
                        <h1 class=" wow fadeInRight" data-wow-duration="1.1s" data-wow-delay=".3s">@lang("site.name2_us")</h1>
                        <h4 class=" wow fadeInRight" data-wow-duration="1.1s" data-wow-delay=".6s">@lang("site.hint2_us")</h4>
                    </div>
                    <div class="search-wrapper wow fadeInRight" data-wow-duration="1.1s" data-wow-delay=".9s">
                       <form method="get" action="{{ route('search') }}">
                            <i class="fa fa-search"></i>
                            <input type="text" name="search" required class="search-box" placeholder="@lang("site.wha_do_you_want_to_learn")" />
                            <button class="close-icon" type="reset"><i class="fa fa-times"></i></button>
                            <input type="submit" value="@lang("site.Search")" class="btn-style" />
                        </form>
                    </div>
                    <div class="span-search wow fadeInRight" data-wow-duration="1.1s" data-wow-delay="1.1s">
                        <span>@lang("site.Most_searched")&nbsp;:&nbsp; 
                        

                         
                    @if(app()->getLocale() == 'ar')
                        
                        @foreach($topcourses as $top) 
                           @auth
                           <a href="{{ url('/') }}/mycourse/{{ $top->id }}"><span>{{ $top->title_ar }}</span></a>&nbsp; ,
                           @else
                           <a href="{{ url('/') }}/mycourseafter/{{ $top->id }}"><span>{{ $top->title_ar }}</span></a>&nbsp; ,
                           @endauth
                        @endforeach 
                        @else
                        @foreach($topcourses as $top) 
                           @auth
                           <a href="{{ url('/') }}/mycourse/{{ $top->id }}"><span>{{ $top->title_en }}</span></a>&nbsp; ,
                           @else
                           <a href="{{ url('/') }}/mycourseafter/{{ $top->id }}"><span>{{ $top->title_en }}</span></a>&nbsp; ,
                           @endauth
                        @endforeach 
                        @endif 
                    ..</span>
                    </div>
                </div>
                
                <div class="col-md-6 col-xs-12"></div>
            </div>
        </section>
        <!-- End Search -->
        
        <!-- Start Sections-all -->
        <section class="sections-all">
            <div class="container">
                <div class="col-md-12">
                    <div class="title wow fadeInUp">
                        <h3>@lang("site.Browse_sections") </h3>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
                    <a href="{{ route('courses') }}" class="block-section">
                        <div class="icon">
                        @if(!empty($topmenus[0]))
                            <img src="{{ url('/') }}/public/storage/{{ $topmenus[2]->logo }}" />
                        @else
                           <img src="{{ url('/') }}/public/storage/{{ $info->logo }}" />
                        @endif
                        </div>
                        <div class="details-block">
                         <h3>@lang("site.Training_Programs")</h3>
                            <p>
                                @if(!empty($topmenus[2]))
                                    {{ $topmenus[2]->desc }}
                                @else
                                   لا توجد تفاصيل
                                @endif
                            </p>   
                                                </div>
                        <div class="hover-btn">
                            <span class="readMore">@lang("site.Go_now")</span>
                        </div>
                    </a>
                </div>
 
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
                    <a href="{{ route('exam') }}" class="block-section">
                        <div class="icon">
                        @if(!empty($topmenus[1]))
                            <img src="{{ url('/') }}/public/storage/{{ $topmenus[1]->logo }}" />
                        @else
                           <img src="{{ url('/') }}/public/storage/{{ $info->logo }}" />
                        @endif
                        </div>
                        <div class="details-block">
                         <h3>@lang("site.Testing_Center")</h3>
                            <p>
                                @if(!empty($topmenus[1]))
                                    {{ $topmenus[1]->desc }}
                                @else
                                   لا توجد تفاصيل
                                @endif
                            </p>   
                                                </div>
                        <div class="hover-btn">
                            <span class="readMore">@lang("site.Go_now")</span>
                        </div>
                    </a>
                </div>
                 <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
                    <a href="{{ route('specializedServices') }}" class="block-section">
                        <div class="icon">
                        @if(!empty($topmenus[2]))
                            <img src="{{ url('/') }}/public/storage/{{ $topmenus[0]->logo }}" />
                        @else
                           <img src="{{ url('/') }}/public/storage/{{ $info->logo }}" />
                        @endif
                        </div>
                        <div class="details-block">
                         <h3>@lang("site.Specialized_Services")</h3>
                            <p>
                                @if(!empty($topmenus[0]))
                                    {{ $topmenus[0]->desc }}
                                @else
                                   لا توجد تفاصيل
                                @endif
                            </p>   
                                                </div>
                        <div class="hover-btn">
                            <span class="readMore">@lang("site.Go_now")</span>
                        </div>
                    </a>
                </div>               

                <!-- End -->
               {{-- @foreach($services as $service)
                <!-- Start Col -->
                <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
                    <a href="{{ url('/') }}/service/{{ $service->id }}/view" class="block-section">
                        <div class="icon">
                            <img src="{{ url('/') }}/public/storage/{{ $service->logo }}" />
                        </div>
                        <div class="details-block">
                         @if(app()->getLocale() == 'ar')
                            <h3>{{ $service->title_ar }}</h3>
                            <p>
                               {{ $service->description_ar }}
                            </p>   

                         @else
                            <h3>{{ $service->title_en }}</h3>
                            <p>
                               {{ $service->description_en }}
                            </p>
                        @endif
                        </div>
                        <div class="hover-btn">
                            <span class="readMore">@lang("site.Go_now")</span>
                        </div>
                    </a>
                </div>
                <!-- End -->
                @endforeach --}}

                <!-- End
                <div class="col-xs-12">
                    <a href="{{ url('/') }}/moreservices" class="btn-style wow fadeInDown">@lang("site.Find_out_more")</a>
                </div> -->
            </div>
        </section>
        <!-- End Sections-all -->
      



        

@endsection