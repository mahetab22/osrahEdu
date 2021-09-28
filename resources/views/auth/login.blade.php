@extends('layouts.app')

@section('content')
   <!--======================== Start Login Page =============================-->
   <section class="login_page">
        <div class="container">
            <div class="modal_form">
                <div class="row">
                    <div class="col-md-7 border_form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="head">@lang('site.login')</div>
                            <div class="form-group">
                                <input type="email" placeholder="@lang('site.email') " name="email" class="form-control email">
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group pass-group">
                                <input type="password" placeholder="@lang("site.password") " name="password" class="form-control lock" id="password-field">
                                <span toggle="#password-field" class="fa toggle-password fa-eye"></span>
                                @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group custom">
                                <div>
                                    <input type="checkbox" id="agree" required>
                                    <label for="agree">أوافق علي الشروط والاحكام</label>
                                </div>
                                <div>
                                    <a href="{{ route('password.request') }}" class="forget_pass">@lang('site.did_you_forget_your_password')</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="main-btn main btn col-md-12"> @lang('site.login')</a>
                            </div>
                            <div class="form-group">
                                <a href="{{url('/')}}/register" class="create">@lang('site.register')</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <div class="image">
                            <img src="{{url('/')}}/public/src_website/assets/img/login.png" alt="img" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End Login Page =============================-->


@endsection