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
                    <h1>@Lang('site.create new exam')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/exams') }}">@lang('site.exams')</a></li>
                        <li class="breadcrumb-item"></li>
                        <li class="active">@Lang('site.create new exam')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ url('admin/exams') }}" enctype="multipart/form-data">
            @csrf
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
                                            <img src="" id="profile-img-tag" width="200px" />
                                        </div>
                                        @error('logo')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputTitle" class="col-sm-2 control-label">@lang('site.exam title')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('title') {{  'is-invalid'  }} @enderror" id="inputTitle" name="title" value="{{ old('title') }}" placeholder="@lang('site.exam title')">
                                        @error('title')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputCode" class="col-sm-2 control-label">@lang('site.exam code')</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @error('code') {{  'is-invalid'  }} @enderror" id="inputCode" name="code" min="1" value="{{ old('code') }}" placeholder="@lang('site.exam code')" required>
                                        @error('code')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="inputContent" class="col-sm-3 control-label">@lang('site.exam content')</label>
                                    <div class="col-md-3">
                                        <div class="icheck-primary-2 d-inline">
                                            <input type="radio" name="content" id="inputContent1" value="0">
                                            <label for="inputContent1">@lang('site.course')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="icheck-primary-2 d-inline">
                                            <input type="radio" name="content" id="inputContent2" value="1">
                                            <label for="inputContent2">@lang('site.level')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="icheck-primary-2 d-inline">
                                            <input type="radio" name="content" id="inputContent3" value="2">
                                            <label for="inputContent3">@lang('site.lesson')</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row col-md-12" id="exam_content">
                                    <div class="col-sm-4 row">
                                        <label for="inputCourses" class="col-sm-3 control-label">@lang('site.course title')</label>
                                        <div class="col-sm-8">
                                            <select class="form-control course @error('course_id') {{  'is-invalid'  }} @enderror" id="inputCourses" name="course_id" required>
                                                <option value="" disabled selected>-- @lang('site.choose service') --</option>
                                                @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" > {{ app()->getLocale() == 'ar' ? $course->title_ar : $course->title_en }} </option>
                                                @endforeach
                                            </select>
                                            @error('course')
                                                <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

            <div class="container-fluid">
                <div class="card-header">
                    <div class="col-sm-11">
                        <h2 class="card-title float-left text-bold">@lang('site.exam questions')</h2>
                    </div>
                    <div class="col-sm-1 float-right">
                        <span class="btn bg-gradient-success btn-md text-white add_question"><i class="fa fa-plus fa-g text-white"></i></span>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-body">
                            <div id="Question">
                                
                                <div  class="col-md-12 newQuestion">
                                    <div class="col-md-12 delete_question">
                                    
                                </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 row">
                                            <label  for="inputMCQ" class="col-md-4">@lang('site.exam question mcq')</label>
                                            <input type="radio" class="col-md-2 mt-1 icheck-primary" id="inputMCQ" name="q_type0" value="0" >
                                        </div>
                                        <div class="col-sm-6 row">
                                            <label for="inputCorrection" class="col-md-4">@lang('site.exam question correct')</label>
                                            <input type="radio" class="col-md-2 mt-1 icheck-primary" id="inputCorrection" name="q_type0" value="1">
                                        </div>
                                        <div class="col-sm-12">
                                            @error('q_type')
                                                <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputQuestion" class="col-sm-2 control-label">@lang('site.exam question')</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('question') {{  'is-invalid'  }} @enderror" id="inputQuestion" name="q[]" value="{{ old('question') }}" placeholder="@lang('site.exam question')">
                                            @error('question')
                                                <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 row">
                                            <div class="form-group col-sm-6 row">
                                                <input type="radio" class="col-sm-1 mt-1 icheck-primary" value ="1" name="q0">
                                                <label for="inputAnswer1" class="col-sm-3 control-label">@lang('site.exam answer1')</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('a1') {{  'is-invalid'  }} @enderror" id="inputAnswer1" name="a1[]" value="{{ old('a1') }}" placeholder="@lang('site.exam answer1')">
                                                    @error('a1')
                                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6 row">
                                                <input type="radio" class="col-sm-1 mt-1 icheck-primary" value ="2" name="q0">
                                                <label for="inputAnswer2" class="col-sm-3 control-label">@lang('site.exam answer2')</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('a2') {{  'is-invalid'  }} @enderror" id="inputAnswer2" name="a2[]" value="{{ old('a2') }}" placeholder="@lang('site.exam answer2')">
                                                    @error('a2')
                                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 row">
                                            <div class="form-group col-sm-6 row mcq_answer">
                                                <input type="radio" class="col-sm-1 mt-1 icheck-primary" value ="3" name="q0">
                                                <label for="inputAnswer3" class="col-sm-3 control-label">@lang('site.exam answer3')</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('a3') {{  'is-invalid'  }} @enderror" id="inputAnswer3" name="a3[]" value="{{ old('a3') }}" placeholder="@lang('site.exam answer3')">
                                                    @error('a3')
                                                        <div class="text-danger"><small class="font-weight-bold">`{{ $message }}`</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6 row mcq_answer">
                                                <input type="radio" class="col-sm-1 mt-1  icheck-primary" value ="4" name="q0">
                                                <label for="inputAnswer4" class="col-sm-3 control-label">@lang('site.exam answer4')</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('a4') {{  'is-invalid'  }} @enderror" id="inputAnswer4" name="a4[]" value="{{ old('a4') }}" placeholder="@lang('site.exam answer4')">
                                                    @error('a4')
                                                        <div class="text-danger"><small class="font-weight-bold">`{{ $message }}`</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div id="Questions">
                                {{-------- Append New Question --------}}
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn bg-gradient-info text-white">@lang('site.create')</button>
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

    $('#exam_content').hide();

    $('input[name=content]').on('change',function(){
        var content_val = $( 'input[name=content]:checked' ).val();
        $('#exam_content').show();
        $('.levels').remove();
        $('.lessons').remove();
        switch (content_val) {
            case '0':
                break;
                case '1':
                $('#exam_content').append('<div class="levels col-sm-4 row"></div>');
                break;
                case '2':
                $('#exam_content').append('<div class="levels col-sm-4 row"></div><div class="lessons col-sm-4 row"></div>');
                break;
                default:
                console.log('not found');
        }
    });



    {{--  $('input[name=q_type]').on('change',function(){
        var content_val = $( 'input[name=q_type]:checked' ).val();
        console.log(content_val);
        switch (content_val) {
            case '0':
                $('.mcq').show(``);
                break;
                case '1':
                $('.mcq').hide();
                break;
                default:
                console.log('not found');
        }
    });  --}}

    $('.add_question').on('click',function(){
        var id = $('#Question').attr('id');
        var len = $('.newQuestion').length;
        var question = $('#Question').children().clone().attr( 'id',id += len );

        question.find('#inputMCQ').attr({
            'id'    : 'inputMCQ' + len,
            'name'    : 'q_type' + len,
            'data-id'    : len
        });

        question.find('#inputCorrection').attr({
            'id'    : 'inputCorrection' + len,
            'name'    : 'q_type' + len,
            'data-id'    : len
        });

        question.find('.mcq').attr({
            'class'    : 'mcq' + len
        });
        

        question.find('[name="q0"]').attr({
            'name'    : 'q' + len
        });
        
        question.find('.delete_question').html('<a href="javascript:void(0)" id="delete_question'+len+'" onclick="delete_clone('+len+')"><i class="fas fa-times-circle text-danger float-right"></i></a>');

        question.appendTo("#Questions");
    });
    
    function delete_clone(id){
        var clone_id = id;
        $('#Question'+clone_id).remove();
        
    }

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
