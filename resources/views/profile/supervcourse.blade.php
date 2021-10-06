@extends('layouts.app')
@section('stylelinks')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css">
@endsection
@section('content')
   {{-- @if(isset($course->whats_link))
    <div class="wahtt">
        <!--<a href="https://api.whatsapp.com/send?phone=966500801977" target="_blank"><i class="fab fa-whatsapp"></i></a>-->
        <a href="https://chat.whatsapp.com/KlpjHQfb4dT6Yz6pWJDJMk" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
@endif--}}
    <!-- Start Courses-inner -->
    <section class="lesson-inner">
        <div class="row">
        <div class="col-md-3 col-xs-12 padding">
            <div class="sidebar-lesson">
                <div class="back-btn">
                    <a href="{{ route('/') }}">@lang("site.Return")<i class="fa fa-angle-left"></i></a>
                </div>
                <div class="name-lesson">
                    @if(app()->getLocale() == 'ar')
                        <h1>{{ $course->title_ar }}</h1>
                        <h5>{{ $course->service->title_ar }}</h5>
                    @else
                        <h1>{{ $course->title_en }}</h1>
                        <h5>{{ $course->service->title_en }}</h5>
                    @endif
                </div>
                <div class="bar-complete">
                    <h3>@lang("site.Welcome, moderator of the course")</h3>

                    @lang("site.Number of students involved") : {{ count($course->subscriptioncourses) }}

                </div>
                <hr />
                <div class="all-levels">
                    <div class="panel-group" id="accordion">
                     @if(0)
                        @if(!empty($course->streaming))
                            <div class="panel-heading streaminglink">
                                <h4 class="panel-title">
                                    <a href="{{$course->streaming->presenter_url}}" target="_blank" class="wiziq"><span> wiziq <i class="fa fa-tv"></i></span></a>
                                </h4>
                            </div>
                        @endif
                        <div class="all-buttons wizip-btn">
                        
                            <div class="big-tw-box wiziq">
                                <div class="tyuo-img">
                                    <img src="{{ url('/') }}/public/src_website/images/wiziq.svg">
                                </div>
                                <div class="tri-bs">
                                
                                        <a class="add-btn addstr" data-toggle="modal" data-target="#addstreaming">
                                            <div class="tyuo-box"> 
                                                <div class="tyuo-title">
                                                    <span class="wiziq-span">wiziq</span>
                                                    <span>@lang("site.create live streaming")</span> 
                                                </div>
                                            </div>
                                        </a>
                                        <a class="add-btn cancelstr" data-toggle="modal" data-target="#cancelstreaming">
                                            <div class="tyuo-box"> 
                                                <div class="tyuo-title">
                                                    <span class="wiziq-span">wiziq</span> 
                                                    <span>@lang("site.cancel live streaming")</span>
                                                </div>
                                            </div>
                                        </a>
                                        
                                </div>
                            </div>
                            
                        </div>

                      @endif
                            @if(!empty($course->streamings_zoom[0]))
                                @if($course->streamings_zoom[0]->super_id==auth()->id())
                        <div class="panel-heading streaminglink">
                            <h4 class="panel-title">
                                <a href="{{$course->streamings_zoom[0]->presenter_url}} " class="zoom" target="_blank"><span>بث مباشر <i class="fa fa-tv"></i></span></a>
                            </h4>
                        </div>

                                    @endif
@endif
                        <div class="all-buttons zoom-btn">
                            <div class="big-tw-box">
                                <div class="tyuo-img">
                                    <img src="{{ url('/') }}/public/src_website/images/zoom.svg">
                                </div>
                                <div class="tri-bs">
                                    <a  href="https://zoom.us/oauth/authorize?response_type=code&client_id=&redirect_uri={{url('/')}}/auth" id="meeting" class="add-btn addstr" >
                                 <div class="tyuo-box"> 
                                    
                                    <div class="tyuo-title">
                                        <span class="zoom-span">zoom</span><span>انشاء زوم بث مباشر</span>
                                    </div> 
                                 </div> 
                                </a>
                                @if(!empty($course->streamings_zoom[0]))
                                      @if($course->streamings_zoom[0]->super_id==auth()->id())
                                <a  value="{{$course->streamings_zoom[0]->class_id}}"   href="https://zoom.us/oauth/authorize?response_type=code&client_id=&redirect_uri={{url('/')}}/auth" id="meeting_delete"  class="add-btn cancelstr" >
                                     <div class="tyuo-box"> 
                                        
                                        <div class="tyuo-title">
                                            <span class="zoom-span">zoom</span> <span>الغاء زوم بث مباشر</span>
                                        </div> 
                                    </div>
                                </a>
                           <input type="hidden"  id='meeting_delete_val' value="{{$course->streamings_zoom[0]->class_id}}">
    
                            @endif
                                @endif
                                </div>
                            </div>
                        </div>
                          
           
                            @if(isset($course->link_url))
                            <div class="all-buttons soci-btn">
                                <a href="{{$course->link_url }}" class="add-btn addstr" >
                                    <div class="swq-sv">

                                        <div class="wei">
                                            <span>{{$course->link_name}}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                                @endif
                        </div>
                          

                        @foreach($course->levels as $levels)
                            @if(app()->getLocale() == 'ar')
                                <div class="panel panel-default">



                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" href="#col{{$levels->id}}">{{ $levels->title_ar }} @if(0)<span>*</span>@endif</a>
                                        </h4>
                                    </div>
                                    <div id="col{{$levels->id}}" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <div class="allcourse ">
                                                <ul>
                                                    @foreach($levels->lessons as $lesson)
                                                        @if(!empty($lesson->link))
                                                            <li> <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_data" data-get_id="{{ $lesson->id }}" ><i class="far fa-play-circle"></i> {{ $lesson->title_ar }} <span>{{ $lesson->duration }} دقيقة</span></a>

                                                            </li>
                                                        @endif
                                                        @if(!empty($lesson->file))
                                                            <li>
                                                                <a href="{{ url('/') }}/public/storage/{{ $lesson->file }}" download><i class="far fa-file-pdf"></i>&nbsp;{{ $lesson->title_ar }} </a>
                                                            </li>
                                                        @endif
                                                        @if($lesson->exam)
                                                            <li>
                                                                {{-- <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $lesson->exam->id }}" >@lang("site.Lesson test") @if($levels->exam)<span>*</span>@endif</a> --}}
                                                                <a  href="{{ url('/') }}/editexamcourseby/{{ $lesson->exam->id}}" ><i class="far fa-sticky-note"></i>@lang("site.Lesson test") @if($levels->exam)<span>تعديل *</span>@endif</a>
                                                            </li>
                                                        @endif

                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" href="#col{{$levels->id}}">{{ $levels->title_en }} @if(0)<span>*</span>@endif</a>
                                        </h4>
                                    </div>
                                    <div id="col{{$levels->id}}" class="panel-collapse collapse ">
                                        <div class="panel-body">
                                            <div class="all-courd">
                                                <ul>
                                                    @foreach($levels->lessons as $lesson)
                                                        <li> <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_data" data-get_id="{{ $lesson->id }}" > {{ $lesson->title_en }} @if(0)<span>*</span>@endif</a>

                                                        </li>
                                                        @if($lesson->exam)
                                                            <li>
                                                                <a  href="{{ url('/') }}/editexamcourseby/{{ $lesson->exam->id}}" ><i class="far fa-sticky-note"></i>@lang("site.Lesson test") @if($levels->exam)<span>تعديل *</span>@endif</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($levels->exam)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a  href="{{ url('/') }}/editexamcourseby/{{ $levels->exam->id}}"  ><i class="far fa-sticky-note"></i>@lang("site.Level test") @if($levels->exam)<span>تعديل *</span>@endif</a>
                                        </h4>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if($course->exam)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a  href="{{ url('/') }}/editexamcourseby/{{ $course->exam->id}}"  ><i class="far fa-sticky-note"></i>@lang("site.Ali exam course") @if($course->exam)<span>تعديل *</span>@endif</a>
                                    </h4>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="all-buttons">
                       <a class="add-btn" data-toggle="modal" data-target="#add_link">@lang("site.add_link")</a>
                        <a class="add-btn" data-toggle="modal" data-target="#add_certificate">@lang("site.add_certificate") </a>
                        <a class="add-btn" data-toggle="modal" data-target="#add-level">@lang("site.Add a level")</a>
                        <a class="add-btn" data-toggle="modal" data-target="#add-lesson">@lang("site.Add a lesson")</a>
                        <a class="add-btn" data-toggle="modal" data-target="#add-exam">@lang("site.Add an exam")</a>
                        <a class="add-btn" data-toggle="modal" data-target="#add-exam-code">@lang("site.Add code for the test")</a>
                        <a class="add-btn" data-toggle="modal" data-target="#addsecmsag">@lang("site.open secret message")</a>
                        <a class="add-btn" data-toggle="modal" data-target="#discounts">@lang("site.Add code for discounts")</a>
                        <a class="add-btn" data-toggle="modal" data-target="#remove">حذف - وحدة / درس / إختبار</a>
                        <!--<a class="add-btn" data-toggle="modal" data-target="#addcertificate">إضافة شهادة إتمام الدورة</a>-->
                    </div>
                </div>
            </div>
        



        <div class="col-md-9 col-xs-12">
            <div class="content-lesson">

                <!-- lesson -->
                <div id="lesson">

                    <div class="new-page">
                        <div class="video-lesson">
                            <?php
                            echo($course->link);
                            ?>

                            {{-- <iframe width="560" height="315" src="{{ $course->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                        </div>
                    </div>

             

                </div>
                <!-- lesson -->

                <div class="all-details-lesson">
                    <div class="header-lesson">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#details">@lang("site.about_th_course")</a></li>
                            <li><a data-toggle="tab" href="#tch">@lang("site.About_th_supervisor")</a></li>
                            <li><a data-toggle="tab" href="#answer">@lang("site.Discussions") </a></li>
                             @if(0)
                            @if(!empty($course->streamings))
                                <li><a data-toggle="tab" href="#Sessions">@lang("site.Available Sessions") </a></li>
                            @endif
                            @endif
                            @if(!empty($course->streamings_zoom[0]))
                                <li><a data-toggle="tab" href="#Sessions-1">جلسات متاحه زوم </a></li>
                            @endif
                            <li><a data-toggle="tab" href="#availablecode">@lang("site.Available code") </a></li>
                            <li><a data-toggle="tab" href="#Unavailable">@lang("site.Unavailable code") </a></li>
                            <li><a data-toggle="tab" href="#certificates">@lang("site.add certificate") </a></li>
                            @if(!empty($course->discounts[0]))
                                <li><a data-toggle="tab" href="#discountcode">@lang("site.discount code") </a></li>
                            @endif
                        </ul>
                        <a class="btn-style" data-toggle="modal" data-target="#add-q">@lang("site.Add a question")</a>
                    </div>
                    <div class="body-lesson">
                        <div class="tab-content">
                            <div id="details" class="tab-pane fade in active">
                                <div class="text-lansser">
                                    @if(app()->getLocale() == 'ar')
                                        <h3>{{ $course->title_ar }}</h3>
                                        <p>
                                            {{ $course->description_ar }}
                                        </p>

                                        <ul>
                                            <li>
                                                {{ $course->feature1 }}
                                            </li>
                                            <li>
                                                {{ $course->feature2 }}
                                            </li>
                                            <li>
                                                {{ $course->feature3 }}
                                            </li>
                                        </ul>


                                    @else
                                        <h3>{{ $course->title_en }}</h3>
                                        <p>
                                            {{ $course->description_en }}
                                        </p>


                                        <ul>
                                            <li>
                                                {{ $course->feature1_en }}
                                            </li>
                                            <li>
                                                {{ $course->feature2_en }}
                                            </li>
                                            <li>
                                                {{ $course->feature3_en }}
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <div id="tch" class="tab-pane fade">
                                <div class="cv-content">
                                    <div class="img-tch">
                                        <div class="img-u">
                                            <img src="{{ url('/') }}/public/storage/{{ $course->supervisorcourse->supervisor->avatar }}" alt="" />
                                        </div>
                                        <div class="social-media">
                                            <a href="{{ $course->supervisorcourse->supervisor->fb }}"><i class="fab fa-facebook-f"></i></a>
                                            <a href="{{ $course->supervisorcourse->supervisor->tw }}"><i class="fab fa-twitter"></i></a>
                                            <a href="{{ $course->supervisorcourse->supervisor->inst }}"><i class="fab fa-google-plus-g"></i></a>
                                            <a href="{{ $course->supervisorcourse->supervisor->google }}"><i class="fab fa-instagram"></i></a>
                                        </div>
                                    </div>
                                    <div class="details-s">
                                        <ul>
                                            <li>
                                                <strong>@lang("site.name") : </strong>
                                                <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}</span>
                                            </li>
                                            <li>
                                                <strong>@lang("site.Educational"):</strong>
                                                <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->Educational }}</span>
                                            </li>
                                        <!-- <li>
                                                    <strong>@lang("site.gender") : </strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->gender }}</span>
                                                </li> -->
                                            <li>
                                                <strong>@lang("site.Specialization") :</strong>
                                                <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->service->title_ar }}</span>
                                            </li>
                                        <!-- <li>
                                                    <strong>@lang("site.Age") :</strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->Age }} سنة</span>
                                                </li>-->
                                        </ul>

                                    </div>
                                </div>
                            </div>


                            <div id="answer" class="tab-pane fade">
                                @foreach($course->comments->where('commentORmassage',0) as $comment)
                                    <div class="qu-block">
                                        <h3>{{ $comment->user->name }} &nbsp;:&nbsp; {{ $comment->title }}</h3>
                                        <p>
                                            {{ $comment->comment }}
                                        </p>
                                        @if(!empty($comment->replay))
                                            <h3>
                                                @lang("site.The coach responded") &nbsp;:&nbsp;  {{ $comment->replay }}
                                            </h3>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div id="availablecode" class="tab-pane fade">
                                <div class="qu-block">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang("site.code")</th>
                                            <th scope="col">@lang("site.action")</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($course->examcodes as $examcode)
                                            @if($examcode->used == 0)
                                                <tr>
                                                    <th scope="row">{{$examcode->id}}</th>
                                                    <td>{{$examcode->code}}</td>
                                                    <td class="actions">
                                                        <a href="{{ url('/') }}/examcode/{{$examcode->id}}/update" class="on-default btn btn-default" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                                        <a href="{{ url('/') }}/examcode/{{$examcode->id}}/delete" class="on-default btn btn-default" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div id="Unavailable" class="tab-pane fade">
                                <div class="qu-block">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang("site.code")</th>
                                            <th scope="col">@lang("site.Name Student")</th>
                                            <th scope="col">@lang("site.delete")</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($course->examcodes as $examcode)
                                            @if($examcode->used == 1)
                                                <tr>
                                                    <th scope="row">{{$examcode->id}}</th>
                                                    <td>{{$examcode->code}}</td>
                                                    @if(!empty($examcode->user))
                                                        <td>{{$examcode->user->name}}</td>
                                                    @else
                                                        <td>الطالب لم يستخدمه بعد</td>
                                                    @endif
                                                    <td class="actions">
                                                        <a href="{{ url('/') }}/examcode/{{$examcode->id}}/delete" class="on-default btn btn-default" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="certificates" class="tab-pane fade">
                                <div class="qu-block">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang("site.Name Student")</th>
                                            <th scope="col">@lang("site.completion")</th>
                                            <th scope="col">@lang("site.show/hiddin certificate")</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($course->subscriptioncourses as $subscriptioncourse)

                                            <tr>
                                                <th scope="row">{{$subscriptioncourse->user->id}}</th>
                                                <td>{{ $subscriptioncourse->user->name }}</td>
                                                <td>
                                                    <div class="bar-complete">

                                                        @php
                                                            $countlessons = 0;
                                                            $i=0;
                                                               $countlessons=(count($subscriptioncourse->user->stulessons->where('course_id',$course->id))/$countlessonns)*100;
                                                        @endphp
                                                        @for($i = 0;$i < $countlessons; $i=$i+5)
                                                        @endfor

                                                        <h5>@lang("site.completion") {{ $i }} &nbsp; %</h5>
                                                    </div>
                                                </td>
                                                <td class="actions">
                                                    <?php $certificat = DB::table('certificates')->where('user_id',$subscriptioncourse->user_id)->where('course_id',$course->id)->first(); ?>
                                                    @if(!empty($certificat) and $certificat->view == 1)
                                                        <a href="{{ url('/') }}/hiddencertificate?course_id={{ $course->id }}&user_id={{ $subscriptioncourse->user->id }}" class="on-default btn btn-default" type="submit" title="إخفاء"><i class="fas fa-eye-slash"></i></a>
                                                    @else
                                                        <a href="{{ url('/') }}/addcertificate?course_id={{ $course->id }}&user_id={{ $subscriptioncourse->user->id }}" class="on-default btn btn-default" type="submit" title="اظهار"><i class="fas fa-eye"></i></a>
                                                    @endif
                                                </td>

                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="discountcode" class="tab-pane fade">
                                <div class="qu-block">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang("site.code")</th>
                                            <th scope="col">@lang("site.amount by sar")</th>
                                            <th scope="col">@lang("site.num_of_used")</th>
                                            <th scope="col">@lang("site.delete")</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($course->discounts as $index=>$discount)
                                            <tr>
                                                <th scope="row">{{$index + 1}}</th>
                                                <td>{{$discount->code}}</td>
                                                <td>{{$discount->amount}}</td>
                                                <td>{{$discount->num_of_used}}</td>
                                                <td class="actions">
                                                    <a href="{{ url('/') }}/discountcode/{{$discount->id}}/delete" class="on-default btn btn-default" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="Sessions" class="tab-pane fade">
                                <div class="qu-block">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">@lang("site.class_id")</th>
                                            <th scope="col">@lang("site.supervisor")</th>
                                            <th scope="col">@lang("site.start_time")</th>
                                            <th scope="col">@lang("site.dawnload")</th>
                                            <th scope="col">@lang("site.add attendee")</th>
                                            <th scope="col">@lang("site.cancel - modifay")</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($course->streamings as $streaming)
                                            <tr>
                                                <th scope="row">{{$streaming->class_id}}</th>
                                                <td>{{$streaming->supervisor->name}}</td>
                                                <td>{{$streaming->start_time}}</td>
                                                <td><a href="{{$streaming->recording_url}}"
                                                    >@lang("site.recording")<span><i class="fa fa-tv"></i></span></a></td>
                                                <td class="actions">
                                                    <a data-toggle="modal" data-target="#addattendeestreamingby" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                                                </td>
                                                <td class="actions">
                                                    <a data-toggle="modal" data-target="#cancelstreamingby" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                    <a data-toggle="modal" data-target="#modifaystreamingby" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-paint-brush" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach




                                        </tbody>
                                    </table>


                                </div>
                            </div>
                            <div id="Sessions-1" class="tab-pane fade">
                                <div class="qu-block">



                                    <span>Zoom</span>

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">@lang("site.class_id")</th>
                                            <th scope="col">@lang("site.supervisor")</th>
                                            <th scope="col">@lang("site.start_time")</th>

                                            <th scope="col">@lang("site.duration")</th>

                                            <th scope="col">@lang("site.add attendee")</th>
                                            <th scope="col">رابط الحصول ع التسجيل</th>
                                            <th scope="col">تعديل</th>
                                            <th scope="col"> الغاء</th>
                                            {{--  <th scope="col">@lang("site.cancel - modifay")</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($course->streamings_zoom as $streaming)

                                            <tr>
                                                <th scope="row">{{$streaming->class_id}}</th>
                                                <td>{{$streaming->supervisor->name}}</td>
                                                <td>{{$streaming->start_time}}</td>
                                                <td>{{$streaming->duration}}</td>
                                                <td class="actions">
                                                    <a data-toggle="modal" data-target="#addattendeestreamingby-zoom" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                                                </td>
                                                  <td><a data-lity href="https://zoom.us/oauth/authorize?response_type=code&client_id=CFcnxH_7SeiMz04zFK_g0w&redirect_uri=https://nhledu.com/auth" data-name="{{$streaming->class_id}}" class="record">التسجيل<span><i class="fa fa-tv"></i></span></a></td>
                                               @if($streaming->super_id==auth()->id())
                                                <td><a  data-name="{{$streaming->class_id}}"  id="update" href="https://zoom.us/oauth/authorize?response_type=code&client_id=CFcnxH_7SeiMz04zFK_g0w&redirect_uri=https://nhledu.com/auth"> تعديل</a></td>


@endif
                                                <td class="actions">
                                                    @if($streaming->super_id==auth()->id())
                                                    <a  data-name="{{$streaming->class_id}}"   href="https://zoom.us/oauth/authorize?response_type=code&client_id=CFcnxH_7SeiMz04zFK_g0w&redirect_uri=https://nhledu.com/auth"  class=" delete on-default btn btn-default drug" type="submit"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                           @endif
                                                              </td>
                                            </tr>

                                        @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Courses-inner -->

<!--- model link---->

   <div id="add_link" class="modal fade" role="dialog">
       <div class="modal-dialog">
           <!-- Modal content-->
           <div class="modal-content">
               <div class="modal-body">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <div class="add-qu">
                       <h3>اضافه رابط</h3>
                       <form action="{{ route('addLink')}}"  method="POST" role="form"  >
                           @csrf
                           <div class="form-group">
                               <input type="text" name="link_name"  placeholder="اضافه اسم الرابط" class="form-control">
                           </div>
                           <input type="hidden"  value="{{$course->id}}"  name="course_id">
                           <div class="form-group">
                               <input type="url" name="link_url"  placeholder="اضافه الرابط" class="form-control">
                           </div>

                           <div class="form-group">
                               <input type="submit" value="@lang("site.send")" class="btn" />
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>

    <!-- Modal -->
    <div id="add-q" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu">
                        <h3>@lang("site.Add your question")</h3>
                        <form action="{{ route('addcomment')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" placeholder="@lang("site.title")" name="title" class="form-control" required="">
                                <input name="course_id" value="{{ $course->id }}" hidden>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="@lang("site.Put a question here")" class="form-control" name="comment"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Exam code-->
    <div id="add-exam-code" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.Add code for the test")</h3>
                        @if(empty($course->examcodes[0]))
                            <p class="text-muted font-13 m-b-30">
                                @lang("site.By adding test codes, no student will be allowed to take a test except with the test code that you will send")
                            </p>
                        @endif

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                <button onclick="myFunction()" class="btn btn-success">
                                    كود رقمي
                                </button>

                                <button onclick="mycharFunction()" class="btn btn-warning">
                                    كود رمزي
                                </button>
                            </div>

                        </div>
                        <form action="{{ route('addcode')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf

                            <input name="course_id" value="{{ $course->id }}" hidden="" />
                            <div class="form-group">
                                <label>الكود المختار</label>
                                <input type="text" id="myText" name="code"  class="form-control" required/>
                            </div>


                            <div class="form-group">
                                <input type="submit" value="إضافة" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Exam code-->
    <div id="discounts" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.Add code for discounts")</h3>
                        @if(empty($course->examcodes[0]))
                            <p class="text-muted font-13 m-b-30">
                                الكود يستخدم لأكثر من مستخدم فقط أرسل للمستخدمين كود الخصم
                            </p>
                        @endif

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                <button onclick="myFunctionn()" class="btn btn-success">
                                    كود رقمي
                                </button>

                                <button onclick="mycharFunctionn()" class="btn btn-warning">
                                    كود رمزي
                                </button>
                            </div>

                        </div>
                        <form action="{{ route('adddiscount')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf

                            <input name="course_id" value="{{ $course->id }}" hidden="" />
                            <div class="form-group">
                                <label>الكود المختار</label>
                                <input type="text" id="myTextt" name="code"  class="form-control" required/>
                            </div>

                            <div class="form-group">
                                <label>قيمة الخصم بالريال السعودي</label>
                                <input type="text" name="amount"  class="form-control" required/>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="إضافة" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Level -->
    <div id="add-level" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.Add a level")</h3>
                        <form action="{{ route('addlevel')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf

                            <input name="course_id" value="{{ $course->id }}" hidden="" />
                            <div class="form-group">
                                <label>@lang("site.Arabic title")</label>
                                <input type="text" placeholder="@lang("site.Arabic title")" name="title_ar" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>@lang("site.The title is in English")</label>
                                <input type="text" placeholder="@lang("site.The title is in English")" name="title_en" class="form-control" />
                            </div>
                        <!--    <div class="form-group">
                                    <label>@lang("site.the details")</label>
                                    <textarea type="text" name="description_ar" placeholder="@lang("site.the details")"  class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.Details are in English")</label>
                                    <textarea type="text" name="description_en" placeholder="@lang("site.Details are in English")"  class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>رفع صورة</label>
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                <i class="fa fa-upload"></i> <input type="file" style="display: none;" multiple>
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="رفع صورة" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <label>التاريخ</label>
                                    <input type="date" placeholder="التاريخ" name="date" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>التاريخ</label>
                                    <input type="date" placeholder="التاريخ" name="date" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>رقم الكورس</label>
                                    <select class="form-control">
                                        <option>123</option>
                                        <option>123</option>
                                        <option>123</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.Link Video")</label>
                                    <input type="text" placeholder="@lang("site.Link Video")" name="link" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.time")</label>
                                    <input type="text" placeholder="@lang("site.time")" name="time" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.upload a file")</label>
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                <i class="fa fa-upload"></i> <input type="file" name="file" style="display: none;" multiple>
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="@lang("site.upload a file")" readonly>
                                    </div>
                                </div> -->
                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Lesson -->
    <div id="add-lesson" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.Add a lesson")</h3>
                        <form action="{{ route('addlesson')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf

                            <input name="course_id" value="{{ $course->id }}" hidden="" />
                            <div class="form-group">
                                <input type="text" placeholder="@lang("site.Arabic title")" name="title_ar" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>@lang("site.The title is in English")</label>
                                <input type="text" placeholder="@lang("site.The title is in English")" name="title_en" class="form-control" />
                            </div>
                        <!--  <div class="form-group">
                                    <label>@lang("site.the details")</label>
                                    <textarea type="text" name="description_ar" placeholder="@lang("site.the details")"  class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.Details are in English")</label>
                                    <textarea type="text" name="description_en" placeholder="@lang("site.Details are in English")"  class="form-control"></textarea>
                                </div>
                                -->
                            <div class="form-group">
                                <label>@lang("site.Choose the level")</label>
                                <select class="form-control" name="level_id">
                                    @foreach($course->levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->title_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>@lang("site.Link Video")</label>
                                <input type="text" placeholder="@lang("site.Link Video")" name="link" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>@lang("site.time")</label>
                                <input type="text" placeholder="@lang("site.time")" name="time" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>@lang("site.upload a file")</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                <i class="fa fa-upload"></i> <input type="file" name="file" style="display: none;" multiple>
                                            </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="@lang("site.upload a file")" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $i = 0; ?>
    <!-- Add Exam -->
    <div id="add-exam" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.Add an exam")</h3>
                        <form action="{{ route('addtonewexam')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="radio" name="radio1" id="r2" value="lesson" onClick="getResults()">درس
                                <label></label>
                                <input type="radio" name="radio1" id="r1" value="level">وحدة دراسية
                                <label></label>
                                <input type="radio" name="radio1" id="r3" value="course">نهاية الدورة
                            </div>

                            <div class="form-group text">
                                <input name="publicexam" value="0" hidden="" />
                                <label>@lang("site.Choose the level")</label>
                                <select class="form-control" name="level_id">
                                    @foreach($course->levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->title_ar }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group text2">
                                <input name="publicexam" value="0" hidden="" />
                                <label>@lang("site.Choose the lesson")</label>
                                <select class="form-control" name="lesson_id">
                                    @foreach($course->levels as $levels)
                                        @foreach($levels->lessons as $lesson)
                                            <option value="{{ $lesson->id }}">{{ $lesson->title_ar }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div class="text3">

                                <input name="course_id" value="{{ $course->id }}" hidden="" />
                            </div>
                            <div class="form-group">
                                <input type="radio" name="Qtype" id="first" value="first" >اختيار متعدد
                                <label></label>
                                <input type="radio" name="Qtype" id="secound" value="secound">صح - خطأ
                            </div>
                            <div class="first">
                                <div class="add-section">
                                        <span class="col-xs-12">
                                            <p class="form-group">
                                                <label>السؤال</label>
                                                <input type="text" name="question" value="" class="form-control" >
                                            </p>
                                        </span>
                                    <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الإجابة الأولي</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checkboxs[]" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                    <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الأجابة الثانية</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checkboxs[]" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                    <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الاجابة الثالثة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio"  name="checkboxs[]" value="2">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                    <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الإجابة الرابعة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio"  name="checkboxs[]" value="3">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                </div>
                            </div>
                            <div  class="secound">
                                <div class="add-section truefalse">
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-10 col-xs-8">
                                                <p class="form-group">
                                                    <label>السؤال</label>
                                                    <input type="text" name="questionn" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2 false">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                            <span class="col-md-1 col-xs-2 true">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>

                                </div>
                            </div>
                            <p>
                                <input type="submit" name="submit1" class="btn-style" value="إضافة">
                            </p>
                            {{-- <p id="addnew">
                                <a href="javascript:new_link()">إضافة سؤال</a>
                            </p> --}}
                        </form>
                        <!-- Template -->
                        <div id="newlinktpl" style="display:none">
                            <div class="add-section">
                                    <span class="col-xs-12">
                                        <p class="form-group">
                                            <label>السؤال</label>
                                            <input type="text" name="questions[]" value="" class="form-control" required>
                                        </p>
                                    </span>
                                <span class="col-xs-12 padding">
                                        <span class="col-md-11 col-xs-10">
                                            <p class="form-group">
                                                <label>3الاجابة</label>
                                                <input type="text" name="answers[]" value="" class="form-control" required>
                                            </p>
                                        </span>
                                        <span class="col-md-1 col-xs-2">
                                            <label class="exam-ch">
                                                <input type="checkbox" name="checkboxs[]" value="0">
                                                <span class="checkmark-exam"></span>
                                            </label>
                                        </span>
                                    </span>
                                <span class="col-xs-12 padding">
                                        <span class="col-md-11 col-xs-10">
                                            <p class="form-group">
                                                <label>3الاجابة</label>
                                                <input type="text" name="answers[]" value="" class="form-control" required>
                                            </p>
                                        </span>
                                        <span class="col-md-1 col-xs-2">
                                            <label class="exam-ch">
                                                <input type="checkbox" name="checkboxs[]" value="1">
                                                <span class="checkmark-exam"></span>
                                            </label>
                                        </span>
                                    </span>
                                <span class="col-xs-12 padding">
                                        <span class="col-md-11 col-xs-10">
                                            <p class="form-group">
                                                <label>3الاجابة</label>
                                                <input type="text" name="answers[]" value="" class="form-control" required>
                                            </p>
                                        </span>
                                        <span class="col-md-1 col-xs-2">
                                            <label class="exam-ch">
                                                <input type="checkbox" name="checkboxs[]" value="2">
                                                <span class="checkmark-exam"></span>
                                            </label>
                                        </span>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $i = 0; ?>
    <!-- remove -->
    <div id="remove" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>حذف - وحدة / درس / إختبار</h3>
                        <form action="{{ route('remove')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="radio" name="type" id="text1" value="level">وحدة دراسية
                                <label></label>
                                <input type="radio" name="type" id="text2" value="lesson">درس
                                <label></label>
                                <input type="radio" name="type" id="text3" value="exam">إختبار
                            </div>

                            <div class="form-group text1">

                                <label>@lang("site.Choose the level")</label>
                                <select class="form-control" name="level_id">
                                    @foreach($course->levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->title_ar }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group text2">

                                <label>@lang("site.Choose the lesson")</label>
                                <select class="form-control" name="lesson_id">
                                    @foreach($course->levels as $levels)
                                        @foreach($levels->lessons as $lesson)
                                            <option value="{{ $lesson->id }}">{{ $lesson->title_ar }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group text3">

                                <label>@lang("site.Choose the lesson")</label>
                                <select class="form-control" name="exam_id">
                                    @foreach($course->levels as $level)
                                        @foreach($level->lessons as $lesson)
                                            @if(!empty($lesson->exam))
                                                <option value="{{ $lesson->exam->id }}"> اختبار علي {{ $lesson->title_ar }}</option>
                                            @endif
                                        @endforeach
                                        @if(!empty($level->exam))
                                            <option value="{{ $level->exam->id }}"> اختبار علي {{ $level->title_ar }}</option>
                                        @endif
                                    @endforeach
                                    @foreach($course->exams as $exam)
                                        <option value="{{ $exam->id }}">اختبار علي الدورة</option>
                                    @endforeach
                                </select>
                            </div>

                            <p>
                                <input type="submit" name="submit1" class="btn-style" value="حذف">
                            </p>
                        </form>
                        <!-- Template -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="addsecmsag" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu">
                        <h3>@lang("site.open secret message")</h3>
                        <form action="{{ route('addmassage')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>@lang("site.Choose the received")</label>
                                <select class="form-control" name="received_id">
                                    @foreach($course->subscriptioncourses as $subscriptioncourse)
                                        <option value="{{ $subscriptioncourse->user->id }}">{{ $subscriptioncourse->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="super" value="1" hidden=""/>
                                <input name="course_id" value="{{ $course->id }}" hidden=""/>
                                <textarea placeholder="@lang("site.Put a Massage here")" class="form-control" name="comment"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="@lang("site.send")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="addcertificate" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu">
                        <h3>اضافة شهادة إتمام الدورة</h3>
                        <form action="{{ route('addcertificate')}}"  method="POST" role="form"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input name="course_id" value="{{ $course->id }}" hidden=""/>
                                <label>أختر المتدرب صاحب الشهادة</label>
                                <select class="form-control" name="user_id">
                                    @foreach($course->subscriptioncourses as $subscriptioncourse)
                                        <option value="{{ $subscriptioncourse->user->id }}">{{ $subscriptioncourse->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>شهادة إتمام الدورة</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                                                                <span class="btn btn-primary">
                                                                                    <i class="fa fa-upload"></i> <input type="file" style="display: none;" name="file" multiple>
                                                                                </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="ملف الشهادة" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="@lang("site.send")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add streaming -->
    <div id="addstreaming" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.create live streaming")</h3>
                        <form method="GET" name="form" action="https://nhledu.com/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="create" hidden="" />
                            <input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                            <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                            <input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.start_time") *</label>
                                <input type="datetime-local" placeholder="@lang('site.start_time')" name="start_time"  id="datepicker" class="form-control datepicker" required=""/>
                            </div>

                            <div class="form-group">
                                <label>@lang("site.attendee_limit")@lang("site.max") 300</label>
                                <input type="number" placeholder="@lang('site.attendee_limit')" name="attendee_limit" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.duration")</label>
                                <input type="number" placeholder="@lang('site.duration') بالدقيقة" name="duration" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.control_category_id")</label>
                                <input type="control_category_id" placeholder="@lang('site.control_category_id')" name="control_category_id" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.create_recording")</label>
                                <input type="text" placeholder="@lang('site.create_recording')" name="create_recording" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.return_url")</label>
                                <input type="text" placeholder="@lang('site.return_url')" name="return_url" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.status_ping_url")</label>
                                <input type="text" placeholder="@lang('site.status_ping_url')" name="status_ping_url" class="form-control" />
                            </div>


                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel streaming -->
    <div id="cancelstreaming" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.cancel live streaming")</h3>
                        <form method="GET" name="form" action="https://nhledu.com/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="CancelClass" hidden="" />
                            <input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                            <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                            <input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control" />
                            </div>


                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel streaming -->
    <div id="cancelstreamingby" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.cancel live streaming")</h3>
                        <form method="GET" name="form" action="https://nhledu.com/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="CancelClass" hidden="" />
                            <input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                            <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                            <input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control pathinput" />
                            </div>


                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modifay streaming -->
    <div id="modifaystreamingby" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.modifay live streaming")</h3>
                        <form method="GET" name="form" action="https://nhledu.com/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="ModifyClass" hidden="" />
                        <!--<input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                                <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                                --><input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control pathinput" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.start_time") *</label>
                                <input type="datetime-local" placeholder="@lang('site.start_time')" name="start_time"  id="datepicker" class="form-control datepicker"/>
                            </div>

                            <div class="form-group">
                                <label>@lang("site.attendee_limit")@lang("site.max") 10</label>
                                <input type="number" placeholder="@lang('site.attendee_limit')" name="attendee_limit" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.duration")</label>
                                <input type="number" placeholder="@lang('site.duration')" name="duration" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.control_category_id")</label>
                                <input type="control_category_id" placeholder="@lang('site.control_category_id')" name="control_category_id" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.create_recording")</label>
                                <input type="text" placeholder="@lang('site.create_recording')" name="create_recording" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.return_url")</label>
                                <input type="text" placeholder="@lang('site.return_url')" name="return_url" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.status_ping_url")</label>
                                <input type="text" placeholder="@lang('site.status_ping_url')" name="status_ping_url" class="form-control" />
                            </div>

                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- add attendee streaming -->
    <div id="addattendeestreamingby" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.add attendee live streaming")</h3>
                        <form method="GET" name="form" action="https://nhledu.com/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="AddAttendee" hidden="" />
                        <!--<input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                                <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                                -->
                            <input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control pathinput" />
                            </div>

                            <div class="form-group">








                                <select id='pre-selected-options' multiple='multiple'>
                                    <label>@lang("site.Choose the received")</label>
                                    @foreach($course->subscriptioncourses as $subscriptioncourse)
                                    <option value='{{ $subscriptioncourse->user->id }}'>{{ $subscriptioncourse->user->name }}</option>
                                    @endforeach
                                  </select>




                            </div>

                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- zoom-->



    <div id="addattendeestreamingby-zoom" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.add attendee live streaming")</h3>
                        <form method="post" name="form" action="{{route('subscripeMeeting')}}">
                            @csrf
                            <input name="typefunction" value="AddAttendee" hidden="" />
                        <!--<input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                                <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                                -->
                            <input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control pathinput" />
                            </div>

                            <div class="form-group">





                                <select   name="attendee[]" id='pre-selected-options-1' multiple='multiple'>
                                    <label>@lang("site.Choose the received")</label>
                                    @foreach($course->subscriptioncourses as $subscriptioncourse)
                                    <option value='{{ $subscriptioncourse->user->id }}'>{{ $subscriptioncourse->user->name }}</option>
                                    @endforeach
                                  </select>





                            </div>

                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <div id="add_certificate" class="modal fade" role="dialog">
       <div class="modal-dialog">
           <!-- Modal content-->
           <div class="modal-content">
               <div class="modal-body">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <div class="add-qu form-contact">
                       <h3></h3>
                       <form method="post" name="form" action="{{route('certificate_all')}}">
                           @csrf
                           <input name="typefunction" value="AddAttendee" hidden="" />
                       <!--<input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                                <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                                -->
                           <input name="title" value="{{ $course->title_ar }}" hidden="" />

                           <input name="course_id" value="{{ $course->id }}" hidden="" />



                           <div class="form-group">





                               <select   name="attendee_cer[]" id='pre-selected-options-2' multiple='multiple'>
                                   <label>@lang("site.Choose the received")</label>
                                   @foreach($course->subscriptioncourses as $subscriptioncourse)
                                       <option value='{{ $subscriptioncourse->user->id }}'>{{ $subscriptioncourse->user->name }}</option>
                                   @endforeach
                               </select>





                           </div>

                           <div class="form-group">
                               <input type="submit" value="@lang("site.go")" class="btn" />
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
    <!-- Cancel streaming -->
    <div id="cancelstreaming" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.cancel live streaming")</h3>
                        <form method="GET" name="form" action="{{url('/')}}/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="CancelClass" hidden="" />
                            <input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                            <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                            <input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control" />
                            </div>


                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel streaming -->
    <div id="cancelstreamingby" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.cancel live streaming")</h3>
                        <form method="GET" name="form" action="https://nhledu.com/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="CancelClass" hidden="" />
                            <input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                            <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                            <input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control pathinput" />
                            </div>


                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modifay streaming -->
    <div id="modifaystreamingby" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.modifay live streaming")</h3>
                        <form method="GET" name="form" action="https://nhledu.com/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="ModifyClass" hidden="" />
                        <!--<input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                                <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                                --><input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control pathinput" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.start_time") *</label>
                                <input type="datetime-local" placeholder="@lang('site.start_time')" name="start_time"  id="datepicker" class="form-control datepicker"/>
                            </div>

                            <div class="form-group">
                                <label>@lang("site.attendee_limit")@lang("site.max") 10</label>
                                <input type="number" placeholder="@lang('site.attendee_limit')" name="attendee_limit" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.duration")</label>
                                <input type="number" placeholder="@lang('site.duration')" name="duration" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.control_category_id")</label>
                                <input type="control_category_id" placeholder="@lang('site.control_category_id')" name="control_category_id" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.create_recording")</label>
                                <input type="text" placeholder="@lang('site.create_recording')" name="create_recording" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.return_url")</label>
                                <input type="text" placeholder="@lang('site.return_url')" name="return_url" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.status_ping_url")</label>
                                <input type="text" placeholder="@lang('site.status_ping_url')" name="status_ping_url" class="form-control" />
                            </div>

                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden"  value="{{$course->id}}">
    <!-- add attendee streaming -->
    <div id="addattendeestreamingby" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="add-qu form-contact">
                        <h3>@lang("site.add attendee live streaming")</h3>
                        <form method="GET" name="form" action="{{url('/')}}/public/WiZiQ/Class/WiZiQService.php">

                            <input name="typefunction" value="AddAttendee" hidden="" />
                        <!--<input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                                <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                                -->
                            <input name="title" value="{{ $course->title_ar }}" hidden="" />

                            <input name="course_id" value="{{ $course->id }}" hidden="" />

                            <div class="form-group">
                                <label>@lang("site.class_id")</label>
                                <input type="text" placeholder="@lang('site.class_id')" name="class_id" class="form-control pathinput" />
                            </div>

                            <div class="form-group">
                                <label>@lang("site.Choose the received")</label>
                                <select class="form-control" name="stud_id">
                                    @foreach($course->subscriptioncourses as $subscriptioncourse)
                                        <option value="{{ $subscriptioncourse->user->id }}">{{ $subscriptioncourse->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="btn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Zoom-->




    <input id="course_id" value="{{ $course->id }}" hidden="" />

@endsection

@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"></script>


    


    <script>



        function myFunction() {
            var chars = "0123456789";
            var string_length = 14;
            var randomstring = '';
            for (var i=0; i<string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum,rnum+1);
            }
            document.getElementById("myText").value = randomstring;
        }

        function mycharFunction() {
            var chars = "0123456789ABCDEFGHIJKLMNOPQR!@$#~%^&*STUVWXTZabcdefghiklmnopqrstuvwxyz";
            var string_length = 14;
            var randomstring = '';
            for (var i=0; i<string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum,rnum+1);
            }
            document.getElementById("myText").value = randomstring;
        }

        function myFunctionn() {
            var chars = "0123456789";
            var string_length = 20;
            var randomstring = '';
            for (var i=0; i<string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum,rnum+1);
            }
            document.getElementById("myTextt").value = randomstring;
        }

        function mycharFunctionn() {
            var chars = "0123456789ABCDEFGHIJKLMNOPQR!@$#~%^&*STUVWXTZabcdefghiklmnopqrstuvwxyz";
            var string_length = 20;
            var randomstring = '';
            for (var i=0; i<string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum,rnum+1);
            }
            document.getElementById("myTextt").value = randomstring;
        }
    </script>

    <script>

        //-----------------
        $(document).ready(function(){
            $('.get_ajax_data').click(function(e){


                var lesson_id= $(this).attr('data-get_id');
//console.log(lesson_id);
                $('#lesson').html('');
                e.preventDefault();
                /*Ajax Request Header setup*/
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // $('#send_form').html('معروض الأن');

                /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ url('/smycourse/lesson')}}",
                    method: 'post',
                    data: {lesson_id:lesson_id},
                    success: function(response){
                        // alert(response);
                        //   console.log(response.link);
                        //------------------------
                        var php = "<?php  echo('"+response.link+"'); ?>"
                        $('#lesson').html('<div class="new-page"><div class="video-lesson">'+php+'</div></div>');
                        //  $('#send_form').html('');
                        //--------------------------
                    }});
            });
        });
        //-----------------
    </script>

    <script>

        //-----------------
        $(document).ready(function(){
            $('.get_ajax_exam').click(function(e){


                var exam_id= $(this).attr('data-get_id');
//console.log(lesson_id);
                $('#lesson').html('');
                e.preventDefault();
                /*Ajax Request Header setup*/
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                /* Submit form data using ajax*/
                $.ajax({
                    url: "{{ url('/smycourse/exam')}}",
                    method: 'post',
                    data: {exam_id:exam_id},
                    success: function(response){
                        //  alert(response);
                        console.log(response.answers.length);
                        //------------------------

                        $('#lesson').append('<div class="answer-new"><div class="qiz-now"><form action="{{ route('exam')}}"  method="POST" role="form"  enctype="multipart/form-data">@csrf<div class="qiz-block"><div class="title"><h3>جب الاسألة التالية</h3></div>');
                        for (i = 0;i < response.questions.length; i++) {
                            $('#lesson').append('<h3>'+response.questions[i].question+'</h3>');
                            for (j = 0;j < response.answers[i].length; j++) {
                                $('#lesson').append('<label class="qiz-check">'+response.answers[i][j].answer+'<input type="radio" checked="checked" name="radio"><span class="qiz-checkmark"></span></label>');
                                //$('#lesson').append('<h3>'+response.answers[i][j].answer+'</h3>');
                            }
                        }
                        $('#lesson').append('</div><input type="submit" value="@lang("site.go")" class="btn" /></form></div></div>');
                        //--------------------------
                    }});
            });
        });
        //-----------------
    </script>

    <script>
        var ct = 1;
        function new_link()
        {
            ct++;
            var div1 = document.createElement('div');
            div1.id = ct;
            // link to delete extended form elements
            var delLink = '<div class="delete-btn" style="text-align:right;"><a class="btn-del" href="javascript:delIt('+ ct +')"><i class="fa fa-times"></i></a></div>';
            div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
            document.getElementById('newlink').appendChild(div1);
        }
        // function to delete the newly added set of elements
        function delIt(eleId)
        {
            d = document;
            var ele = d.getElementById(eleId);
            var parentEle = d.getElementById('newlink');
            parentEle.removeChild(ele);
        }

        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".text1").hide();
            $(".text2").hide();
            $(".text3").hide();
            $("#text1").click(function () {
                $(".text1").show();
                $(".text2").hide();
                $(".text3").hide();
            });
            $("#text2").click(function () {
                $(".text1").hide();
                $(".text2").show();
                $(".text3").hide();
            });
            $("#text3").click(function () {
                $(".text1").hide();
                $(".text2").hide();
                $(".text3").show();
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".text").hide();
            $(".first").hide();
            $(".secound").hide();
            $("#r1").click(function () {
                $(".text").show();
                $(".text2").hide();
                $(".text3").hide();
            });
            $("#r2").click(function () {
                $(".text").hide();
                $(".text2").show();
                $(".text3").hide();
            });
            $("#r3").click(function () {
                $(".text").hide();
                $(".text2").hide();
                $(".text3").show();
            });
            $("#first").click(function () {
                $(".first").show();
                $(".secound").hide();
            });
            $("#secound").click(function () {
                $(".first").hide();
                $(".secound").show();
            });
        });
    </script>

    <script type="text/javascript">
        $('.drug').click(function(){
            var path = $(this).attr('path');
            $('#c-profile').css('display','block');
            $('.pathinput').val(path);
            $('.path').text(path);
        });


        $('#meeting').click(function() {
            //    alert($('#course_id').val());
            $.ajax({
                url: "/set-session/"+$('#course_id').val(),
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                }
            });
        });


        $('#meeting_detail').click(function() {
            //    alert($('#course_id').val());
            // alert('df');
            $.ajax({
                url: "/set-session-detail/"+$('#course_id').val(),
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    console.log(res);
                    alert(res);
                }
            });
        });



        $('#meeting_delete').click(function() {
            //    alert($('#course_id').val());
            // alert('df');
            $.ajax({
                url: "/set-session-delete/"+$('#meeting_delete_val').val(),
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    console.log(res);
                    alert(res);
                }
            });
        });



        $('.delete').click(function() {
             // alert($(this).val());
            // alert('df');
            $.ajax({
                url: "/set-session-delete/"+$(this).data('name'),
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    console.log(res);
                    alert(res);
                }
            });
        });
        $('.record').click(function() {
            // alert($(this).val());
            // alert('df');
            $.ajax({
                url: "/set-session-record/"+$(this).data('name'),
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    console.log(res);
                    alert(res);
                }
            });
        });
        $('#update').click(function() {
            // alert($(this).val());
            // alert('df');
            $.ajax({
                url: "/set-session-update/"+$(this).data('name'),
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    console.log(res);
                    alert(res);
                }
            });
        });

    </script>
@endsection