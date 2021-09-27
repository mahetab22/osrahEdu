@extends('layouts.app')
@section('stylelinks')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
        
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
                        @else
                        <h1>{{ $course->title_en }}</h1>
                        @endif
                    </div>
                    <div class="bar-complete">
                      <h3>@lang("site.Welcome, moderator of the course")</h3> 

                     @lang("site.Number of students involved") : {{ count($course->subscriptioncourses) }}

                    </div>
                    <hr />
                    <div class="all-levels">
                        <div class="panel-group" id="accordion">
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
                                        <div class="all-courd">
                                            <ul>
                                              @foreach($levels->lessons as $lesson)
                                                <li> <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_data" data-get_id="{{ $lesson->id }}" > {{ $lesson->title_ar }} @if(0)<span>*</span>@endif</a>
                                                   
                                                </li>
                                                @if($lesson->exam)
                                                <li>
                                                   <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $lesson->exam->id }}" >@lang("site.Lesson test") @if($levels->exam)<span>*</span>@endif</a>
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
                                                   <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $lesson->exam->id }}" >@lang("site.Lesson test") @if($levels->exam)<span>*</span>@endif</a>
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
                                         <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $levels->exam->id }}"  >@lang("site.Level test") @if($levels->exam)<span>*</span>@endif</a>
                                    </h4>
                                </div>
                            </div>
                            @endif 
                            @endforeach
                            @if($course->exam)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                         <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $course->exam->id }}"  >@lang("site.Ali exam course") @if($course->exam)<span>*</span>@endif</a>
                                    </h4>
                                </div>
                            </div>
                            @endif  

                        </div> 
                        <div class="all-buttons">
                            <a class="add-btn" data-toggle="modal" data-target="#add-level">@lang("site.Add a level")</a>
                            <a class="add-btn" data-toggle="modal" data-target="#add-lesson">@lang("site.Add a lesson")</a>
                            <a class="add-btn" data-toggle="modal" data-target="#add-exam">@lang("site.Add an exam")</a>
                            <a class="add-btn" data-toggle="modal" data-target="#add-exam-code">@lang("site.Add code for the test")</a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-9 col-xs-12">
                <div class="content-lesson">

                      <!-- lesson -->
                       <div id="lesson">

                           <div class="new-page">
                                <div class="video-lesson">
                                    <iframe width="560" height="315" src="{{ $course->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>

                            <div class="download-attch">
                                <h3><i class="fa fa-paperclip"></i>@lang("site.Download the attachments") </h3>
                                <a href="{{ url('/') }}/public/storage/{{ $course->file }}" download>@lang("site.Press here")</a>
                            </div>

                       </div>
                      <!-- lesson -->

                    <div class="all-details-lesson">
                        <div class="header-lesson">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#details">@lang("site.about_th_course")</a></li>
                                <li><a data-toggle="tab" href="#tch">@lang("site.About_th_supervisor")</a></li>
                                <li><a data-toggle="tab" href="#answer">@lang("site.Discussions") </a></li>
                                <li><a data-toggle="tab" href="#availablecode">@lang("site.Available code") </a></li>
                                <li><a data-toggle="tab" href="#Unavailable">@lang("site.Unavailable code") </a></li>
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
                                                <li>
                                                    <strong>@lang("site.gender") : </strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->gender }}</span>
                                                </li>
                                                <li>
                                                    <strong>@lang("site.Specialization") :</strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->service->title_ar }}</span>
                                                </li>
                                                <li>
                                                    <strong>@lang("site.Age") :</strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->Age }} سنة</span>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>


                                <div id="answer" class="tab-pane fade">
                                     @foreach($course->comments as $comment)
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
                                    <input type="submit" value="أضافة" class="btn" />
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
                                <div class="form-group">
                                    <label>@lang("site.the details")</label>
                                    <textarea type="text" name="description_ar" placeholder="@lang("site.the details")"  class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.Details are in English")</label>
                                    <textarea type="text" name="description_en" placeholder="@lang("site.Details are in English")"  class="form-control"></textarea>
                                </div>
{{--                                 <div class="form-group">
                                    <label>رفع صورة</label>
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                <i class="fa fa-upload"></i> <input type="file" style="display: none;" multiple>
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" placeholder="رفع صورة" readonly>
                                    </div>
                                </div> --}}
{{--                                 <div class="form-group">
                                    <label>التاريخ</label>
                                    <input type="date" placeholder="التاريخ" name="date" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>التاريخ</label>
                                    <input type="date" placeholder="التاريخ" name="date" class="form-control" />
                                </div> --}}
{{--                                 <div class="form-group">
                                    <label>رقم الكورس</label>
                                    <select class="form-control">
                                        <option>123</option>
                                        <option>123</option>
                                        <option>123</option>
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label>@lang("site.Link Video")</label>
                                    <input type="text" placeholder="@lang("site.Link Video")" name="link" class="form-control" />
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
                                    <label>@lang("site.Arabic title")</label>
                                    <input type="text" placeholder="@lang("site.Arabic title")" name="title_ar" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.The title is in English")</label>
                                    <input type="text" placeholder="@lang("site.The title is in English")" name="title_en" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.the details")</label>
                                    <textarea type="text" name="description_ar" placeholder="@lang("site.the details")"  class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.Details are in English")</label>
                                    <textarea type="text" name="description_en" placeholder="@lang("site.Details are in English")"  class="form-control"></textarea>
                                </div>
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
                              <form action="{{ route('addexam')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                @csrf
                                <div id="newlink">
                                    <div class="add-section">
                                        <div class="form-group">
                                         <input name="publicexam" value="0" hidden="" />
                                         <input name="course_id" value="{{ $course->id }}" hidden="" />
                                        <label>@lang("site.Choose the level")</label>
                                        <select class="form-control" name="level_id">
                                            @foreach($course->levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->title_ar }}</option>
                                            @endforeach
                                        </select>
                                         </div>
                                        <span class="col-xs-12">
                                            <p class="form-group">                                                
                                                <label>السؤال</label>
                                                <input type="text" name="questions[]" value="" class="form-control" required="">
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
                                                    <input type="checkbox"  name="checkboxs[]" value="2">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <p>
                                    <input type="submit" name="submit1" class="btn-style" value="إضافة">
                                </p>
                                <p id="addnew">
                                    <a href="javascript:new_link()">إضافة سؤال</a>
                                </p>
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
@endsection

@section('script')

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
   
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

            $('#lesson').html('<div class="new-page"><div class="video-lesson"><iframe width="560" height="315" src="'+response.link+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div><div class="download-attch"><h3><i class="fa fa-paperclip"></i>@lang("site.Download Attachments")</h3><a href="#" download>@lang("site.Click here")</a></div>');
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
@endsection