@extends('layouts.app')

@section('content')

        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
            <div class="container">
                <h2>@lang("site.Join_teacher")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                           @lang("site.Main")
                        </a>
                    </li>
                    <li>
                        <span>
                            @lang("site.Join_teacher")
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title -->
        
        <!-- Start Req-inner -->
        <section class="contact-inner body-inner req-inner">
            <div class="container">
                <div class="col-md-3 col-xs-12"></div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-contact">
                        <form action="{{ route('Register') }}" method="POST" role="form"  enctype="multipart/form-data">
                         @csrf

                            <h3>@lang("site.Personal_data")</h3>
                            <div class="form-group">
                                <label>@lang("site.name")</label>
                                <input type="text" placeholder="@lang("site.name")" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label@lang("site.email")</label>
                                <input placeholder="@lang("site.email")" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          <!--  <div class="form-group">
                                <label>@lang("site.phone")</label>
                                <input placeholder="@lang("site.phone")" class="form-control"  type="tel" id="phone" name="phone"  />
                            </div>-->
                            
                         <!--   <div class="form-group mx-sm-3 mb-2">
                                <label class="excheck">@lang("site.male")
                                    <input type="radio" name="gender"  value="male"/>
                                    <span class="checkmarkEx"></span>
                                </label>
                                <label class="excheck">@lang("site.female")
                                    <input type="radio" name="gender" value="female"/>
                                    <span class="checkmarkEx"></span>
                                </label>
                            </div>
 
                             <div class="form-group mx-sm-3 mb-2">
                                <label>@lang("site.Age")</label>
                                <input placeholder='@lang("site.Age")'  type="text" id="Age" name="Age"  class="form-control" required>
                            </div>-->
                            
                            <div class="form-group">
                                <label>@lang("site.phone")</label>
                                <input placeholder='@lang("site.phone")'  type="tel" id="phone" name="phone"  class="form-control" required>
                            </div>
                                                    
                            <div class="form-group mx-sm-3 mb-2">
                                <label>@lang("site.Educational")</label>
                                <input placeholder='@lang("site.Educational")'  type="text" id="Educational" name="Educational"  class="form-control" required>
                            </div>

                            
                            <div class="form-group">
                                <label>@lang("site.password")</label>
                                <input placeholder="@lang("site.password")" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang("site.password_confirmation")</label>
                                <input placeholder="@lang("site.password_confirmation")" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"/>
                            </div>
                            <input name="role_id" value="3" hidden/>
                            <div class="form-group">
                                <label>@lang("site.image")</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                            <i class="fa fa-upload"></i> <input type="file" name="avatar" style="display: none;" multiple>
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="@lang("site.image")" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>@lang("site.fb")</label>
                                <input type="text" placeholder="@lang("site.fb")" class="form-control" name="fb"  autocomplete="fb" autofocus pattern="https?://.+"/>
                            </div>

                            <div class="form-group">
                                <label>@lang("site.tw")</label>
                                <input type="text" placeholder="@lang("site.tw")" class="form-control" name="tw" autocomplete="tw" autofocus pattern="https?://.+"/>
                            </div>

                           <div class="form-group">
                                <label>@lang("site.inst")</label>
                                <input type="text" placeholder="@lang("site.inst")" class="form-control" name="inst" autocomplete="inst" autofocus pattern="https?://.+"/>
                            </div>

                            <div class="form-group">
                                <label>@lang("site.google")</label>
                                <input type="text" placeholder="@lang("site.google")" class="form-control" name="google" autocomplete="google" autofocus pattern="https?://.+"/>
                            </div>

                            <div class="form-group">
                                <label>@lang("site.service")</label>
                                @if(app()->getLocale() == 'ar')
                                <select  class="form-control" name="service_id" required >
                                        @foreach($services as $service) 
                                          <option value="{{ $service->id }}">{{ $service->title_ar }}</option>
                                        @endforeach
                                </select>
                                    @else
                                <select  class="form-control" name="service_id" required >
                                      <option disabled selected>@lang("site.Select_Specialty")</option>
                                    @foreach($services as $service) 
                                      <option value="{{ $service->id }}">{{ $service->title_en }}</option>
                                    @endforeach
                                </select>
                                @endif

                            </div>


                            <div class="form-group">
                                <input type="submit" value="@lang("site.Sign_Up")" class="form-control btn-style" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
            </div>
        </section>
        <!-- End Req-inner -->

@endsection