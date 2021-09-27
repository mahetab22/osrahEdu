@extends('layouts.app')



@section('content')
@if(!empty($user))
<?php $received_id =$user->id; ?>
@endif
{{--         <!-- Start Title -->
        <section class="title-s" style="background-image: url(images/111.jpg)">
            <div class="container">
                <h2>محادثة</h2>
                <ul>
                    <li>
                        <a href="index.html">
                            الرئيسية
                        </a>
                    </li>
                    <li>
                        <span>
                            محادثة
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title --> --}}
        
        <!-- Start Req-inner -->
        <section class="contact-inner body-inner">
            <div class="container">
<div class="box-chat">
            @foreach($comments as $comment)
                @if($comment->user_id != Auth::user()->id)
                    <div class="containerr">
                        <?php $received_id = $comment->user_id; ?>
                      <img src="{{ url('/')}}/public/storage/{{isset($comment->user->avatar)?$comment->user->avatar:''}} " alt="Avatar">
                      <p>{{ $comment->title }}</p>
                            @if(isset($comment->stream_url))
                                <a href="{{$comment->stream_url}}">دخول البث</a>
                                @endif
                      <span class="time-rightr">{{ date('H:i:s',strtotime($comment->created_at)) }}</span>
                    </div>
                @elseif($comment->user_id == Auth::user()->id)
                        <?php $received_id = $comment->received_id; ?>
                    <div class="containerr darkerr">
                      <img src="{{ url('/')}}/public/storage/{{$comment->user->avatar}} " alt="Avatar" class="rightr">
                      <p>{{ $comment->title }}</p>
                      <span class="time-leftr">{{ date('H:i:s',strtotime($comment->created_at)) }}</span>
                    </div>
                @endif
            @endforeach


                        <div class="add-qu">
                            <h3>@lang("site.new massage")</h3>
                            <form action="{{ route('addmassage')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                @csrf
                                @if(empty($comments[0]) and !empty($course))
                                    <input name="course_id" value="{{ $course->id }}" hidden>

{{--                                  <div class="form-group">
                                    <label>@lang("site.Choose the course")</label>
                                    <select class="form-control" name="course_id">
                                        @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
                                        <option value="{{ $supervisorcourse->course->id }}">{{ $supervisorcourse->course->title_ar }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                @endif                               
                                <div class="form-group">

                                    <input name="received_id" value="{{ $received_id }}" hidden>
                                    @if(!empty($comments[0]))
                                    <input name="course_id" value="{{ $comments[0]->course->id }}" hidden>
                                    @endif
                                    <textarea placeholder="@lang("site.Put a question here")" class="form-control" name="comment"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="@lang("site.send")" class="btn" />
                                </div>
                            </form>
                        </div>

</div>
</div>
</section>

@endsection

@section('stylelinks')

    <style type="text/css">
        /* Chat containers */
    .containerr {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
    }

    /* Darker chat container */
    .darkerr {
      border-color: #ccc;
      background-color: #ddd;
    }

    /* Clear floats */
    .containerr::after {
      content: "";
      clear: both;
      display: table;
    }

    /* Style images */
    .containerr img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    /* Style the right image */
    .containerr img.rightr {
      float: right;
      margin-left: 20px;
      margin-right:0;
    }

    /* Style time text */
    .time-rightr {
      float: right;
      color: #aaa;
    }

    /* Style time text */
    .time-leftr {
      float: left;
      color: #999;
    }
    </style>

@endsection