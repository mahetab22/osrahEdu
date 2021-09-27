@extends('layouts.app')

@section('content')

		<!-- Start Courses-inner -->
        <section class="lesson-inner">
            <div class="col-md-3 col-xs-12 padding">
                <div class="sidebar-lesson">
                    <div class="back-btn">
                        <a href="#">العودة للدورة <i class="fa fa-angle-left"></i></a>
                    </div>
                    <div class="name-lesson">
                        <h1>اسم الدورة هنا</h1>
                    </div>
                    <div class="bar-complete">
                        <span class="complete-5"></span>
<!--
                        <span class="complete-10"></span>
                        <span class="complete-15"></span>
                        <span class="complete-20"></span>
                        <span class="complete-25"></span>
                        <span class="complete-30"></span>
                        <span class="complete-35"></span>
                        <span class="complete-40"></span>
                        <span class="complete-45"></span>
                        <span class="complete-50"></span>
                        <span class="complete-55"></span>
                        <span class="complete-60"></span>
                        <span class="complete-65"></span>
                        <span class="complete-70"></span>
                        <span class="complete-75"></span>
                        <span class="complete-80"></span>
                        <span class="complete-85"></span>
                        <span class="complete-90"></span>
                        <span class="complete-95"></span>
                        <span class="complete-100"></span>
-->
                        <h5>اكتمال 5%</h5>
                    </div>
                    <hr />
                    <div class="all-levels">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" href="#collapse1">المستوي الاول</a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="allcourse">
                                            <ul>
                                                <li class="active">
                                                    <a href="#"><i class="far fa-play-circle"></i> اسم الدورة هنا <span>20 دقيقة</span></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="far fa-file-alt"></i> اسم الدورة هنا </a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="far fa-file-pdf"></i> اسم الدورة هنا </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>  

                            <div class="panel panel-default">
                                <div class="panel-heading active">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">المستوي الثاني</a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="all-courd">
                                            <ul>
                                                <li>
                                                    <a href="#">عنوان الدرس <i class="fa fa-paperclip"></i></a>
                                                </li>
                                                <li class="active">
                                                    <a href="#">عنوان الدرس</a>
                                                </li>
                                                <li>
                                                    <a href="#">عنوان الدرس</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">المستوي التالت</a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="all-courd">
                                            <ul>
                                                <li>
                                                    <a href="#">عنوان الدرس</a>
                                                </li>
                                                <li>
                                                    <a href="#">عنوان الدرس</a>
                                                </li>
                                                <li>
                                                    <a href="#">عنوان الدرس</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="all-buttons">
                            <a class="add-btn" data-toggle="modal" data-target="#add-level">إضافة مستوي</a>
                            <a class="add-btn" data-toggle="modal" data-target="#add-lesson">إضافة درس</a>
                            <a class="add-btn" data-toggle="modal" data-target="#add-exam">إضافة امتحان</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-xs-12">
                <div class="content-lesson">
                    <!-- New-page -->
                    <div class="new-page">
<!--
                        <div class="video-lesson">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/jnLSYfObARA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
-->
                        <div class="oh-sorry">
                            <img src="images/sad.png" />
                            <p class="first-p">
                                نعتذر جدا
                            </p>
                            <p class="sec-p">
                                يجب ان تشاهد الدرس السابق أولا
                            </p>
                        </div>
                    </div>
                    <!-- End --> 
                    <!-- Answer-now 
                    <div class="answer-new">
                        <div class="qiz-now">
                            <form action="">
                                <div class="qiz-block">
                                    <div class="title">
                                        <h3>
                                            اجب الاسألة التالية
                                        </h3>
                                    </div>
                                    <h3>يوضع السؤال هنا؟</h3>
                                    <label class="qiz-check">الاختيار الاول
                                      <input type="radio" checked="checked" name="radio">
                                      <span class="qiz-checkmark"></span>
                                    </label>
                                    <label class="qiz-check">الاختيار الثاني
                                      <input type="radio" name="radio">
                                      <span class="qiz-checkmark"></span>
                                    </label>
                                    <label class="qiz-check">الاختيار الثالث
                                      <input type="radio" name="radio">
                                      <span class="qiz-checkmark"></span>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End -->
                    <div class="download-attch">
                        <h3><i class="fa fa-paperclip"></i> تحميل المرفقات</h3>
                        <a href="#" download>اضغط هنا</a>
                    </div>
                    <div class="all-details-lesson">
                        <div class="header-lesson">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#details">المحتوي</a></li>
                                <li><a data-toggle="tab" href="#tch">عن المحاضر</a></li>
                                <li><a data-toggle="tab" href="#answer">نقاشات</a></li>
                            </ul>
                            <a class="btn-style" data-toggle="modal" data-target="#add-q">إضافة سؤال</a>
                        </div>
                        <div class="body-lesson">
                            <div class="tab-content">
                                <div id="details" class="tab-pane fade in active">
                                    <div class="text-lansser">
                                        <h3>ما هو "لوريم إيبسوم" ؟</h3>
                                        <p>
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        </p>
                                        <p>
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.
                                        </p>
                                    </div>
                                </div>

                                <div id="tch" class="tab-pane fade">
                                    <div class="cv-content">
                                        <div class="img-tch">
                                            <div class="img-u">
                                                <img src="images/user.jpg" alt="" />
                                            </div>
                                            <div class="social-media">
                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                                <a href="#"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                        <div class="details-s">
                                            <ul>
                                                <li>
                                                    <strong>الاسم: </strong>
                                                    <span>محمد احمد</span>
                                                </li>
                                                <li>
                                                    <strong>المؤهل الدراسي: </strong>
                                                    <span>المؤهل</span>
                                                </li>
                                                <li>
                                                    <strong>النوع: </strong>
                                                    <span>ذكر</span>
                                                </li>
                                                <li>
                                                    <strong>التخصص: </strong>
                                                    <span>نوع التخصص</span>
                                                </li>
                                                <li>
                                                    <strong>السن: </strong>
                                                    <span>30 سنة</span>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>

                                <div id="answer" class="tab-pane fade">
                                    <div class="qu-block">
                                        <h3>يوضع السؤال هنا؟</h3>
                                        <p>
                                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<!-- End Courses-inner -->
        
@endsection