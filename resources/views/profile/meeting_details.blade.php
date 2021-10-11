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
    <link href="{{ asset('public/src_website/css/style2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/src_website/css/mobile2.css') }}" rel="stylesheet" type="text/css" />

    @if(app()->getLocale() == 'ar')
        <link href="{{ asset('public/src_website/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />

    @else
        <link href="{{ asset('public/src_website/css/style-en.css') }}" rel="stylesheet" type="text/css" />
    @endif
    @yield('stylelinks')

</head>
<body>

    <div  class="form-group">
        <div class="qu-block">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">@lang("site.class_id")</th>
                    <th scope="col">@lang("site.supervisor")</th>
                    <th scope="col">@lang("site.start_time")</th>
                    <th scope="col">@lang("site.dawnload")</th>
                    <th scope="col">@lang("site.add attendee")</th>
                    <th scope="col">@lang("site.cancel - modifay")</th>
                </tr>
                </thead>
                <tbody>
                @foreach($course->streamings as $streaming)
                    <tr>
                        <th scope="row">{{$streaming->class_id}}</th>
                        <td>{{$streaming->supervisor->name}}</td>
                        <td>{{$streaming->start_time}}</td>
                        <td><a href="{{$streaming->recording_url}}" target="_blank">@lang("site.recording")<span><i class="fa fa-tv"></i></span></a></td>
                        <td class="actions">
                            <a data-toggle="modal" data-target="#addattendeestreamingby" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                        </td>
                        <td class="actions">
                            <a data-toggle="modal" data-target="#cancelstreamingby" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <a data-toggle="modal" data-target="#modifaystreamingby" class="on-default btn btn-default drug" path="{{$streaming->class_id}}" type="submit"><i class="fa fa-paint-brush" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>




</body>


</html>