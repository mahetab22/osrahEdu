@extends('layouts.app')

@section('content')

        
        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
            <div class="container">
                <h2>@lang("site.profile")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                            @lang("site.Main")
                        </a>
                    </li>
                    <li>
                        <span>
                            @lang("site.profile")
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title -->
        
        <!-- Start Team-inner -->
        <section class="profile-inner body-inner">
            <div class="container">
                <div class="col-md-2 col-xs-12"></div>
                <div class="col-md-8 col-xs-12">
                    <div class="cv-content">
                        <div class="col-md-5 col-xs-12">
                            <div class="img-u">
                                <img src="{{ url('/') }}/public/storage/{{ Auth::user()->avatar }}" alt="" />
                            </div>

                            <a class="btn-style" data-toggle="modal" data-target="#changepassword">@lang("site.changepassword")</a>
                        </div>
                        <div class="col-md-7 col-xs-12">
                            <h3>{{ Auth::user()->name }}</h3>
{{--                             <span><h5>{{ Auth::user()->email }}</h5></span> --}}
                                <ul>
                                 <li>
                                   <strong>@lang("site.email"): </strong>
                                    <span>{{ Auth::user()->email }}</span>
                                </li>
                            </ul>
                            <a class="btn-style" data-toggle="modal" data-target="#profile2">تعديل</a>
                        </div>
                        <div class="col-xs-12"></div>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12"></div>
            </div>
        </section>
        <!-- End Team-inner -->

        <!-- Modal -->
        <div id="profile2" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="cv-content">
                          <form action="{{ route('updateProfile') }}" method="POST" role="form"  enctype="multipart/form-data">
                             @csrf
                                <div class="col-md-5 col-xs-12">
                                    <div class="img-u">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload"></label>
                                            </div>
                                            <div class="avatar-preview">
                                                {{-- <div class="imagePreview" style="background-image: url(images/user.jpg);">
                                                </div> --}}
                                                <img class="imagePreview" src="{{ url('/') }}/public/storage/{{ Auth::user()->avatar }}"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-xs-12">


                                   <div class="form-group">
                                        <label>@lang("site.name")</label>
                                        <input type="text" placeholder="@lang("site.name")" value="{{ Auth::user()->name }}" class="form-control" name="name" />
                                    </div>
                                    <div class="form-group">
                                        <label>@lang("site.email")</label>
                                        <input type="text" name="email" placeholder="@lang("site.email")&nbsp; @lang("site.email")" value="{{  Auth::user()->email }}" class="form-control">
                                    </div>


                                    <div class="form-group">
                                        <input type="submit" value="حفظ" class="btn" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="changepassword" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="cv-content">
                          <form action="{{ route('changepassword') }}" method="POST" role="form"  enctype="multipart/form-data">
                             @csrf
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label>@lang("site.oldpassword")</label>
                                        <input type="password" name="oldpassword" placeholder="@lang("site.oldpassword")"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang("site.newpassword")</label>
                                        <input type="password" name="password" placeholder="@lang("site.password")" class="form-control">
                                    </div>
                                    <div class="form--group">
                                        <label>@lang("site.password_confirmation")</label>
                                        <input type="password" name="password_confirmation" placeholder="@lang("site.password_confirmation")" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="@lang("site.edit")" class="btn" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection