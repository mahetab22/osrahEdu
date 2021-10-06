@extends('layouts.app')
@section('content')

    <!--==================== Start courses header =======================-->
    <section class="course_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="info">
                        <div>
                            <h3>تصفح كل الدورات</h3>
                            <p>@lang('site.hint2_us') </p>
                           
                            <div class="search_input">
                            <form method="get" action="{{ route('search') }}">
                                <input type="search" class="form-control"name="search" required  placeholder="قم بوضع كلمات البحث هنا">
                                 <button class="icon btn"><i class="fal fa-search"></i></button>
                            </form>
                            </div>
                            <div class="tags">
                                @foreach($services as $serv)
                                <a href="{{url('/')}}/courses?service={{$serv->id}}" class="tag">{{$serv->title}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image">
                        <img src="{{url('/')}}/public/src_website/assets/img/course_img.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End courses header =======================-->

    <!--==================== Start our courses =======================-->
    <section class="our_courses_page" id="courses_section">
        <div class="container">
            <div class="filter_courses">
                <div class="col-lg-2 col-md-6">
                    <div class="text">
                        <h5>الدورات</h5>
                    </div>
                </div>
                <div class="col-lg-8 o-2">
                    <div class="box_filter">
                        <div class="mini_box">
                            <div class="form-group">
                                <span class="icon"><i class="far fa-stream"></i></span>
                                <select class="nice-select" name="service">
                                    <option value="">كل الأقسام </option>
                                @foreach($services as $serv)
                                    <option value="{{$serv->id}}" {{isset($service)?$serv->id==$service->id?'selected':'':''}}>{{$serv->title}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mini_box">
                            <div class="form-group">
                                <span class="icon"><i class="fal fa-chalkboard-teacher"></i></span>
                                <select class="nice-select" name="supervisor">

                                    <option value="">مقدم الدورة</option>
                                    @foreach($supervisors as $super)
                                    <option value="{{$super->id}}">{{$super->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mini_box">
                            <div class="form-group">
                                <span class="icon"><i class="fal fa-book-open"></i></span>
                                <select class="nice-select" name="online">
                                    <option value="">توقيت الدورة</option>
                                    <option value="1">أونلاين</option>
                                    <option value="0">تعليم ذاتى</option>
                                </select>
                            </div>
                        </div>
                        <div class="mini_box">
                            <div class="form-group">
                                <span class="icon"><i class="fal fa-book-open"></i></span>
                                <select class="nice-select" name="dep">
                                    <option value="">نوع الدورة</option>
                                    @foreach($departments as $deps)
                                    <option value="{{$deps->id}}">{{$deps->title}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                      
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="filter_date">
                        <span class="icon"><i class="far fa-sort-amount-down-alt"></i></span>
                        <select class="nice-select" name="order">
                            <option value="2">ترتيب بالأحدث</option>
                            <option value="3">ترتيب بالأقدم</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($courses as $course)
                <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="box_course">
                        <div class="image">
                            <img src="{{url('/')}}/{{$course->logo}}" alt="img">
                            <div class="status">
                                @if($course->sponsor)
                                <span>{{$course->sponsor}} <i class="fal fa-clock"></i></span>
                                @endif
                                @if($course->department)
                                <span>{{$course->department->title}}<i class="fal fa-user"></i></span>
                                @endif
                            </div>
                        </div>
                        <div class="info">
                            <h6 class="name">{{$course->title}}</h6>
                            <p class="desc">{{$course->description}}</p>
                            <div class="details">
                                <div class="item">
                                    <span>مدة الدوره :</span>
                                    <span class="value">{{$course->duration}}<i class="fal fa-clock"></i></span>
                                </div>
                                <div class="item">
                                    <span>تاريخ الدورة :</span>
                                    <span class="value">{{$course->created_at->year}}/{{$course->created_at->month}}/{{$course->created_at->day}}<i class="fal fa-calendar-alt"></i></span>
                                </div>
                            </div>
  
                           @auth
                            <a href="{{ url('/') }}/mycourse/{{ $course->id }}" class="main-btn main">@lang('site.more')<i class="fal fa-arrow-left"></i></a>
                           @else
                           <a href="{{ url('/') }}/mycourseafter/{{ $course->id }}" class="main-btn main">@lang('site.more')<i class="fal fa-arrow-left"></i></a>
                           @endauth
                        </div>
                        <div class="meta">
                            <div class="teacher">
                                <div class="img"><img src="{{url('/')}}/public/src_website/assets/img/person.png" alt="img"></div>
                                <div class="text">
                                    <h5>{{$course->supervisorcourses->first()->supervisor->supervisorinfo->name}}</h5>
                                    <h6>{{$course->supervisorcourses->first()->supervisor->supervisorinfo->Educational}}</h6>
                                </div>
                            </div>
                            <div class="icon_video">
                                <img src="{{url('/')}}/public/src_website/assets/img/icon_video.png" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--==================== End our courses =======================-->


@endsection

@section('script')
<script>
$(document).on('change','select[name="service"]',function(){
    search();
});

$(document).on('change','select[name="supervisor"]',function(){  
    search();
});
$(document).on('change','select[name="online"]',function(){
    search();
});
$(document).on('change','select[name="order"]',function(){
    search();
});
$(document).on('change','select[name="dep"]',function(){
    search();
});
function search(){
    var online=$('select[name="online"]').val();
    console.log(online);
    var supervisor=$('select[name="supervisor"]').val();
    var order=$('select[name="order"]').val();
    var service=$('select[name="service"]').val();
    var dep=$('select[name="dep"]').val();
    $.ajax({
            type: 'get',
            url: "{{ url(app()->getLocale() . '/ajax/courses') }}",
            data: {
                online: online,
                super:supervisor,
                order:order,
                service:service,
                dep:dep,
            },
            success: function(data) {
            $("#courses_section").empty();
                document.getElementById('courses_section').innerHTML = data;
                console.log(data);
            },
            error: function(data) {
                console.log("error");
                console.log(data);
            }
        });
}
</script>
@endsection