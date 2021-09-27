@extends('layouts.app')

@section('content')
        
        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
            <div class="container">
                <h2>@lang("site.about")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                           @lang("site.Main")
                          
                        </a>
                    </li>
                    <li>
                        <span>
                           @lang("site.about")
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title -->
        
        <!-- Start About-inner -->
        <section class="about-inner body-inner">
            <div class="container">
                <div class="col-md-6 col-xs-12">
                    <div class="text-about">
                        <div class="title-inner">
                            <h3>@lang("site.about")</h3>
                        </div>
                                    @if(app()->getLocale() == 'ar')
                                    <p>
                                        <?php echo $Info->aboutus_ar ?>
                                    </p>
                                    @else
                                       <p>
                                        <?php echo $Info->aboutus_en ?>
                                      </p>
                                    @endif
                    </div>
                    <div class="about-more">
                      <div class="about-slider owl-carousel owl-theme">
                        	<div class="item">
                                <div class="text-about">
                                    <div class="title-inner">
                                        <h3>
                                        <i class="far fa-comments"></i>
                                      @lang("site.Our_Vision")</h3>
                                    </div>
                                    @if(app()->getLocale() == 'ar')
                                    <p>
                                        <?php echo $Info->our_vision_ar ?>
                                    </p>
                                    @else
                                       <p>
                                        <?php echo $Info->our_vision_en ?>
                                      </p>
                                    @endif
                                </div>
							</div>
                        	<div class="item">
                                <div class="text-about">
                                    <div class="title-inner">
                                        <h3>
                                        <i class="far fa-comments"></i>
                                      @lang("site.ourmessage")</h3>
                                    </div>
                                    @if(app()->getLocale() == 'ar')
                                    <p>
                                        <?php echo $Info->ourmessage_ar ?>
                                    </p>
                                    @else
                                       <p>
                                        <?php echo $Info->ourmessage_en ?>
                                      </p>
                                    @endif
                                </div>
							</div>

                       </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div  class="img-about">
                        @if(!empty($slide_imgabout))
                        <div class="img" style="background-image: url({{ $slide_imgabout }})"></div>
                        @else
                        <div class="img" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})"></div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- End About-inner -->
        
        <!-- Start About-more -->
        <section class="about-more">
            <div class="container">
                <div class="col-md-6 col-xs-12">
                    <div class="text-about list-style">
                      	<div class="title-inner">
                          <h3>قيمنا</h3>
                         </div>
                         <ul>
                              <li>
                              	<i class="far fa-eye"></i>
                                <span>الجودة</span>
                              </li>
                              <li>
                              	<i class="fas fa-hourglass-half"></i>
                                <span>الإبتكار</span>
                              </li>
                              <li>
                              	<i class="fas fa-child"></i>
                                <span>الشغف</span>
                              </li>
                              <li>
                              	<i class="fas fa-thumbs-up"></i>
                                <span>الإلتزام</span>
                              </li>
                         </ul>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="text-about">
                        <div class="title-inner">
                            <h3>@lang("site.Our_Goals")</h3>
                        </div>
                        <ul>
                            <li>
                                @lang("site.goal1_us")
                            </li>
                            <li>
                                @lang("site.goal2_us")
                            </li>
                            <li>
                                @lang("site.goal3_us")
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About-more -->
        
        
@endsection