@extends('admin.layouts.app')
@section('style')
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/summernote/summernote-bs4.css">
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@Lang('site.site info')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">@Lang('site.site info')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-info">

                <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{{ url('admin/info/'.$key.'/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <input type="hidden" name="key_word" value="{{ $key }}">
                            @if($key == 'basic')
                            {{----- Image -----}}
                            <div class="form-group row">
                                <label for="Inputlogo" class="col-sm-2 control-label">@lang('site.logo')</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="logo" class="custom-file-input @error('logo') {{  'is-invalid'  }} @enderror" id="Inputlogo">
                                            <label class="custom-file-label" for="Inputlogo">@lang('site.logo')</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">@lang('site.choose image')</span>
                                        </div>
                                    </div>
                                    <img src="{{url('/')}}/{{$info->logo}}"/>
                                    @error('logo')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Image -----}}
                            <div class="form-group row">
                                <label for="InputFavIcon" class="col-sm-2 control-label">@lang('site.favicon')</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="favicon" class="custom-file-input @error('favicon') {{  'is-invalid'  }} @enderror" id="InputFavIcon">
                                            <label class="custom-file-label" for="InputFavIvon">@lang('site.favicon')</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">@lang('site.choose image')</span>
                                        </div>
                                    </div>
                                    <img src="{{url('/')}}/{{$info->favicon}}"/>
                                    @error('favicon')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputNameAr" class="col-sm-2 control-label">@lang('site.info arabic name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name_ar') {{  'is-invalid'  }} @enderror" id="inputNameAr" name="name_ar" value="{{ $info->name_ar }}" placeholder="@lang('site.info arabic name')" required>
                                    @error('name_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputNameEn" class="col-sm-2 control-label">@lang('site.info english name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name_en') {{  'is-invalid'  }} @enderror" id="inputNameEn" name="name_ar" value="{{ $info->name_en }}" placeholder="@lang('site.info english name')" required>
                                    @error('name_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputHintAr" class="col-sm-2 control-label">@lang('site.info arabic hint')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputHintAr" name="hint_ar" placeholder="{{ __('site.info arabic hint') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->hint_ar !!}</textarea>
                                    @error('hint_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputHintEn" class="col-sm-2 control-label">@lang('site.info english hint')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputHintEn" name="hint_en" placeholder="{{ __('site.info english hint') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->hint_en !!}</textarea>
                                    @error('hint_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputName2Ar" class="col-sm-2 control-label">@lang('site.info second arabic name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name2_ar') {{  'is-invalid'  }} @enderror" id="inputName2Ar" name="name2_ar" value="{{ $info->name2_ar }}" placeholder="@lang('site.info second arabic name')">
                                    @error('name2_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputName2En" class="col-sm-2 control-label">@lang('site.info second english name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name2_en') {{  'is-invalid'  }} @enderror" id="inputName2En" name="name2_en" value="{{ $info->name2_en }}" placeholder="@lang('site.info second english name')">
                                    @error('name2_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputHint2Ar" class="col-sm-2 control-label">@lang('site.info second arabic hint')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputHint2Ar" name="hint2_ar" placeholder="{{ __('site.info second arabic hint') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->hint2_ar !!}</textarea>
                                    @error('hint2_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputHint2En" class="col-sm-2 control-label">@lang('site.info second english hint')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputHint2En" name="hint2_en" placeholder="{{ __('site.info second english hint') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->hint2_en !!}</textarea>
                                    @error('hint2_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputWhatsAppMale" class="col-sm-2 control-label">@lang('site.info whats app male')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('whatsapp_male') {{  'is-invalid'  }} @enderror" id="inputWhatsAppMale" name="whatsapp_male" value="{{ $info->whatsapp_male }}" placeholder="@lang('site.info whats app male')">
                                    @error('whatsapp_male')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputWhatsAppFemale" class="col-sm-2 control-label">@lang('site.info whats app female')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('whatsapp_female') {{  'is-invalid'  }} @enderror" id="inputWhatsAppFemale" name="whatsapp_female" value="{{ $info->whatsapp_female }}" placeholder="@lang('site.info whats app female')">
                                    @error('whatsapp_female')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            @elseif ($key == 'social')
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputFb" class="col-sm-2 control-label">@lang('site.info facebook')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('fb') {{  'is-invalid'  }} @enderror" id="inputFb" name="fb" value="{{ $info->fb }}" placeholder="@lang('site.info facebook')">
                                    @error('fb')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputTw" class="col-sm-2 control-label">@lang('site.info twitter')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('tw') {{  'is-invalid'  }} @enderror" id="inputTw" name="tw" value="{{ $info->tw }}" placeholder="@lang('site.info twitter')">
                                    @error('tw')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputInsta" class="col-sm-2 control-label">@lang('site.info instagram')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('insta') {{  'is-invalid'  }} @enderror" id="inputInsta" name="insta" value="{{ $info->insta }}" placeholder="@lang('site.info instagram')">
                                    @error('insta')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputGoogle" class="col-sm-2 control-label">@lang('site.info google')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('google') {{  'is-invalid'  }} @enderror" id="inputGoogle" name="google" value="{{ $info->google }}" placeholder="@lang('site.info google')">
                                    @error('google')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            @elseif ($key == 'pages')
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputAboutUsAr" class="col-sm-2 control-label">@lang('site.info arabic aboutus')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputAboutUsAr" name="aboutus_ar" placeholder="{{ __('site.info arabic aboutus') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->aboutus_ar !!}</textarea>
                                    @error('aboutus_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputAboutUsEn" class="col-sm-2 control-label">@lang('site.info english aboutus')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputAboutUsEn" name="aboutus_en" placeholder="{{ __('site.info english aboutus') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->aboutus_en ?? $info->aboutus_ar !!}</textarea>
                                    @error('aboutus_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputOurVisionAr" class="col-sm-2 control-label">@lang('site.info arabic our_vision')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputOurVisionAr" name="our_vision_ar" placeholder="{{ __('site.info arabic our_vision') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->our_vision_ar !!}</textarea>
                                    @error('our_vision_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputOurVisionAr" class="col-sm-2 control-label">@lang('site.info english our_vision')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputOurVisionAr" name="our_vision_en" placeholder="{{ __('site.info english our_vision') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->our_vision_en ?? $info->our_vision_ar !!}</textarea>
                                    @error('our_vision_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputOurMessageAr" class="col-sm-2 control-label">@lang('site.info arabic ourmessage')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputOurMessageAr" name="ourmessage_ar" placeholder="{{ __('site.info arabic ourmessage') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->ourmessage_ar !!}</textarea>
                                    @error('ourmessage_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputOurMessageEn" class="col-sm-2 control-label">@lang('site.info english ourmessage')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputOurMessageEn" name="ourmessage_en" placeholder="{{ __('site.info english ourmessage') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->ourmessage_en ?? $info->ourmessage_ar !!}</textarea>
                                    @error('ourmessage_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputAssemblyClassificationAr" class="col-sm-2 control-label">@lang('site.info arabic assembly classification')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputAssemblyClassificationAr" name="assembly_classification_ar" placeholder="{{ __('site.info arabic assembly classification') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->assembly_classification_ar !!}</textarea>
                                    @error('assembly_classification_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputAssemblyClassificationEn" class="col-sm-2 control-label">@lang('site.info english assembly classification')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputAssemblyClassificationEn" name="assembly_classification_en" placeholder="{{ __('site.info english assembly classification') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->assembly_classification_en ?? $info->assembly_classification_ar !!}</textarea>
                                    @error('assembly_classification_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputGoal1" class="col-sm-2 control-label">@lang('site.info arabic goal1')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputGoal1" name="goal1_ar" placeholder="{{ __('site.info arabic goal1') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->goal1_ar !!}</textarea>
                                    @error('goal1_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputGoal2" class="col-sm-2 control-label">@lang('site.info arabic goal2')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputGoal2" name="goal2_ar" placeholder="{{ __('site.info arabic goal2') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->goal2_ar !!}</textarea>
                                    @error('goal2_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputGoal3" class="col-sm-2 control-label">@lang('site.info arabic goal3')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputGoal3" name="goal3_ar" placeholder="{{ __('site.info arabic goal3') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->goal3_ar !!}</textarea>
                                    @error('goal3_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputGoal1En" class="col-sm-2 control-label">@lang('site.info english goal1')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputGoal1En" name="goal1_en" placeholder="{{ __('site.info english goal1') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->goal1_en ?? $info->goal1_ar !!}</textarea>
                                    @error('goal1_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputGoal2En" class="col-sm-2 control-label">@lang('site.info english goal2')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputGoal2En" name="goal2_en" placeholder="{{ __('site.info english goal2') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->goal2_en ?? $info->goal2_ar !!}</textarea>
                                    @error('goal2_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text Editor -----}}
                            <div class="form-group row">
                                <label for="inputGoal3En" class="col-sm-2 control-label">@lang('site.info english goal3')</label>
                                <div class="col-sm-10">
                                    <textarea class="textarea" id="inputGoal3En" name="goal3_en" placeholder="{{ __('site.info english goal3') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $info->goal3_en ?? $info->goal3_ar !!}</textarea>
                                    @error('goal3_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputScript1" class="col-sm-2 control-label">@lang('site.info script1')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('script1') {{  'is-invalid'  }} @enderror" id="inputScript1" name="script1" value="{{ $info->script1 }}" placeholder="@lang('site.info script1')">
                                    @error('script1')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputScript2" class="col-sm-2 control-label">@lang('site.info script2')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('script2') {{  'is-invalid'  }} @enderror" id="inputScript2" name="script2" value="{{ $info->script2 }}" placeholder="@lang('site.info script2')">
                                    @error('script2')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{----- Text -----}}
                            <div class="form-group row">
                                <label for="inputYear1" class="col-sm-2 control-label">@lang('site.info year experts')</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('year') {{  'is-invalid'  }} @enderror" id="inputYear1" name="year" min="1980" value="{{ $info->year }}" placeholder="@lang('site.info year experts')">
                                    @error('year')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn bg-gradient-info text-white">@lang('site.update')</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
@endsection
@section('script')

<!-- jQuery -->
<script src="{{url('/')}}/public/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/public/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/')}}/public/admin/dist/js/demo.js"></script>
<!-- Summernote -->
<script src="{{url('/')}}/public/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Popper -->
<script src="{{url('/')}}/public/admin/plugins/popper/popper.js"></script>
<!-- Popper MAp -->
<script src="{{url('/')}}/public/admin/plugins/popper/popper.js.map"></script>
<script>
    $(function () {
      // Summernote
      $('.textarea').summernote()
    });

    $('#role').on('change',function(){
        console.log('test');
        $(this).removeClass('is-invalid');
    });
</script>
@endsection
