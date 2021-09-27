@extends('layouts.app')

@section('content')


		
		<!-- Start Title -->
		<section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
		    <div class="container">
		        <h2>@lang("site.Our_team")</h2>
		        <ul>
		            <li>
		                <a href="index.html">
		                   @lang("site.Main")
		                </a>
		            </li>
		            <li>
		                <span>
		                    @lang("site.Our_team")
		                </span>
		            </li>
		        </ul>
		    </div>
		</section>
		<!-- End Title -->
		
		<!-- Start Team-inner -->
        <section class="team-inner body-inner">
            <div class="container">
                <div class="col-xs-12 padding">
    	                @if(app()->getLocale() == 'ar') 
                         @foreach($users as $index=>$user)
                         @if($user->s == 1 and !empty($user->supervisorinfo))
                         <?php 
                         $name=explode(" ",$user->name);
                         $cvv=$index.$user->id;
                         ?>
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="team-block">
                                    <div class="img-t">
                                        <img src="{{ url('/') }}/public/storage/{{ $user->avatar }}" />
                                        <div class="social-t">
                                            <ul>
                                                <li>
                                                    <a href="{{ $user->fb }}">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $user->tw }}">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $user->inst }}">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $user->google }}">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details-t">
                                        <h4  data-toggle="modal" data-target="#{{ $cvv }}">{{ $user->name }}</h4>
                                        <span>{{ $user->supervisorinfo->service->title_ar ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End -->
                            <!-- Modal -->
                            <div id="{{ $cvv }}" class="cv modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <div class="cv-content">
                                                <div class="col-md-5 col-xs-12">
                                                    <div class="img-u">
                                                        <img src="{{ url('/') }}/public/storage/{{ $user->avatar }}" alt="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-xs-12">
                                                    <h3>{{ $user->name }}</h3>
                                                    <ul>
                                                        <li>
                                                            <strong>@lang("site.Educational") :</strong>
                                                            <span>{{ $user->supervisorinfo->Educational ?? '' }}</span>
                                                        </li>
                                                        <li>
                                                            <strong>@lang("site.Specialization") :</strong>
                                                            <span>{{ $user->supervisorinfo->service->title_ar ?? '' }}</span>
                                                        </li>
                                                        <li>
                                                            <div class="hover-btn">
                                                                <a href="{{ url('/') }}/superprofile/{{ $user->id }}" class="btn-style">@lang("site.more")</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                         @endforeach

                         @else
                         @foreach($users as $index=>$user)
                         @if($user->s == 1)
                         <?php 
                         $name=explode(" ",$user->name);
                         $cvv=$index.$user->id;
                         ?>
                            <!-- Start Col -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="team-block">
                                    <div class="img-t">
                                        <img src="{{ url('/') }}/public/storage/{{ $user->avatar }}" />
                                        <div class="social-t">
                                            <ul>
                                                <li>
                                                    <a href="{{ $user->fb }}">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $user->tw }}">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $user->inst }}">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $user->google }}">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details-t">
                                        <h4  data-toggle="modal" data-target="#{{ $cvv }}">{{ $user->name }}</h4>
                                        <span>{{ $user->supervisorinfo->service->title_en ?? '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End -->
                            <!-- Modal -->
                            <div id="{{ $cvv }}" class="cv modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <div class="cv-content">
                                                <div class="col-md-5 col-xs-12">
                                                    <div class="img-u">
                                                        <img src="{{ url('/') }}/public/storage/{{ $user->avatar }}" alt="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-xs-12">
                                                    <h3>{{ $user->name }}</h3>
                                                    <ul>
                                                        <li>
                                                            <strong>@lang("site.Educational") :</strong>
                                                            <span>{{ $user->supervisorinfo->Educational ?? '' }}</span>
                                                        </li>
                                                        <li>
                                                            <strong>@lang("site.Specialization") :</strong>
                                                            <span>{{ $user->supervisorinfo->service->title_en ?? '' }}</span>
                                                        </li>
                                                        <li>
                                                            <div class="hover-btn">
                                                                <a href="{{ url('/') }}/superprofile/{{ $user->id }}" class="btn-style">@lang("site.more")</a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                         @endforeach
                        @endif
    			</div>
            </div>
        </section>
		<!-- End Team-inner -->



@endsection