@extends('admin.layouts.app')
@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <style>
    body{
        background-color:black;
    }
  </style>

@endsection
@section('content')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@Lang('site.create new course')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/courses') }}">@lang('site.course')</a></li>
                        <li class="breadcrumb-item"></li>
                        <li class="active">@Lang('site.create new course')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card-header">
                    <h2 class="card-title float-left text-bold">@lang('site.course information')</h2>
                </div>
                <!-- /.card-header -->
                <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">

                    <!-- form start -->
                        <form class="form-horizontal" method="POST" action="{{ url('admin/courses/'.$course->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.service arabic title')</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('service') {{  'is-invalid'  }} @enderror" id="inputName1" name="service" value="{{ old('service') }}" placeholder="@lang('site.service arabic title')" required>
                                            <option value="" disabled selected>-- @lang('site.choose service') --</option>
                                            @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {{$course->service->id==$service->id?'selected':''}} > {{ app()->getLocale() == 'ar' ? $service->title_ar : $service->title_en }} </option>
                                            @endforeach
                                        </select>
                                        @error('service')
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
                                            <img src="{{url('/')}}/{{$course->logo}}" style="width:250px;height:250px">
                                        </div>
                                        @error('logo')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputSupervisor" class="col-sm-2 control-label">@lang('site.supervisor')</label>
                                    <div class="col-sm-10">
                                        <?php $sups=$course->supervisorcourses->pluck('supervisor_id')->toArray();?>
                                        <select class="form-control @error('supervisor_id') {{  'is-invalid'  }} @enderror select2 "data-placeholder="-- @lang('site.choose supervisor') --" multiple="multiple" id="inputSupervisor" name="supervisor_id[]" required>
                                            <option value="" disabled selected>-- @lang('site.choose supervisor') --</option>
                                            @foreach ( $supervisors as $supervisor)
                                                <option value="{{ $supervisor->user->id }}"{{in_array($supervisor->id,$sups)?'selected':''}} >{{ $supervisor->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('supervisor_id')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.course arabic title')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('title_ar') {{  'is-invalid'  }} @enderror" id="inputName1" name="title_ar" value="{{ $course->title_ar }}" placeholder="@lang('site.course arabic title')" required>
                                        @error('title_ar')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.course english title')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('title_en') {{  'is-invalid'  }} @enderror" id="inputName1" name="title_en" value="{{ $course->title_en }}" placeholder="@lang('site.service english title')">
                                        @error('title_en')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.course arabic description')</label>
                                    <div class="col-sm-10">
                                        <textarea name="desc_ar" class="form-control @error('desc_ar') {{  'is-invalid'  }} @enderror">{{ $course->description_ar }}</textarea>
                                        @error('desc_ar')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 control-label">@lang('site.course arabic description')</label>
                                    <div class="col-sm-10">
                                        <textarea name="desc_en" class="form-control @error('desc_en') {{  'is-invalid'  }} @enderror">{{ $course->description_en }}</textarea>
                                        @error('desc_en')
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
            <hr>
            <div class="container-fluid">
                <div class="card-header">
                    <h2 class="card-title float-left text-bold">@lang('site.course duration')</h2>
                </div>
                <!-- /.card-header -->
                <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputDuration1" class="col-sm-2 control-label">@lang('site.duration')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('duration') {{  'is-invalid'  }} @enderror" id="inputDuration1" name="duration" value="{{ $course->duration }}" placeholder="@lang('site.duration')">
                                    @error('duration')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 row">
                                    <label for="inputDuration1" class="col-sm-4  control-label">@lang('site.start date')</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control @error('start_date') {{  'is-invalid'  }} @enderror" id="inputDuration1" name="start_date" value="{{ $course->from_date }}" placeholder="@lang('site.duration')">
                                        @error('start_date')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputDuration1" class="col-sm-4 control-label">@lang('site.end date')</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control @error('end_date') {{  'is-invalid'  }} @enderror" id="inputDuration1" name="end_date" value="{{ $course->to_date }}" placeholder="@lang('site.end date')">
                                        @error('end_date')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
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
            <hr>
            <div class="container-fluid">
                <div class="card-header">
                    <h2 class="card-title float-left text-bold">@lang('site.course features')</h2>
                </div>
                <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-sm-6 row">
                                    <label for="inputDuration1_ar" class="col-sm-4  control-label">@lang('site.feature1_ar')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('feature1_ar') {{  'is-invalid'  }} @enderror" id="inputDuration1_ar" name="feature1_ar" value="{{ $course->feature1 }}" placeholder="@lang('site.feature1_ar')">
                                        @error('feature1_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputFeature1_en" class="col-sm-4 control-label">@lang('site.feature1_en')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('feature1_en') {{  'is-invalid'  }} @enderror" id="inputFeature1_en" name="feature1_en" value="{{ $course->feature1_en }}" placeholder="@lang('site.feature1_en')">
                                        @error('feature1_en')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 row">
                                    <label for="inputFeature2_ar" class="col-sm-4  control-label">@lang('site.feature2_ar')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('feature2_ar') {{  'is-invalid'  }} @enderror" id="inputFeature2_ar" name="feature2_ar" value="{{ $course->feature2 }}" placeholder="@lang('site.feature2_ar')">
                                        @error('feature2_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputFeature2_en" class="col-sm-4 control-label">@lang('site.feature2_en')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('feature2_en') {{  'is-invalid'  }} @enderror" id="inputFeature2_en" name="feature2_en" value="{{ $course->feature2_en }}" placeholder="@lang('site.feature2_en')">
                                        @error('feature2_en')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 row">
                                    <label for="inputFeature3_ar" class="col-sm-4  control-label">@lang('site.feature3_ar')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('feature3_ar') {{  'is-invalid'  }} @enderror" id="inputFeature3_ar" name="feature3_ar" value="{{ $course->feature3 }}" placeholder="@lang('site.feature3_ar')">
                                        @error('feature3_ar')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputFeature3_en" class="col-sm-4 control-label">@lang('site.feature3_en')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('feature3_en') {{  'is-invalid'  }} @enderror" id="inputFeature3_en" name="feature3_en" value="{{ $course->feature3_en }}" placeholder="@lang('site.feature3_en')">
                                        @error('feature3_en')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
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
            <hr>
            <div class="container-fluid">
                <div class="card-header">
                    <h2 class="card-title float-left text-bold">@lang('site.course additional information')</h2>
                </div>
                <!-- /.card-header -->
                <div class="row">
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputtype1" class="col-sm-2 control-label">@lang('site.course type')</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('type') {{  'is-invalid'  }} @enderror" id="inputType1" name="type" value="{{ old('type') }}" placeholder="@lang('site.service arabic title')">
                                        <option value="" disabled selected>-- @lang('site.choose type') --</option>
                                        <option value="0" {{ $course->online == 0 ?'selected':'' }}>@lang('site.course online')</option>
                                        <option value="1" {{ $course->online == 1 ?'selected':'' }}>@lang('site.course offline')</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row online">
                                <div class="col-sm-6 row">
                                    <label for="inputLink_url1" class="col-sm-4 control-label">@lang('site.link url')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('link_url') {{  'is-invalid'  }} @enderror" id="inputLink_url1" name="link_url" value="{{ $course->online == 0 ? $course->link_url : '' }}" placeholder="@lang('site.link url')">
                                        @error('link_url')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputLink_url1" class="col-sm-4 control-label">@lang('site.link name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('link_name') {{  'is-invalid'  }} @enderror" id="inputLink_name1" name="link_name" value="{{ $course->online == 0 ? $course->link_name : '' }}" placeholder="@lang('site.link name')">
                                        @error('link_name')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row offline">
                                <div class="col-sm-6 row">
                                    <label for="inputLink_url1" class="col-sm-4 control-label">@lang('site.address name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('address_name') {{  'is-invalid'  }} @enderror" id="inputAddressName" name="address_name" value="{{ $course->online == 1 ? $course->link_name : '' }}" placeholder="@lang('site.address name')">
                                        @error('address_name')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 row">
                                    <label for="inputAddress1" class="col-sm-4 control-label">@lang('site.google map')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('google_map') {{  'is-invalid'  }} @enderror" id="inputAddress1" name="google_map" value="{{ $course->online == 1 ? $course->link_url : '' }}" placeholder="@lang('site.google map')">
                                        @error('google_map')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputtype1" class="col-sm-2 control-label">@lang('site.course trailer link')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('link') {{  'is-invalid'  }} @enderror" id="inputLink1" name="link" value="{{ $course->link }}" placeholder="@lang('site.course trailer link')">
                                    @error('link')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputPrice1" class="col-sm-2 control-label">@lang('site.price')</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('price') {{  'is-invalid'  }} @enderror" id="inputPrice1" name="price" value="{{ $course->price }}" placeholder="@lang('site.price')">
                                    @error('price')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputDiscount1" class="col-sm-2 control-label">@lang('site.discount')</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('discount') {{  'is-invalid'  }} @enderror" id="inputDiscount1" name="discount" value="{{ $course->studentDiscount }}" placeholder="@lang('site.discount')">
                                    @error('discount')
                                        <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-sm-6 row">
                                    <label for="inputLink_url1" class="col-sm-4 control-label">@lang('site.whatsapp')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('whatsapp') {{  'is-invalid'  }} @enderror" id="inputLink_url1" name="whatsapp" value="{{ $course->whatsapp }}" placeholder="@lang('site.whatsapp')">
                                        @error('whatsapp')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6 row">
                                    <label for="inputLink_url1" class="col-sm-4 control-label">@lang('site.telegram')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('telegram') {{  'is-invalid'  }} @enderror" id="inputLink_url1" name="telegram" value="{{ $course->telegram }}" placeholder="@lang('site.telegram')">
                                        @error('telegram')
                                            <div class="text-danger"><small class="font-weight-bold">{{ $message }}</small></div>
                                        @enderror
                                    </div>
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
        </section>


        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn bg-gradient-info text-white">@lang('site.edit')</button>
        </div>
        <!-- /.card-footer -->
        <!-- /.content -->
</form>
    </div>
<!-- /.content-wrapper -->

@endsection

@section('script')
<!-- Select2 -->
<script src="{{url('/')}}/public/admin/plugins/select2/js/select2.full.min.js"></script>

@if ($course->online == 0)
<script>
    $('.offline').hide();
</script>
@else
<script>
    $('.online').hide();
</script>
@endif

<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })
 });
        $('#inputType1').on('change',function(){
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;

        if(valueSelected == 0){
            $('.online').show();
            $('.offline').hide();
        }else{
            $('.offline').show();
            $('.online').hide();
        }

    });

    $('#role').on('change',function(){
        console.log('test');
        $(this).removeClass('is-invalid');
    });
</script>
@endsection
