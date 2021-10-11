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
                    <h1>@Lang('site.create new breadcrumb')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/breadcrumbs') }}">@lang('site.breadcrumbs')</a></li>
                        <li class="breadcrumb-item"></li>
                        <li class="active">@Lang('site.create new breadcrumb')</li>
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
                    <form class="form-horizontal" method="POST" action="{{ url('admin/breadcrumbs') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="InputImage" class="col-sm-2 control-label">@lang('site.breadcrumb image')</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input @error('image') {{  'is-invalid'  }} @enderror" id="InputImage">
                                            <label class="custom-file-label" for="InputImage">@lang('site.choose image')</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">@lang('site.choose image')</span>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputTitleAr" class="col-sm-2 control-label">@lang('site.breadcrumb arabic title')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title_ar') {{  'is-invalid'  }} @enderror" id="inputTitleAr" name="title_ar" value="{{ old('title_ar') }}" placeholder="@lang('site.breadcrumb arabic title')" required>
                                    @error('title_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputTitleEn" class="col-sm-2 control-label">@lang('site.breadcrumb english title')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title_en') {{  'is-invalid'  }} @enderror" id="inputTitleEn" name="title_en" value="{{ old('title_en') }}" placeholder="@lang('site.breadcrumb english title')" required>
                                    @error('title_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputLinkUrl" class="col-sm-2 control-label">@lang('site.breadcrumb link url')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('link_url') {{  'is-invalid'  }} @enderror" id="inputLinkUrl" name="link_url" value="{{ old('link_url') }}" placeholder="@lang('site.breadcrumb link url')" required>
                                    @error('link_url')
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
        console.log('test');
        $(this).removeClass('is-invalid');
    });
</script>
@endsection
