<!DOCTYPE html>
<html class="no-js" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta charset="utf-8">
    <meta name="author" content="Hadeer Magdy">
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
    
    
    <style>
        .page-no-content {
            position: relative;
            height: 100vh;
            width: 100vw;
        }
            
            .cont {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            text-align: center;
        }
            
            .page-no-content .cont button {
            background: linear-gradient(to right, #428bbb, #e63d7b, #428bbb, #e63d7b) !important;
            border: none;
            color: #fff;
            padding: 6px 12px;
            min-width: 160px;
            min-height: 50px;
            font-size: 16px;
            border-radius: 50px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="page-no-content">
    <div class="container">
        <div class="cont">
            <h1>لا توجد تسجيلات لهذه الجلسه </h1>
           {{-- <button>الرئيسيه</button>--}}
        </div>
    </div>
</div>


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
<script>
    $(document).ready(function(){
        $('#lightgallery').lightGallery();
    });
</script>

</body>
</html>