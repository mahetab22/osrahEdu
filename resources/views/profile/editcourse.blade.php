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
                    <?php
                        $imagePreview=json_encode(url('/').'/public/storage/'.$course->logo);
                    ?>
                                    <!-- tab4 -->
                                    <div class="">
                                        <div class="form-contact">
                                            <form action="{{ route('updatecourse')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                                @csrf 
                                                <div id="vehicleFieldsWrapper" >    
                                                    <div class="vehicleFields"> 


                                                               <div class="profile-image">
                                                                    <div class="avatar-upload">
                                                                        <div class="avatar-edit">
                                                                            <input type='file' id="imageUpload" name="logo" accept=".png, .jpg, .jpeg" />
                                                                            <label for="imageUpload"></label>
                                                                        </div>
                                                                        <div class="avatar-preview">
                                                                            <div id="imagePreview" style="background-image: url({{ $imagePreview }})"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-12 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>رفع ملف آخر pdf</label>
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
                                                                <input type="text" class="form-control" name="title_ar" value="{{ $course->title_ar }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>اسم الكورس بالانجليزية</label>
                                                                <input type="text" class="form-control" name="title_en" value="{{ $course->title_en }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>تفاصيل الكورس</label>
                                                                <textarea value="{{ $course->description_ar }}"  class="form-control" name="description_ar">{{ $course->description_ar }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>تفاصيل الكورس  بالانجليزية</label>
                                                                <textarea placeholder="تفاصيل الكورس" class="form-control" name="description_en">{{ $course->description_en }}</textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6 col-xs-12">
                                                           <div class="form-group">
                                                                <label>رسوم الاشتراك</label>
                                                                <input type="number" class="form-control" name="price" value="{{ $course->price }}" step="0.1" required />
                                                           </div>
                                                        </div>
                                                  
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>مدة الكورس</label>
                                                                <input type="text" class="form-control" name="duration" required value="{{ $course->duration }}" />
                                                            </div>
                                                        </div>                                                       
                                                         <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يبدأ في </label>
                                                                <input type="date" class="form-control" name="from_date" value="{{ $course->from_date }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>ينتهي في</label>
                                                                <input type="date" class="form-control" name="to_date" value="{{ $course->to_date }}" required />
                                                            </div>
                                                        </div>  
                                                         <?php $sservices=DB::table('services')->where('parent_id',$course->service_id)->get(); ?>    
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
                                                         <input name="service_id" value="{{ $course->service_id }}" hidden>
                                                        @endif
                                                         <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>طريقة التعلم</label>
                                                                 <select class="form-control" name="online">
                                                                 @if($course->online == 1)
                                                                        <option value="1" selected>مباشر</option>
                                                                        <option value="0" >تعلم ذاتي</option>
                                                                        @else
                                                                        <option value="0" selected>تعلم ذاتي</option>
                                                                         <option value="1" >مباشر</option>
                                                                        
                                                                  @endif
                                                                  </select>
                                                                  
                                                            </div>
                                                        </div>
                                                        <input name="course_id" value="{{ $course->id }}" hidden>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكورس ب</label>
                                                                <input type="text" class="form-control" name="feature2" value="{{ $course->feature2 }}" required />
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكورس ب</label>
                                                                <input type="text" class="form-control" name="feature2" value="{{ $course->feature2 }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكورس ب</label>
                                                                <input type="text" class="form-control" name="feature3" value="{{ $course->feature3 }}" required />
                                                            </div>
                                                        </div>                                                       
                                                         <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكورس ب  بالانجليزية</label>
                                                                <input type="text" class="form-control" name="feature1_en" value="{{ $course->feature1_en }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكورس ب  بالانجليزية</label>
                                                                <input type="text" class="form-control" name="feature2_en" value="{{ $course->feature2_en }}" required />
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>يتميز الكورس ب  بالانجليزية</label>
                                                                <input type="text" class="form-control" name="feature3_en" value="{{ $course->feature3_en }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>لينك اليوتيوب</label>
                                                                <input type="text" class="form-control" name="link" value="{{ $course->link }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>لينك الواتساب</label>
                                                                <input type="text" class="form-control" name="whats_link" value="{{ $course->whats_link }}" required />
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn-style" value="تعديل" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- tab4 -->


                    </div>
                </div>
                <div class="col-md-2 col-xs-12"></div>
            </div>
        </section>
        <!-- End Profile3-inner -->
        
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