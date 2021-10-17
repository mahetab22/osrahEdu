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
                    <h1>@Lang('site.edit partner')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/partners') }}">@lang('site.partners')</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="active">@Lang('site.edit partner')</li>
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
                    <form class="form-horizontal" method="POST" action="{{ url('admin/partners/'.$partner->id) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputPartner" class="col-sm-2 control-label">@lang('site.partner title')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') {{  'is-invalid'  }} @enderror" id="inputPartner" name="title" value="{{ $partner->title }}" placeholder="@lang('site.partner title')" required>
                                    @error('title')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

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
                                    <div class="mt-2">
                                        <img src="{{url('/')}}/{{$partner->logo}}" style="width:250px;height:250px">
                                    </div>
                                    @error('logo')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
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
<script src="{{url('/')}}/public/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/popper/popper.js"></script>
<script src="{{url('/')}}/public/admin/plugins/popper/popper.js.map"></script>
{{--  <script src="https://unpkg.com/@popperjs/core@2"></script>  --}}

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
