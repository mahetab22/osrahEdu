@extends('layouts.app')

@section('content')

        <!-- Start Title -->
        <section class="title-s" style="background-image: url({{ asset('public/src_website/images/111.jpg') }})">
            <div class="container">
                <h2>@lang("site.Contact_Us")</h2>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                           @lang("site.Main")
                        </a>
                    </li>
                    <li>
                        <span>
                           @lang("site.Contact_Us")
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Title -->
        
        <!-- Start Contact-inner -->
        <section class="contact-inner body-inner">
            <div class="container">
                <div class="col-md-3 col-xs-12"></div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-contact">
                        <form action="{{ route('addcontacts') }}" method="POST" role="form"  enctype="multipart/form-data">
                         @csrf
                            <h3>@lang("site.contact_details")</h3>
                            <div class="form-group">
                                <label>@lang("site.Address_the_problem")</label>
                                <input type="text" name="title_problem" placeholder="@lang("site.Address_the_problem")" class="form-control" required/>
                            </div>
                            <div class="form-group">
                             <select  class="form-control" name="Suggestions_and_Complaints" required >

                                  <option value="@lang("site.Complaints")" selected>@lang("site.Complaints")</option>
                                  <option value="@lang("site.Suggestions")">@lang("site.Suggestions")</option>
                             </select>
                            </div>
                            <div class="form-group">
                                <label>@lang("site.Course_name")</label>
                                <input type="text" name="course_link" placeholder="@lang("site.Course_name")" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>@lang("site.Message_details")</label>
                                <textarea name="details" placeholder="@lang("site.Message_details")" class="form-control"></textarea>
                            </div>
                            
                            <h3> @lang("site.Personal_data")</h3>
                            <div class="form-group">
                                <label>@lang("site.name")</label>
                                <input type="text" name="name" placeholder="@lang("site.name")" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>@lang("site.email")</label>
                                <input type="email" name="email" placeholder="@lang("site.email")" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label>@lang("site.phone")</label>
                                <input placeholder="@lang("site.phone")" class="form-control"  type="tel" id="phone" name="phone" />
                            </div>
                            <div class="form-group">
                                <label>@lang("site.Attachments")</label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                            <i class="fa fa-upload"></i> <input type="file" name="file" style="display: none;" multiple>
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="@lang("site.files")" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="@lang("site.send")" class="form-control btn-style" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12"></div>
               <!--  <div class="col-md-5 col-xs-12">
                    <div class="qut">
                        <h4>@lang("site.common_questions")</h4>
                        <ul>
                            
                        @foreach($questions as $question)
                            <li>
                                <a href="{{ url('/') }}/comquestion/{{ $question->id }}/view">
                                    {{ $question->question }}
                                </a>
                            </li>
                         @endforeach
                        </ul>
                    </div>
                </div>-->
            </div>
        </section>
        <!-- End Contact-inner -->
        
        

@endsection