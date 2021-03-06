<!DOCTYPE html>
<html class="no-js" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
    <head>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta charset="utf-8">
        <meta name="author" content="elryad.com">
        <meta name="description" content="NumScroller - jQuery plugin for number increment rolling animation when it becomes visibile while scrolling">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@lang("site.name_us")</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/src_website/images/logo.png') }}" />
        <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <link href="{{ asset('public/src_website/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/src_website/css/mobile.css') }}" rel="stylesheet" type="text/css" />

        @if(app()->getLocale() == 'ar')
                <link href="{{ asset('public/src_website/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />

        @else
                <link href="{{ asset('public/src_website/css/style-en.css') }}" rel="stylesheet" type="text/css" />
        @endif
        
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TQFDGCS');</script>
        <!-- End Google Tag Manager -->
        
    </head>
    <body>
        
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TQFDGCS"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        
        <?php
        $info = DB::table('infos')->first();
        ?>

       @auth
        @if(Auth::user()->hasPermission('browse_lessons'))
        <nav class="navbar navbar-inverse header">
            <div class="container">
                <div class="col-md-9 col-xs-12">
                    <div class="collapse navbar-collapse">
                        
                        <ul class="nav navbar-nav" >
                            @if(Auth::user()->role_id == 3)
                            <li class="current-menu-item"><a href="{{ url('admin') }}">@lang("site.welcome_professor")&nbsp;: &nbsp; {{ Auth::user()->name}}</a></li>
                            @elseif(Auth::user()->role_id == 1 )
                            <li class="current-menu-item">{{ Auth::user()->name}}</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-8">
                    <div class="navbar-right">
                        <ul>
                            @auth
                            @if(Auth::user()->role_id == 3)
                            <li><a href="{{ url('admin') }}"><i class="fa fa-user"></i>@lang("site.supervisor_panel")</a></li>
                            @elseif(Auth::user()->role_id == 1 )
                            <li><a href="{{ url('admin') }}"><i class="fa fa-user"></i>@lang("site.admin_panel")</a></li>
                            @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        @endif
        @endauth
        <!-- Start Header -->
        <header class="header-top">
            <div class="container">
                <div class="col-xs-6">
                    <a href="{{ route('/') }}" class="logo">
                        {{-- <img src="{{ asset('public/src_website/images/logo.png') }}" alt="" /> --}}
                        <img src="{{ url('/') }}/public/storage/{{ $info->logo }}" alt="" />
                        <div class="text-logo">
                            <h2>@lang("site.name_us")</h2>
                            <h4>@lang("site.hint_us")</h4>
                        </div>
                    </a>
                </div>
                <div class="col-xs-6">
                    <div class="margin-16"></div>

                         @auth
                         <!--@if(Auth::user()->role_id == 4)                         
                          <a href="{{ route('profile') }}" class="lang">@lang("site.profile")<i class="fa fa-user"></i></a>
                                                                                 
                          @endif                                                  
                         <a href="{{ route('Logout') }}" class="btn-style" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span> @lang("site.logout")</span> <i class="fa fa-user"></i></a>
                                    <form id="logout-form" action="{{ route('Logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form> --> 
                     @else 
                        <a class="btn-style" data-toggle="modal" data-target="#login"><span>@lang("site.login")</span> <i class="fa fa-user"></i></a>
{{--                         <a href="#" class="btn-style"><span>?????????? ???????? </span> <i class="fa fa-user"></i></a>
 --}} 
                        @endauth
                    @if(app()->getLocale() == 'ar')
                    <a href="{{ LaravelLocalization::getLocalizedURL("en", null, [], true) }}" class="lang">@lang("site.English")<i class="fa fa-globe-americas"></i></a>
                    @else
                    <a href="{{ LaravelLocalization::getLocalizedURL("ar", null, [], true) }}" class="lang"> <i class="fa fa-globe-americas"></i>@lang("site.arabic")</a>
                    @endif
                </div>
            </div>
        </header>
        <!-- End Header -->
        <!-- Start Nav -->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="col-md-9 col-xs-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        
                        <ul class="nav navbar-nav" >
                            <li class="current-menu-item"><a href="{{ route('/') }}">@lang("site.Main")</a></li>                            
                            <li><a href="{{ route('about') }}">@lang("site.about")</a></li>
                            <li><a href="{{ route('courses') }}">@lang("site.Training_Programs")</a></li>
                            <li><a href="{{ route('exam') }}">@lang("site.Testing_Center")</a></li>
                            <li><a href="{{ route('moreservices') }}">@lang("site.Specialized_Services")</a></li>
                            <li><a href="{{ route('team') }}">@lang("site.Our_team")</a></li>
                            <li><a href="{{ route('contact') }}">@lang("site.Contact_Us")</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-xs-8">
                    <div class="navbar-right">
                         @auth
                       
                            @auth
                            
                               <ul class="nav navbar-nav Other" >
                                <li class="dropdown menu-item-has-children">
    							    <a href="#"><i class="fa fa-user"></i>{{ Auth::user()->name}}</a>
    							    <ul class="sub-menu">
                                    @if(Auth::user()->role_id == 4)
    							           <li>
    							            <a href="{{ route('profile') }}"><i class="fa fa-briefcase"></i>@lang("site.profile")</a>
    							          </li>
                                        @elseif(Auth::user()->role_id == 3)
                                             <li>
							                 <a href="{{ route('supervprofile') }}"><i class="fa fa-briefcase"></i>@lang("site.profile")</a>
							                 </li>
                                        @endif
                                        
    							        <li>
    							            <a href="{{ route('Logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt"></i>@lang("site.logout")</a>
                                        <form id="logout-form" action="{{ route('Logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
    							        </li>
    							    </ul>
    							</li>
                            </ul>
                            <!--<li><a href="{{ route('profile') }}"><i class="fa fa-user"></i>@lang("site.profile")</a></li>-->
                                <!--<li><a href="{{ route('supervprofile') }}"><i class="fa fa-user"></i>@lang("site.profile")</a></li>-->
                            
                            @endauth
                        
                        @else
                        <ul>
                            <li>
                                <a href="{{ route('registerStudent') }}" class="joinS"><i class="fa fa-user"></i> @lang("site.Join_student")</a>
                            </li>
                            <li>
                                <a href="{{ route('registerSupervisor') }}" class="joinS"><i class="fa fa-briefcase"></i> @lang("site.Join_teacher")</a>
                            </li>
                        </ul>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
        
        <!--?????? ?? redirect?????? ???? ????????  -->
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

      {{--  @include('layouts._validation') --}}
        <!-- End Nav -->
        @yield('content')
        <!-- Start Footer -->

        <!-- Start Login-now -->
        <section class="login-now" style="background-image: url({{ asset('public/src_website/images/slider1.png') }})">
            <div class="container">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <h1 class=" wow fadeInRight" data-wow-duration="1.1s" data-wow-delay=".3s"> @lang("site.Ready_to_start_learning_now")</h1>
                    <h4 class=" wow fadeInRight" data-wow-duration="1.1s" data-wow-delay=".5s">@lang("site.hint_us")</h4>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    @auth
                    <a href="{{ route('courses') }}" class="btn-style white fadeInLeft">@lang("site.go")</a>
                    @else
                    <a href="{{ route('registerorlogin') }}" class="btn-style white fadeInLeft">@lang("site.go")</a>
                    @endif
                </div>
            </div>
        </section>
        <!-- End Login-now -->
        <div></div>
        <!-- Start Footer -->
        <footer>
            <div class="container">
                <!-- Start Footer-top -->
                <div class="footer-top">
                    <!-- Start Col -->
                    <div class="col-md-4 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
                        <p>
                            @lang("site.our_vision_us")
                        </p>
                    </div>
                    <!-- End -->
                    <!-- Start Col -->
                    <div class="col-md-5 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".5s">
                        <h3>@lang("site.Site_Map")</h3>
                        <ul class="links">

                            <li>
                                <a href="{{ route('/') }}">@lang("site.Main")</a>
                            </li>
                            <li>
                               <a href="{{ route('about') }}">@lang("site.about")</a>
                            </li>
                            <li>
                               <a href="{{ route('courses') }}">@lang("site.Training_Programs")</a>
                            </li>
                            <li>
                                <a href="{{ route('exam') }}">@lang("site.Testing_Center")</a>
                            </li>
                            <li>
                                <a href="{{ route('moreservices') }}">@lang("site.Specialized_Services")</a>
                            </li>
                            <li>
                                <a href="{{ route('team') }}">@lang("site.Our_team")</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">@lang("site.Contact_Us")</a>
                            </li>
{{--                             <li>
                                <a href="#">?????????? ????????????</a>
                            </li> --}}
                        </ul>
                    </div>
                    <!-- End -->

                    <!-- Start Col -->
                    <div class="col-md-3 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".7s">
                        <h3>@lang("site.Mailing_List")</h3>
                        <div class="news-lett">
                            <span>@lang("site.Add_your_emai_to_receiv_new_courses")</span>
                            <div class="form-news">
                                <form action="{{ route('addnewemail') }}"  method="POST" role="form" >
                                    @csrf
                                    <input type="email" name="email" placeholder="@lang("site.Email")" />
                                    <button type="submit"><i class="fa fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="social-f">
                            <ul>
                                <li>
                                    <a href="{{ $info->fb }}">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $info->tw }}">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $info->tw }}">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $info->google }}">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End -->
                </div>
                <!-- End Footer-top -->
                <!-- Start Footer-bottom -->
                <div class="footer-bottom">
                    <div class="col-md-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".3s">
                        <p>
                            &copy; @lang("site.All_rights_reserved")
                            <a href="{{ url('/') }}">@lang("site.name_us")</a>
                            2019
                        </p>
                    </div>
                    <div class="col-md-6 col-xs-12 wow fadeIn" data-wow-duration="1.1s" data-wow-delay=".5s">
                        <div class="company-n">
                            <div class="ryad-logo" style="display: inline-block;">
                                <a href="https://elryad.com/ar/" title="?????????? ??????????" style="color:#fff">
                                  <svg height="90" width="102" style=" transform: rotateY(180deg) scale(.35);float: left;width: 77px;">
                                    <line x1="0" y1="0" x2="90" y2="0" style="stroke:rgb(255,255,255);stroke-width:35" />
                                    <line x1="100" y1="0" x2="0" y2="10" style="stroke:rgb(255,255,255);stroke-width:20; transform:rotate(40deg)" />
                                    <line x1="10" y1="95" x2="50" y2="45" style="stroke:rgb(255,255,255);stroke-width:20;" />
                                </svg></a>
                                <div class="lolo-co" style="float: right;text-align: left;position: relative;left: -15px;">
                                <a href="https://elryad.com/ar/" title="?????????? ??????????" style="color:#fff;text-decoration: none;">
                                <p style="text-transform: uppercase;font-family: sans-serif;font-size: 24px;line-height: 0.7;margin: 0;font-weight: 700;">elryad</p></a>
                                    <span style="font-size: 12px;font-family: sans-serif; color:#fff;">
                                    <a href="https://elryad.com/ar/" style="font-size: 12px; font-family: sans-serif; color:#fff;text-decoration: none;">?????????? ?????????? </a> /
                                     <a href="https://elryad.com/ar/??????????-??????????????-????????????/" style="font-size: 12px; font-family: sans-serif; color:#fff;text-decoration: none;">??????????????</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Footer-bottom -->
            </div>
        </footer>
        <!-- End Footer -->


        <div class="wahtt">
            <a href="https://api.whatsapp.com/send?phone=96605123587"><i class="fab fa-whatsapp"></i></a>
        </div>


        <!-- End -->
         <!-- Start ModalLogin -->
        <div id="login" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <label>@lang("site.email")</label>
                                <input type="email" placeholder="@lang("site.email")" class="form-control" name="email" />
                            </div>
                            <div class="form-group">
                                <label>@lang("site.password")</label>
                                <input type="password" placeholder="@lang("site.password")" class="form-control" name="password" />
                            </div>
                            <div class="form-group">
                                <input type="submit" value="@lang("site.login")" class="form-control btn-style" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End -->
      

        <script src="{{ asset('public/src_website/js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/bootstrap.js') }}"></script>
        <script src="{{ asset('public/src_website/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('public/src_website/js/wow.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/responsiveCarousel.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/jquery-scrolloffset.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/main.js') }}"></script>
        <script src="{{ asset('public/src_website/js/lightgallery.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/intlTelInput.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/intlTelInput-jquery.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/java.js') }}"></script>
        
        <script>
        $(document).ready(function(){
        $('#lightgallery').lightGallery();
        });
        
        $(".telephone").intlTelInput({});
        </script>
 
    </body>
</html>