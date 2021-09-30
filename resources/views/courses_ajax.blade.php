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
                                    <option value="{{$serv->id}}" {{$service != null?$serv->id==$service?'selected':'':''}}>{{$serv->title}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mini_box">
                            <div class="form-group">
                                <span class="icon"><i class="fal fa-chalkboard-teacher"></i></span>
                                <select class="nice-select" name="supervisor">

                                    <option value="">مقدم الدورة</option>
                                    @foreach($supervisors as $sup)
                                    <option value="{{$sup->id}}"{{$super != null?$super==$sup->id?'selected':'':''}}>{{$sup->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                   
                        <div class="mini_box">
                            <div class="form-group">
                                <span class="icon"><i class="fal fa-book-open"></i></span>
                                <select class="nice-select" name="online">
                                    <option value="" {{$online==null?'selected':''}}>توقيت الدورة</option>
                                    <option value="1"{{$online==1 && $online!=null?'selected':''}}>أونلاين</option>
                                    <option value="0"{{$online==0 && $online!=null?'selected':''}}>تعليم ذاتى</option>
                                </select>
                            </div>
                        </div>
                        <div class="mini_box">
                            <div class="form-group">
                                <span class="icon"><i class="fal fa-book-open"></i></span>
                                <select class="nice-select" name="dep">
                                    <option value="">نوع الدورة</option>
                                    @foreach($departments as $deps)
                                    <option value="{{$deps->id}}" {{$dep !=null ?$dep==$deps->id?'selected':'':''}}>{{$deps->title}}</option>
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
                            <option value="2" {{$or==2?'selected':''}}>ترتيب بالأحدث</option>
                            <option value="3" {{$or==3?'selected':''}}>ترتيب بالأقدم</option>
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
        </div>