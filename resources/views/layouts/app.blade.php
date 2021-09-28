<!DOCTYPE html>
<html lang="en">
<?php
        $info = DB::table('infos')->first();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{url('/')}}/{{$info->favicon}}" sizes="16x16" type="image/png"> 
 <meta name="description" content="@lang('site.aboutus') @lang('site.hint_us') @lang('site.hint2_us')">
  <meta name="description" content="@lang('site.aboutus')">
  <!--fb & Whatsapp-->
  <meta property="og:site_name" content="@lang('site.name_us')">
<meta property="og:description" content="@lang('site.aboutus')">
<meta property="og:type" content="website" />
<title>@lang('site.name_us')</title>
@yield('title')

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- vendor styles -->
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/FontAwesome/all.css">
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/owl.carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/owl.carousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/animate.css/animate.css">
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/venobox/venobox.css">
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/nice-select/nice-select.css">
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/slick/slick.css">
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/vendor/slick/slick-theme.css">

    <!-- main style -->
    <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/css/style.css">
@yield('style')
<meta property="og:image" content="{{url('/')}}/{{$info->favicon}}">
<link rel="apple-touch-icon" sizes="57x57" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{url('/')}}/{{$info->favicon}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('/')}}/{{$info->favicon}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('/')}}/{{$info->favicon}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{url('/')}}/{{$info->favicon}}">
    <meta name="theme-color" content="#ffffff">
    <meta name="google-site-verification" content="03YcNFDeAGcthXeQw-y2GA1e0MrA5QCQlNGTXVvUUQU" />
       
    <!-- <link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/css/style-ltr.css"> -->
</head>

<body>
@include('layouts._validation')
    <!--======================== start nav top =============================-->
    <div class="nav_top">
        <div class="container">
            <div class="row">
                <div class="col-12 ">
                    <div class="row_nav row">
                        <div class="col-sm-6">
                            <a href="{{url('/')}}" class="logo">
                                <img src="{{url('/')}}/{{$info->logo}}" alt="img">
                            </a>
                        </div>
                       
                        <div class="col-sm-6 flex_end vission d-sm-flex d-none">
                        @if(!auth::check())
                            <div class="btns">
                                <a href="{{url('/')}}/login" class="main-btn main">@lang('site.login')</a>
                                <a href="{{ route('registerStudent') }}" class="main-btn main"> @lang("site.Join_student")</a>
                                <a href="{{ route('registerSupervisor') }}" class="main-btn main">@lang("site.Join_teacher")</a>
                          
                            </div>
                        @else
                        <div class="btns">
                                   @if(auth::user()->role_id==1)
                                   <a href="{{url('/')}}/admin" class="main-btn main">@lang('site.main')</a>
                                   @elseif(Auth::user()->role_id == 4 )
    							          
    							            <a href="{{ route('profile') }}"class="main-btn main"><i class="fa fa-briefcase"></i>@lang("site.profile")</a>
    							         
                                 @elseif(Auth::user()->role_id == 3)
                                            
							                 <a href="{{ route('supervprofile') }}" class="main-btn main"><i class="fa fa-briefcase"></i>@lang("site.profile")</a>
							                
                                   @endif
                                   <a href="{{ route('Logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();" class="main-btn main"> <i class="fas fa-sign-out-alt"></i>@lang("site.logout")</a>
                                        <form id="logout-form" action="{{ route('Logout-form') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                         </div>
                        @endif
                            <img src="{{url('/')}}/public/src_website/assets/img/vission.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======================== End nav top =============================-->

    <!--======================== start nav bar =============================-->

    <nav class="nav_bar">
        <div class="container">
            <div class="row_nav row">
                <div class="col-lg-7 d-lg-flex d-none align-items-center">
                    <ul class="list">
                        <li><a class="active" href="{{url('/')}}">@lang('site.Main')</a></li>
                        <li><a href="{{ route('about') }}">@lang('site.about')</a></li>
                        <li><a href="{{ route('courses') }}">@lang("site.Training_Programs")</a></li>
                        <li><a href="{{ url('/') }}/comquestion">@lang("site.common_questions")</a></li>
                        <li><a href="{{ url('/') }}/books">@lang('site.library')</a></li>
                        <li><a href="{{ route('contact') }}">@lang("site.Contact_Us")</a></li>
                    </ul>
                </div>
                <div class="col-3 d-flex d-lg-none">
                    <div class="navbar-toggler" id="nav-icon1">
                        <div>
                            <span class="one"></span>
                            <span class="two"></span>
                            <span class="three"></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-9 flex_end icons">
                    <span class="cart_icon"><i class="fal fa-shopping-cart"></i></span>
                    <span class="icon_search d-sm-flex d-none"><i class="fal fa-search"></i></span>
                </div>
            </div>
        </div>
    </nav>
    <div class="sidebar">
        <div class="side-nav">
            <ul>
                <li>
                    <a href="{{url('/')}}">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="name">@lang('site.Main')</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('about') }}">
                        <span class="icon"><i class="fas fa-address-card"></i></span>
                        <span class="name">@lang('site.about')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('courses') }}">
                        <span class="icon"><i class="fas fa-star"></i></span>
                        <span class="name">@lang("site.Training_Programs")</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}/comquestion">
                        <span class="icon"><i class="far fa-envelope"></i></span>
                        <span class="name">@lang("site.common_questions")</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}/books">
                        <span class="icon"><i class="far fa-envelope"></i></span>
                        <span class="name">@lang('site.library')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">
                        <span class="icon"><i class="far fa-envelope"></i></span>
                        <span class="name">@lang("site.Contact_Us")</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="overlay_gen" style="display: none;"></div>

    @yield('content')

     <!--==================== Start footer =======================-->
     <footer class="footer">
        <div class="container">
            <!--==================== Start newsletter =======================-->
            <section class="newsletter_section wow fadeInUp">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="text">
                            <h4>@lang('site.Be aware of our events?')</h4>
                            <h6>@lang('site.Subscribe by e-mail to receive new news')</h6>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <form action="{{ route('addnewemail') }}" method="post" class="enter_email">
                            @csrf
                            <input type="email" name="email" class="email" placeholder="@lang('site.email')">
                            <button type="submit" class="icon"><i class="fal fa-arrow-left"></i></button>
                        </form>
                    </div>
                </div>
            </section>
            <!--==================== End newsletter =======================-->


            <!--==================== Start footer bottom =======================-->
            <section class="footer_bootom wow fadeInUp">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="info_site">
                            <a href="{{url('/')}}" class="logo"><img src="{{url('/')}}/{{$info->logo}}" alt="logo"></a>
                            <p class="desc text-ellipsis">@lang('site.aboutus')</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="sochial">
                            <a href="{{url('/')}}" class="logo"><img src="{{url('/')}}/{{$info->logo}}" alt="logo"></a>
                            <div class="s_media">
                                <a href="{{$info->fb}}" class="face"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$info->inst}}" class="insta"><i class="fab fa-instagram"></i></a>
                                <a href="{{$info->tw}}" class="twitter"><i class="fab fa-twitter"></i></a>
                                <a href="{{$info->google}}" class="google"><i class="fab fa-google-plus-g"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="site_map">
                            <div>
                                <h6 class="head">@lang('site.Site_Map')</h6>
                                <ul class="list">
                                    <li> <a href="{{ route('about') }}">@lang("site.about")</a> </li>
                                    <li>  <a href="{{ route('courses') }}">@lang("site.Training_Programs")</a>   </li>                                    <li><a href="{{ route('moreservices') }}">@lang("site.Specialized_Services")</a></li>
                                    <li><a href="{{ route('team') }}">@lang("site.Our_team")</a></li>
                                    <li><a href="{{ route('conditions') }}">@lang("site.conditions")</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--==================== End footer bottom =======================-->
        </div>
    </footer>
    <!--==================== End footer =======================-->


    <!--======================= Start copyright Section ===========================-->
    <div class="copyright wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 copy">
                    <p>© @lang('site.All rights reserved to') <a class="main-color" href="{{url('/')}}">@lang('site.name_us')</a> 2021</p>
                </div>
                <div class="col-sm-6 image">
                    <div class="ryad-logo" style="display: inline-block;">
                        <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" style="color:#666666">
                            <svg height="90" width="102" style=" transform: rotateY(180deg) scale(.35);float: left;width: 77px;">
                                                            <line x1="0" y1="0" x2="90" y2="0" style="stroke:#f00;stroke-width:35" />
                                                            <line x1="100" y1="0" x2="0" y2="10" style="stroke:#f00;stroke-width:20; transform:rotate(40deg)" />
                                                            <line x1="10" y1="95" x2="50" y2="45" style="stroke:#f00;stroke-width:20;" />
                                                        </svg>
                        </a>
                        <div class="lolo-co" style="float: right;text-align: left;padding-top: 30px;position: relative;left: -15px;">
                            <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" style="color:#666666;text-decoration: none;">
                                <p style="text-transform: uppercase;font-family: sans-serif;font-size: 24px;line-height: 0.7;margin: 0;font-weight: 700;">elryad</p>
                            </a>
                            <span style="font-size: 12px;font-family: sans-serif; color:#666666;">
                                                            <a target="_balnk" href="https://elryad.com/ar/" title="تصميم مواقع" alt="تصميم مواقع" style="font-size: 12px; font-family: sans-serif; color:inherit;text-decoration: none;">تصميم مواقع </a> /
                                                             <a target="_balnk" href="https://elryad.com/ar/برمجة-تطبيقات-الجوال/" title="تطبيقات" alt="تطبيقات" style="font-size: 12px; font-family: sans-serif; color:inherit;text-decoration: none;">تطبيقات</a>
                                                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======================= Start copyright Section ===========================-->
















    <!--======================== start search popup =============================-->
    <div class="search-popup search-popup__default">
        <div class="search-popup__overlay search-toggler"></div>
        <div class="search-popup__content">
            <div class="aws-container" data-url="/themes/agrikon/?wc-ajax=aws_action" data-siteurl="https://ninetheme.com/themes/agrikon" data-lang="" data-show-loader="true" data-show-more="true" data-show-page="true" data-show-clear="true" data-mobile-screen="false"
                data-use-analytics="false" data-min-chars="1" data-buttons-order="1" data-is-mobile="false" data-page-id="4016" data-tax="">
                <form class="aws-search-form aws-show-clear" action="#" method="post" role="search">
                    <div class="aws-wrapper">
                        <label style="position:absolute !important;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;" class="aws-search-label" for="6054afa526acc">Search</label>
                        <input type="search" name="s" id="6054afa526acc" value="" class="aws-search-field" placeholder="Search" autocomplete="off">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--======================== End search popup =============================-->



    <!-- ==================== button up =================== -->
    <div class="up"><i class="fas fa-chevron-up"></i></div>
    <!-- ==================== button up =================== -->



    <!-- vendor scripts -->
    <script src="{{url('/')}}/public/src_website/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/popper.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/wow/wow.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/venobox/venobox.min.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/mixitup/mixitup.min.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/multi-animated-counter.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/nice-select/jquery.nice-select.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/slick/slick.min.js"></script>


    <script src="{{url('/')}}/public/src_website/assets/vendor/intelTellinput/intlTelInput.js"></script>
    <script src="{{url('/')}}/public/src_website/assets/vendor/intelTellinput/intlTelInput-jquery.min.js"></script>
    <!-- main.js -->
    <script src="{{url('/')}}/public/src_website/assets/js/main.js"></script>
@yield('script')


    <script>
        //MixItUp
        var mixer = mixitup('.courses_section');
        $('.courses_section .list_control li').click(function() {

            $(this).addClass('active').siblings().removeClass('active')

        })
    </script>
</body>

</html>