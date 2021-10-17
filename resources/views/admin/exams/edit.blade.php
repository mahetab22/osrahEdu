@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@Lang('site.edit exam')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/exams') }}">@lang('site.exams')</a></li>
                        <li class="breadcrumb-item"></li>
                        <li class="active">@Lang('site.edit exam')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ url('admin/exams/'.$exam->id) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="container-fluid">
                <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="exampleInputFile" class="col-sm-2 control-label">@lang('site.logo')</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="logo" class="custom-file-input @error('logo') {{  'is-invalid'  }} @enderror" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">@lang('site.choose image')</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">@lang('site.choose image')</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <img src="{{url('/')}}/{{$exam->logo}}" id="profile-img-tag" width="200px" />
                                        </div>
                                        @error('logo')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">@lang('site.exam title')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('title') {{  'is-invalid'  }} @enderror" id="inputTitle" name="title" value="{{ $exam->title }}" placeholder="@lang('site.exam title')">
                                        @error('title')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputCode" class="col-sm-2 control-label">@lang('site.exam code')</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @error('code') {{  'is-invalid'  }} @enderror" id="inputCode" name="code" min="1" value="{{ $exam->code }}" placeholder="@lang('site.exam code')" required>
                                        @error('code')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputContent" class="col-sm-3 control-label">@lang('site.exam content')</label>
                                    <div class="col-md-3">
                                        <div class="icheck-primary-2 d-inline">
                                            <input type="radio" name="content" id="inputContent1" value="0" {{ $exam->content == 0 ? 'checked' : '' }}>
                                            <label for="inputContent1">@lang('site.course')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="icheck-primary-2 d-inline">
                                            <input type="radio" name="content" id="inputContent2" value="1" {{ $exam->content == 1 ? 'checked' : '' }}>
                                            <label for="inputContent2">@lang('site.level')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="icheck-primary-2 d-inline">
                                            <input type="radio" name="content" id="inputContent3" value="2" {{ $exam->content == 2 ? 'checked' : '' }}>
                                            <label for="inputContent3">@lang('site.lesson')</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row col-md-12" id="exam_content">
                                        {{--- Courses ---}}
                                        <div class="col-sm-4 row" id="Courses">
                                            <label for="inputCourses" class="col-sm-3 control-label">@lang('site.course title')</label>
                                            <div class="col-sm-8">
                                                <select class="form-control course @error('course_id') {{  'is-invalid'  }} @enderror" id="inputCourses" name="course_id" required>
                                                    <option value="" disabled selected>-- @lang('site.Choose the course') --</option>
                                                    @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"  {{  $exam->course_id ==  $course->id ? 'selected' : '' }} > {{ app()->getLocale() == 'ar' ? $course->title_ar : $course->title_en }} </option>
                                                    @endforeach
                                                </select>
                                                @error('course_id')
                                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div>{{--- /Courses ---}}
                                        {{--
                                        <!--- Levels ---->
                                        <div class="col-sm-4 row" id="Levels">
                                            <label for="inputLevels" class="col-sm-3 control-label">@lang('site.level')</label>
                                            <div class="col-sm-8">
                                                <select class="form-control course @error('level_id') {{  'is-invalid'  }} @enderror" id="inputLevels" name="level_id" required>
                                                    <option value="" disabled selected>-- @lang('site.Choose the level') --</option>
                                                    @foreach ($levels as $level)
                                                    <option value="{{ $level->id }}"  {{  $exam->level_id ==  $level->id ? 'selected' : '' }} > {{ app()->getLocale() == 'ar' ? $level->title_ar : $level->title_en }} </option>
                                                    @endforeach
                                                </select>
                                                @error('level_id')
                                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div><!--- /Levels --->

                                        <!--- Lessons --->
                                        <div class="col-sm-4 row" id="Lessons">
                                            <label for="inputLessons" class="col-sm-3 control-label">@lang('site.lesson')</label>
                                            <div class="col-sm-8">
                                                <select class="form-control lessons @error('lesson_id') {{  'is-invalid'  }} @enderror" id="inputLessons" name="lesson_id" required>
                                                    <option value="" disabled selected>-- @lang('site.Choose the level') --</option>
                                                    @foreach ($lessons as $lesson)
                                                    <option value="{{ $lesson->id }}"  {{  $exam->lesson_id ==  $lesson->id ? 'selected' : '' }} > {{ app()->getLocale() == 'ar' ? $lesson->title_ar : $lesson->title_en }} </option>
                                                    @endforeach
                                                </select>
                                                @error('lesson_id')
                                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div><!--- /Lessons --->
                                        --}}
                                    </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn bg-gradient-info text-white">@lang('site.edit')</button>
                            </div>
                            <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            </section>
        </form>
        <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
@endsection
@section('script')
<script>
    //Display New Image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log(reader);
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#exampleInputFile").change(function(){
        console.log('test');
        readURL(this);
    });


    //Getting All Sections Contetnt Courses And Levels And Lessons On Edit
    if($('[name="content"]').is(':checked')) {
        var content_val =$('input[name=content]:checked').val();
        console.log(content_val);
        switch (content_val) {
            case '0':
                $('.levels').hide();
                $('.lessons').hide();
                break;
            case '1':
                $('#exam_content').append('<div class="levels col-sm-4 row"></div>');
                get_levels();
                $('.levels').show();
                $('.lessons').hide();
                break;
            case '2':
                $('#exam_content').append('<div class="levels col-sm-4 row"></div><div class="lessons col-sm-4 row"></div>');
                $('.levels').show();
                $('.lessons').show();
                get_levels();
                get_lessons();
                break;
            default:
                console.log('not found');
        }
    }

    //Getting All Sections Contetnt Courses And Levels And Lessons On Change
    $('input[name=content]').on('change',function(){
        var content_val = $( 'input[name=content]:checked' ).val();
        console.log(content_val);
        $('#Courses').show();
        $('#Levels').remove();
        $('#Lessons').remove();
        switch (content_val) {
            case '0':
                $('#Levels').remove();
                $('#Lessons').remove();
                $('.levels').remove();
                $('.lessons').remove();
                break;
            case '1':
                $('#Lessons').remove();
                $('.lessons').remove();
                $('#exam_content').append('<div class="levels col-sm-4 row"></div>');
                break;
            case '2':
                $('#exam_content').append('<div class="levels col-sm-4 row"></div><div class="lessons col-sm-4 row"></div>');
                break;
            default:
                console.log('not found');
        }
    });
    //--- ON EDIT MOOD ---
    function get_levels(){
        $.ajax({
            url:"{{ url('admin/exam/levels') }}"+'/'+ '{{ $exam->course_id }}',
            method:"GET",
            data:{
                "_token": "{{ csrf_token() }}",
                "level_id": {{ $exam->level_id ?? '0' }}
            },success:function(res){
                $('.levels').show();
                $('.levels').html(res);
            }
        });
    }
    //--- ON EDIT MOOD ---
    function get_lessons(){
        $.ajax({
            url:"{{ url('admin/exam/lessons') }}"+'/'+'{{ $exam->level_id }}',
            method:"GET",
            data:{
                "_token": "{{ csrf_token() }}",
                "lesson_id": {{ $exam->lesson_id ?? '0' }}
            },success:function(res){
                $('.lessons').show();
                $('.lessons').html(res);
            }
        });
    }



    //--- Getting All levels related to the specific course id ---
    $('.course').on('change',function(){
        var course_id = $(this).val();
        $('.levels').hide();
        $('.lessons').hide();
        $.ajax({
            url:"{{ url('admin/exam/levels') }}"+'/'+course_id,
            method:"GET",
            success:function(res){
                $('.levels').html(res);
                $('.levels').show();
            }
        });
    });


    //--- Getting All lessons related to the specific level id ---
    function lessons(){
        var level_id = $('#level').val();
        $.ajax({
            url:"{{ url('admin/exam/lessons') }}"+'/'+level_id,
            method:"GET",
            success:function(res){
                $('.lessons').show();
                $('.lessons').html(res);
            }
        });
    }




</script>
@endsection
