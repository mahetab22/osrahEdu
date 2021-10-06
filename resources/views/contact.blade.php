@extends('layouts.app')

@section('content')

    <!--======================== Start page header =============================-->
    <section class="page_header" style="background-image: url({{url('/')}}/public/src_website/assets/img/hero.png);">
        <div class="container">
            <div class="content">
                <h4 class="title">@lang("site.Contact_Us")</h4>
                <div class="history">
                    <a href="#" class="home">@lang("site.Main")</a>
                    <span class="break"></span>
                    <h5 class="page_name">@lang("site.Contact_Us")</h5>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End page header =============================-->

    <!-- ==================== Start common questions page =================== -->
    <section class="contact_page">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-8 o-2">
                    <div class="modal_form">
                        <div class="">
                            <form action="{{ route('addcontacts') }}" method="POST" role="form"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>@lang("site.name")</label>
                                <input type="text" name="name" placeholder="@lang('site.name')" class="form-control"  />
                                @error('name')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang("site.email")</label>
                                <input type="email" name="email" placeholder="@lang('site.email')" class="form-control"/>
                                @error('email')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                          
                            <div class="form-group">
                                <label>@lang("site.contactType")</label>
                                   <select name="type" class="form-control">
                                       @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->title_ar}}</option>
                                        @endforeach
                                   </select>
                             </div>
                                <div class="form-group">
                                    <label for="">@lang('site.topic')</label>
                                    <input type="text" placeholder="الموضوع" name="topic" class="form-control">
                                    @error('topic')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">@lang('site.message')</label>
                                    <textarea placeholder="الرسالة" class="form-control" name="message" style="height: 150px; resize: none;"></textarea>
                                    @error('message')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <button class="main-btn main">@lang('site.sent')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card_contact">
                        <div>
                            <h5 class="head">للتواصل معنا</h5>
                            <div class="item">
                                <span>{{$info->email}}</span>
                            </div>
                            <!-- <div class="item">
                                <span>rwabet2030@gmail.com</span>
                            </div> -->
                            <div class="item">
                                <span>الجوال : {{$info->whatsapp_male}}</span>
                            </div>
                            <div class="item">
                                <span>الجوال : {{$info->whatsapp_female}}</span>
                            </div>
                            <div class="sochial_media">
                                <a href="{{$info->fb}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$info->tw}}" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{$info->inst}}" class="insta"><i class="fab fa-instagram"></i></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="animate-group">
            <img class="shape-1 move-1" src="{{url('/')}}/public/src_website/assets/img/shapes/01.png" alt="">
            <img class="shape-2 move-2" src="{{url('/')}}/public/src_website/assets/img/shapes/02.png" alt="">
            <img class="shape-3 rotate" src="{{url('/')}}/public/src_website/assets/img/shapes/03.png" alt="">
            <img class="shape-4 move-3" src="{{url('/')}}/public/src_website/assets/img/shapes/04.png" alt="">
            <img class="shape-5 move-2" src="{{url('/')}}/public/src_website/assets/img/shapes/05.png" alt="">
        </div>
    </section>
    <!-- ==================== End common questions page =================== -->


    <section class="location_section">
        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=%D8%A7%D9%84%D8%B3%D8%B9%D9%88%D8%AF%D9%8A%D8%A9%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0"
            marginwidth="0"></iframe>
    </section>


        

@endsection