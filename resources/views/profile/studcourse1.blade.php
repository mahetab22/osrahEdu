@extends('layouts.app')
@section('stylelinks')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
        @if(isset($course->whats_link))
            <div class="wahtt">
                <!--<a href="https://api.whatsapp.com/send?phone=966500801977" target="_blank"><i class="fab fa-whatsapp"></i></a>-->
                <a href="https://chat.whatsapp.com/KlpjHQfb4dT6Yz6pWJDJMk" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>


        @endif
        <!-- Start Courses-inner -->
        <section class="lesson-inner">
            <div class="col-md-3 col-xs-12 padding">
                <div class="sidebar-lesson">
                    <div class="back-btn">
                        <a href="{{ route('/') }}">@lang("site.Return to the course")<i class="fa fa-angle-left"></i></a>
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
                        @php
                            $i=0;
                        @endphp
                        @for($i = 0;$i < $countlessons; $i=$i+5)
                        @endfor
                        <span class='complete-{{ $i }}'></span>
                        <h5>@lang("site.completion") {{ $i }} &nbsp; %</h5>
                    </div>
                    <hr />
                    <div class="all-levels">
                        <div class="panel-group" id="accordion">
                        
                       {{-- <div class="all-buttons whatsup-btn swq">
                                <a href="{{$course->whats_link }}" id="whatsup" class="add-btn addstr" > 
                                    <div class="swq-sv">
                                        <div class="tyuo-img">
                                            <img src="{{ url('/') }}/public/src_website/images/whats.svg">
                                        </div>
                                        <div class="wei">
                                            <span class="whatsup-span">whatsup</span>
                                            <span>قروب الواتس اب</span> 
                                        </div>
                                    </div>
                                </a>
                            </div>--}}

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
                          
                           @if(!empty($course->certificate) and $course->certificate->view == 1)
                               <div class="panel-heading streaminglink">
                                    <h4 class="panel-title">
                                        <a href="{{ url('/') }}/certificate?course_id={{ $course->id }}&certificate_id={{ $course->certificate->id }}"  >تحميل شهادة انتهاء الدورة<span><i class="fa fa-bell"></i></span></a>
                                        {{-- <a href="{{ url('/') }}/public/storage/{{ $course->certificate->file }}"  download>تحميل شهادة انتهاء الدورة<span><i class="fa fa-bell"></i></span></a> --}}
                                    </h4>
                                </div>
                            @endif
                            @if(!empty($course->studstreaming))
                                 @if(0)
                               <div class="panel-heading streaminglink">
                                    <h4 class="panel-title">
                                    
                                        <a href="{{--{{$course->studstreaming->attendee_url}}--}}" class="wiziq" target="_blank"><span>wiziq <i class="fa fa-tv"></i></span></a>
                                    </h4>
                                </div>
                                @endif
                                <div class="panel-heading streaminglink">
                                   <h4 class="panel-title">
@if(!empty($streamings[0]))
                                       <a href="{{$streamings[0]->join_url}}" class="zoom" target="_blank"><span> البث المباشر <i class="fa fa-tv"></i></span></a>
                                 @endif
                                   </h4>
                               </div>
                            @endif
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
                                        <div class="allcourse">
                                            <ul>
                                              @foreach($levels->lessons as $lesson)
                                                @if(!empty($lesson->link))
                                                <li> <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_data" data-get_id="{{ $lesson->id }}" ><i class="far fa-play-circle"></i> {{ $lesson->title_ar }} <span>{{ $lesson->duration }} دقيقة</span></a>
                                                   
                                                </li>
                                                @endif
                                                 @if(!empty($lesson->file))
                                                <li>
                                                    <a href="{{ url('/') }}/public/storage/{{ $lesson->file }}" download><i class="far fa-file-pdf"></i> {{ $lesson->title_ar }} </a>
                                                </li>
                                                @endif
                                                @if($lesson->exam)
                                                <li>
                                                   <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $lesson->exam->id }}" ><i class="far fa-sticky-note"></i>@lang("site.Lesson test") @if($levels->exam)<span>*</span>@endif</a>
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
                                                   <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $lesson->exam->id }}" ><i class="far fa-sticky-note"></i>@lang("site.Lesson test") @if($levels->exam)<span>*</span>@endif</a>
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
                                         <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $levels->exam->id }}"  ><i class="far fa-sticky-note"></i> @lang("site.Level test")@if($levels->exam)<span>*</span>@endif</a>
                                    </h4>
                                </div>
                            </div>
                            @endif  
                            @endforeach
                            @if($course->exam)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                         <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $course->exam->id }}"  ><i class="far fa-sticky-note"></i> @lang("site.Ali exam course")@if($course->exam)<span>*</span>@endif</a>
                                    </h4>
                                </div>
                            </div>
                            @endif
                               
                        </div> 
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-xs-12">
                <div class="content-lesson">

                      <!-- lesson -->
                      <form action="{{ route('postexam')}}"  method="post">@csrf
                       <div id="lesson">

                           <div class="new-page">
                                <div class="video-lesson">
                                    <?php
                                        echo($course->link);
                                    ?>
                                    {{-- <iframe width="560" height="315" src="{{ $course->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                </div>
                            </div>

                          <!--  <div class="download-attch">
                                <h3><i class="fa fa-paperclip"></i>@lang("site.Download the attachments") </h3>
                                <a href="{{ url('/') }}/public/storage/{{ $course->file }}" download>@lang("site.Press here")</a>
                            </div>-->

                       </div>
                      <!-- lesson -->
</form>
                    <div class="all-details-lesson">
                        <div class="header-lesson">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#details">@lang("site.about_th_course")</a></li>
                                <li><a data-toggle="tab" href="#tch">@lang("site.About_th_supervisor")</a></li>
                                <li><a data-toggle="tab" href="#answer">@lang("site.Discussions") </a></li>
                                <li><a data-toggle="tab" href="#xce">جلسات زوم متاحه </a></li>                            </ul>
                            <a class="btn-style" data-toggle="modal" data-target="#add-q">@lang("site.Add a question")</a>
                        </div>
                        <div class="body-lesson">
                            <div class="tab-content">
                                <div id="details" class="tab-pane fade in active">
                                    <div class="text-lansser">
                               @if(app()->getLocale() == 'ar')
                                            <h3>{{ $course->title_ar }}</h3>
                                            <p>
                                                <?php echo($course->description_ar); ?>
                                            </p>

                                            <ul>
                                                <li>
                                                <?php echo($course->feature1); ?>
                                                     
                                                </li>
                                                <li>
                                                <?php echo($course->feature2); ?>
                                                     
                                                </li>
                                                <li>
                                                <?php echo($course->feature3); ?>
                                                     
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
                                @if(!empty($course->supervisorcourse->supervisor))
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

                                                <li>
                                                    <strong>@lang("site.Specialization") :</strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->service->title_ar }}</span>
                                                </li>

                                            </ul>

                                        </div>
                                    </div>
                                </div>
                               @else
                                <div id="tch" class="tab-pane fade">
                                    <div class="cv-content">
                                       <div class="details-s">
                                        بيانات المدرب غير كاملة ونعمل علي أكتمالها في الوقت الحالي
                                       </div>
                                     </div>
                                </div>
                               @endif

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
                                
                                <div id="xce" class="tab-pane fade">
                            <div class="qu-block">
                                <span>Zoom</span>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang("site.class_id")</th>
                                        <th scope="col">@lang("site.supervisor")</th>
                                        <th scope="col">@lang("site.start_time")</th>
                                        <th scope="col">@lang("site.duration")</th>
                                      {{--  <th scope="col">@lang("site.cancel - modifay")</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($streamings as $streaming)
                                        <tr>
                                            <th scope="row">{{$streaming->class_id}}</th>
                                            <td>{{$streaming->supervisor->name}}</td>
                                            <td>{{$streaming->start_time}}</td>
                                            <td>{{$streaming->duration}}</td>
                                                 {{-- <td class="actions">
                                                <a data-toggle="modal" data-target="#addattendeestreamingby-zoom" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                                            </td>--}}
                                            <td class="actions">
                                                <a href="{{$streaming->join_url}}" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit">دخول الاجتماع</a>
                                               {{-- <a data-toggle="modal" data-target="#modifaystreamingby" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-paint-brush" aria-hidden="true"></i></a>
                                    --}}        </td>
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
        </section>
        <!-- End Courses-inner -->
        
 
         
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
@endsection

@section('script')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

<script>

//-----------------
$(document).ready(function(){
$('.get_ajax_data').click(function(e){


 var lesson_id= $(this).attr('data-get_id'); 
//console.log(lesson_id); 
$('#lesson').html('');
   e.preventDefault();
   /*Ajax Request Header setup*/$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  // $('#send_form').html('معروض الأن');
   
   /* Submit form data using ajax*/
   $.ajax({
      url: "{{ url('/mycourse/lesson')}}",
      method: 'post',
  data: {lesson_id:lesson_id},
      success: function(response){
       // alert(response);
        console.log(response);
         //------------------------
var php = "<?php  echo('"+response.link+"'); ?>";
 $('#lesson').html('<div class="new-page"><div class="oh-sorry"><img src="images/sad.png" /><p class="first-p">نعتذر جدا</p><p class="sec-p">يجب ان تشاهد الدرس السابق أولا</p></div></div>');        
            $('#lesson').html('<div class="new-page"><div class="video-lesson">'+php+'</div></div><div class="download-attch"><h3><i class="fa fa-paperclip"></i>@lang("site.Download Attachments")</h3><a href="#" download>@lang("site.Click here")</a></div>');
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
      url: "{{ url('/mycourse/exam')}}",
      method: 'post',
  data: {exam_id:exam_id},
      success: function(response){
      //  alert(response);
        console.log(response.answers.length); 
         //------------------------

if(response.status == 'false'){
    $('#lesson').html('<div class="new-page"><div class="oh-sorry"><img src="{{ asset('public/src_website/images/sad.png') }}" /><p class="first-p">@lang("site.To enter the test")</p><p class="sec-p">@lang("site.you should see the previous lesson first")</p></div></div>');
}else if(response.status == 'true'){

$('#lesson').html('<div class="new-page"><div class="oh-sorry"><img src="{{ asset('public/src_website/images/go.png') }}" /><p class="first-p">@lang("site.Are you ready for testing")</p><p class="sec-p">@lang("site.Once ready, press the button below")</p><a href="{{ url('/exambyid')}}/'+exam_id+'" class="btn btn-style">@lang("site.go test")</a></div></div>');

 
}else if(response.status == 'have'){

$('#lesson').html('<div class="new-page"><div class="oh-sorry"><img src="{{ asset('public/src_website/images/go.png') }}" /><p class="first-p">@lang("site.You have already taken the test before")</p><p class="sec-p">@lang("site.And the percentage of correct solutions for your test was"):&nbsp;'+response.total+ '&nbsp;%</p><a href="{{ url('/exambyid')}}/'+exam_id+'" class="btn btn-style">@lang("site.Review the answers")</a></div></div>');

 
}                                
         //--------------------------
      }});
   });
});
//------------//------------/examResults/{course}/{exam}-- $('#lesson').append('</div><a  value="رؤية النتيجة" class="btn" src="{{ url('') }}/examResults/{{ $course->id }}/'+[i]+'/"/></a>'); --------
</script>
@endsection