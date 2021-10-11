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
                                <h3>{{auth::user()->name}} <span>@if(auth::user()->role_id==4)
                                طالب
                                @else
                                مسوق
                                @endif
                                </span></h3>
                            </div>
                            <div class="join-data">Joined {{ date("Y-M", strtotime(Auth::user()->created_at)) }}</div>
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

                                    </div>
                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>@lang("site.Educational")</span>
                                            </div>
                                            <div class="label-details">
                                                <select class="form-control" name="Educational">
                                                    <option value="Bachelor">@lang("site.Bachelor")</option>
                                                    <option value="Master">@lang("site.Master")</option>
                                                    <option value="Doctorate">@lang("site.Doctorate")</option>
                                                </select>
                                            </div>

                                        </div>

                                       <!-- <div class="block-item">
                                            <div class="label-title">
                                                <span>النوع</span>
                                            </div>
                                            <div class="label-details">
                                                <select>
                                                    <option>ذكر</option>
                                                    <option>انثي</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        


                                        <div class="block-item">
                                            <div class="label-title">
                                                <span>رقم الهاتف</span>
                                            </div>
                                            <div class="label-details">
                                                <input type="tel" value="{{ Auth::user()->phone }}" name="phone" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-form">
                                        <input type="submit" value="حفظ" class="btn-style" />
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

@endsection

@section('script')   

@endsection    