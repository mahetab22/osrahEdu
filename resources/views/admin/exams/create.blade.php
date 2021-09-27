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
                    <li class="breadcrumb-item"><a href="{{ url('admin/services') }}">@lang('site.exams')</a></li>
                    <li class="breadcrumb-item active">@Lang('site.create new exam')</li>
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
                                        <label for="inputContent1" class="col-sm-9 control-label">@lang('site.course')</label>
                                        <input type="radio" name="content" class="form-control col-md-3" id="inputContent1" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputContent2" class="col-sm-9 control-label">@lang('site.level')</label>
                                        <input type="radio" name="content" class="form-control col-md-3" id="inputContent2" value="1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputContent3" class="col-sm-9 control-label">@lang('site.lesson')</label>
                                        <input type="radio" name="content" class="form-control col-md-3" id="inputContent3" value="2">
                                    </div>
                                </div>

                                <div class="form-group row col-md-12" id="exam_content">
                                    <div class="col-sm-4 row">
                                        <label for="inputEmail3" class="col-sm-3 control-label">@lang('site.course title')</label>
                                        <div class="col-sm-8">
                                            <select class="form-control course @error('service') {{  'is-invalid'  }} @enderror" id="inputName1" name="course" required>
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
                        <button class="btn bg-gradient-success btn-md text-white add_question"><i class="fa fa-plus fa-g text-white"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-body questions">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-sm-6 row">
                                        <label for="inputMCQ" class="col-sm-4 control-label">@lang('site.exam question mcq')</label>
                                        <div class="col-sm-8">
                                            <input type="radio" class="form-control" id="inputMCQ" name="exam_type[]" value="0" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 row">
                                        <label for="inputCorrection" class="col-sm-4 control-label">@lang('site.exam question correct')</label>
                                        <div class="col-sm-8">
                                            <input type="radio" class="form-control" id="inputCorrection" name="exam_type[]" value="1">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        @error('mcq')
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
                                            <label for="inputAnswer1" class="col-sm-4 control-label">@lang('site.exam answer1')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('a1') {{  'is-invalid'  }} @enderror" id="inputAnswer1" name="a1[]" value="{{ old('a1') }}" placeholder="@lang('site.exam answer1')">
                                                @error('a1')
                                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 row">
                                            <label for="inputAnswer2" class="col-sm-4 control-label">@lang('site.exam answer2')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('a2') {{  'is-invalid'  }} @enderror" id="inputAnswer2" name="a2[]" value="{{ old('a2') }}" placeholder="@lang('site.exam answer2')">
                                                @error('a2')
                                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 row mcq">
                                        <div class="form-group col-sm-6 row mcq_answer">
                                            <label for="inputAnswer3" class="col-sm-4 control-label">@lang('site.exam answer3')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('a3') {{  'is-invalid'  }} @enderror" id="inputAnswer3" name="a3[]" value="{{ old('a3') }}" placeholder="@lang('site.exam answer3')">
                                                @error('a3')
                                                    <div class="text-danger"><small class="font-weight-bold">`{{ $message }}`</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 row mcq_answer">
                                            <label for="inputAnswer4" class="col-sm-4 control-label">@lang('site.exam answer4')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('a4') {{  'is-invalid'  }} @enderror" id="inputAnswer4" name="a4[]" value="{{ old('a4') }}" placeholder="@lang('site.exam answer4')">
                                                @error('a4')
                                                    <div class="text-danger"><small class="font-weight-bold">`{{ $message }}`</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-sm-6 row">
                                        <label for="inputMCQ" class="col-sm-4 control-label">@lang('site.exam question mcq')</label>
                                        <div class="col-sm-8">
                                            <input type="radio" class="form-control" id="inputMCQ" name="exam_type1[]" value="0" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 row">
                                        <label for="inputCorrection" class="col-sm-4 control-label">@lang('site.exam question correct')</label>
                                        <div class="col-sm-8">
                                            <input type="radio" class="form-control" id="inputCorrection" name="exam_type1[]" value="1">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        @error('mcq')
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
                                            <label for="inputAnswer1" class="col-sm-4 control-label">@lang('site.exam answer1')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('a1') {{  'is-invalid'  }} @enderror" id="inputAnswer1" name="a1[]" value="{{ old('a1') }}" placeholder="@lang('site.exam answer1')">
                                                @error('a1')
                                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 row">
                                            <label for="inputAnswer2" class="col-sm-4 control-label">@lang('site.exam answer2')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('a2') {{  'is-invalid'  }} @enderror" id="inputAnswer2" name="a2[]" value="{{ old('a2') }}" placeholder="@lang('site.exam answer2')">
                                                @error('a2')
                                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 row mcq">
                                        <div class="form-group col-sm-6 row mcq_answer">
                                            <label for="inputAnswer3" class="col-sm-4 control-label">@lang('site.exam answer3')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('a3') {{  'is-invalid'  }} @enderror" id="inputAnswer3" name="a3[]" value="{{ old('a3') }}" placeholder="@lang('site.exam answer3')">
                                                @error('a3')
                                                    <div class="text-danger"><small class="font-weight-bold">`{{ $message }}`</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6 row mcq_answer">
                                            <label for="inputAnswer4" class="col-sm-4 control-label">@lang('site.exam answer4')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control @error('a4') {{  'is-invalid'  }} @enderror" id="inputAnswer4" name="a4[]" value="{{ old('a4') }}" placeholder="@lang('site.exam answer4')">
                                                @error('a4')
                                                    <div class="text-danger"><small class="font-weight-bold">`{{ $message }}`</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    $('#exam_content').hide();

    $('input[name=content]').on('change',function(){
        var content_val = $( 'input[name=content]:checked' ).val();
        $('#exam_content').show();
        $('.levels').remove();
        $('.lessons').remove();
        switch (content_val) {
            case '0':
                console.log('test');
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
{{--
    $('input[name=exam_type]').on('change',function(){
        var content_val = $( 'input[name=exam_type]:checked' ).val();

        switch (content_val) {
            case '0':
                $('.mcq').append(``);
                break;
                case '1':
                $('.mcq_answer').remove();
                break;
                default:
                console.log('not found');
        }
    }); --}}


    $('#role').on('change',function(){
        $(this).removeClass('is-invalid');
    });

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

    $('.add_question').on('click',function(){
        $('.').append(``);
    });

</script>
@endsection
