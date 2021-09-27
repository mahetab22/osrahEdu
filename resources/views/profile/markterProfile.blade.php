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
                                <h3>{{ Auth::user()->name }}<span>مسوق</span></h3>
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
                                    @if(Auth::user()->s == 1)
                                    <li><a data-toggle="tab" href="#profile2">احصائيات الخاصة بالكود</a></li>
                                    <li><a data-toggle="tab" href="#profile3">الاحصائيات المالية</a></li>
                                    @endif
                                    
                                </ul>
                            </div>
                            <div class="body-tab-pro">
                                <div class="tab-content">
                                    <!-- tab1 -->
                                    <div id="profile1" class="tab-pane fade in active">
                                        <div class="details-contact">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span> الاسم</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ Auth::user()->name }}</span>
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
                                         @if(Auth::user()->s == 1)
                                                 <div class="block-item">
                                                <div class="label-title">
                                                    <span>كود</span>
                                                </div>
                                                <div class="label-details">
                                                    <span class=" copy-content"><i>{{ Auth::user()->marketer?Auth::user()->marketer->code:'' }}</i></span>
                                                    <button class="copy-btn">نسخ</button>
                                                </div>
                                            </div>
                                                <div class="block-item">
                                                <div class="label-title">
                                                    <span>لينك المشاركه</span>
                                                </div>
                                                <div class="label-details">
                                                    <span class=" copy-content"><i>{{ Auth::user()->marketer?Auth::user()->marketer->url:'' }}</i></span>
                                                    <button class="copy-btn">نسخ</button>
                                                </div>
                                            </div>
                                                                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>نسبة العمولة </span>
                                                </div>
                                                <div class="label-details">
                                                    <span class=" copy-content"><i>{{ Auth::user()->marketer?Auth::user()->marketer->discount:'' }}</i></span>
                                      
                                                </div>
                                            </div>
                                          @endif
                                        </div>
                                      
                                        <a href="{{ url('/') }}/editprofile/{{ Auth::user()->id }}" class="btn btn-gray">تعديل البيانات</a>
                                    </div>
                                    <div id="profile2" class="tab-pane fade in">
                                        <div class="details-contact">
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span> عدد الزوار المستخدمين اللينك</span>
                                                </div>
                                                <div class="label-details">
                                                    <span>{{ Auth::user()->marketer?Auth::user()->marketer->visitors:'0' }}</span>
                                                </div>
                                            </div>
                                          
                                            <div class="block-item">
                                                <div class="label-title">
                                                    <span>المستخدمين للكود اثناء التسجيل للدوره</span>
                                                </div>
                                                <div class="label-details">
                                                    <span><i>{{ Auth::user()->marketer?Auth::user()->marketer->sales:'0' }}</i></span>
                                                </div>
                                            </div>
                                        
                                                 <div class="block-item">
                                                <div class="label-title">
                                                    <span>مستحقاتك المالية</span>
                                                </div>
                                                <div class="label-details">
                                                    <span><i>{{ Auth::user()->marketer?Auth::user()->marketer->amount:'0' }}</i></span>
                                                </div>
                                            </div>

                                       
                                        </div>
                         
                                    </div>
                                    <div id="profile3" class="tab-pane fade in">
                                        <div class="details-contact">
                                            <table class="table table-bordered">
                                                <thead>
                                                  <tr>
                                                    <th>الطالب</th>
                                                    <th>اسم الدوره</th>
                                                    <th>نسبة الخصم للطالب</th>
                                                    <!--<th>نسبه العموله</th>-->
                                                    <th>سعر الكورس</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @if(auth::user()->s==1)
                                                @foreach(\App\Stusubscriptioncourse::where('code',Auth::user()->marketer->code)->get() as $st)
                                                  <tr>
                                                    <td>{{$st->user->name}}</td>
                                                    <td>{{$st->course->title_ar}}</td>
                                                    <td>{{$st->course->studentDiscount}}</td>
                                                     <!--<td>{{$st->course->marketer_commission}}</td>-->
                                                      <td>{{$st->course->price}}</td>
                                                  </tr>
                                                @endforeach
                                                @endif
                                                </tbody>
                                              </table>
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
      


@endsection

@section('script')
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
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