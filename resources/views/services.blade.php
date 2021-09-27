@extends('layouts.app')

@section('content')

		<!-- Start Title -->
        @if(!empty($slide_image))
        <section class="title-s" style="background-image: url({{ $slide_image }})">
        @else
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
        @endif
            @if($toggel==2)
		    <div class="container">
		        <h2>@lang("site.departments")</h2>
		        <ul>
		            <li>
                        <a href="{{ route('/') }}">
                            @lang("site.Main")
                        </a>
		            </li>
		            <li>
		                <span> 
		                   @lang("site.departments")
		                </span>
		            </li>
		        </ul>
		    </div>
            @else
            <div class="container">
                <h2>@lang("site.departments")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                            @lang("site.Main")
                        </a>
                    </li>
                    <li>
                        <span> 
                           @lang("site.departments")
                        </span>
                    </li>
                </ul>
            </div>
            @endif
		</section>
		<!-- End Title -->
		
		<!-- Start Courses-inner -->
        <section class="courses-inner body-inner">
            <div class="container">
                <div class="col-xs-12">
                  @if(app()->getLocale() == 'ar') 
                        @foreach($services as $service)
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn">
                                <a href="{{ url('/') }}/service/{{ $service->id }}/view" class="block-section">
                                    <div class="icon">
                                        <img src="{{ url('/') }}/public/storage/{{ $service->logo }}" />
                                    </div>
                                    <div class="details-block">
                                        <h3>{{ $service->title_ar }}</h3>
                                        <p>
                                           {{ $service->description_ar }}
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
                        @foreach($services as $service)
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn">
                                <a href="{{ url('/') }}/service/{{ $service->id }}/view" class="block-section">
                                    <div class="icon">
                                        <img src="{{ url('/') }}/public/storage/{{ $service->logo }}" />
                                    </div>
                                    <div class="details-block">
                                        <h3>{{ $service->title_en }}</h3>
                                        <p>
                                           {{ $service->description_en }}
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
        </section>
		<!-- End Courses-inner -->


@endsection