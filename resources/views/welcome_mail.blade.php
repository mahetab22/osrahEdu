@extends('layouts.app_mail')

@section('content')

                                    <div class="text-table">
                                        <h3>@lang("site.Welcome_to_the_site")&nbsp;{{$user['name']}}</h3>
                                        <p>
                                            @lang("site.Your_registered_email-id_is")&nbsp;{{$user['email']}}
                                        </p>


                                    </div>

@endsection