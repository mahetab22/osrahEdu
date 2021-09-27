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
                    <h1>@Lang('site.edit terms')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/terms') }}">@lang('site.terms and condition')</a></li>
                    <li class="breadcrumb-item active">@Lang('site.edit terms')</li>
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
                    <form class="form-horizontal" method="POST" action="{{ url('admin/terms/'.$term->id) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputTitle1" class="col-sm-2 control-label">@lang('site.terms arabic title')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title_ar') {{  'is-invalid'  }} @enderror" id="inputTitle1" name="title_ar" value="{{ $term->title_ar }}" placeholder="@lang('site.terms arabic title')" required>
                                    @error('title_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{--
                                <div class="form-group row">
                                    <label for="inputTitle2" class="col-sm-2 control-label">@lang('site.terms english title')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('title_en') {{  'is-invalid'  }} @enderror" id="inputTitle2" name="title_en" value="{{ $term->title_en }}" placeholder="@lang('site.terms english title')" required>
                                        @error('title_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            --}}


                            <div class="form-group row">
                                <label for="inputDesc1" class="col-sm-2 control-label">@lang('site.terms arabic description')</label>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <textarea class="textarea" id="inputDesc1" name="terms_ar" placeholder="{{ __('site.terms arabic description') }}"
                                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $term->terms_ar !!}</textarea>
                                    </div>
                                    @error('term_ar')
                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            {{--
                                <div class="form-group row">
                                    <label for="inputDesc2" class="col-sm-2 control-label">@lang('site.terms english description')</label>
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <textarea class="textarea" name="terms_en" id="inputDesc2" placeholder="Place some text here"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;">{!! $term->terms_en !!}</textarea>
                                        </div>
                                        @error('term_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            --}}


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
