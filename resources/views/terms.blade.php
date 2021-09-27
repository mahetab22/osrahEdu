@extends('layouts.app')

@section('content')

		<!-- Start Title -->
		<section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
		    <div class="container">
		        <h2>شروط الاستخدام</h2>
		        <ul>
		            <li>
		                <a href="index.html">
		                    الرئيسية
		                </a>
		            </li>
		            <li>
		                <span>
    		                شروط الاستخدام
		                </span>
		            </li>
		        </ul>
		    </div>
		</section>
		<!-- End Title -->
		
		<!-- Start Trems-inner -->
        <section class="trems-inner body-inner">
            <div class="container">
                <div class="col-md-3 col-xs-12">
                    <ul class="nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tr1">عنوان الرئيسي</a></li>
                        <li><a data-toggle="tab" href="#tr2">القبول</a></li>
                        <li><a data-toggle="tab" href="#tr3">السلوك</a></li>
                    </ul>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="tab-content">
                        <div id="tr1" class="tab-pane fade in active">
                            <div class="text-about">
                                <h3>العنوان الرئيسي</h3>
                                <p>
                                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها
                                </p>
                            </div>
                        </div>
                        <div id="tr2" class="tab-pane fade">
                            <div class="text-about">
                                <h3>العنوان الرئيسي</h3>
                                <p>
                                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها
                                </p>
                            </div>
                        </div>
                        <div id="tr3" class="tab-pane fade">
                            <div class="text-about">
                                <h3>العنوان الرئيسي</h3>
                                <p>
                                    هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<!-- End Trems-inner -->


@endsection