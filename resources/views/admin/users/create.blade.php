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
                    <h1>@Lang('site.add new user')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">@lang('site.users')</a></li>
                    <li class="breadcrumb-item"></li>
                    <li class="active">@Lang('site.add new user')</li>
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
                    <form class="form-horizontal" method="POST" action="{{ url('admin/users') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="exampleInputFile" class="col-sm-2 control-label">@lang('site.avatar')</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input @error('avatar') {{  'is-invalid'  }} @enderror" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">@lang('site.choose image')</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">@lang('site.choose image')</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <img src="" id="profile-img-tag" width="200px" />
                                    </div>
                                    @error('avatar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.username')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') {{  'is-invalid'  }} @enderror" id="inputName1" name="name" value="{{ old('name') }}" placeholder="@lang('site.username')" required>
                                    @error('name')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 control-label">@lang('site.password')</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control @error('password') {{  'is-invalid'  }} @enderror" id="inputPassword3" name="password" size="40" placeholder="@lang('site.password placeholder')" required>
                                    @error('password')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 control-label">@lang('site.email')</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') {{  'is-invalid'  }} @enderror" id="inputEmail3" name="email" value="{{ old('email') }}" placeholder="@lang('site.email')" required>
                                    @error('email')
                                    <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 control-label">@lang('site.phone')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('phone') {{  'is-invalid'  }} @enderror" id="inputPhone3" name="phone" value="{{ old('phone') }}" placeholder="@lang('site.phone')">
                                    @error('phone')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.age')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('age') {{  'is-invalid'  }} @enderror" id="inputAge3" name="age" value="{{ old('age') }}" placeholder="@lang('site.user age')">
                                    @error('age')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 control-label">@lang('site.user role')</label>
                                <div class="col-sm-10">
                                    <select class="form-control  @error('role') {{  'is-invalid'  }} @enderror" id="role" name="role" required>
                                        <option value="" disabled selected>-- @lang('site.choose user role') --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $role->id == old('role') ? 'selected' : ''}}>{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 control-label">@lang('site.gender')</label>
                                <div class="col-sm-10 row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : ''}}>
                                            <label class="form-check-label">@lang('site.male')</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : ''}}>
                                            <label class="form-check-label">@lang('site.female')</label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
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
    //Display New Image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log(reader);
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#exampleInputFile").change(function(){
        console.log('test');
        readURL(this);
    });

    $('#role').on('change',function(){
        console.log('test');
        $(this).removeClass('is-invalid');
    });
</script>
@endsection
