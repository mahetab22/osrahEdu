@extends('layouts.app')

@section('content')


        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
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
                <div class="col-xs-12">
                    <ul class="nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#ds1">@lang("site.about_th_course")</a></li>
                        <li><a data-toggle="tab" href="#ds2">@lang("site.About_th_supervisor")</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 padding">
                    <div class="tab-content">
                        <!-- Start Ds1 -->
                        <div id="ds1" class="tab-pane fade in active">
                            <!-- Start Col -->
                            <div class="col-md-6 col-xs-12">
                                <div class="all-deta">
                       @if(app()->getLocale() == 'ar')
                                    <h2>{{ $cour->title_ar }}</h2>
                                    <p>
                                        {{ $cour->description_ar }}
                                    </p>

                                    <ul>
                                        <li>
                                             {{ $cour->feature1 }}
                                        </li>
                                        <li>
                                             {{ $cour->feature2 }}
                                        </li>
                                        <li>
                                             {{ $cour->feature3 }}
                                        </li>
                                    </ul>


                         @else
                                    <h2>{{ $cour->title_en }}</h2>
                                    <p>
                                        {{ $cour->description_en }}
                                    </p>
                       

                                    <ul>
                                        <li>
                                             {{ $cour->feature1_en }}
                                        </li>
                                        <li>
                                             {{ $cour->feature2_en }}
                                        </li>
                                        <li>
                                             {{ $cour->feature3_en }}
                                        </li>
                                    </ul>
                                     @endif
                                     @auth  
                                    <a href="{{ route('courses') }}" class="btn btn-style">@lang("site.Register_for_the_course")</a>
                                    @else
                                    <a href="{{ route('registerorlogin') }}" class="btn btn-style">@lang("site.Register_for_the_course")</a>
                                    @endif
                                    
                                </div>
                            </div>
                            <!-- End -->
                            <!-- Start Col -->
                            <div class="col-md-6 col-xs-12">
                                <div class="img-cur">
                                <?php echo($cour->link) ?>
                                    <!--<div class="img" style="background-image: url(images/slider1.png)"></div>
                                    <iframe width="700" height="450" src="{{ $cour->link }}" frameborder="0" allowfullscreen></iframe>
                                    -->
                                </div>
                            </div>
                            <!-- End -->
                        </div>
                        <!-- End -->
                        
                        <!-- Start Ds2 -->
                        <div id="ds2" class="tab-pane fade">
                            <div class="details-t">

                                <div class="col-md-4 col-xs-12">
                                    <div class="img-t">
                                        <div class="img">
                                            <img src="{{ url('/') }}/public/storage/{{ $cour->avatar }}" />
                                        </div>
                                        <div class="name-t">
                                            <h5>{{ $cour->name }}</h5>
                                            @if(app()->getLocale() == 'ar')
                                            <span>{{ $service->title_ar }}</span>
                                             @else
                                            <span>{{ $service->title_en }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-xs-12">
                                    <div class="details-t">
                                        <h5>@lang("site.Trainer_Profile")</h5>
                                        <p>
                                            {{ $cour->profile }}
                                        </p>
                                        <h5>@lang("site.skills")</h5>
                                        <ul>
                                            <li>
                                                {{ $cour->skill1 }}
                                            </li>
                                            <li>
                                                {{ $cour->skill2 }}
                                            </li>
                                            <li>
                                                {{ $cour->skill3 }}
                                            </li>
                                        </ul>
                                        <h5>@lang("site.To_communicate")</h5>
                                        <ul class="social-t">
                                            <li>
                                                <a href="{{ $cour->fb }}">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ $cour->tw }}">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ $cour->inst }}">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ $cour->google }}">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End Courses-inner -->
        

@endsection