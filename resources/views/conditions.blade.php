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
                           @lang("site.conditions")
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
                     @if(app()->getLocale() == 'ar')
                        <div class="title-inner">
                            <h3>{{$conditions->title_ar}}</h3>
                        </div>
                        <p>
                            <?php echo $conditions->condition_ar; ?>
                        </p>
                        @else
                        <div class="title-inner">
                            <h3>{{$conditions->title_en}}</h3>
                        </div>
                        <p>
                            <?php echo $conditions->condition_en; ?>
                        </p>
                        @endif
                    </div>

            </div>
            </div>
        </section>
        <!-- End About-inner -->
        


        
        
@endsection