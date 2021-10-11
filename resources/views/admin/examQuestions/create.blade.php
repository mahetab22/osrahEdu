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
                    <h1>@Lang('site.create new question')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/exam/'.$exam_id.'/questions') }}">{{  App\Exam::find($exam_id)->title }}</a></li>
                        <li class="breadcrumb-item"></li>
                        <li class="active">@Lang('site.create new question')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->

        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card-header">
                    <div class="col-sm-11">
                        <h2 class="card-title float-left text-bold">@lang('site.exam question')</h2>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <!-- form  -->
                        <!---- Exam Question Form Create ---->
                        <form class="form-horizontal" method="POST" action="{{ url('admin/exam/'.$exam_id.'/questions/store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div id="Question">
                                    <div  class="col-md-12 newQuestion">
                                        <div class="form-group row">
                                            <div class="col-sm-6 clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="inputMCQ" name="q_type" value="0" {{  old('q_type') == 0 ? 'checked' : '' }}>
                                                    <label for="inputMCQ">@lang('site.exam question mcq')</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 clearfix">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioSuccess3" class="" name="q_type" value="1" {{  old('q_type') == 1 ? 'checked' : '' }}>
                                                    <label for="radioSuccess3" class="">@lang('site.exam question correct')</label>
                                                </div>
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
                                                <input type="text" class="form-control @error('question') {{  'is-invalid'  }} @enderror" id="inputQuestion" name="question" value="{{ old('question') }}" placeholder="@lang('site.exam question')">
                                                @error('question')
                                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 row mcq">
                                                <div class="form-group col-sm-6 row">
                                                    <input type="radio" class="col-md-1 mt-2 icheck-primary" value="1"name="co" {{  old('co') == 1 ? 'checked' : '' }}>
                                                    <label for="inputAnswer1" class="col-sm-3 control-label">@lang('site.exam answer1')</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('a.0') {{  'is-invalid'  }} @enderror" id="inputAnswer1" name="a[]" value="{{ old('a.0') }}" placeholder="@lang('site.exam answer1')">
                                                        @error('a.0')
                                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6 row">
                                                    <input type="radio" class="col-md-1 mt-2 icheck-primary" value="2" name="co" {{  old('co') == 2 ? 'checked' : '' }}>
                                                    <label for="inputAnswer2" class="col-sm-3 control-label">@lang('site.exam answer2')</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('a.1') {{  'is-invalid'  }} @enderror" id="inputAnswer2" name="a[]" value="{{ old('a.1') }}" placeholder="@lang('site.exam answer2')">
                                                        @error('a.1')
                                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6 row question3">
                                                    <input type="radio" class="col-md-1 mt-2 icheck-primary" value="3" name="co" {{  old('co') == 3 ? 'checked' : '' }}>
                                                    <label for="inputAnswer3" class="col-sm-3 control-label">@lang('site.exam answer3')</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('a.2') {{  'is-invalid'  }} @enderror" id="inputAnswer3" name="a[]" value="{{ old('a.2') }}" placeholder="@lang('site.exam answer3')">
                                                        @error('a.2')
                                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-6 row question4">
                                                    <input type="radio" class="col-md-1 mt-2 icheck-primary" value ="4" name="co" {{  old('co') == 4 ? 'checked' : '' }}>
                                                    <label for="inputAnswer4" class="col-sm-3 control-label">@lang('site.exam answer4')</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control @error('a.3') {{  'is-invalid'  }} @enderror" id="inputAnswer4" name="a[]" value="{{ old('a.3') }}" placeholder="@lang('site.exam answer4')">
                                                        @error('a.3')
                                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @error('co')
                                                <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                            @enderror

                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn bg-gradient-info text-white">@lang('site.create')</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                        <!-- /.form -->
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
<script>
    $('#role').on('change',function(){
        console.log('test');
        $(this).removeClass('is-invalid');
    });

    if($('[name="q_type"]').is(':checked')) {
        var content_val =$('input[name=q_type]:checked').val();
        console.log(content_val);
        if(content_val == 1){
            $('.question3').remove();
            $('.question4').remove();
        }
    }

    $('input[name=q_type]').on('change',function(){
        var content_val = $( 'input[name=q_type]:checked' ).val();
        console.log(content_val+'basem');
        switch (content_val) {
            case '0':
                $('.mcq').append(`<div class="form-group col-sm-6 row question3">
                    <input type="radio" class="col-md-1 mt-2 icheck-primary" value="3" name="co" {{  old('co') == 3 ? 'checked' : '' }}>
                    <label for="inputAnswer3" class="col-sm-3 control-label">@lang('site.exam answer3')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('a.2') {{  'is-invalid'  }} @enderror" id="inputAnswer3" name="a[]" value="{{ old('a.3') }}" placeholder="@lang('site.exam answer3')">
                        @error('a.2')
                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-sm-6 row question4">
                    <input type="radio" class="col-md-1 mt-2 icheck-primary" value ="4" name="co" {{  old('co') == 4 ? 'checked' : '' }}>
                    <label for="inputAnswer4" class="col-sm-3 control-label">@lang('site.exam answer4')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('a.3') {{  'is-invalid'  }} @enderror" id="inputAnswer4" name="a[]" value="{{ old('a.4') }}" placeholder="@lang('site.exam answer4')">
                        @error('a.3')
                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>`);
                break;
                case '1':
                $('.question3').remove();
                $('.question4').remove();
                break;
                default:
                console.log('not found');
        }
    });
</script>
@endsection
