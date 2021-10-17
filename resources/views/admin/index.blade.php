@extends('admin.layouts.app')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.admin_panel')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('site.main')</a></li>
              <li class="breadcrumb-item"></li>
              <li class="active">@lang('site.admin_panel')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$visitors}}</h3>

                <p>@lang('site.visitors')</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{url('/')}}/admin/visitors" class="small-box-footer">@lang('site.more') <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box ">
              <div class="inner">
                <h3>{{$users}}</h3>

                <p>@lang('site.users')</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('/')}}/admin/users" class="small-box-footer">@lang('site.more')<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$coaches}}</h3>

                <p>@lang('site.coaches')</p>
              </div>
              <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
              </div>
              <a href="#" class="small-box-footer">@lang('site.more') <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box ">
              <div class="inner">
                <h3>{{$courses}}</h3>

                <p>@lang('site.courses')</p>
              </div>
              <div class="icon">
                <i class="fab fa-leanpub"></i>
              </div>
              <a href="{{url('/')}}/admin/courses" class="small-box-footer">@lang('site.more') <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$students}}</h3>

                <p>@lang('site.students')</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-graduate"></i>
              </div>
              <a href="#" class="small-box-footer">@lang('site.more') <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box ">
              <div class="inner">
                <h3>{{$specials}}</h3>

                <p>@lang('site.Specialized_Services')</p>
              </div>
              <div class="icon">
                <i class="fa fa-file-alt"></i>
              </div>
              <a href="#" class="small-box-footer">@lang('site.more') <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  @section('script')

@endsection