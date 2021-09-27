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
                        <li><a data-toggle="tab" href="#more">@lang("site.about_th_course")</a></li>
                        <li><a data-toggle="tab" href="#pg2">@lang("site.About_the_content")</a></li>
                       <!-- <li class="active"><a data-toggle="tab" href="#pg1">@lang("site.about_th_course")</a></li>
                        <li><a data-toggle="tab" href="#pg2">@lang("site.About_the_content")</a></li>
                        <li><a data-toggle="tab" href="#ds2">@lang("site.About_th_supervisor")</a></li>
                        <li><a data-toggle="tab" href="#more">@lang("site.additional_information")</a></li>-->
                    </ul>
                </div>
                <div class="col-xs-12 padding">
                    <div class="tab-content">
                        <!-- Start Pg1 -->
                        <div id="pg1" class="tab-pane fade">
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
                                     <a href="#" class="btn btn-style">التسجيل بالدورة</a>
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
                         <!-- Start pg2 -->
                        <div id="pg2" class="tab-pane fade">
                            <div class="list-t">
                            @if(app()->getLocale() == 'ar')                                
                                <div class="col-xs-12">
                                    <div class="panel-group">
                                    @foreach($levels as $level)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse{{ $level->id }}">{{ $level->title_ar }}</a>
                                                </h4>
                                            </div>
                                           <?php   
                                                $lessons = DB::table('lessons')->where('level_id',$level->id)->get();
                                            ?>
                                           
                                            <div id="collapse{{ $level->id }}" class="panel-collapse collapse">
                                                @foreach($lessons as $lesson)
                                                <a href="{{ $lesson->link }}" class="item-cu">
                                                    <i class="fa fa-play"></i>
                                                    {{ $lesson->title_ar }}
                                                    <span class="time-s">{{ $lesson->duration }}</span>
                                                </a>
                                                
                                                @endforeach
                                                <a href="#" class="item-cu">
                                                    <i class="fas fa-book-dead"  style="font-size: 17px; !important"></i>
                                                    الاختبار
                                                    <span class="time-s"></span>
                                                </a>
                                                <a href="#" class="item-cu">
                                                    <i class="far fa-file-pdf" style="font-size: 17px; !important"></i>
                                                    ملف PDF
                                                    <span class="time-s"></span>
                                                </a>
                                            </div> 
                                        </div>
                                     @endforeach
                                    </div>
                                </div>
                                @else
                                <div class="col-xs-12">
                                    <div class="panel-group">
                                    @foreach($levels as $level)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse{{ $level->id }}">{{ $level->title_en }}</a>
                                                </h4>
                                            </div>
                                           <?php   
                                                $lessons = DB::table('lessons')->where('level_id',$level->id)->get();
                                            ?>
                                           
                                            <div id="collapse{{ $level->id }}" class="panel-collapse collapse">
                                                @foreach($lessons as $lesson)
                                                <a href="{{ $lesson->link }}" class="item-cu">
                                                    <i class="fa fa-play"></i>
                                                    {{ $lesson->title_en }}
                                                    <span class="time-s">{{ $lesson->duration }}</span>
                                                </a>
                                                 @endforeach
                                            </div> 
                                        </div>
                                     @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- End -->                       
                        <!-- Start pg2 
                        <div id="pg2" class="tab-pane fade">
                            <div class="list-t">
                                @if(app()->getLocale() == 'ar')
                                @foreach($levels as $level)
                                <div class="col-xs-12">
                                    <h3>{{ $level->title_ar }}</h3>
                                    <?php   
                                        $lessons = DB::table('lessons')->where('level_id',$level->id)->get();
                                    ?>
                                    @foreach($lessons as $lesson)
                                    <a href="{{ $lesson->link }}" class="item-cu">
                                        <i class="fa fa-play"></i>
                                        {{ $lesson->title_ar }}
                                        <span class="time-s">{{ $lesson->duration }}</span>
                                    </a>
                                    @endforeach
                                </div>
                                @endforeach
                                @else
                                @foreach($levels as $level)
                                <div class="col-xs-12">
                                    <h3>{{ $level->title_en }}</h3>
                                    <?php   
                                        $lessons = DB::table('lessons')->where('level_id',$level->id)->get();
                                    ?>
                                    @foreach($lessons as $lesson)
                                    <a href="{{ $lesson->link }}" class="item-cu">
                                        <i class="fa fa-play"></i>
                                        {{ $lesson->title_en }}
                                        <span class="time-s">{{ $lesson->duration }}</span>
                                    </a>
                                    @endforeach
                                </div>
                                @endforeach
                                @endif
                            </div>
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
                                            @if(!empty($service))
                                            @if(app()->getLocale() == 'ar')
                                            <span>{{ $service->title_ar }}</span>
                                             @else
                                            <span>{{ $service->title_en }}</span>
                                            @endif
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
                                        <h5></h5>
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
                        
                        
                        <!-- Start Ds1 -->
                        <div id="more" class="tab-pane fade in active">
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
                                </div>
                            </div>
                            <!-- End -->
                            <!-- Start Col -->
                            <div class="col-md-6 col-xs-12">
                                <div class="img-cur">
                                    <img class="img" src="{{ url('/') }}/public/storage/{{ $cour->logo }}" />
                                    {{-- <div class="img" style="background-image: href({{ asset('public/storage/'.$cour->logo) }})"></div> --}}
                                </div>
                            </div>
                            <!-- End -->
                        </div>
                        <!-- End -->
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- End Courses-inner -->
        

@endsection