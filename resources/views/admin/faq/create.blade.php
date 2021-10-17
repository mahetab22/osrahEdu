@extends('admin.layouts.app')
@section('style')
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
                    <h1>@Lang('site.add new question')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/faqs') }}">@lang('site.faq')</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="active">@Lang('site.add new question')</li>
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
                    <form class="form-horizontal" method="POST" action="{{ url('admin/faqs') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputQuestion" class="col-sm-2 control-label">@lang('site.question')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('question') {{  'is-invalid'  }} @enderror" id="inputQuestion" name="question" value="{{ old('question') }}" placeholder="@lang('site.question')" required>
                                    @error('question')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputSolution" class="col-sm-2 control-label">@lang('site.solution')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('solution') {{  'is-invalid'  }} @enderror" id="inputSolution" name="solution" value="{{ old('solution') }}" placeholder="@lang('site.solution')" required>
                                    @error('solution')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn bg-gradient-info text-white">@lang('site.create')</button>
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
        $(this).removeClass('is-invalid');
    });
</script>
@endsection
