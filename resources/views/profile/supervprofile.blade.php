@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{url('/')}}/public/src_website/assets/css/style_2.css">
@endsection

@section('content')
<?php
    $imagePreview=json_encode(url('/').'/public/storage/'.Auth::user()->avatar);
?>
        <!-- Start Profile3-inner -->
        <section class="profile3-inner body-inner">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-md-8 col-xs-12">
                    <div class="profile-details-inner">
                        <div class="profile-image">
                            <div class="avatar-upload">
                              <!--  <div class="avatar-edit">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div> -->
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url({{ $imagePreview }})"></div>
                                </div>
                            </div>
                        </div>
                        <div class="join-name">
                            <div class="name">
                                <h3>{{ Auth::user()->name }}<span>مدرب</span></h3>
                            </div>
                            <div class="join-data">Joined {{ date("Y-M", strtotime(Auth::user()->created_at)) }}</div>
                            <div class="socila-media-j">
                                <a href="{{ Auth::user()->fb }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ Auth::user()->inst }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ Auth::user()->tw }}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ Auth::user()->google }}">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            </div>
                        </div>
                        <div class="body-profile">
                            <div class="header-tab-pro">
                                <ul class="nav nav-tabs">
                                    <li class="active muo_tab" data-content="profile1" ><a>الملف الشخصي</a></li>
                                    @if(Auth::user()->s == 1)

                                    <li class="muo_tab" data-content="profile2"><a>الدورات <span class="badge">{{ count(Auth::user()->supervisorcourses) }}</span></a></li>
                                    <!-- <li class="muo_tab" data-content="profile8"><a>الاختبارات <span class="badge">{{ count(Auth::user()->supervisorexams) }}</span></a></li> -->
                                    <li class="muo_tab" data-content="profile3"><a>إضافة دورات</a></li>
                                    <!-- <li class="muo_tab" data-content="profile9"><a>إضافة اختبارات</a></li> -->
                                    
                                    @if(!empty(Auth::user()->supervisorcourses[0]) and Auth::user()->supervisorcourses[0]->course and !empty(Auth::user()->supervisorcourses[0]->course->comments->where('commentORmassage',1)[0]))
                                    <li class="muo_tab" data-content="profile5"><a>أسئلة تم الرد عليها</a></li>
                                    @endif
                                    @endif
                                    <?php $rep = 0; ?>
                                    @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
                                    @if($supervisorcourse->course)
                                     @foreach($supervisorcourse->course->comments->where('commentORmassage',1) as $comment)
                                      @if(empty($comment->replay) and $rep==0)
                                      <?php $rep = 1; ?>
                                         <li class="muo_tab" data-content="profile4"><a>أسئلة لم يتم الرد عليها</a></li>
                                      @endif
                                    @endforeach

                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="body-tab-pro">
                                <div class="tab-content">
                                    <!-- tab1 -->
                                    <div id="profile1" class="box_content active">
                                        <div class="details-contact">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>الاسم الاول</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ Auth::user()->name }}</span>
                                                </div>
                                            </div>

                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>المؤهل</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ $supervisor_info->Educational }}</span>
                                                </div>
                                            </div>
                                        
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>رقم الهاتف</span>
                                                </div>
                                                <div class="label-details">
                                                    <span><i>{{ Auth::user()->phone }}</i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="more-details">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>السيرة الذاتية</span>
                                                </div>
                                                <div class="label-details">
                                                    <ul>
                                                    @foreach(Auth::user()->supervisorachievements as $supervisorachievement)  
                                                        <li>
                                                          {{ $supervisorachievement->achievement }}
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ url('/') }}/editsuperprofile/{{ Auth::user()->id }}" class="btn btn-gray">تعديل البيانات</a>
                                    </div>
                                    <!-- tab2 -->
                                    <div id="profile2" class="box_content">
                                        <div class="allcourse">
                                            <ul>
                                                @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
                                                @if($supervisorcourse->course)
                                                    <li class="active">
                                                        <a href="{{ url('/') }}/mycourse/{{ $supervisorcourse->course->id }}"><i class="far fa-play-circle"></i>{{ $supervisorcourse->course->title_ar }}<span></span></a>
                                                        <div class="all-buttons">
                                                            <a class="add-btn"  href="{{ url('/') }}/editcourse/{{ $supervisorcourse->course->id }}">تعديل دورة</a>

                                                            @if($supervisorcourse->course->publicexam)
                                                            <a class="add-btn" href="{{ url('/') }}/editexamcourse/{{ $supervisorcourse->course->id }}">تعديل الاختبار</a> 
                                                            @else
                                                            <a class="add-btn drug" path="{{$supervisorcourse->course->id}}" data-toggle="modal" data-target="#add-exam">@lang("site.Add an exam")</a>
                                                             @endif
                                                        </div>
                                                    </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <!-- tab8 -->
                                    <div id="profile8" class="box_content">
                                        <div class="allcourse">
                                            <ul>
                                                @foreach(Auth::user()->supervisorexams as $supervisorexam)
                                                
                                                   <li class="active">
                                                        <a href="{{ url('/') }}/editexamcourseby/{{ $supervisorexam->id }}"><i class="fab fa-accusoft"></i>{{ $supervisorexam->title }}<span></span></a>
                                                        <div class="all-buttons">
                                                           @if( $supervisorexam->code)
                                                            <a class="add-btn drug" path="{{ $supervisorexam->code }}" data-toggle="modal" data-target="#viewcodepublicexam">رؤية كود الاختبار الحالي</a>
                                                           @endif
                                                            <a class="add-btn drug" path="{{ $supervisorexam->id }}" data-toggle="modal" data-target="#addcodepublicexam">إضافة كود لدخول الاختبار</a>
                                                                                  
                                                            <a class="add-btn"  href="{{ url('/') }}/exam/{{$supervisorexam->id}}/deleteexam">حذف الاختبار</a>

                       
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- tab3 -->
                                    <div id="profile3" class="box_content">
                                        <div class="form-contact">
                                            <form action="{{ route('addcourse')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                                @csrf 
                                               <!-- <input name="service_id" value="{{ $supervisor_info->service_id }}" hidden>  -->
                                                <div id="vehicleFieldsWrapper" >    
                                                    <div class="vehicleFields"> 
                                                        <div class="row">
                                                                <div class="col-md-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>لوجو للكورس</label>
                                                                        <div class="input-group">
                                                                            <label class="input-group-btn">
                                                                                <span class="btn btn-primary">
                                                                                    <i class="fa fa-upload"></i> <input type="file" style="display: none;" name="logo" multiple>
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" placeholder="لوجو للكورس" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>رفع ملف pdf</label>
                                                                        <div class="input-group">
                                                                            <label class="input-group-btn">
                                                                                <span class="btn btn-primary">
                                                                                    <i class="fa fa-upload"></i> <input type="file" style="display: none;" name="file" multiple>
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" placeholder="رفع ملف pdf" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                               
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>اسم الكورس</label>
                                                                <input type="text" class="form-control" name="title_ar" placeholder="اسم الكورس" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>اسم الكورس بالانجليزية</label>
                                                                <input type="text" class="form-control" name="title_en" placeholder="اسم الكورس بالانجليزية" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>تفاصيل الكورس</label>
                                                                <textarea placeholder="تفاصيل الكورس" class="form-control" name="description_ar"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>تفاصيل الكورس  بالانجليزية</label>
                                                                <textarea placeholder="تفاصيل الكورس" class="form-control" name="description_en"></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>رسوم الاشتراك</label>
                                                                <input type="number" class="form-control" name="price" placeholder="اذا كانت الدورة مجانية أدخل صفر" step="0.1" required />
                                                            </div>
                                                        </div>
                                
                                                        
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>مدة الكورس</label>
                                                                <input type="text" class="form-control" name="duration" placeholder="مدة الكورس" required />
                                                            </div>
                                                        </div>                                                       
                                                         <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يبدأ في </label>
                                                                <input type="date" class="form-control" name="from_date" placeholder="يبدأ في " required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>ينتهي في</label>
                                                                <input type="date" class="form-control" name="to_date" placeholder="ينتهي في" required />
                                                            </div>
                                                        </div>  
                                                         <?php $sservices=DB::table('services')->get(); ?>    
                                                         @if(!empty($sservices[0]))                                                  
                                                       <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>اختار قسم</label>
                                                               
                                                                
                                                                 <select class="form-control" name="service_id">
                                                                   
                                                                    @foreach($sservices as $service)
                                                                        <option value="{{ $service->id }}">{{ $service->title_ar }}</option>
                                                                    @endforeach
                                                                  </select>
                                                            </div>
                                                        </div>
                                                           @else
                                                         <input name="service_id" value="{{ $supervisor_info->service_id }}" hidden>
                                                        @endif
                                                       <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>طريقة التعلم</label>
                                                                 <select class="form-control" name="online">
                                                                        <option value="1">مباشر</option>
                                                                        <option value="0">تعلم ذاتي</option>
                                                                  </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكور ب</label>
                                                                <input type="text" class="form-control" name="feature1" placeholder="يتميز الكور ب" required />
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكور ب</label>
                                                                <input type="text" class="form-control" name="feature2" placeholder="يتميز الكور ب" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكور ب</label>
                                                                <input type="text" class="form-control" name="feature3" placeholder="يتميز الكور ب" required />
                                                            </div>
                                                        </div>                                                       
                                                         <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكور ب  بالانجليزية</label>
                                                                <input type="text" class="form-control" name="feature1_en" placeholder="يتميز الكور ب  بالانجليزية" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكور ب  بالانجليزية</label>
                                                                <input type="text" class="form-control" name="feature2_en" placeholder="يتميز الكور ب  بالانجليزية" required />
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكور ب  بالانجليزية</label>
                                                                <input type="text" class="form-control" name="feature3_en" placeholder="يتميز الكور ب  بالانجليزية" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>لينك اليوتيوب</label>
                                                                <input type="text" class="form-control" name="link" placeholder="لينك اليوتيوب" required />
                                                            </div>
                                                        </div>



                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>لينك جروب الواتساب</label>
                                                                <input type="text" class="form-control" name="whats_link" placeholder="لينك الاتساب"  />
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <input type="submit" class="nextPage" value="اضافة" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>

                                    <div id="profile9" class="box_content">
                                        <div class="form-contact">
                                            <form action="{{ route('addtonewpublicexam')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                                @csrf 
                                               <!-- <input name="service_id" value="{{ $supervisor_info->service_id }}" hidden>  -->
                                                <div id="vehicleFieldsWrapper" >    
                                                    <div class="vehicleFields"> 

                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>لوجو الاختبار</label>
                                                                <div class="input-group">
                                                                    <label class="input-group-btn">
                                                                        <span class="btn btn-primary">
                                                                            <i class="fa fa-upload"></i> <input type="file" style="display: none;" name="logo" multiple>
                                                                        </span>
                                                                    </label>
                                                                    <input type="text" class="form-control" placeholder="لوجو الاختبار " readonly>
                                                                </div>
                                                            </div>
                                                        </div>                                                           
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>اسم الاختبار </label>
                                                                <input type="text" class="form-control" name="title" placeholder="اسم الاختبار " required />
                                                            </div>
                                                        </div>
   
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="text3">                                          
                                                            <input name="publicexam" value="1" hidden="" />
                                                            <input name="course_id" class="pathinput" hidden=""/>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="radio" name="Qtype" id="first" value="first" >اختيار من متعدد
                                                                <label></label>
                                                                <input type="radio" name="Qtype" id="secound" value="secound">صح - خطأ
                                                            </div>                                      
                                                            <div class="first">
                                                                <div class="add-section">
                                                                    <div class="row">
                                                                        <span class="col-12">
                                                                            <p class="form-group">                                                
                                                                                <label>السؤال</label>
                                                                                <input type="text" name="question" value="" class="form-control" >
                                                                            </p>
                                                                        </span>
                                                                        <span class="col-12 padding">
                                                                            <div class="row">
                                                                                <span class="col-md-11 col-10">
                                                                                    <p class="form-group">
                                                                                        <label>الإجابة  الأولي</label>
                                                                                        <input type="text" name="answers[]" value="" class="form-control" >
                                                                                    </p>
                                                                                </span>
                                                                                <span class="col-md-1 col-2">
                                                                                    <label class="exam-ch">
                                                                                        <input type="radio" name="checkboxs[]" value="0">
                                                                                        <span class="checkmark-exam"></span>
                                                                                    </label>
                                                                                </span>
                                                                            </div>
                                                                        </span>
                                                                        <span class="col-12 padding">
                                                                            <div class="row">
                                                                                <span class="col-md-11 col-10">
                                                                                    <p class="form-group">
                                                                                        <label> الإجابة  الثانيه</label>
                                                                                        <input type="text" name="answers[]" value="" class="form-control" >
                                                                                    </p>
                                                                                </span>
                                                                                <span class="col-md-1 col-2">
                                                                                    <label class="exam-ch">
                                                                                        <input type="radio" name="checkboxs[]" value="1">
                                                                                        <span class="checkmark-exam"></span>
                                                                                    </label>
                                                                                </span>
                                                                            </div>
                                                                        </span>
                                                                        <span class="col-12 padding">
                                                                            <div class="row">
                                                                                <span class="col-md-11 col-10">
                                                                                    <p class="form-group">
                                                                                        <label> الإجابة  الثالثة</label>
                                                                                        <input type="text" name="answers[]" value="" class="form-control" >
                                                                                    </p>
                                                                                </span>
                                                                                <span class="col-md-1 col-2">
                                                                                    <label class="exam-ch">
                                                                                        <input type="radio"  name="checkboxs[]" value="2">
                                                                                        <span class="checkmark-exam"></span>
                                                                                    </label>
                                                                                </span>
                                                                            </div>
                                                                        </span>
                                                                        <span class="col-12 padding">
                                                                            <div class="row">
                                                                                <span class="col-md-11 col-10">
                                                                                    <p class="form-group">
                                                                                        <label> الإجابة  الرابعة</label>
                                                                                        <input type="text" name="answers[]" value="" class="form-control" >
                                                                                    </p>
                                                                                </span>
                                                                                <span class="col-md-1 col-2">
                                                                                    <label class="exam-ch">
                                                                                        <input type="radio"  name="checkboxs[]" value="3">
                                                                                        <span class="checkmark-exam"></span>
                                                                                    </label>
                                                                                </span>
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div  class="secound">
                                                                <div class="add-section truefalse">
                                                                    <span class="col-xs-12 padding">
                                                                        <div class="row">
                                                                            <span class="col-md-10 col-8">
                                                                                <p class="form-group">
                                                                                    <label>السؤال</label>
                                                                                    <input type="text" name="questionn" value="" class="form-control" >
                                                                                </p>
                                                                            </span>
                                                                            <span class="col-md-1 col-2 false">
                                                                                <label class="exam-ch">
                                                                                    <input type="radio" name="checck" value="0">
                                                                                    <span class="checkmark-exam"></span>
                                                                                </label>
                                                                            </span>
                                                                            <span class="col-md-1 col-2 true">
                                                                                <label class="exam-ch">
                                                                                    <input type="radio" name="checck" value="1">
                                                                                    <span class="checkmark-exam"></span>
                                                                                </label>
                                                                            </span>  
                                                                        </div>                                           
                                                                    </span>

                                                                </div>
                                                            </div>
                                                        </div>
   
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="submit" class="nextPage" value="إضافة" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- tab4 -->
                                    <div id="profile4" class="box_content">
                                        <div class="replay-text">
                                     @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
                                     @if($supervisorcourse->course)
                                         @foreach($supervisorcourse->course->comments->where('commentORmassage',0) as $comment)
                                            @if(empty($comment->replay))
                                            <div class="block">
                                                <form action="{{ route('replaycomment')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                                  @csrf
                                                    <div class="qu-n">
                                                        <h2>&nbsp;<a href="{{ url('/') }}/conversation/{{ $comment->user->id }}/{{ $comment->course_id }}/studshow">{{ $comment->user->name }}</a> &nbsp; &nbsp;:{{ $comment->title }}.... الاستفسار عن كورس    ....{{ $supervisorcourse->course->title_ar }}</h2>
                                                    </div>
                                                    <div class="answer-n">
                                                        <input name="course_id" value="{{ $supervisorcourse->course->id }}" hidden/>
                                                        <input name="comment_id" value="{{ $comment->id }}" hidden/>
                                                        <input type="text" name="replay" placeholder="اضف الرد هنا" required />
                                                        <button type="submit"><i class="fa fa-paper-plane"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                         @endforeach
                                         @endif
                                        @endforeach
                                        </div>
                                    </div>

                                    <!-- tab5 -->
                                    <div id="profile5" class="box_content">
                                        <div class="replay-text">
                                     @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
                                     @if($supervisorcourse->course)
                                         @foreach($supervisorcourse->course->comments->where('commentORmassage',1) as $comment)
                                            @if(!empty($comment->replay))
                                            <div class="block">
                                                <form action="{{ route('replaycomment')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                                  @csrf
                                                    <div class="qu-n">
                                                        <h2>{{ $comment->title }}.... الاستفسار عن كورس    ....{{ $supervisorcourse->course->title_ar }}</h2>
                                                    </div>
                                                    <div class="answer-n">
                                                        <input name="course_id" value="{{ $supervisorcourse->course->id }}" hidden/>
                                                        <input name="comment_id" value="{{ $comment->id }}" hidden/>
                                                        <input type="text" name="replay" value="{{ $comment->replay }}" required />
                                                        <button type="submit"><i class="fa fa-paper-plane"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                         @endforeach
                                         @endif
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- End Profile3-inner -->
      


                <!-- Add Exam -->
        <div id="add-exam" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="add-qu form-contact">
                            <h3>@lang("site.Add an exam")</h3>
                              <form action="{{ route('addtonewexam')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                @csrf
                                         <div class="text3">                                          
                                         <input name="publicexam" value="1" hidden="" />
                                         <input name="course_id" class="pathinput" hidden=""/>
                                         </div>
                                        <div class="form-group">
                                         <input type="radio" name="Qtype" id="first" value="first" >أختيار من متعدد
                                         <label></label>
                                         <input type="radio" name="Qtype" id="secound" value="secound">صح - خطأ
                                       </div>                                      
                                <div class="first">
                                    <div class="add-section">
                                        <span class="col-xs-12">
                                            <p class="form-group">                                                
                                                <label>السؤال</label>
                                                <input type="text" name="question" value="" class="form-control" >
                                            </p>
                                        </span>
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الأجابة الأولي</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checkboxs[]" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الأجابة الثانيه</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checkboxs[]" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الأجابة الثالثة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio"  name="checkboxs[]" value="2">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>الأجابة الرابعة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="radio"  name="checkboxs[]" value="3">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div  class="secound">
                                    <div class="add-section truefalse">
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-10 col-xs-8">
                                                <p class="form-group">
                                                    <label>السؤال</label>
                                                    <input type="text" name="questionn" value="" class="form-control" >
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2 false">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                            <span class="col-md-1 col-xs-2 true">
                                                <label class="exam-ch">
                                                    <input type="radio" name="checck" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>                                            
                                        </span>

                                    </div>
                                </div>
                                <p>
                                    <input type="submit" name="submit1" class="btn-style" value="إضافة">
                                </p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
      
              <!-- Add Exam code-->
        <div id="addcodepublicexam" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="add-qu form-contact">
                            <h3>@lang("site.Add code for the test")</h3>

            					<div class="form-group">
            						<div class="col-sm-offset-3 col-sm-9 m-t-15">
            							<button onclick="myFunction()" class="btn btn-success">
            							كود رقمي 
            							</button>
                                        
                                        <button onclick="mycharFunction()" class="btn btn-warning">
            							كود رمزي
            							</button>
            						</div>
                                    
            					</div>
                               <form action="{{ route('addpubliccode')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                @csrf
                                
                                <input name="exam_id" hidden="" class="pathinput"/>
                                <div class="form-group">
                                    <label>الكود المختار</label>
                                    <input type="text" id="myText" name="code"  class="form-control" required/>
                                </div>


                                <div class="form-group">
                                    <input type="submit" value="أضافة" class="btn" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
              <!-- view Exam code-->
        <div id="viewcodepublicexam" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="add-qu form-contact">
                            <h3>الكود المفعل الان لكل الطلاب</h3>
                                <div class="form-group">
                                    <label>الكود</label>
                                    <input type="text"  name="code"  class="form-control pathinput" disabled=""/>
                                </div>

                     
                        </div>
                    </div>
                </div>
            </div>
        </div> 
@endsection

@section('script')
   {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  --}}
        <script>
             var ct = 1;
                function new_link()
                {
                    ct++;
                    var div1 = document.createElement('div');
                    div1.id = ct;
                    // link to delete extended form elements
                    var delLink = '<div class="delete-btn" style="text-align:right;"><a class="btn-del" href="javascript:delIt('+ ct +')"><i class="fa fa-times"></i></a></div>';
                    div1.innerHTML = document.getElementById('newlinktpl').innerHTML + delLink;
                    document.getElementById('newlink').appendChild(div1);
                }
                // function to delete the newly added set of elements
                function delIt(eleId)
                {
                    d = document;
                    var ele = d.getElementById(eleId);
                    var parentEle = d.getElementById('newlink');
                    parentEle.removeChild(ele);
                }

            $(document).ready(function(){
                $('#lightgallery').lightGallery();
            });
        </script>

        <script type="text/javascript">
            $('.drug').click(function(){
            var path = $(this).attr('path');
            $('#c-profile').css('display','block');
            $('.pathinput').val(path);
            $('.path').text(path);
            });
        </script>
   
  <script>   
 
     function myFunction() {
            var chars = "0123456789";
            var string_length = 14;
            var randomstring = '';
            for (var i=0; i<string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum,rnum+1);
            }
      document.getElementById("myText").value = randomstring;
    }
    
    function mycharFunction() {
            var chars = "0123456789ABCDEFGHIJKLMNOPQR!@$#~%^&*STUVWXTZabcdefghiklmnopqrstuvwxyz";
            var string_length = 14;
            var randomstring = '';
            for (var i=0; i<string_length; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                randomstring += chars.substring(rnum,rnum+1);
            }
      document.getElementById("myText").value = randomstring;
    }
       
        $(document).ready(function () {
    $(".first").hide();
    $(".secound").hide();    

        $("#first").click(function () {
        $(".first").show();
        $(".secound").hide();
    });
    $("#secound").click(function () {
        $(".first").hide();
        $(".secound").show();
    });    
});
</script>
@endsection