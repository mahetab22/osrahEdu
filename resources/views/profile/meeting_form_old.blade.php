
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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/src_website/images/nahl0.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link href="{{ asset('public/src_website/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/src_website/css/mobile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/src_website/css/main.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>

        @media (max-width: 991px) {
            .col-6-img, .col-6-form {
                position: relative !important;
                width: 100% !important;
                margin-bottom: 20px !important;
            }
            .col-6-form {
                position: absolute !important;
                top: 0 !important;
            }

            .col-6-form .form-content {
                background: #fff !important;
            }
        }

        .container.ssk {
            width: 100%;
            position: relative;
        }

        .col-6-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100vh;
            background-size: cover;
        }

        .col-6-form {
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100vh;
        }

        .col-6-form .form-content {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            padding: 25px;
            box-shadow: 0px 0px 11px #3333;
            border-radius: 15px;
            width: calc(100% - 200px);
            margin: 0 auto;
        }
        .col-6-img:before {
            content: "";
            background: linear-gradient(to right, #428bbb, #e63d7b);
            position: absolute;
            right: 0;
            left: 0;
            top: 0;
            bottom: 0;
            opacity: .8;
        }

        .col-6-form .form-content form input.btn {
            min-width: 130px;
            line-height: 30px;
            background: linear-gradient(to right, #428bbb, #e63d7b);
            color: #fff;
            border: none;
            transition: all .3s linear;
        }

        .col-6-form .form-content form input.btn:hover {
            background: linear-gradient(to left, #428bbb, #e63d7b);
        }

        .col-6-form .form-group div div h3 {
            text-align: center;
        }
    </style>

    @if(app()->getLocale() == 'ar')
        <link href="{{ asset('public/src_website/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />

    @else
        <link href="{{ asset('public/src_website/css/style-en.css') }}" rel="stylesheet" type="text/css" />
   @endif
    @yield('stylelinks')

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-6-img" style="background-image: url('https://esraa.azq1.com/nhlzoom/public/src_website/images/slider1.png')">

        </div>
        <div class="col-6-form">
            <div class="form-content">
                <div class="form-group">
                    <!-- Modal content-->
                    <div >
                        <div >

                            <h3>@lang("site.create live streaming")</h3>
                            <form method="get" name="form" action="{{route("create_meeting")}}">
                                @csrf


                                                                <input name="typefunction" value="create" hidden="" />
                                                                <input name="presenter_id" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->user_id }}" hidden="" />
                                                                <input name="presenter_name" value="{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}" hidden="" />
                                                                <input name="title" value="{{ $course->title_ar }}" hidden="" />




                                <input name="course_id" value="{{ $course->id }}" hidden="" >
                                <div class="form-group">
                                    <label>عنوان البث*</label>
                                    <input type="text" placeholder=عنوان البث name="topic"   class="form-control" required=""/>
                                </div>

                                <div class="form-group">
                                    <label>@lang("site.type") *</label>

                                    <dropdown class="form-control">
                                        <option>

                                        </option>

                                    </dropdown>
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.start_time") *</label>
                                    <input type="datetime-local" placeholder="@lang('site.start_time')" name="start_time"  id="datepicker" class="form-control datepicker" required=""/>
                                </div>



                                <div class="form-group">
                                    <label>@lang("site.duration")</label>
                                    <input type="number" placeholder="@lang('site.duration') بالدقيقة" name="duration" class="form-control" />
                                </div>

                                 <div class="form-group">
                                     <label>@lang("site.password")</label>
                                     <input type="password" name="password" class="form-control" />
                                 </div>





                                <div class="form-group">
                                    <input type="submit" value="@lang("site.go")" class="btn" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>





            </div>
        </div>
        </div>
    </div>
</div>


</body>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</html>