@extends('layouts.app')

@section('content')

        <!-- Start Title -->
        <section class="title-s" style="background-image: url(images/111.jpg)">
            <div class="container">
                <h2>@lang("site.research_results")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                            @lang("site.Main")
                        </a>
                    </li>
                    <li>
                        <span>
                            @lang("site.research_results")
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title -->

        <!-- Start Res-pass -->
        <section class="res-pass body-inner">
            <div class="container">
                <div class="col-md-3 col-xs-12">
                    <div class="sidebar-search">
                        <!-- Start Search -->
                        <div class="search-side">
                            <form method="get" action="{{ route('search') }}">
                                <input type="search" name="search" required class="search-box" placeholder="@lang("site.search")" />
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!-- End -->
                        
                        <!-- Start Keywords -->
                        <div class="keywords">
                            <div class="title-sid">
                                <h3>@lang("site.Most_searched")</h3>
                            </div>
                            <ul>
                                @if(app()->getLocale() == 'ar')
                                 @foreach($topcourses as $top)
                                    <li>
                                        <a href="{{ url('/') }}/coursed/{{ $top->id }}/view">{{ $top->title_ar }}</a>
                                    </li>
                                 @endforeach
                                 @else
                                 @foreach($topcourses as $top)
                                    <li>
                                        <a href="{{ url('/') }}/coursed/{{ $top->id }}/view">{{ $top->title_en }}</a>
                                    </li>
                                 @endforeach
                                 @endif
                            </ul>
                        </div>
                        <!-- End -->
                    </div>
                </div>
                
                <div class="col-md-9 col-xs-12 padding">
                    <div class="content-p">
                        <!--- Start Rus-inner -->
                        <div class="col-xs-12">
                            <div class="res-inner">
                            <!-- Start col -->
                            <div class="col-sm-6 col-xs-12">
                                <div class="block-res">
                                    <span class="title-res"> @lang("site.keyword"): </span>
                                    <span class="res">{{ $search }}</span>
                                </div>
                            </div>
                            <!-- Start col -->
                            <div class="col-sm-6 col-xs-12">
                                <div class="block-res">
                                    <span class="title-res"> @lang("site.Number_of_search_results"): </span>
                                    <span class="res">{{ count($results) }}</span>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- End -->
                        @if(app()->getLocale() == 'ar')
                         @foreach($results as $top)

                         <?php
                             $service = DB::table('services')->where('id',$top->service_id)->first();
                         ?>
                        <!-- Start Col -->
                        <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" >
                                @auth
                                <a href="{{ url('/') }}/mycourse/{{ $top->id }}" class="block-section">
                                @else
                                <a href="{{ url('/') }}/mycourseafter/{{ $top->id }}" class="block-section">
                                @endauth
                           <!-- <a href="{{ url('/') }}/coursed/{{ $top->id }}/view" class="block-section"> -->
                                <div class="icon">
                                    <img src="{{ url('/') }}/public/storage/{{ $top->logo }}" />
                                </div>
                                <div class="details-block">
                                    <h3>{{ $top->title_ar }}</h3>
                                    <span class="section-name">@lang("site.service"): <i>{{ $service->title_ar }}</i></span>
                                    <br>
                                    <span class="section-name">@lang("site.num_of_search"): <i>{{ $top->num_of_search }}</i></span>

                                    <p>
                                        {{ $top->description_ar }}
                                    </p>
                                </div>
                                <div class="hover-btn">
                                    <span class="readMore">@lang("site.Go_now")</span>
                                </div>
                            </a>
                        </div>
                        <!-- End -->
                        @endforeach
                        @else

                         @foreach($results as $top)

                         <?php
                             $service = DB::table('services')->where('id',$top->service_id)->first();
                         ?>
                        <!-- Start Col -->
                        <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" >
                                @auth
                                <a href="{{ url('/') }}/mycourse/{{ $top->id }}" class="block-section">
                                @else
                                <a href="{{ url('/') }}/mycourseafter/{{ $top->id }}" class="block-section">
                                @endauth
                          <!--  <a href="{{ url('/') }}/coursed/{{ $top->id }}/view" class="block-section">-->
                                <div class="icon">
                                    <img src="{{ url('/') }}/public/storage/{{ $top->logo }}" />
                                </div>
                                <div class="details-block">
                                    <h3>{{ $top->title_en }}</h3>
                                    <span class="section-name">@lang("site.service"): <i>{{ $service->title_en }}</i></span>
                                    <p>
                                        {{ $top->description_en }}
                                    </p>
                                </div>
                                <div class="hover-btn">
                                    <span class="readMore">@lang("site.Go_now")</span>
                                </div>
                            </a>
                        </div>
                        <!-- End -->
                        @endforeach

                        @endif

                    </div>
                </div>
            </div>
        </section>
        <!-- End Res-pass -->
@endsection