@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/css/mobile.css">
<link rel="stylesheet" href="{{url('/')}}/public/src_website/css/style.css">
    @endsection
@section('content')
<?php
$conversation=array();
    $imagePreview=json_encode(url('/').'/public/storage/'.Auth::user()->avatar);
    $comments = DB::table('comments')->where('user_id',Auth::user()->id)->orwhere('received_id',Auth::user()->id)->where('commentORmassage',1)->get();
?>
        <!-- Start Profile3-inner -->
        <section class="profile3-inner body-inner">
            <div class="container">
                <div class="col-md-2 col-xs-12"></div>
                <div class="col-md-8 col-xs-12">
                    <div class="profile-details-inner">
                        <div class="profile-image">
                            <div class="avatar-upload">
                              <!--  <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div> -->
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url({{ $imagePreview }})"></div>
                                </div>
                            </div>
                        </div>
                        <div class="join-name">
                            <div class="name">
                                <h3>{{ Auth::user()->name }}<span>طالب</span></h3>
                            </div>
                            <div class="join-data">Joined {{ date("Y-M", strtotime(Auth::user()->created_at)) }}</div>
{{--                             <div class="socila-media-j">
                                <a href="{{ Auth::user()->fb }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ Auth::user()->inst }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ Auth::user()->tw }}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ Auth::user()->google }}">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            </div> --}}
                        </div>
                        <div class="body-profile">
                            <div class="header-tab-pro">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#profile1">الملف الشخصي</a></li>
                                    <li><a data-toggle="tab" href="#profile2">الدورات <span class="badge">{{ count(Auth::user()->stusubscriptioncourses) }}</span></a></li>
                                    <?php $repp = 0; ?>
                                    @foreach(Auth::user()->stusubscriptioncourses as $supervisorcourse)
                                     @foreach($supervisorcourse->course->comments->where('commentORmassage',0) as $comment)
                                      @if(!empty($comment->replay) and $repp==0 and $comment->user_id == Auth::user()->id)
                                      <?php $repp = 1; ?>
                                    <li><a data-toggle="tab" href="#profile5">أسئلة تم الرد عليها</a></li>
                                       @endif
                                    @endforeach
                                    @endforeach
                                    <?php $rep = 0; ?>
                                    @foreach(Auth::user()->stusubscriptioncourses as $supervisorcourse)
                                     @foreach($supervisorcourse->course->comments->where('commentORmassage',0) as $comment)
                                      @if(empty($comment->replay) and $rep==0 and $comment->user_id == Auth::user()->id)
                                      <?php $rep = 1; ?>
                                         <li><a data-toggle="tab" href="#profile4">أسئلة لم يتم الرد عليها</a></li>
                                      @endif
                                    @endforeach
                                    @endforeach
                                    <li><a data-toggle="tab" href="#profile6">الرسائل والتنبيهات @if(count(Auth::user()->unreadnotifications) > 0)<span class="badge">{{ count(Auth::user()->unreadnotifications) }}</span>@endif</a></li>
                                </ul>
                            </div>
                            <div class="body-tab-pro">
                                <div class="tab-content">
                                    <!-- tab1 -->
                                    <div id="profile1" class="tab-pane fade in active">
                                        <div class="details-contact">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>الاسم الاول</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ Auth::user()->name }}</span>
                                                </div>
                                            </div>
                                            <!-- 
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>النوع</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ Auth::user()->gender }}</span>
                                                </div>
                                            </div>
                                             -->
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>رقم الهاتف</span>
                                                </div>
                                                <div class="label-details">
                                                    <span><i>{{ Auth::user()->phone }}</i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ url('/') }}/editprofile/{{ Auth::user()->id }}" class="btn btn-gray">تعديل البيانات</a>
                                    </div>
                                    <!-- tab2 -->
                                    <div id="profile2" class="tab-pane fade">
                                        <div class="allcourse">
                                            <ul>
                                                @foreach(Auth::user()->stusubscriptioncourses as $stusubscriptioncourse)
                                                <li class="active">
                                                    <a href="{{ url('/') }}/mycourse/{{ $stusubscriptioncourse->course->id }}"><i class="far fa-play-circle"></i>{{ $stusubscriptioncourse->course->title_ar }}<span></span></a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- tab4 -->
                                    <div id="profile4" class="tab-pane fade">
                                          @foreach(Auth::user()->stusubscriptioncourses as $stusubscriptioncourse)
                                             @foreach($stusubscriptioncourse->course->comments->where('commentORmassage',0) as $comment)
                                                @if(empty($comment->replay) and $comment->user_id == Auth::user()->id)
                                                    <div class="qu-block">
                                                        <h3>
                                                         @lang("site.Your question") &nbsp;:  {{ $comment->title }}
                                                        </h3>
                                                        <p>
                                                           {{ $comment->comment }}
                                                        </p>
                                                    </div>
                                               @endif
                                             @endforeach
                                            @endforeach
                                    </div>

                                    <!-- tab5 -->


                                    <div id="profile5" class="tab-pane fade">
                                    @foreach(Auth::user()->stusubscriptioncourses as $stusubscriptioncourse)
                                     @foreach($stusubscriptioncourse->course->comments->where('commentORmassage',0) as $comment)
                                      @if(!empty($comment->replay) and $comment->user_id == Auth::user()->id)
                                                    <div class="qu-block">
                                                        <h3>
                                                         @lang("site.Your question") &nbsp;:  {{ $comment->title }}
                                                        </h3>
                                                        <p>
                                                           {{ $comment->comment }}
                                                        </p>
                                                        @if(!empty($comment->replay))
                                                        <h3>
                                                         @lang("site.The coach responded") &nbsp;:  {{ $comment->replay }}
                                                        </h3>
                                                         @endif
                                                    </div>
                                               @endif
                                             @endforeach
                                            @endforeach
                                    </div>

                                    <div id="profile6" class="tab-pane fade">
                                    
                                        <div class="allcourse">
                                            <ul>
                                                @foreach($comments as $comment)
                                                 @if(!in_array($comment->conversation_id, $conversation))
                                                <li class="active">
                                                    <a href="{{ url('/') }}/conversation/{{$comment->conversation_id}}/show"><i class="far fa-play-circle" aria-hidden="true"></i>رسائل دورة <?php echo DB::table('courses')->find($comment->course_id)->title_ar ?></a>
                                                </li>
                                                 <?php $conversation[]= $comment->conversation_id ?>
                                                 @endif
                                                @endforeach
                                            </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12"></div>
            </div>
        </section>
        <!-- End Profile3-inner -->
@endsection