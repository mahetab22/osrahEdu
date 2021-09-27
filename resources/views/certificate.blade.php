<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta charset="utf-8">
        <meta name="author" content="Hadeer Magdy">
        <meta name="description" content="NumScroller - jQuery plugin for number increment rolling animation when it becomes visibile while scrolling">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@lang("site.name_us")</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/src_website/images/logo.png') }}" />
        <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <link href="{{ asset('public/src_website/css/style.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/src_website/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
<!--        <link href="css/style-en.css" rel="stylesheet" type="text/css" />-->
        <link href="{{ asset('public/src_website/css/mobile.css') }}" rel="stylesheet" type="text/css" />
      <!--<style type="text/css" media="print">
        @page land {size: landscape;}
        .landscape {page: land;}
        @page port {size: portrait;}
        .portrait {page: port;}
        </style>
        -->
    </head>
    <body>
    	
		<section class="cer-s" id="cre-sss" style="background-image: url({{ asset('public/src_website/images/bgc.png') }})">
            <div class="logo-cer">
                <img src="{{ asset('public/storage/infos/May2020/ILJUeUTeonGNoZmpy5T6.png') }}" />
            </div>
            <div class="text-inner-ce" id="content-inner">
                <h1>شهادة اكمال دورة</h1>
                <h4>تشهد منصة  @lang("site.name_us") بأن</h4>
                <h3>{{ Auth::user()->name }}</h3>
                <h4>قد أتم دورة</h4>
                <h3>{{ $course->title_ar }}</h3>
                <p>

                    تم اكمال الدورة في تاريخ  &nbsp;<span style="display: inline-block;
 direction: ltr;">{{ $certificate->created_at->format('d-F-Y ')  }} </span>
                   &nbsp;   بعدد ساعات تدريبية  <span>{{ $course->duration }}</span>
                </p>
                <h5>قدم الدورة</h5>
                <h2>{{ $course->supervisorcourse->supervisor->name }}</h2>
                <span>{{ $course->supervisorcourse->supervisor->supervisorinfo->service->title_ar ?? '' }}</span>
                <div class="dd-lo"><img src="{{ asset('public/src_website/images/stamp.png') }}" /></div>
            </div>
            <div id="editor"></div>
            <button onclick="getPDF()" class="btn-style" id="submit"><i class="fa fa-download"></i>تحميل PDF</button>
        </section>
        
        <script src="{{ asset('public/src_website/js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/bootstrap.js') }}"></script>
        <script src="{{ asset('public/src_website/js/owl.carousel.js') }}"></script>
        <script src="{{ asset('public/src_website/js/wow.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/responsiveCarousel.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/jquery-scrolloffset.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/main.js') }}"></script>
        <script src="{{ asset('public/src_website/js/lightgallery.min.js') }}"></script>
        <script src="{{ asset('public/src_website/js/jspdf.debug.js') }}"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <script src="{{ asset('public/src_website/js/java.js') }}"></script>
        <script>
			$(document).ready(function(){
				$('#lightgallery').lightGallery();
			});
			
			function getPDF(){
             var HTML_Width = $("#cre-sss").width();
             var HTML_Height = $("#cre-sss").height();
             var top_left_margin = 15;
             var PDF_Width = HTML_Width+(top_left_margin*2);
             var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
             var canvas_image_width = HTML_Width;
             var canvas_image_height = HTML_Height;
             
             var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
             
             
             html2canvas($("#cre-sss")[0],{allowTaint:true}).then(function(canvas) {
             canvas.getContext('2d');
             
             console.log(canvas.height+"  "+canvas.width);
             
             
             var imgData = canvas.toDataURL("image/jpeg", 1.0);
             var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
                 pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
             
             
             for (var i = 1; i <= totalPDFPages; i++) { 
             pdf.addPage(PDF_Width, PDF_Height);
             pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
             }
             
                 pdf.save("certificate.pdf");
                    });
             };
            
            // var doc = new jsPDF(); 
            // var specialElementHandlers = { 
            //     '#editor': function (element, renderer) { 
            //         return true; 
            //     } 
            // };
            // $('#submit').click(function () { 
            //     doc.fromHTML($('#content-inner').html(), 15, 15, { 
            //         'width': 190, 
            //             'elementHandlers': specialElementHandlers 
            //     }); 
            //     doc.save('sample-page.pdf'); 
            // });
        </script>
    </body>
</html>