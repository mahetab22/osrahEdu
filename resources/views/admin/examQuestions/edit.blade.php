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
                    <h1>@Lang('site.edit exam question')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/exam/'.$exam_id.'/questions') }}">{{  App\Exam::find($exam_id)->title }}</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="breadcrumb-item active">@Lang('site.edit exam question')</li>
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
                    <form class="form-horizontal" method="POST" action="{{ url('admin/exam/'.$exam_id.'/questions/'.$question->id.'/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div id="Question">
                                <div  class="col-md-12 newQuestion">
                                    <div class="form-group row">
                                        <div class="col-sm-6 clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="inputMCQ" name="q_type" value="0" {{  $question->type == 0 ? 'checked' : '' }}>
                                                <label for="inputMCQ">@lang('site.exam question mcq')</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioSuccess3" class="" name="q_type" value="1" {{  $question->type == 1 ? 'checked' : '' }}>
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
                                            <input type="text" class="@error('question') {{  'is-invalid'  }} @enderror" id="inputQuestion" name="question" value="{{ $question->question }}" placeholder="@lang('site.exam question')">
                                            @error('question')
                                                <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 row mcq">
                                            @foreach ($answers as $i => $answer)
                                            <div class="form-group col-sm-6 row question{{ $i + 1 }}">
                                                <input type="radio" class="icheck-primary col-md-1 mt-2" value="{{ $i + 1 }}" name="co" {{  $question->sol == ($i + 1) ? 'checked' : '' }}>
                                                <label for="inputAnswer{{ $i + 1 }}" class="col-sm-3 control-label">@lang('site.exam answer'.($i + 1))</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('a.'.$i) {{  'is-invalid'  }} @enderror" id="inputAnswer{{ $i + 1 }}" name="a[]" value="{{ $answer->answer }}" placeholder="@lang('site.exam answer'.($i+1))">
                                                    @error('a.'.$i)
                                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endforeach
                                            {{--
                                            <div class="form-group col-sm-6 row">
                                                <input type="radio" class="col-md-1 mt-2" value="2" name="co" {{  $question->sol == 2 ? 'checked' : '' }}>
                                                <label for="inputAnswer2" class="col-sm-3 control-label">@lang('site.exam answer2')</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('a.1') {{  'is-invalid'  }} @enderror" id="inputAnswer2" name="a[]" value="{{ old('a.1') }}" placeholder="@lang('site.exam answer2')">
                                                    @error('a.1')
                                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                                    @enderror
                                                </div>
                                            </div>
                                             --}}
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
<script>
    $('#role').on('change',function(){
        console.log('test');
        $(this).removeClass('is-invalid');
    });

    $('input[name=q_type]').on('change',function(){
        var content_val = $( 'input[name=q_type]:checked' ).val();
        console.log(content_val);
        switch (content_val) {
            case '0':
                $('.mcq').append(`<div class="form-group col-sm-6 row question3">
                    <input type="radio" class="col-md-1 mt-2" value="3" name="co" {{  $question->sol == 3 ? 'checked' : '' }}>
                    <label for="inputAnswer3" class="col-sm-3 control-label">@lang('site.exam answer3')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('a.2') {{  'is-invalid'  }} @enderror" id="inputAnswer3" name="a[]" value="" placeholder="@lang('site.exam answer3')">
                        @error('a.2')
                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>
                <div class="form-group col-sm-6 row question4">
                    <input type="radio" class="col-md-1 mt-2" value ="4" name="co" {{  $question->sol == 4 ? 'checked' : '' }}>
                    <label for="inputAnswer4" class="col-sm-3 control-label">@lang('site.exam answer4')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('a.3') {{  'is-invalid'  }} @enderror" id="inputAnswer4" name="a[]" value="" placeholder="@lang('site.exam answer4')">
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
