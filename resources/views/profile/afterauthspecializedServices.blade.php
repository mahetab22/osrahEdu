@extends('layouts.app')
@section('stylelinks')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
        
        <!-- Start departments-inner -->
        <section class="lesson-inner">
            <div class="col-md-3 col-xs-12 padding">
                <div class="sidebar-lesson">
                    <div class="back-btn">
                        <a href="{{ route('specializedServices') }}">@lang("site.Return to the Specialized_Services")<i class="fa fa-angle-left"></i></a>
                    </div>
                    <div class="name-lesson">
                       @if(app()->getLocale() == 'ar')
                        <h1>{{ $department->title_ar }}</h1>
                        @else
                        <h1>{{ $department->title_en }}</h1>
                        @endif
                    </div>
                    <div class="bar-complete">
                      <h3>@lang("site.welcome our dear guest")</h3> 


                    </div>
                    <hr />
                    <div class="all-levels">
                        <div class="panel-group" id="accordion">
  

                        </div> 

                    </div>
                </div>
            </div>



            <div class="col-md-9 col-xs-12">
                <div class="content-lesson">

                      <!-- lesson -->
                       <div id="lesson">

                           <div class="new-page">
                                <div class="video-lesson">
                                   <?php echo ($department->linktube) ?>
                                </div>
                            </div>

                       </div>
                      <!-- lesson -->

                    <div class="all-details-lesson">
                        <div class="header-lesson">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#details">@lang("site.about_th_Service")</a></li>
                                <li><a data-toggle="tab" href="#subscribe">@lang("site.Register_for_the_Service")</a></li>
                            </ul>
                        </div>
                        <div class="body-lesson">
                            <div class="tab-content">
                                <div id="details" class="tab-pane fade in active">
                                    <div class="text-lansser">

                               @if(app()->getLocale() == 'ar')
                                            <h3>{{ $department->title_ar }}</h3>
                                            <p>
                                                <?php echo ($department->description_ar) ?>
                                            </p>

                                            <ul>
                                                <li>
                                                     {{ $department->feature1 }}
                                                </li>
                                                <li>
                                                     {{ $department->feature2 }}
                                                </li>
                                                <li>
                                                     {{ $department->feature3 }}
                                                </li>
                                            </ul>


                                 @else
                                            <h3>{{ $department->title_en }}</h3>
                                            <p>
                                                {{ $department->description_en }}
                                            </p>
                               

                                            <ul>
                                                <li>
                                                     {{ $department->feature1_en }}
                                                </li>
                                                <li>
                                                     {{ $department->feature2_en }}
                                                </li>
                                                <li>
                                                     {{ $department->feature3_en }}
                                                </li>
                                            </ul>
                                   @endif
                                    </div>
                                </div>

                                <div id="subscribe" class="tab-pane fade">
                                    <div class="cv-content">

                                    <a data-toggle="modal" data-target="#Register-Service" class="btn btn-style">@lang("site.Register_for_the_Service")</a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                <!-- Register-Service -->
        <div id="Register-Service" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="add-qu form-contact">
                            <h3>@lang("site.Register_for_the_Service")</h3>
                            <form action="{{ route('Registercontacts')}}"  method="POST" role="form"  enctype="multipart/form-data">
                                @csrf

                                <input name="department" value="{{ $department->title_ar }}" hidden="" />
                                <div class="form-group">
                                    <label>@lang("site.name")</label>
                                    <input type="text" placeholder="@lang("site.name")" name="name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.phone")</label>
                                    <input type="tel" placeholder="@lang("site.phone")" name="phone" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>@lang("site.email")</label>
                                    <input type="email" placeholder="@lang("site.email")" name="email" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="@lang("site.send")" class="btn" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- End departments-inner -->
        
      
@endsection

@section('script')

@endsection