@extends('layouts.app')

@section('content')
        
        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
            <div class="container">
                <h2>@lang("site.reset-password")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                           @lang("site.Main")
                          
                        </a>
                    </li>
                    <li>
                        <span>
                           @lang("site.reset-password")
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title -->
        
        <!-- Start Res-pass -->
        <section class="res-pass body-inner">
            <div class="container">
                <div class="col-xs-12">
                    <div class="title wow fadeInUp">
                        <h3>@lang("site.reset-password")</h3>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
                <div class="col-md-6 col-xs-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-contact">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                            <div class="form-group">
                                <label>@lang("site.email")</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>

                               @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" value="@lang("site.go")" class="form-control btn-style" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
            </div>
        </section>
        <!-- End Res-pass -->  
        
@endsection