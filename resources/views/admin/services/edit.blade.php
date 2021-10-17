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
                    <h1>@Lang('site.update services')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/services') }}">@lang('site.services')</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="active">@Lang('site.update services')</li>
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
                    <form class="form-horizontal" method="POST" action="{{ url('admin/services/'.$service->id) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
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
                                <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.service arabic title')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title_ar') {{  'is-invalid'  }} @enderror" id="inputName1" name="title_ar" value="{{ $service->title_ar }}" placeholder="@lang('site.service arabic title')" required>
                                    @error('title_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.service english title')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title_en') {{  'is-invalid'  }} @enderror" id="inputName1" name="title_en" value="{{ $service->title_en }}" placeholder="@lang('site.service english title')">
                                    @error('title_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.service arabic description')</label>
                                <div class="col-sm-10">
                                    <textarea name="desc_ar" class="form-control @error('desc_ar') {{  'is-invalid'  }} @enderror">{{ $service->description_ar }}</textarea>
                                    @error('desc_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.service arabic description')</label>
                                <div class="col-sm-10">
                                    <textarea name="desc_en" class="form-control @error('desc_en') {{  'is-invalid'  }} @enderror">{{ $service->description_en }}</textarea>
                                    @error('desc_en')
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
<script>
    $('#role').on('change',function(){
        console.log('test');
        $(this).removeClass('is-invalid');
    });
</script>
@endsection
