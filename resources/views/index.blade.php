@extends('layouts.app')

@section('content')

    <!--==================== Start Header =======================-->
    <section class="header" id="home">
        <div class="overlay"></div>
        <div class="container h-100">
            <div class="center">
                <div class="info">
                    <span class="welcome wow fadeInRight">@lang('site.welcome')</span>
                    <h2 class="wow fadeInRight">@lang('site.name_us')</h2>
                    <span class="line"></span>
                    <p class="wow fadeInRight" data-wow-delay="0.5s">@lang('site.hint_us')</p>
                    <a href="{{ route('courses') }}" class="sp_link wow fadeInRight" data-wow-delay="0.8s"><span>@lang('site.more')</span></a>
                    <span class="line two"></span>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End Header =======================-->

    <!--==================== Start courses =======================-->
    <section class="courses_section">
        <div class="container">
            <div class="main-heading text-center wow fadeInUp">
                <h2>على ماذا ستتدرب مع أسرة</h2>
                <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="img">
            </div>
            <ul class="list_control mt-40 wow fadeInUp">
            <li class="active" data-filter="all"><span>@lang('site.all')</span></li>
                @foreach($departments as $i=>$dep)
                <li data-filter=".dep{{$dep->id}}"  ><span>{{$dep->title}}</span></li>
                @endforeach
                <li data-filter=".live"><span>@lang('site.online')</span></li>
                <li data-filter=".self"><span>@lang('site.offline')</span></li>
            </ul>
            <div class="row mt-40">
                @foreach($topcourses as $course)
                <div class="col-lg-4 col-md-6 mix {{$course->department_id?'dep'.$course->department_id:'AllDep'}} {{$course->online==1?'live':'self'}}">
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
                            <a href="#" class="main-btn main">@lang('site.more')<i class="fal fa-arrow-left"></i></a>
                        </div>
                        <div class="meta">
                            <div class="teacher">
                                <div class="img"><img src="{{url('/')}}/public/src_website/assets/img/person.png" alt="img"></div>
                                <div class="text">
                                    <h5>{{$course->supervisorcourses->supervisor->supervisorinfo->name}}</h5>
                                    <h6>{{$course->supervisorcourses->supervisor->supervisorinfo->Educational}}</h6>
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
            <div class="text-center mt-40">
                <a href="{{route('courses')}}" class="sp_link"><span>@lang('site.explore all courses')</span></a>
            </div>
        </div>
    </section>
    <!--==================== End courses =======================-->

    <!--==================== Start news =======================-->
    <section class="news_section">
        <div class="container">
            <div class="content">
                <div class="row wow fadeInUp">
                    <div class="col-lg-4">
                        <div class="info">
                            <div class="head">
                                <h2>@lang('site.Check out the events and news') @lang('site.name_us')</h2>
                                <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="line_img">
                            </div>
                             <p>@lang('site.our_vision_us')</p>
                            <a href="{{url('/')}}/news" class="main-btn white">@lang('site.more')</a>
                        </div>
                    </div>
                    <div class="col-lg-8 news_slider">
                        <div class="owl-carousel owl-theme">
                            @foreach($news as $new)
                            <div class="item">
                                <div class="box_new">
                                    <div class="image">
                                        <a href="{{url('/')}}/single/{{$new->id}}/news"><img src="{{url('/')}}/{{$new->logo}}" alt="img"></a>
                                    </div>
                                    <div class="details">
                                        <div class="date"><i class="fal fa-clock"></i>{{$new->created_at->year}}/{{$new->created_at->month}}/{{$new->created_at->day}}</div>
                                        <h6 class="name"><a href="{{url('/')}}/single/{{$new->id}}/news">{{$new->title}}</a></h6>
                                        <p class="desc">{{$new->short_desc}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End news =======================-->

    <!--==================== Start services =======================-->
    <section class="services_section">
        <div class="container">
            <div class="row align-items-center wow fadeInUp">
                <div class="col-lg-3">
                    <div class="box_info">
                        <h2>أطلع على خدمات معهد مستقبل المعرفة</h2>
                        <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="img">
                            <p> @lang('site.our_vision_us') </p>
                        <a href="{{route('about')}}" class="main-btn main">@lang('site.more')</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="serv_box">
                        <span class="icon"><i class="fal fa-lightbulb"></i></span>
                        <h5>الاسئله الشائعه</h5>
                        <p>وصف تعريفي عن الخدمة يتم التحكم به من خلال لوحة التحكم .</p>
                        <a href="{{ url('/') }}/comquestion" class="sp_link">
                            <span>@lang('site.more')</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="serv_box active">
                        <span class="icon"><i class="fal fa-graduation-cap"></i></span>
                        <h5>البرامج لتدريبيه</h5>
                        <p>وصف تعريفي عن الخدمة يتم التحكم به من خلال لوحة التحكم .</p>
                        <a href="{{ route('courses') }}" class="sp_link">
                            <span>@lang('site.more')</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="serv_box">
                        <span class="icon"><i class="fal fa-chalkboard-teacher"></i></span>
                        <h5>الدورات</h5>
                        <p>وصف تعريفي عن الخدمة يتم التحكم به من خلال لوحة التحكم .</p>
                        <a href="{{ route('courses') }}" class="sp_link">
                            <span>@lang('site.more')</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End services =======================-->

    <!--==================== Start about =======================-->
    <section class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 wow fadeInRight">
                    <div class="info">
                        <div class="main-heading">
                            <h2>نبذة عن معهد جمعية التنمية الأسرية تعرف علينا في سطور</h2>
                            <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="img">
                        </div>
                        <p>@lang('site.aboutus') </p>
                        <a href="{{url('/')}}/about" class="main-btn main">@lang('site.more')</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image wow fadeInLeft">
                        <img src="{{url('/')}}/public/src_website/assets/img/courses/01.png" alt="img">
                        <a class="venobox play-btn" data-autoplay="true" data-vbtype="video" href="{{url('/')}}/{{$info->video}}"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End about =======================-->

    <!--==================== Start counter =======================-->
    <section class="counter_section">
        <div class="container">
            <div class="row wow fadeInUp" id="counters_1">
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="box">
                        <div class="icon"><img src="{{url('/')}}/public/src_website/assets/img/icons/earth-globe.svg" alt="img"></div>
                        <div class="counter" data-TargetNum="{{\App\Course::count()}}" data-Speed="3000">{{\App\Course::count()}}</div>
                        <div class="name">الدورات</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="box">
                        <div class="icon"><img src="{{url('/')}}/public/src_website/assets/img/icons/experience.svg" alt="img"></div>
                        <div class="counter" data-TargetNum="{{\App\Service::count()}}" data-Speed="3000">{{\App\Service::count()}}</div>
                        <div class="name">البرامج التدريبية</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="box">
                        <div class="icon"><img src="{{url('/')}}/public/src_website/assets/img/icons/goal.svg" alt="img"></div>
                        <div class="counter" data-TargetNum="{{\App\User::where('role_id',3)->count()}}" data-Speed="3000">{{\App\User::where('role_id',3)->count()}}</div>
                        <div class="name">المدربين</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="box">
                        <div class="icon"><img src="{{url('/')}}/public/src_website/assets/img/icons/earth-globe.svg" alt="img"></div>
                        <div class="counter" data-TargetNum="{{\App\User::where('role_id',4)->count()}}" data-Speed="3000">{{\App\User::where('role_id',4)->count()}}</div>
                        <div class="name">المتدربين</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                <?php $year=date("Y");
                            $start_year=DB::table('infos')->first()->start_year;
                            $y=$year-$start_year;?>
                    <div class="box">
                        <div class="icon"><img src="{{url('/')}}/public/src_website/assets/img/icons/experience.svg" alt="img"></div>
                        <div class="counter" data-TargetNum="{{$y}}" data-Speed="3000">{{$y}}</div>
                        <div class="name">سنوات خبرة</div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="box">
                        <div class="icon"><img src="{{url('/')}}/public/src_website/assets/img/icons/goal.svg" alt="img"></div>
                        <div class="counter" data-TargetNum="{{\App\Partnnner::count()}}" data-Speed="3000">{{\App\Partnnner::count()}}</div>
                        <div class="name">شريك نجاح</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End counter =======================-->

    <!--==================== Start library =======================-->
    <section class="library_section">
        <div class="container">
            <div class="main-heading text-center wow fadeInUp">
                <h2>المكتبة الإلكترونية</h2>
                <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="img">
            </div>
        </div>
        <div class="slick-slider mt-40 wow fadeInUp">
        @foreach($books as $book)
            <div class="item_carousel">
                <div class="box_lib">
                    <div class="image">  <a href="{{url('/')}}/single/{{$book->id}}/books">   <img src="{{url('/')}}/{{$book->title}}" alt="img"></a></div>
                    <div class="info">
                        <div class="details">
                            <span class="item"><i class="fal fa-calendar-alt"></i>{{$book->created_at->year}}/{{$book->created_at->month}}/{{$book->created_at->day}}</span>
                            <span class="item"><i class="fal fa-eye"></i>({{$book->show}})</span>
                            <span class="item">
                            <a href="{{url('/')}}/{{$book->pdf}}" download>    
                            <i class="fal fa-download"></i>تحميل الكتاب
                            </a>
                            </span>
                        </div>
                        <h5 class="name">{{$book->title}}</h5>
                        <p class="desc text-ellipsis">{{$book->desc}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="text-center mt-40">
            <a href="{{url('/')}}/books" class="main-btn main">@lang('site.more')</a>
        </div>
    </section>
    <!--==================== End library =======================-->

    <!--==================== Start testimonials =======================-->
    <section class="testimonials_section">
        <div class="container">
            <div class="main-heading text-center wow fadeInUp">
                <h2>قالو عنا</h2>
                <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="img">
            </div>
            <div class="owl-carousel owl-theme mt-40 wow fadeInUp">
              @foreach($said as $s)
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

    <!--==================== Start contact us =======================-->
    <section class="contact_us_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 wow fadeInRight">
                    <div class="info">
                        <div class="main-heading">
                            <h2>اتصل بنا</h2>
                            <img src="{{url('/')}}/public/src_website/assets/img/line_heading.png" alt="img">
                        </div>
                        <p class="desc">@lang('site.hint2_us')</p>
                        <a href="{{route('about')}}" class="main-btn main">@lang('site.more')</a>
                        <div class="whats_con">
                            <a href="tel:{{$info->whatsapp_male}}" class="item ">
                                <span class="icon man"><i class="fab fa-whatsapp"></i></span>
                                <span class="name">Whatsapp للرجال</span>
                            </a>
                            <a href="tel:{{$info->whatsapp_female}}" class="item ">
                                <span class="icon woman"><i class="fab fa-whatsapp"></i></span>
                                <span class="name">Whatsapp للنساء</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="modal_contact">
                        <form action="{{route('addcontacts')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="الاسم الرباعي بالكامل">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="البريد الالكتروني">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="موضوع الرساله">
                            </div>
                            <div class="form-group">
                                <select class="nice-select form-control" name="type" required>
                                    <option disabled selected value="">أختر موضوع الرسالة</option>
                                    @foreach(\App\ContactType::get() as $t)
                                    <option value="{{$t->id}}">{{$t->title}} </option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" required placeholder="رسالتك" name="details"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button class="main-btn main border-0">ارسال</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==================== End contact us =======================-->

@endsection