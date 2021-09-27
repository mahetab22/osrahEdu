@extends('layouts.app')

@section('content')
        <?php
        $excourses=App\Course::get();
        $publicexams=App\Exam::where('user_id','!=',null)->where('view',1)->get();
        ?>
        
        <!-- Start Title -->
            <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
                <div class="container">
                    <h2>  @lang("site.Test Center")</h2>
                    <ul>
                        <li>
                            <a href="{{ route('/') }}">
                               @lang("site.Main")
                            </a>
                        </li>
                        <li>
                            <span>
                                @lang("site.Test Center")
                            </span>
                        </li>
                    </ul>
                </div>
            </section>
        <!-- End Title -->
        
		<!-- Start Sections-all -->
		<section class="sections-all">
			<div class="container">
				<div class="col-md-12">
					<div class="title wow fadeInUp">
						<h3>@lang("site.General tests")</h3>
					</div>
				</div>
                
                @foreach($excourses as $course)
                @if(!empty($course->examcodes[0]) and !empty($course->exams->where('publicexam',1)->first()))
				<!-- Start Col -->
				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
					<a class="block-section drug" path="{{$course->id}}" data-toggle="modal" data-target="#check-exam-code">
						<div class="icon">
							<img src="{{ url('/') }}/public/storage/{{ $course->logo }}" />
						</div>
						<div class="details-block">
							<h3>{{$course->title_ar}}</h3>
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
              @elseif(!empty($course->exams->where('publicexam',1)->first()))
				<!-- Start Col -->
				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
					<a class="block-section" href="{{ url('/') }}/examcourse/{{ $course->id }}">
						<div class="icon">
							<img src="{{ url('/') }}/public/storage/{{ $course->logo }}" />
						</div>
						<div class="details-block">
							<h3>{{$course->title_ar}}</h3>
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
               @endif
            @endforeach
            
              @foreach($publicexams as $publicexam)
              @if(!empty($publicexam->code))
				<!-- Start Col -->
				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
					<a class="block-section drug" path="{{$publicexam->id}}" data-toggle="modal" data-target="#checkpubliccode">
						<div class="icon">
							<img src="{{ url('/') }}/public/storage/{{ $publicexam->logo }}" />
						</div>
						<div class="details-block">
							<h3>{{$publicexam->title}}</h3>
                            <p>
                                
                            </p>  
						</div>
						<div class="hover-btn">
							<span class="readMore">@lang("site.Go_now")</span>
						</div>
					</a>
				</div>
				<!-- End -->
                @else
                
				<!-- Start Col -->
				<div class="col-md-4 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
					<a class="block-section" href="{{ url('/') }}/exambyid/{{ $publicexam->id }}">
						<div class="icon">
							<img src="{{ url('/') }}/public/storage/{{ $publicexam->logo }}" />
						</div>
						<div class="details-block">
							<h3>{{$publicexam->title}}</h3>
                            <p>

                            </p>
						</div>
						<div class="hover-btn">
							<span class="readMore">@lang("site.Go_now")</span>
						</div>
					</a>
				</div>
				<!-- End -->
                
                @endif
                @endforeach
			</div>
		</section>
		<!-- End Sections-all -->
        <!-- End Ex-inner -->

@endsection