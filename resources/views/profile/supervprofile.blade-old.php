@extends('layouts.app')

@section('content')
<?php
    $imagePreview=json_encode(url('/').'/public/storage/'.Auth::user()->avatar);
?>
        <!-- Start Profile3-inner -->
        <section class="profile3-inner body-inner">
            <div class="container">
                <div class="col-md-2 col-xs-12"></div>
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
                                    <li class="active"><a data-toggle="tab" href="#profile1">الملف الشخصي</a></li>
                                    <li><a data-toggle="tab" href="#profile2">الدورات <span class="badge">{{ count(Auth::user()->supervisorcourses) }}</span></a></li>
                                    <li><a data-toggle="tab" href="#profile3">إضافة دورات</a></li>
                                    @if(!empty(Auth::user()->supervisorcourses[0]->course->comments->where('commentORmassage',1)[0]))
                                    <li><a data-toggle="tab" href="#profile5">أسئلة تم الرد عليها</a></li>
                                    @endif
                                    <?php $rep = 0; ?>
                                    @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
                                     @foreach($supervisorcourse->course->comments->where('commentORmassage',1) as $comment)
                                      @if(empty($comment->replay) and $rep==0)
                                      <?php $rep = 1; ?>
                                         <li><a data-toggle="tab" href="#profile4">أسئلة لم يتم الرد عليها</a></li>
                                      @endif
                                    @endforeach
                                    @endforeach
                                </ul>
                            </div>
                            <div class="body-tab-pro">
                                <div class="tab-content">
                                    <!-- tab1 -->
                                    <div id="profile1" class="tab-pane fade in active">
                                        <div class="details-contact">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>الاسم الاول</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ Auth::user()->name }}</span>
                                                </div>
                                            </div>
{{--                                             <div class="block-item">
                                                <div class="label-title">
                                                    <span>الاسم الاخير</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>احمد</span>
                                                </div>
                                            </div> --}}
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
                                                    <span>النوع</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ Auth::user()->gender }}</span>
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
                                      <!--  <div class="more-details">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>مهاراته</span>
                                                </div>
                                                <div class="label-details">
                                                    <ul>
                                                        <li>
                                                          {{ $supervisor_info->skill1 }}
                                                        </li>
                                                        <li>
                                                           {{ $supervisor_info->skill2 }}
                                                        </li>
                                                        <li>
                                                           {{ $supervisor_info->skill3 }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        -->
                                        <div class="more-details">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>سيرة زاتية</span>
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
                                    <div id="profile2" class="tab-pane fade">
                                        <div class="allcourse">
                                            <ul>
                                                @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
                                                <li class="active">
                                                    <a href="{{ url('/') }}/mycourse/{{ $supervisorcourse->course->id }}"><i class="far fa-play-circle"></i>{{ $supervisorcourse->course->title_ar }}<span></span></a>
                                                    <div class="all-buttons">
                                                        <a class="add-btn"  href="{{ url('/') }}/editcourse/{{ $supervisorcourse->course->id }}">تعديل دورة</a>
                                                        <a class="add-btn drug" path="{{$supervisorcourse->course->id}}" data-toggle="modal" data-target="#add-exam">@lang("site.Add an exam")</a>
                                                       <!-- <a class="add-btn drug" path="{{$supervisorcourse->course->id}}" data-toggle="modal" data-target="#add-exam">مراجعة أختبارات طالب</a>-->
                                                         
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- tab3 -->
                                    <div id="profile3" class="tab-pane fade">
                                        <div class="form-contact">
                                            <form action="{{ route('addcourse')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                                @csrf 
                                               <!-- <input name="service_id" value="{{ $supervisor_info->service_id }}" hidden>  -->
                                                <div id="vehicleFieldsWrapper" >    
                                                    <div class="vehicleFields"> 

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
                                                         <?php $sservices=DB::table('services')->where('parent_id',$supervisor_info->service_id)->get(); ?>    
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

{{--                                                         <div class="col-xs-12 padding">
                                                            <div class="customer_records">
                                                                <div class="col-md-6 col-xs-12">
                                                                    <div class="form-group ">
                                                                        <label>اسم الدرس</label>
                                                                        <input type="text" class="form-control" name="lesson-name" placeholder="اسم الدرس" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>رفع الفيديو</label>
                                                                        <div class="input-group">
                                                                            <label class="input-group-btn">
                                                                                <span class="btn btn-primary">
                                                                                    <i class="fa fa-upload"></i> <input type="file" style="display: none;" multiple>
                                                                                </span>
                                                                            </label>
                                                                            <input type="text" class="form-control" placeholder="رفع الفيديو" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <a class="extra-fields-customer">اضافة درس اخر</a>
                                                              </div>
                                                              <div class="customer_records_dynamic"></div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
{{--                                                         <a  class="nextPage requ" id="addVehicle"><i class="fa fa-plus"></i> إضافة كورس اخر</a> --}}
                                                        <input type="submit" class="nextPage" value="اضافة" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- tab4 -->
                                    <div id="profile4" class="tab-pane fade">
                                        <div class="replay-text">
                                     @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
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
                                        @endforeach
                                        </div>
                                    </div>

                                    <!-- tab5 -->
                                    <div id="profile5" class="tab-pane fade">
                                        <div class="replay-text">
                                     @foreach(Auth::user()->supervisorcourses as $supervisorcourse)
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
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12"></div>
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
                              <form action="{{ route('addexam')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                @csrf
                                         <div class="text3">                                          
                                         <input name="publicexam" value="1" hidden="" />
                                         <input name="course_id" class="pathinput" hidden=""/>
                                         </div>
                                                                                 
                                <div id="newlink">
                                    <div class="add-section">
                                        <span class="col-xs-12">
                                            <p class="form-group">                                                
                                                <label>السؤال</label>
                                                <input type="text" name="questions[]" value="" class="form-control" required="">
                                            </p>
                                        </span>
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>3الاجابة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" required>
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="checkbox" name="checkboxs[]" value="0">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>3الاجابة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" required>
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="checkbox" name="checkboxs[]" value="1">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                        <span class="col-xs-12 padding">
                                            <span class="col-md-11 col-xs-10">
                                                <p class="form-group">
                                                    <label>3الاجابة</label>
                                                    <input type="text" name="answers[]" value="" class="form-control" required>
                                                </p>
                                            </span>
                                            <span class="col-md-1 col-xs-2">
                                                <label class="exam-ch">
                                                    <input type="checkbox"  name="checkboxs[]" value="2">
                                                    <span class="checkmark-exam"></span>
                                                </label>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <p>
                                    <input type="submit" name="submit1" class="btn-style" value="إضافة">
                                </p>
                                <p id="addnew">
                                    <a href="javascript:new_link()">إضافة سؤال</a>
                                </p>
                            </form>
                            <!-- Template -->
                            <div id="newlinktpl" style="display:none">
                                <div class="add-section">
                                    <span class="col-xs-12">
                                        <p class="form-group">
                                            <label>السؤال</label>  
                                            <input type="text" name="questions[]" value="" class="form-control" required>
                                        </p>
                                    </span>
                                    <span class="col-xs-12 padding">
                                        <span class="col-md-11 col-xs-10">
                                            <p class="form-group">
                                                <label>3الاجابة</label>
                                                <input type="text" name="answers[]" value="" class="form-control" required>
                                            </p>
                                        </span>
                                        <span class="col-md-1 col-xs-2">
                                            <label class="exam-ch">
                                                <input type="checkbox" name="checkboxs[]" value="0">
                                                <span class="checkmark-exam"></span>
                                            </label>
                                        </span>
                                    </span>
                                    <span class="col-xs-12 padding">
                                        <span class="col-md-11 col-xs-10">
                                            <p class="form-group">
                                                <label>3الاجابة</label>
                                                <input type="text" name="answers[]" value="" class="form-control" required>
                                            </p>
                                        </span>
                                        <span class="col-md-1 col-xs-2">
                                            <label class="exam-ch">
                                                <input type="checkbox" name="checkboxs[]" value="1">
                                                <span class="checkmark-exam"></span>
                                            </label>
                                        </span>
                                    </span>
                                    <span class="col-xs-12 padding">
                                        <span class="col-md-11 col-xs-10">
                                            <p class="form-group">
                                                <label>3الاجابة</label>
                                                <input type="text" name="answers[]" value="" class="form-control" required>
                                            </p>
                                        </span>
                                        <span class="col-md-1 col-xs-2">
                                            <label class="exam-ch">
                                                <input type="checkbox" name="checkboxs[]" value="2">
                                                <span class="checkmark-exam"></span>
                                            </label>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
@endsection

@section('script')
  
  <script>      
        $(document).ready(function () {
    $(".text").hide();
    $("#r1").click(function () {
        $(".text").show();
        $(".text2").hide();
        $(".text3").hide();
    });
    $("#r2").click(function () {
        $(".text").hide();
        $(".text2").show();
        $(".text3").hide();
    });
    $("#r3").click(function () {
        $(".text").hide();
        $(".text2").hide();
        $(".text3").show();
    });
});
</script>
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
@endsection