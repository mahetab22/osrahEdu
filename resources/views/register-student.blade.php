@extends('layouts.app')

@section('content')
 <!--======================== Start Login Page =============================-->
 <section class="login_page">
        <div class="container">
            <div class="modal_form">
                <div class="row">
                    <div class="col-md-7 border_form">
                        <form action="{{ route('Register') }}" method="POST" role="form"  enctype="multipart/form-data">
                        @csrf
                            <div class="head">يمكنك القيام بإنشاء حساب جديد</div>
                            <div class="form-group">
                                <input type="text" placeholder="@lang('site.name')" name="name" class="form-control user">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="@lang('site.phone')" name="phone" class="form-control phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="@lang('site.email') " name="email" class="form-control email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group pass-group">
                                <input type="password" placeholder="@lang('site.password')" name="password" class="form-control lock" id="password-field">
                                <span toggle="#password-field" class="fa toggle-password fa-eye"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group pass-group">
                                <input type="password" placeholder="@lang('site.password_confirmation')" name="password_confirmation" class="form-control lock" id="password-field_2">
                                <span toggle="#password-field_2" class="fa toggle-password fa-eye"></span>
                            </div>
                            <input name="role_id" value="4" hidden/>
                            <div class="form-group custom">
                                <div>
                                    <input type="checkbox" id="agree" required>
                                    <label for="agree">أوافق علي الشروط والاحكام</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="main-btn main btn col-12">@lang("site.Sign_Up")</button>
                            </div>
                            <div class="form-group">
                                <p href="{{url('/')}}/login" class="login_now">هل لديك حساب بالفعل ! <a href="{{url('/')}}/login">تسجيل الدخول</a></p>
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
    <!--======================== End Login Page =============================-->




@endsection