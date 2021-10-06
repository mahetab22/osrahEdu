@extends('layouts.app')

@section('content')
        

    <!--======================== Start page header =============================-->
    <section class="page_header" style="background-image: url({{url('/')}}/public/src_website/assets/img/hero.png);">
        <div class="container">
            <div class="content">
                <h4 class="title">@lang('site.about')</h4>
                <div class="history">
                    <a href="{{url('/')}}" class="home">@lang('site.Main')</a>
                    <span class="break"></span>
                    <h5 class="page_name">@lang('site.about')</h5>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End page header =============================-->

    <!--======================== Start about page =============================-->
    <section class="about_page_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="info">
                        <div class="main-heading colored">
                            <h2>عن المنصة</h2>
                            <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="">
                        </div>
                        <div class="desc">
                            <p>@lang('site.aboutus') </p>
                        </div>
                        <ul class="list">
                            <li>@lang('site.goal1_us')</li>
                            <li>@lang('site.goal2_us')</li>
                            <li>@lang('site.goal3_us')</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image">
                        <img src="{{url('/')}}/public/src_Website/assets/img/about/02.png" alt="img" class="img">
                        <img src="{{url('/')}}/public/src_Website/assets/img/about/01.png" alt="img" class="img">
                        <img src="{{url('/')}}/public/src_Website/assets/img/shapes/points.png" alt="" class="points_shape one">
                        <img src="{{url('/')}}/public/src_Website/assets/img/shapes/points.png" alt="" class="points_shape two">
                    </div>
                </div>
            </div>
        </div>
        <div class="animate-group">
            <img class="shape-1 move-1" src="{{url('/')}}/public/src_Website/assets/img/shapes/01.png" alt="">
            <img class="shape-2 move-2" src="{{url('/')}}/public/src_Website/assets/img/shapes/02.png" alt="">
            <img class="shape-3 rotate" src="{{url('/')}}/public/src_Website/assets/img/shapes/03.png" alt="">
            <img class="shape-4 move-3" src="{{url('/')}}/public/src_Website/assets/img/shapes/04.png" alt="">
            <img class="shape-5 move-2" src="{{url('/')}}/public/src_Website/assets/img/shapes/05.png" alt="">
        </div>
    </section>
    <!--======================== End about page =============================-->


    <!--======================== Start our features =============================-->

    <section class="our_features_section">
        <div class="main">
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-4 wow fadeInRight">
                            <div class="box">
                                <div class="info">
                                    <div class="head">
                                        <div class="icon">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M469.333,64H42.667C19.135,64,0,83.135,0,106.667v298.667C0,428.865,19.135,448,42.667,448h426.667
                                                                C492.865,448,512,428.865,512,405.333V106.667C512,83.135,492.865,64,469.333,64z M42.667,85.333h426.667
                                                                c1.168,0,2.177,0.486,3.294,0.667L267.333,252.677c-6.938,4.385-16.854,3.677-21.906,0.563L39.365,86.003
                                                                C40.484,85.82,41.496,85.333,42.667,85.333z M490.667,405.333c0,11.76-9.573,21.333-21.333,21.333H42.667
                                                                c-11.76,0-21.333-9.573-21.333-21.333V106.667c0-2.385,0.637-4.585,1.362-6.728l210.221,170.54
                                                                c6.927,4.479,14.917,6.854,23.083,6.854c7.875,0,15.563-2.198,22.313-6.375c0.625-0.323,1.219-0.708,1.76-1.156l209.23-169.868
                                                                c0.727,2.145,1.363,4.346,1.363,6.733V405.333z"></path>
                                                        </g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                    <g>
                                                    </g>
                                                </svg>
                                        </div>


                                        <div class="name">
                                            <h4>رسالتنا</h4>
                                        </div>
                                    </div>
                                    <div class="desc">
                                        <p>@lang('site.ourmessage') </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 wow fadeInRight">
                            <div class="box">
                                <div class="info">


                                    <div class="head">
                                        <div class="icon">
                                            <svg id="Layer_1_1_" enable-background="new 0 0 64 64" height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <path d="m2.2002 50.6001 2.65332 3.5376-2.77246 6.46826c-.16797.39258-.06934.84814.24707 1.13477.18847.17089.42968.25927.67187.25927.16504 0 .33105-.04053.48145-.12402l20-11c.32031-.1753.51855-.51123.51855-.87598s-.19824-.70068-.51855-.87598l-20-11c-.37109-.20557-.83691-.15234-1.15332.13525-.31641.28662-.41504.74219-.24707 1.13477l2.77246 6.46826-2.65332 3.5376c-.26661.35547-.26661.84473 0 1.2002zm4.51983 4.25812 9.38776-2.20886-11.04431 6.07427zm9.38776-7.50757-9.38776-2.20886-1.65656-3.86542zm-9.7005-.22718 12.22528 2.87653-12.22528 2.87653-2.15729-2.87653z"></path>
                                            <path d="m46 2c-8.48474 0-15.42889 6.6441-15.94934 15h-2.6366l-2.70703-2.70703-1.41406 1.41406 1.29297 1.29297h-4.08594c-5.79004 0-10.5 4.71045-10.5 10.5s4.70996 10.5 10.5 10.5h11.08594l2.70703 2.70703 1.41406-1.41406-1.29297-1.29297h19.08594c3.03223 0 5.5 2.46729 5.5 5.5s-2.46777 5.5-5.5 5.5h-9.08594l-2.70703-2.70703-1.41406 1.41406 1.29297 1.29297h-15.58594v2h15.58594l-1.29297 1.29297 1.41406 1.41406 2.70703-2.70703h9.08594c4.13574 0 7.5-3.36426 7.5-7.5s-3.36426-7.5-7.5-7.5h-19.08594l1.29297-1.29297-1.41406-1.41406-2.70703 2.70703h-11.08594c-4.68652 0-8.5-3.81299-8.5-8.5s3.81348-8.5 8.5-8.5h4.08594l-1.29297 1.29297 1.41406 1.41406 2.70703-2.70703h2.6366c.52045 8.3559 7.4646 15 15.94934 15 8.82227 0 16-7.17773 16-16s-7.17773-16-16-16zm0 30c-7.3822 0-13.43304-5.74707-13.94934-13h3c.50751 5.5979 5.22143 10 10.94934 10 6.06543 0 11-4.93457 11-11s-4.93457-11-11-11c-5.72791 0-10.44183 4.4021-10.94934 10h-3c.5163-7.25293 6.56714-13 13.94934-13 7.71973 0 14 6.28027 14 14s-6.28027 14-14 14zm-2.29297-10.29297 3-3c.39062-.39062.39062-1.02344 0-1.41406l-3-3-1.41406 1.41406 1.29297 1.29297h-6.52692c.49945-4.49298 4.31647-8 8.94098-8 4.96289 0 9 4.0376 9 9s-4.03711 9-9 9c-4.62451 0-8.44153-3.50702-8.94098-8h6.52692l-1.29297 1.29297z"></path>
                                            <path d="m52 18c0-3.30859-2.69141-6-6-6v2c2.20605 0 4 1.79443 4 4s-1.79395 4-4 4v2c3.30859 0 6-2.69141 6-6z"></path>
                                        </svg>
                                        </div>
                                        <div class="name">
                                            <h4>رؤيتنا</h4>
                                        </div>
                                    </div>
                                    <div class="desc">
                                        <p>@lang('site.our_vision_us')</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow fadeInRight">
                            <div class="box">
                                <div class="info">
                                    <div class="head">
                                        <div class="icon">
                                            <svg height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg">
                                                <g id="worth-idea-design-up-hand">
                                                    <path d="m17 3.988h2v2h-2z" transform="matrix(.012 -1 1 .012 12.793 22.926)"></path>
                                                    <path d="m13 3.988h2v2h-2z" transform="matrix(.012 -1 1 .012 8.842 18.926)"></path>
                                                    <path d="m15 1.988h2v2h-2z" transform="matrix(.012 -1 1 .012 12.817 18.95)"></path>
                                                    <path d="m15 5.988h2v2h-2z" transform="matrix(.012 -1 1 .012 8.817 22.901)"></path>
                                                    <path d="m45 3.988h2v2h-2z" transform="matrix(1 -.013 .013 1 -.06 .584)"></path>
                                                    <path d="m49 3.988h2v2h-2z" transform="matrix(1 -.012 .012 1 -.057 .611)"></path>
                                                    <path d="m47 1.988h2v2h-2z" transform="matrix(1 -.013 .013 1 -.034 .61)"></path>
                                                    <path d="m47 5.988h2v2h-2z" transform="matrix(1 -.013 .013 1 -.085 .61)"></path>
                                                    <path d="m62 43v-15a.919.919 0 0 0 -.06-.33l-5.53-15.67a3 3 0 0 0 -2.83-2h-.91a2.984 2.984 0 0 0 -2.4 1.2 3.025 3.025 0 0 0 -.48 2.65l4.21 14.29v7.6l-3 5.4v-8.14a3.009 3.009 0 0 0 -3-3h-.5a3.015 3.015 0 0 0 -2.88 2.15l-4.58 15.57a.863.863 0 0 0 -.04.28v6h-2a1 1 0 0 0 -.99.84l-1 6a1 1 0 0 0 .99 1.16h24a1 1 0 0 0 .99-1.16l-1-6a1 1 0 0 0 -.99-.84h-1.61l3.56-10.68a1.185 1.185 0 0 0 .05-.32zm-2.85 13 .67 4h-21.64l.67-4zm.85-13.16-3.72 11.16h-14.28v-5.86l4.54-15.42a1 1 0 0 1 .96-.72h.5a1 1 0 0 1 1 1v12a1 1 0 0 0 1.87.49l5-9a.947.947 0 0 0 .13-.49v-8a.863.863 0 0 0 -.04-.28l-4.25-14.44a1 1 0 0 1 .96-1.28h.91a1 1 0 0 1 .95.67l5.47 15.5z"></path>
                                                    <path d="m26.99 54.84a1 1 0 0 0 -.99-.84h-2v-6a.863.863 0 0 0 -.04-.28l-4.58-15.57a3.015 3.015 0 0 0 -2.88-2.15h-.5a3.009 3.009 0 0 0 -3 3v8.14l-3-5.4v-7.6l4.21-14.29a3.025 3.025 0 0 0 -.48-2.65 2.984 2.984 0 0 0 -2.4-1.2h-.91a3 3 0 0 0 -2.83 2l-5.53 15.67a.919.919 0 0 0 -.06.33v15a1.185 1.185 0 0 0 .05.32l3.56 10.68h-1.61a1 1 0 0 0 -.99.84l-1 6a1 1 0 0 0 .99 1.16h24a1 1 0 0 0 .99-1.16zm-22.99-12v-14.67l5.47-15.5a1 1 0 0 1 .95-.67h.91a1 1 0 0 1 .96 1.28l-4.25 14.44a.863.863 0 0 0 -.04.28v8a.947.947 0 0 0 .13.49l5 9a1 1 0 0 0 1.87-.49v-12a1 1 0 0 1 1-1h.5a1 1 0 0 1 .96.72l4.54 15.42v5.86h-14.28zm.18 17.16.67-4h20.3l.67 4z"></path>
                                                    <path d="m43 23a11.025 11.025 0 0 0 -7-10.24v-3.76h3a1 1 0 0 0 .58-1.81l-7-5a.991.991 0 0 0 -1.16 0l-7 5a1 1 0 0 0 .58 1.81h3v3.76a10.988 10.988 0 0 0 -1 20.03v4.21a1 1 0 0 0 -1 1v6a3.009 3.009 0 0 0 3 3h6a3.009 3.009 0 0 0 3-3v-6a1 1 0 0 0 -1-1v-4.21a10.982 10.982 0 0 0 6-9.79zm-11-18.77 3.88 2.77h-.88a1 1 0 0 0 -1 1v4.19a10.621 10.621 0 0 0 -4 0v-4.19a1 1 0 0 0 -1-1h-.88zm4 39.77a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1-1v-1h8zm0-3h-8v-2h8zm-.4-9.75a1 1 0 0 0 -.6.91v4.84h-2v-13h4v-2h-10v2h4v13h-2v-4.84a1 1 0 0 0 -.6-.91 9 9 0 1 1 7.2 0z"></path>
                                                </g>
                                            </svg>
                                        </div>


                                        <div class="name">
                                            <h4>تصنيف الجمعية</h4>
                                        </div>
                                    </div>
                                    <div class="desc">
                                        <p>@lang('site.assembly_classification') </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--======================== End our features =============================-->

    <!-- ==================== Start Counter =================== -->
    <section class="counter-section">
        <div class="container">
            <div class="content">
                <div class="main-heading colored text-center">
                    <h2>لماذا تختارنا</h2>
                    <img src="assets/img/line_heading.png" alt="">
                </div>
                <div class="row" id="counters_1">
                    <div class="col-lg-3 col-sm-6">
                        <div class="box wow fadeInUp">
                            <div class="icon">
                                <img src="{{url('/')}}/public/src_website/assets/img/counter/experience.svg" alt="img">
                            </div>
                            <?php $year=date("Y");
                            $start_year=DB::table('infos')->first()->start_year;
                            $y=$year-$start_year;?>
                            <div class="cover">
                                <div class="counter c_0" data-targetnum="{{$y}}" data-speed="4000">{{$y}}</div>
                            </div>
                            <h4>عام من الخبرة</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="box wow fadeInUp">
                            <div class="icon">
                                <img src="{{url('/')}}/public/src_website/assets/img/counter/teacher.svg" alt="img">
                            </div>
                            <div class="cover">
                                <div class="counter c_1" data-targetnum="{{\App\User::where('role_id',3)->count()}}" data-speed="4000">{{\App\User::where('role_id',3)->count()}}</div>
                            </div>
                            <h4>عدد المعلمين</h4>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="box wow fadeInUp">
                            <div class="icon">
                                <img src="{{url('/')}}/public/src_website/assets/img/counter/university.svg" alt="">
                            </div>
                            <div class="cover">
                                <div class="counter c_2" data-targetnum="{{\App\Course::where('activate',1)->count()}}" data-speed="4000">{{\App\Course::where('activate',1)->count()}}</div>

                            </div>
                            <h4>عدد الكورسات</h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="box wow fadeInUp">
                            <div class="icon">
                                <img src="{{url('/')}}/public/src_website/assets/img/counter/student.svg" alt="">
                            </div>
                            <div class="cover">
                                <div class="counter c_3" data-targetnum="{{\App\User::where('role_id',4)->count()}}" data-speed="4000">{{\App\User::where('role_id',4)->count()}}</div>

                            </div>
                            <h4>عدد الطلاب</h4>
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
    <!-- ==================== End Counter =================== -->

 
    <!--==================== Start testimonials =======================-->
    <section class="testimonials_section" style="background-color: #fff; padding: 80px 0 40px;">
        <div class="container">
            <div class="main-heading text-center wow fadeInUp">
                <h2>قالو عنا</h2>
                <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="img">
            </div>
            <div class="owl-carousel owl-theme mt-40 wow fadeInUp">
              @foreach(\App\SaidAboutUs::get() as $s)
                <div class="item_carousel_p">
                    <div class="box">
                        <div class="image"><img src="{{url('/')}}/{{$s->photo}}" alt="img"></div>
                        <div class="info">
                            <div class="about">
                                <h5 class="name">{{$s->username}}</h5>
                                <h6 class="title">{{$s->job}}</h6>
                                <img src="{{url('/')}}/public/src_website/assets/img/icons/quotes.svg" alt="img">
                                <img class="two" src="{{url('/')}}/public/src_website/assets/img/icons/quotes.svg" alt="img">
                            </div>
                            <p class="text-ellipsis">{{$s->comment}}</p>
                            <div class="stars">
                                @for($i=0;$i<$s->rate;$i++)
                                <i class="fas fa-star"></i>
                                @endfor
                                @for($i=0;$i<5-$s->rate;$i++)
                                <i class="fal fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div>
    </section>
    <!--==================== End testimonials =======================-->


    
        
@endsection