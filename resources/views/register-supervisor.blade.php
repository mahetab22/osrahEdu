@extends('layouts.app')

@section('content')


<section class="login_page">
        <div class="container">
            <div class="modal_form">
                <div class="row">
                    <div class="col-md-7 border_form">
                        <form action="{{ route('Register') }}" method="POST" role="form"  enctype="multipart/form-data">
                         @csrf

                         <div class="head">@lang("site.Personal_data")</div>
                            <div class="form-group">
                               
                                <input type="text" placeholder="@lang("site.name")" class="form-control user" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                             
                                <input placeholder="@lang("site.email")" id="email" type="email" class="form-control email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                         
                            
                            <div class="form-group">
                               
                                <input placeholder='@lang("site.phone")'  type="tel" id="phone" name="phone"  class="form-control phone" required>
                            </div>
                                                    
                            <div class="form-group">
                                
                                <input placeholder='@lang("site.Educational")'  type="text" id="Educational" name="Educational"  class="form-control" required>
                            </div>

                            
                            <div class="form-group  pass-group">
                            <input type="password" placeholder="@lang("site.password") " class="form-control lock @error('password') is-invalid @enderror" name="password" required id="password-field">
                                <span toggle="#password-field" class="fa toggle-password fa-eye"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group  pass-group">
                                
                                <input placeholder="@lang("site.password_confirmation")" id="password-field_2" type="password" class="form-control lock" name="password_confirmation" required autocomplete="new-password"/>
                                <span toggle="#password-field_2" class="fa toggle-password fa-eye"></span>
                            </div>
                            <input name="role_id" value="3" hidden/>
                            <div class="form-group">
                               
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
                              
                                <input type="text" placeholder="@lang("site.fb")" class="form-control" name="fb"  autocomplete="fb" autofocus pattern="https?://.+"/>
                            </div>

                            <div class="form-group">
                                
                                <input type="text" placeholder="@lang("site.tw")" class="form-control" name="tw" autocomplete="tw" autofocus pattern="https?://.+"/>
                            </div>

                           <div class="form-group">
                                
                                <input type="text" placeholder="@lang("site.inst")" class="form-control" name="inst" autocomplete="inst" autofocus pattern="https?://.+"/>
                            </div>

                            <div class="form-group">
                              
                                <input type="text" placeholder="@lang("site.google")" class="form-control" name="google" autocomplete="google" autofocus pattern="https?://.+"/>
                            </div>

                            <div class="form-group">
                                
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
                                <input type="submit" value="@lang("site.Sign_Up")" class="main-btn main btn col-12" />
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <div class="image">
                            <img src="{{url('/')}}/public/src_website/assets/img/register.png" alt="img" class="img-fluid">
                        </div>
                    </div>
               </div>
            </div>
        </div>
</section>
        <!-- End Req-inner -->

@endsection