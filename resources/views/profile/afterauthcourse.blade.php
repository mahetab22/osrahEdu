@extends('layouts.app')
@section('stylelinks')
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.2.0/moyasar.css">
@endsection
@section('content')
        
        <!-- Start Courses-inner -->
        <section class="lesson-inner">
            <div class="col-md-3 col-xs-12 padding">
                <div class="sidebar-lesson">
                    <div class="back-btn">
                        <a href="{{ route('/') }}">@lang("site.Return to the course")<i class="fa fa-angle-left"></i></a>
                    </div>
                    <div class="name-lesson">
                       @if(app()->getLocale() == 'ar')
                        <h1>{{ $course->title_ar }}</h1>
                        <h5>{{ $course->service->title_ar }}</h5>
                        @else
                        <h1>{{ $course->title_en }}</h1>
                        <h5>{{ $course->service->title_en }}</h5>
                        @endif
                    </div>
                    <div class="bar-complete">
                      <h3>@lang("site.welcome our dear guest")</h3> 


                    </div>
                    <hr />
                    <div class="all-levels">
                        <div class="panel-group" id="accordion">
                        
                            @foreach($course->levels as $levels)
                               @if(app()->getLocale() == 'ar')
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" href="#col{{$levels->id}}">{{ $levels->title_ar }} @if(0)<span>*</span>@endif</a>
                                    </h4>
                                </div>
                                <div id="col{{$levels->id}}" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <div class="allcourse">
                                        <!--  
                                            <ul>
                                              @foreach($levels->lessons as $lesson)
                                                <li> <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_data" data-get_id="{{ $lesson->id }}" ><i class="far fa-play-circle"></i> {{ $lesson->title_ar }} <span>{{ $lesson->duration }} دقيقة</span></a>
                                                   
                                                </li>
                                                @if($lesson->exam)
                                                <li>
                                                   <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $lesson->exam->id }}" >@lang("site.Lesson test") @if($levels->exam)<span>*</span>@endif</a>
                                                </li>
                                                @endif
                                              @endforeach
                                            </ul>
                                            -->
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            @else
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" href="#col{{$levels->id}}">{{ $levels->title_en }} @if(0)<span>*</span>@endif</a>
                                    </h4>
                                </div>
                                <div id="col{{$levels->id}}" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <div class="allcourse">
                                        <!-- 
                                            <ul>
                                              @foreach($levels->lessons as $lesson)
                                                <li> <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_data" data-get_id="{{ $lesson->id }}" ><i class="far fa-play-circle"></i> {{ $lesson->title_ar }} <span>{{ $lesson->duration }} دقيقة</span></a>
                                                   
                                                </li>

                                                @if($lesson->exam)
                                                <li>
                                                   <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $lesson->exam->id }}" >@lang("site.Lesson test") @if($levels->exam)<span>*</span>@endif</a>
                                                </li>
                                                @endif
                                              @endforeach
                                            </ul>
                                            -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($levels->exam)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                         <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $levels->exam->id }}"  >@lang("site.Level test") @if($levels->exam)<span>*</span>@endif</a>
                                    </h4>
                                </div>
                            </div>
                            @endif 
                            @endforeach
                            @if($course->exam)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                         <a  data-toggle="collapse" data-parent="#accordion" class="get_ajax_exam" data-get_id="{{ $course->exam->id }}"  >@lang("site.Ali exam course") @if($course->exam)<span>*</span>@endif</a>
                                    </h4>
                                </div>
                            </div>
                            @endif  

                        </div> 

                    </div>
                </div>
            </div>



            <div class="col-md-9 col-xs-12">
                <div class="content-lesson">

                      <!-- lesson -->
                       <div id="lesson">
                                    <?php
                                        echo($course->link);
                                    ?>
                           <!--<div class="new-page">
                                <div class="video-lesson">
                                    <iframe width="560" height="315" src="{{ $course->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>

                            <div class="download-attch">
                                <h3><i class="fa fa-paperclip"></i>@lang("site.Download the attachments") </h3>
                                <a href="{{ url('/') }}/public/storage/{{ $course->file }}" download>@lang("site.Press here")</a>
                            </div>-->

                       </div>
                      <!-- lesson -->

                    <div class="all-details-lesson">
                        <div class="header-lesson">
                            <ul class="nav nav-tabs">
                            @if(!empty($course->stop_subscription) and $course->stop_subscription == 1)
                                @if($course->price > 0)
                                <li><a data-toggle="tab" href="#subscribe">الدفع بالبطاقة</a></li>
                                <li><a data-toggle="tab" href="#subscribe_by_bank">@lang("site.Register_for_the_course_by_bank")</a></li>
                                @else
                                <li><a data-toggle="tab" href="#subscribe">التسجيل بالدورة</a></li>
                                @endif
                             @endif
                                <li class="active"><a data-toggle="tab" href="#details">@lang("site.about_th_course")</a></li>
                                <li><a data-toggle="tab" href="#tch">@lang("site.About_th_supervisor")</a></li>
                            </ul>
                        </div>
                        <div class="body-lesson">
                            <div class="tab-content">
                                <div id="details" class="tab-pane fade in active">
                                    <div class="text-lansser">

                               @if(app()->getLocale() == 'ar')
                                            <h3>{{ $course->title_ar }}</h3>
                                            <p>
                                                {{ $course->description_ar }}
                                            </p>

                                            <ul>
                                                <li>
                                                     {{ $course->feature1 }}
                                                </li>
                                                <li>
                                                     {{ $course->feature2 }}
                                                </li>
                                                <li>
                                                     {{ $course->feature3 }}
                                                </li>
                                            </ul>


                                 @else
                                            <h3>{{ $course->title_en }}</h3>
                                            <p>
                                                {{ $course->description_en }}
                                            </p>
                               

                                            <ul>
                                                <li>
                                                     {{ $course->feature1_en }}
                                                </li>
                                                <li>
                                                     {{ $course->feature2_en }}
                                                </li>
                                                <li>
                                                     {{ $course->feature3_en }}
                                                </li>
                                            </ul>
                                   @endif
                                   @if($course->stop_subscription == 0)
                                   <p>
                                                الاشتراك غير متاح الأن
                                  </p>
                                   @endif
                                    </div>
                                </div>
                               @if(!empty($course->supervisorcourse->supervisor))
                                <div id="tch" class="tab-pane fade">
                                    <div class="cv-content">
                                        <div class="img-tch">
                                            <div class="img-u">
                                                <img src="{{ url('/') }}/public/storage/{{ $course->supervisorcourse->supervisor->avatar }}" alt="" />
                                            </div>
                                            <div class="social-media">
                                                <a href="{{ $course->supervisorcourse->supervisor->fb }}"><i class="fab fa-facebook-f"></i></a>
                                                <a href="{{ $course->supervisorcourse->supervisor->tw }}"><i class="fab fa-twitter"></i></a>
                                                <a href="{{ $course->supervisorcourse->supervisor->inst }}"><i class="fab fa-google-plus-g"></i></a>
                                                <a href="{{ $course->supervisorcourse->supervisor->google }}"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="details-s">
                                            <ul>
                                                <li>
                                                    <strong>@lang("site.name") : </strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->name }}</span>
                                                </li>
                                                <li>
                                                    <strong>@lang("site.Educational"):</strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->Educational }}</span>
                                                </li>
                                              <!--   <li>
                                                    <strong>@lang("site.gender") : </strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->gender }}</span>
                                                </li> -->
                                                <li>
                                                    <strong>@lang("site.Specialization") :</strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->service->title_ar }}</span>
                                                </li>
                                               <!-- <li>
                                                    <strong>@lang("site.Age") :</strong>
                                                    <span>{{ $course->supervisorcourse->supervisor->Age }} سنة</span>
                                                </li>-->
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                               @else
                                <div id="tch" class="tab-pane fade">
                                    <div class="cv-content">
                                       <div class="details-s">
                                        بيانات المدرب غير كاملة ونعمل علي أكتمالها في الوقت الحالي
                                       </div>
                                     </div>
                                </div>
                               @endif
                               
                               <div id="subscribe_by_bank" class="tab-pane fade form-contact">

                                    <div class="cv-content">
                                     @auth  
                                    <form action="{{ route('uploadimg') }}" method="POST" role="form"  enctype="multipart/form-data">
                                    @csrf
                                    <input name="course_id" value="{{ $course->id }}" hidden>

                                   <div class="text-lansser account">
                                       <ul>
                                           <li>البنك</li>
                                           <li><img src="{{ asset('public/src_website/images/ahly.png') }}" /></li>
                                           <li>اسم صاحب الحساب</li>
                                           <li>  شركة نهل للخدمات التسويقية التعليمية </li>
                                           <li>رقم الحساب</li>
                                           <li>سيتوفر الرقم قريبا</li>
                                          <!-- <li>24300000621000</li>-->
                                           <li>IBAN-رقم الحساب المصرفي الدولي</li>
                                           <li>سيتوفر الرقم قريبا</li>
                                          <!-- <li>SA4910000024300000621000</li> -->
                                       </ul>
                                            <!--<h3>حساب بنك الأهلي -NCB</h3>-->
                                            <!--<p>-->
                                            <!--    شركة نهل للخدمات التسويقيةالتعليمية-->
                                            <!--</p>-->

                                            <!--<ul>-->
                                            <!--    <li>-->
                                            <!--         الرقم الشخصي : 78205702-->
                                            <!--    </li>-->
                                            <!--    <li>-->
                                            <!--         <span>IBAN-رقم الحساب المصرفي الدولي</span> : SA4910000024300000621000-->
                                            <!--    </li>-->
                                            <!--</ul>-->
                                        </div>

                                   <div class="text-lansser account">
                                        <ul>
                                           <li>البنك</li>
                                           <li><img src="{{ asset('public/src_website/images/rajhi.png') }}" /></li>
                                           <li>اسم صاحب الحساب</li>
                                           <li>شركة نهل للخدمات التسويقية التعليمية</li>
                                           <li>رقم الحساب</li>
                                           <li>216608010979193</li>
                                           <li>IBAN-رقم الحساب المصرفي الدولي</li>
                                           <li>SA9480000216608010979193</li>
                                       </ul>
                                            <!--<h3>مصرف الراجحي</h3>-->
                                            <!--<p>-->
                                            <!--    شركة نهل للخدمات التسويقيةالتعليمية-->
                                            <!--</p>-->

                                            <!--<ul>-->
                                            <!--    <li>-->
                                            <!--         الرقم الشخصي : 20801699-->
                                            <!--    </li>-->
                                            <!--    <li>-->
                                            <!--         <span>IBAN-رقم الحساب المصرفي الدولي</span> : SA9480000216608010979193-->
                                            <!--    </li>-->
                                            <!--</ul>-->
                                        </div>

                                     <div class="form-group">
                                        <label>أرفق صورة الإيصال</label>


                                        <div class="input-group">
                                            <label class="input-group-btn">
                                                <span class="btn btn-primary">
                                                    <i class="fa fa-upload"></i> <input type="file" name="img" style="display: none;" multiple>
                                                </span>
                                            </label>
                                            <input type="text" class="form-control" placeholder="@lang("site.image")" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="ارسال المرفق" class="form-control btn-style" />
                                    </div>
                                    <!--
                                    <a href="{{ url('/') }}/subscribe/{{ $course->id }}" class="btn btn-style">@lang("site.Register_for_the_course")</a>
                                     -->
                                     </form>
                                    @else
                                    <a href="{{ route('registerorlogin') }}" class="btn btn-style">@lang("site.Register_for_the_course")</a>
                                    @endif
                                    </div>
                                </div>
                                
                                <div id="subscribe" class="tab-pane fade form-contact">
{{--                                     <div class="cv-content">
                                     @auth  
                                    <a href="{{ url('/') }}/subscribe/{{ $course->id }}" class="btn btn-style">@lang("site.Register_for_the_course")</a>
                                    @else
                                    <a href="{{ route('registerorlogin') }}" class="btn btn-style">@lang("site.Register_for_the_course")</a>
                                    @endif
                                    </div> --}}
                                    

                                     @auth  
@if($course->price > 0)
                                    <div class="col-md-12">
                                        <div class="title wow fadeInUp" style="visibility: visible;">
                                            <h3>@lang("site.To register for the course, enter the following data")</h3>
                                        </div>
                                    </div>
                                    <div class="visas-all"><img src="{{ asset('public/src_website/images/payments-cards.png') }}" /></div>
                                <input  id="course_id" name="course_id" value="{{ $course->id }}" hidden>
                                @if($course->studentDiscount!=0)
                                <div class="form-group">
                                    <label>كود الخصم</label>
                                    <input type="text" id="code" name="code"  class="form-control" value="{{session('codeMarketer')??''}}"required/>
                                    <a type="submit" class="btn link" >تأكيد كود الخصم</a>
                                </div>
                                @endif
                                       <div class="form-group">
                                            <label>قيمة الدورة التدريبية بالريال</label>
                                             <input type="text" class="form-control" value="{{ $course->price }}" disabled=""/>

                                        </div>
                                        
                                        <div class="form-group">
                                            <label>القيمة الاجمالية بعد الخصم</label>
                                             <input type="text" class="form-control lolAfter" value="{{ $course->price }}" disabled="" />
                                        </div>
                                <div class="mysr-form"></div>
                                    <!--<form accept-charset="UTF-8" id="formmoyaser" action="https://api.moyasar.com/v1/payments.html" method="POST">-->
                                    <!--     <input name="publishable_api_key" value="pk_test_8nqExJA62LTtaCySMbzuFYpdzgLMC7gBzZygX7QM" hidden="" />-->
                                    <!--      <input name="course_id" value="{{ $course->id }}" hidden="" />-->
                                    <!--      <input type="hidden" name="callback_url" value="{{ url('/') }}/subscribe/{{ $course->id }}" />-->
                                    <!--      <input type="hidden" name="coupon" />-->
                                    <!--      <input name="amount_format" value="885.71 SAR" hidden="" />-->
                                    <!--      <input type="hidden" class="lol" name="amount" value="{{ $course->price*100 }}" />-->
                                    <!--        <input type="hidden" name="methods[]" value="creditcard" />-->
                                    <!--         <input type="hidden" name="methods[]" value="stcpay" />-->
                                    <!--      <input type="hidden" name="applepay[country]" value="SA" />-->
                                    <!--      <input type="hidden" name="applepay[label]" value="label" />-->
                                    <!--      <input type="hidden" name="applepay[merchant_validation_url]" value="https://nhledu.com/nhl_marketer" />-->

                                 
                                    <!--    </div>-->
                                        
                                    <!--<div class="form-pay">-->
                                    <!--    <div class="col-xs-12">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <input type="number" placeholder="رقم البطاقة" name="source[number]" class="form-control"/>-->

                                    <!--            <i class="far fa-credit-card"></i>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6 col-xs-12">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <input type="text" placeholder="MM" name="source[month]" class="form-control" />-->
                                    <!--            <i class="far fa-calendar-alt"></i>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-6 col-xs-12">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <input type="text" placeholder="YY" name="source[year]" class="form-control" />-->
                                    <!--            <i class="far fa-calendar-alt"></i>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-md-12 col-xs-12">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <input type="number" placeholder="CVC" name="source[cvc]" class="from-control" />-->
                                    <!--            <i class="fa fa-lock"></i>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--    <div class="col-xs-12">-->
                                    <!--        <div class="form-group">-->
                                    <!--            <input type="text" placeholder="الاسم" name="source[name]" class="form-control" />-->
                                    <!--            <i class="fa fa-user"></i>-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--    <input id="in_ch" type="checkbox"/>-->
                                    <!--     <span>يجب الموافقة علي الشروط والأحكام أولا . <a class="add-btn" data-toggle="modal" data-target="#view">مراجعة</a></span>-->
                                    <!--    <input disabled="disabled" type="submit" class="btn btn-style"   id="check" value="ادفع هنا">-->
                                    <!--</form>-->
@else
                                    <div class="col-md-12">
                                        <div class="title wow fadeInUp" style="visibility: visible;">
                                            <h3>@lang("site.There is no fee to pay Welcome")</h3>
                                        </div>
                                    </div>
                                    <form action="{{ url('/') }}/subscribemag/{{ $course->id }}" method="get" role="form"  enctype="multipart/form-data">
                                    
                                  <input  id="in_ch" type="checkbox"/>
                                   <span>يجب الموافقة علي الشروط والأحكام أولا . <a class="add-btn" data-toggle="modal" data-target="#view">مراجعة</a></span> 
                                   <input disabled="disabled" type="submit" class="btn btn-style"   id="check" value="اضغط هنا للتسجيل بالدورة">
                                   </form>
@endif
                                    @else
                                    <a href="{{ route('registerorlogin') }}" class="btn btn-style">@lang("site.Register_for_the_course")</a>
                                    @endauth

                                    


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Courses-inner -->
        
              <!-- Modal -->
        <div id="view" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="add-qu">
                            <h3>الشروط والأحكام </h3>
                            <h4><?php 
                            $conditions = DB::table('conditions')->first();
                             echo ($conditions->condition_ar); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
              <!-- check Exam code-->
        <div id="check-exam-code" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="add-qu form-contact">
                            <h3>أدخل كود الخصم</h3>

                                <input  id="course_id" name="course_id" value="{{ $course->id }}" hidden>
                                <div class="form-group">
                                    <label>كود الخصم</label>
                                    <input type="text" id="code" name="code"  class="form-control" required/>
                                </div>


                                <div class="form-group">
                                    <a type="submit" class="btn link" >@lang("site.go")</a>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

<!-- Moyasar Scripts -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
<script src="https://cdn.moyasar.com/mpf/1.2.0/moyasar.js"></script>

<script>
moyaser();
   
   console.log(url);
   function moyaser(){
       var x=$(".lolAfter").val()*100;
   var code=$('input[name="code"]').val();
   var url="{{ url('/') }}/subscribe/{{ $course->id }}?coupon="+code;
    Moyasar.init({
        // Required
        // Specify where to render the form
        // Can be a valid CSS selector and a reference to a DOM element
        element: '.mysr-form',
        // Required
        // Amount in the smallest currency unit
        // For example:
        // 10 SAR = 10 * 100 Halalas
        // 10 KWD = 10 * 1000 Fils
        // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
        amount: x,
        // Required
        // Currency of the payment transation
        currency: 'SAR',
        // Required
        // A small description of the current payment process
        description: "{{$course->title_ar}}",
        // Required
        publishable_api_key: 'pk_test_8nqExJA62LTtaCySMbzuFYpdzgLMC7gBzZygX7QM',
        // Required
        // This URL is used to redirect the user when payment process has completed
        // Payment can be either a success or a failure, which you need to verify on you system (We will show this in a couple of lines)
        callback_url: url,
        // Optional
        // Required payments methods
        // Default: ['creditcard', 'applepay', 'stcpay']
        methods: [
            'creditcard',
            'stcpay'
        ],
        applepay: {
            country: 'SA',
            label: 'nhl',
            merchant_validation_url: 'https://nhledu.com/nhl_marketer',
        }
    });
   }
</script>











<script type="text/javascript">
var checkbox = $('#in_ch');

var button = $('#check');

 

checkbox.on('change', function(){
 if(checkbox.is(':checked')){  
 
    button.removeProp('disabled');

}else{  
button.prop('disabled', 'disabled');
} 
});
</script>

<script>

//-----------------
$(document).ready(function(){
$('.get_ajax_data').click(function(e){


 var lesson_id= $(this).attr('data-get_id'); 
//console.log(lesson_id); 
       $('#lesson').html('<div class="new-page"><div class="oh-sorry"><img src="{{ asset('public/src_website/images/sad.png') }}" /><p class="first-p">@lang("site.To enter the lesson")</p><p class="sec-p">@lang("site.You must first subscribe")</p></div></div>');
   });
});
//-----------------
</script>

<script>

//-----------------
$(document).ready(function(){
$('.get_ajax_exam').click(function(e){


 var exam_id= $(this).attr('data-get_id'); 
//console.log(lesson_id); 
       $('#lesson').html('<div class="new-page"><div class="oh-sorry"><img src="{{ asset('public/src_website/images/sad.png') }}" /><p class="first-p">@lang("site.To enter the test")</p><p class="sec-p">@lang("site.You must first subscribe")</p></div></div>');
   e.preventDefault();
   /*Ajax Request Header setup*/
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
   

   /* Submit form data using ajax*/

   });
});
//-----------------
</script>

        <script>
        $(document).ready(function () {

            $(document).on('click', '.link', function(){
              var code=$('#code').val();
              var course_id=$('#course_id').val();
                    console.log(code);
                    var token = '{{ csrf_token() }}';
                    $.ajax({
                    type:'GET',
                    url:"{{ url('checkcodediscount')}}",
                    data: { "course_id": course_id,"code" : code,_token: token},
                    success: function(data){
                    console.log(data);
                    $('.lolAfter').val(data);
                    $('.lol').val(data*100);
                    moyaser();
                    },error(err){
                        console.log(err);
                    }
                    });
                    
       /* var token = '{{ csrf_token() }}';
        $.ajax({
        type: "GET",
        url: "{{ url('cccodediscount')}}",
        data:{ "code" : code,_token: token},
        success: function(data) {
        }
        });*/
        
            });

        });
        </script>
        <script>
            $('#formmoyaser').submit(function() {
                var code=$('input[name="code"]').val();
              $('input[name="callback_url"]').val("{{ url('/') }}/subscribe/{{ $course->id }}/?coupon="+code); 
             });
        </script>
@endsection