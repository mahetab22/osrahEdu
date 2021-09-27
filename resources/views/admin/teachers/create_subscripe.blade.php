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
                    <h1>@Lang('site.subscripe courses')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}">@lang('site.teacher subscriptions')</a></li>
                    <li class="breadcrumb-item active">@Lang('site.subscripe courses')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
        <form class="form-horizontal" method="POST" action="{{ url('admin/teacher/subscripe/store') }}" enctype="multipart/form-data">
        @csrf
        {{--  {{ method_field('PUT') }}  --}}
        <input type="hidden" name="supervisor_id" value="{{ $supervisor->id }}">
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title float-left text-bold">@lang('site.course subscripion')</h2>
            </div>
            <!-- /.card-header -->
            <div class="row">
            <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputCourse1" class="col-sm-2 control-label">@lang('site.courses')</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('course_id') {{  'is-invalid'  }} @enderror" id="inputCourse1" name="course_id"required>
                                        <option value="" disabled selected>-- @lang('site.choose service') --</option>
                                        @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" > {{ app()->getLocale() == 'ar' ? $course->title_ar : $course->title_en  }} </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputCourse1" class="col-sm-2 control-label">@lang('site.users')</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('course_id') {{  'is-invalid'  }} @enderror" id="inputCourse1" name="user_id" required>
                                        <option value="" disabled selected>-- @lang('site.choose user') --</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $supervisor->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
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
        </form>
        <hr>
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
