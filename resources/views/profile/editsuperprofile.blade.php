@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/css/mobile.css">
<link rel="stylesheet" href="{{url('/')}}/public/src_website/css/style.css">
    @endsection
@section('content')
<?php
    $imagePreview=json_encode(url('/').'/public/storage/'.Auth::user()->avatar);
?>
        <!-- Start Profile3-inner -->
        <section class="profile3-inner edite-inner body-inner">
            <div class="container">
                <div class="col-md-2 col-xs-12"></div>
                <div class="col-md-8 col-xs-12">
                    <div class="profile-details-inner">
                            <form action="{{ route('updateProfile') }}" method="POST" role="form"  enctype="multipart/form-data">
                             @csrf
                        <div class="profile-image">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url({{ $imagePreview }})"></div>
                                </div>
                            </div>
                        </div>
                        <div class="join-name">
                            <div class="name">
                                <h3>اسم المستخدم <span>مدرب</span></h3>
                            </div>
                            <div class="join-data">Joined {{ date("Y-M", strtotime(Auth::user()->created_at)) }}</div>
                            <div class="socila-media-j">
                                <a href="{{ Auth::user()->supervisorinfo->fb }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ Auth::user()->supervisorinfo->inst }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ Auth::user()->supervisorinfo->tw }}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ Auth::user()->supervisorinfo->google }}">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            </div>
                        </div>
                        <div class="body-profile">
                            <div class="body-tab-pro">
                                


                                    <div class="details-contact">
                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>الاسم الاول</span>
                                            </div>
                                            <div class="label-details">
                                                <input type="text" value="{{ Auth::user()->name }}" name="name" />
                                            </div>
                                        </div>
                                    <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.email")</span>
                                            </div>
                                            <div class="label-details">
                                             <input type="text" name="email" placeholder="@lang("site.email")&nbsp; @lang("site.email")" value="{{  Auth::user()->email }}" class="form-control">
                                            </div>
                                    </div>
                                    <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.fb")</span>
                                            </div>
                                            <div class="label-details">
                                             <input type="text" name="fb" placeholder="@lang("site.fb")&nbsp; @lang("site.one")" value="{{ Auth::user()->supervisorinfo->fb }}" class="form-control">
                                            </div>
                                    </div>
                                    <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.tw")</span>
                                            </div>
                                            <div class="label-details">
                                            <input type="text" name="tw" placeholder="@lang("site.tw")&nbsp; @lang("site.two")" value="{{ Auth::user()->supervisorinfo->tw }}" class="form-control">
                                           </div>
                                    </div>
                                    <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.inst")</span>
                                            </div>
                                            <div class="label-details">

                                        <input type="text" name="inst" placeholder="@lang("site.inst")&nbsp; @lang("site.three")" value="{{ Auth::user()->supervisorinfo->inst }}" class="form-control">
                                    </div>
                                    </div>
                                    <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.google")</span>
                                            </div>
                                        <div class="label-details">
                                        <input type="text" name="google" placeholder="@lang("site.google")&nbsp; @lang("site.three")" value="{{ Auth::user()->supervisorinfo->google }}" class="form-control">
                                    </div>
                                    </div>
                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.Educational")</span>
                                            </div>
                                            <div class="label-details">
                                                <input value="{{ Auth::user()->supervisorinfo->Educational }}" placeholder='@lang("site.Educational")'  type="text" id="Educational" name="Educational"  class="form-control" required>
                                            </div>

                                        </div>
<!-- Start Profile3-inner 
                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>النوع</span>
                                            </div>
                                            <div class="label-details">
                                                <select>
                                                    <option>ذكر</option>
                                                    <option>انثي</option>
                                                </select>
                                            </div>
                                        </div>

                                        -->

                                           @foreach($user->supervisorachievements as $supervisorachievement)  
                                           <div class="more-details">   
                                           
                                            
                                                <div class="label-title">
                                                @if($supervisorachievement->type == 1)
                                                <span>@lang("site.education")</span>
                                               @else
                                               <span>@lang("site.cv")</span>
                                               @endif
                                                </div>
                                                <div class="label-details">
                                                  <textarea name="achievement[{{$supervisorachievement->id}}]" placeholder='@lang("site.add achievement")' value="{{ $supervisorachievement->achievement }}" class="form-control">{{ $supervisorachievement->achievement }}</textarea>
                                                </div>
                                               
                                                </div>
                                            @endforeach
                                                                                    
                                       
                                        
                                       <!-- <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.skill")</span>
                                            </div>
                                            <div class="label-details">
                                                <input type="text" name="skill1" placeholder="@lang("site.skill")&nbsp; @lang("site.one")" value="{{ Auth::user()->supervisorinfo->skill1 }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.skil2")</span>
                                            </div>
                                            <div class="label-details">
                                                <input type="text" name="skill2" placeholder="@lang("site.skil2")&nbsp; @lang("site.two")" value="{{ Auth::user()->supervisorinfo->skill2 }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.skil3")</span>
                                            </div>
                                            <div class="label-details">
                                                <input type="text" name="skill3" placeholder="@lang("site.skil3")&nbsp; @lang("site.three")" value="{{ Auth::user()->supervisorinfo->skill1 }}" class="form-control">
                                            </div>
                                        </div>-->

                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>رقم الهاتف</span>
                                            </div>
                                            <div class="label-details">
                                                <input type="tel" value="{{ Auth::user()->phone }}" name="phone" />
                                            </div>
                                        </div>
                                    </div>
                                     <!--
                                    <div class="more-details">
                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.Trainer_Profile")</span>
                                            </div>
                                            <div class="label-details">
                                        <textarea type="text" name="note_profile" placeholder="{{ Auth::user()->supervisorinfo->profile }}" value="{{ Auth::user()->supervisorinfo->profile }}" class="form-control">{{ Auth::user()->supervisorinfo->profile }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    -->
                                    <div class="btn-form">
                                        <input type="submit" value="حفظ" class="btn-style" />
                                        <a class="btn-style" data-toggle="modal" data-target="#add-achievement">@lang("site.add-achievement")</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12"></div>
            </div>
        </section>
        <!-- End Profile3-inner -->
        <!-- Add Exam code-->
        <div id="add-achievement" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="add-qu form-contact">
                            <h3>@lang("site.add-achievement")</h3>

                               <form action="{{ route('addachievement')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                         <label></label>
                                         <input type="radio" name="radio" value="1">@lang("site.education")
                                         <label></label>
                                         <input type="radio" name="radio" value="2" checked="">@lang("site.cv")
                                </div>
                                  
                               <!-- <div class="form-group text">
                                  <label>@lang("site.Choose the order")</label>
                                   <select class="form-control" id="myselect" name="order">
                                           @foreach($user->supervisorachievements as $supervisorachievement)
                                            <option value="{{ $supervisorachievement->id }}" class="btn"><span>@lang("site.after") -- {{ $supervisorachievement->achievement }}</span> </option>
                                          <!--   @endforeach
                                   </select>
                                </div>-->
                                              
                                <input name="user_id" value="{{ Auth::user()->id }}" hidden="" />
                                <div class="form-group">
                                    <label>@lang("site.achievement")</label>
                                    <textarea  name="achievement" placeholder='@lang("site.achievement")'  class="form-control"></textarea>
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
@endsection

@section('script')   

@endsection    