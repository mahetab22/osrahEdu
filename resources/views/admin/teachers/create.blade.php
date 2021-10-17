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
                    <h1>@Lang('site.create new teacher')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/teachers') }}">@lang('site.teachers')</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="active">@Lang('site.create new teacher')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
        <form class="form-horizontal" method="POST" action="{{ url('admin/teachers') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title float-left text-bold">@lang('site.teacher basic inforamtion')</h2>
            </div>
            <!-- /.card-header -->
            <div class="row">
            <!-- right column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-info">

                <!-- form start -->

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputUser1" class="col-sm-2 control-label">@lang('site.teacher username')</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('user_id') {{  'is-invalid'  }} @enderror" id="inputUser1" name="user_id" value="{{ old('user_id') }}" placeholder="@lang('site.teacher username')" required>
                                        <option value="" disabled selected>-- @lang('site.choose user') --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : ''}}> {{ $user->name  }} </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName1" class="col-sm-2 control-label">@lang('site.teacher arabic name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name_ar') {{  'is-invalid'  }} @enderror" id="inputName1" name="name_ar" value="{{ old('name_ar') }}" placeholder="@lang('site.teacher arabic name')" required>
                                    @error('name_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 control-label">@lang('site.teacher english name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name_en') {{  'is-invalid'  }} @enderror" id="inputName2" name="name_en" value="{{ old('name_en') }}" placeholder="@lang('site.teacher english name')">
                                    @error('name_en')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEducational1" class="col-sm-2 control-label">@lang('site.teacher educational')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('educational') {{  'is-invalid'  }} @enderror" id="inputEducational1" name="educational" value="{{ old('educational') }}" placeholder="@lang('site.teacher educational')" required>
                                    @error('educational')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputService1" class="col-sm-2 control-label">@lang('site.service')</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('service_id') {{  'is-invalid'  }} @enderror" id="inputService1" name="service_id" value="{{ old('service_id') }}" placeholder="@lang('site.service')" required>
                                        <option value="" disabled selected>-- @lang('site.choose service') --</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {{ $service->id == old('service_id') ? 'selected' : ''}}> {{ app()->getLocale() ? $service->title_ar : $service->title_en  }} </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
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
        <hr>
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title float-left text-bold">@lang('site.teacher social inforamtion')</h2>
            </div>
            <!-- /.card-header -->
            <div class="row">
            <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputFacebook1" class="col-sm-2 control-label">@lang('site.facebook')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('facebook') {{  'is-invalid'  }} @enderror" id="inputFacebook1" name="facebook" value="{{ old('facebook') }}" placeholder="@lang('site.facebook')">
                                    @error('facebook')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputTwitter1" class="col-sm-2 control-label">@lang('site.twitter')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('twitter') {{  'is-invalid'  }} @enderror" id="inputTwitter1" name="twitter" value="{{ old('twitter') }}" placeholder="@lang('site.twitter')">
                                    @error('twitter')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputInstagram1" class="col-sm-2 control-label">@lang('site.instagram')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('instagram') {{  'is-invalid'  }} @enderror" id="inputInstagram1" name="instagram" value="{{ old('instagram') }}" placeholder="@lang('site.instagram')">
                                    @error('instagram')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputGoogle1" class="col-sm-2 control-label">@lang('site.google url')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('google') {{  'is-invalid'  }} @enderror" id="inputGoogle1" name="google" value="{{ old('google') }}" placeholder="@lang('site.google url')">
                                    @error('google')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title float-left text-bold">@lang('site.teacher additional inforamtion')</h2>
            </div>
            <!-- /.card-header -->
            <div class="row">
            <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-sm-6 row">
                                    <label for="inputCurriculumAr1" class="col-sm-4 control-label">@lang('site.teacher arabic curriculum')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('curriculum_ar') {{  'is-invalid'  }} @enderror" id="inputCurriculumAr1" name="curriculum_ar" value="{{ old('curriculum_ar') }}" placeholder="@lang('site.teacher arabic curriculum')">
                                        @error('curriculum_ar')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputCurriculumEn1" class="col-sm-4 control-label">@lang('site.teacher english curriculum')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('curriculum_en') {{  'is-invalid'  }} @enderror" id="inputCurriculumEn1" name="curriculum_en" value="{{ old('curriculum_en') }}" placeholder="@lang('site.teacher english curriculum')">
                                        @error('curriculum_en')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 row">
                                    <label for="inputSkillAr1" class="col-sm-4 control-label">@lang('site.teacher arabic skill1')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('skill1_ar') {{  'is-invalid'  }} @enderror" id="inputSkillAr1" name="skill1_ar" value="{{ old('skill1_ar') }}" placeholder="@lang('site.teacher arabic skill1')">
                                        @error('skill1_ar')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputSkillEn1" class="col-sm-4 control-label">@lang('site.teacher english skill1')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('skill1_en') {{  'is-invalid'  }} @enderror" id="inputSkillEn1" name="skill1_en" value="{{ old('skill1_en') }}" placeholder="@lang('site.teacher english skill1')">
                                        @error('skill1_en')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 row">
                                    <label for="inputSkillAr2" class="col-sm-4 control-label">@lang('site.teacher arabic skill2')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('skill2_ar') {{  'is-invalid'  }} @enderror" id="inputSkillAr2" name="skill2_ar" value="{{ old('skill2_ar') }}" placeholder="@lang('site.teacher arabic skill2')">
                                        @error('skill2_ar')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputSkillEn2" class="col-sm-4 control-label">@lang('site.teacher english skill2')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('skill2_en') {{  'is-invalid'  }} @enderror" id="inputSkillEn2" name="skill2_en" value="{{ old('skill2_en') }}" placeholder="@lang('site.teacher english skill2')">
                                        @error('skill2_en')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 row">
                                    <label for="inputSkillAr3" class="col-sm-4 control-label">@lang('site.teacher arabic skill3')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('skill3_ar') {{  'is-invalid'  }} @enderror" id="inputSkillAr3" name="skill3_ar" value="{{ old('skill3_ar') }}" placeholder="@lang('site.teacher arabic skill3')">
                                        @error('skill3_ar')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputSkillEn3" class="col-sm-4 control-label">@lang('site.teacher english skill3')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('skill3_en') {{  'is-invalid'  }} @enderror" id="inputSkillEn3" name="skill3_en" value="{{ old('skill3_en') }}" placeholder="@lang('site.teacher english skill3')">
                                        @error('skill3_en')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
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
