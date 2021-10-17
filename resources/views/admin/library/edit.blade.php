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
                    <h1>@Lang('site.add new book')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/library') }}">@lang('site.library')</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="active">@Lang('site.add new book')</li>
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
                    <form class="form-horizontal" method="POST" action="{{ url('admin/library',$book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="exampleInputFile" class="col-sm-2 control-label">@lang('site.book image')</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input @error('image') {{  'is-invalid'  }} @enderror" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">@lang('site.choose image')</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">@lang('site.choose image')</span>
                                        </div>
                                    </div>
                                    <img src="{{url('/')}}/{{$book->image}}" style="width:250px;height:250px"/>
                                    @error('image')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.title')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') {{  'is-invalid'  }} @enderror" id="inputName1" name="title" value="{{$book->title}}" placeholder="@lang('site.title')" required>
                                    @error('title')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.book short desc')</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{$book->desc}}" class="form-control @error('short_desc') {{  'is-invalid'  }} @enderror" id="inputName1" name="short_desc"  placeholder="@lang('site.book short desc')">
                                    @error('short_desc')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputFile" class="col-sm-2 control-label">@lang('site.book file')</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="pdf" class="custom-file-input @error('pdf') {{  'is-invalid'  }} @enderror" accept=".pdf,.doc" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">@lang('site.choose file')</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">@lang('site.choose file')</span>
                                        </div>
                                    </div>
                                    @error('pdf')
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
