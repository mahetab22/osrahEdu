@extends('layouts.app')
@section('content')
    <!--======================== Start Login Page =============================-->
    <section class="login_page survey_page">
        <div class="container">
            <div class="modal_form">

                <form action="{{route('add_survey',$course->id)}}" method="post">
                    @csrf
                    <div class="head">ما مدى رضاك عن الأتي</div>
                    <div class="form-group">
                        <h6 class="name">الدورة</h6>
                        <label for="survey_1" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>ممتاز</span>
                            </div>
                            <input type="radio" value="3" id="survey_1" name="survey">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_2" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>جيد جدا</span>
                            </div>
                            <input type="radio"value="2" id="survey_2" name="survey">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_3" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>متوسط</span>
                            </div>
                            <input type="radio" value="1" id="survey_3" name="survey">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_4" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>مقبول</span>
                            </div>
                            <input type="radio" value="0" id="survey_4" name="survey">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <h6 class="name">المحاضر</h6>
                        <label for="survey_5" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>ممتاز</span>
                            </div>
                            <input type="radio"value="3" id="survey_5" name="survey2">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_6" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>جيد جدا</span>
                            </div>
                            <input type="radio"value="2"  id="survey_6" name="survey2">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_7" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>متوسط</span>
                            </div>
                            <input type="radio" value="1" id="survey_7" name="survey2">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_8" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>مقبول</span>
                            </div>
                            <input type="radio" value="0" id="survey_8" name="survey2">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <h6 class="name">الجمعية</h6>
                        <label for="survey_9" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>ممتاز</span>
                            </div>
                            <input type="radio"value="3" id="survey_9" name="survey3">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_10" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>جيد جدا</span>
                            </div>
                            <input type="radio"value="2" id="survey_10" name="survey3">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_11" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>متوسط</span>
                            </div>
                            <input type="radio"value="1" id="survey_11" name="survey3">
                            <span class="checkmark"></span>
                        </label>
                        <label for="survey_12" class="custom_checkbox input_custom_m">
                            <div class="text">
                                <span>مقبول</span>
                            </div>
                            <input type="radio"value="0" id="survey_12" name="survey3">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="main-btn main btn col-md-12">ارسال الاستبيان</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--======================== End Login Page =============================-->


@endsection
@section('script')

@endsection