@extends('layouts.app')

@section('content')
<?php
    $imagePreview=json_encode(url('/').'/public/storage/'.$user->avatar);
?>
        <!-- Start Profile3-inner -->
        <section class="profile3-inner body-inner">
            <div class="container">
                <div class="col-md-2 col-xs-12"></div>
                <div class="col-md-8 col-xs-12">
                    <div class="profile-details-inner">
                        <div class="profile-image">
                            <div class="avatar-upload">

                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url({{ $imagePreview }})"></div>
                                </div>
                            </div>
                        </div>
                        <div class="join-name">
                            <div class="name">
                                <h3>{{ $user->name }}<span>مدرب</span></h3>
                            </div>
                            <div class="join-data">Joined {{ date("Y-M", strtotime($user->created_at)) }}</div>
                            <div class="socila-media-j">
                                <a href="{{ $user->fb }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ $user->inst }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ $user->tw }}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ $user->google }}">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            </div>
                        </div>
                        <div class="body-profile">
                            <div class="header-tab-pro">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#profile1">الملف الشخصي</a></li>
                                    <li><a data-toggle="tab" href="#profile2">الدورات <span class="badge">{{ count($user->supervisorcourses) }}</span></a></li>
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
                                                    <span>{{ $user->name }}</span>
                                                </div>
                                            </div>
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>المؤهل</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ $user->supervisorinfo->Educational }}</span>
                                                </div>
                                            </div>
                                            <!-- tab2 
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>النوع</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ $user->gender }}</span>
                                                </div>
                                            </div>
                                            -->
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>رقم الهاتف</span>
                                                </div>
                                                <div class="label-details">
                                                    <span><i>{{ $user->phone }}</i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="more-details">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>سيرة ذاتية</span>
                                                </div>
                                                <div class="label-details">
                                                    <ul>
                                                    @foreach($user->supervisorachievements as $supervisorachievement)  
                                                        <li>
                                                          {{ $supervisorachievement->achievement }}
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- tab2 -->
                                    <div id="profile2" class="tab-pane fade">
                                        <div class="allcourse">
                                            <ul>
                                                @foreach($user->supervisorcourses as $supervisorcourse)
                                                <li class="active">
                                                    <a href="{{ url('/') }}/mycourseafter/{{ $supervisorcourse->course->id }}"><i class="far fa-play-circle"></i>{{ $supervisorcourse->course->title_ar }}<span></span></a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- tab3 -->




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

@section('script')
  
  <script>      
        $(document).ready(function () {
    $(".text").hide();
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
});
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
 							<script type="text/javascript">
							$('.drug').click(function(){
							var path = $(this).attr('path');
							$('#c-profile').css('display','block');
							$('.pathinput').val(path);
							$('.path').text(path);
							});
							</script>
@endsection