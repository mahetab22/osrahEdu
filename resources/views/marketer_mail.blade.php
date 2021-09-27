@extends('layouts.app_mail')

@section('content')

                                    <div class="text-table">
                                        <h3>مرحبا&nbsp;{{$user['name']}}</h3>
                                        <p style=" white-space: pre-line;">
                                           يمكن للعملاء الطلب بطريقتين:
                                            الكوبون التسويقي: وذلك بإستخدام الكوبون التالي الخاص بك : ({{$user->marketer->code}})
                                            للطلب من متجرنا:
                                            https://nhledu.com/nhl_marketer/ar/courses
                                            أو من خلال الرابط التسويقي:
                                           {{$user->marketer->url}}
                                            كما يمكنك الاطلاع على احصائيات مبيعاتك عبر الرابط التالي:

                                        </p>

                                    </div>

@endsection