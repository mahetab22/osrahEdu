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
        <!-- Start Req-inner -->
        <section class="table-inner body-inner">
            <div class="container">
                <div class="req-table">
                    <!-- Start Table -->
                    <table>
                        <!-- Start Thead -->
                        <thead>
                            <tr>
                                <th>
                                    <a href="{{ route('/') }}" class="logo">
                                        <img src="{{ url('/') }}/public/storage/{{ $info->logo }}" alt="" />
                                        <div class="text-logo">
                                            <h2>@lang("site.name_us")</h2>
                                            <h4>@lang("site.hint_us")</h4>
                                        </div>
                                    </a>
                                    
                                </th>
                            </tr>
                        </thead>
                        <!-- End Thead -->
                        <!-- Start Tbody -->
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    @yield('content')
                                </td>
                            </tr>
                        </tbody>
                        <!-- End Tbody -->
                        <!-- Start Tfoot -->
                        <!--<tfoot>-->
                        <!--<tr>-->
                        <!--    <td colspan="3">-->
                        <!--        <div class="socialmedia-table">-->
                        <!--            <ul>-->
                        <!--                <li>-->
                        <!--                    <a href="{{ $info->fb }}">-->
                        <!--                        <i class="fab fa-facebook-f"></i>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="{{ $info->tw }}">-->
                        <!--                        <i class="fab fa-twitter"></i>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="{{ $info->google }}">-->
                        <!--                        <i class="fab fa-google-plus-g"></i>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="{{ $info->inst }}">-->
                        <!--                        <i class="fab fa-instagram"></i>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!--    </td>-->
                        <!--</tr>-->
                        <!--</tfoot>-->
                        <!-- End Tfoot -->
                    </table>
                    <!-- End Table -->
                </div>
            </div>
        </section>
        <!-- End Req-inner -->
        <script src="{{ asset('public/src_website/js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/bootstrap.js') }}"></script>
        <script src="{{ asset('public/src_website/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('public/src_website/js/wow.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/responsiveCarousel.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/jquery-scrolloffset.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/main.js') }}"></script>
        <script src="{{ asset('public/src_website/js/lightgallery.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/java.js') }}"></script>
    </body>
</html>