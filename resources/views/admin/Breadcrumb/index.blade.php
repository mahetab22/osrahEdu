@extends('admin.layouts.app')
@section('style')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('site.breadcrumbs')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin">@lang('site.admin_panel')</a></li>
              <li class="breadcrumb-item active">@lang('site.breadcrumbs')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
            <a class="btn bg-gradient-primary text-white" href="{{url('/admin/breadcrumbs/create')}}">@lang('site.create new breadcrumb')</a>
            <h3 class="card-title">@lang('site.breadcrumbs')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>@lang('site.image')</th>
                        <th>@lang('site.breadcrumb arabic title')</th>
                        <th>@lang('site.breadcrumb english title')</th>
                        <th>@lang('site.link url')</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($breadcrumbs as $i => $breadcrumb)
                  <tr data-row-id='{{ $breadcrumb->id }}'>
                      <td><img src="{{url('/')}}/{{$breadcrumb->image}}" width="100px"/></td>
                      <td>{{$breadcrumb->title_ar}}</td>
                      <td>{{$breadcrumb->title_en}}</td>
                      <td>{{$breadcrumb->url}}</td>

                      <td>
                          <div class="row">
                              <div class="col-md-6">
                                  <a class="edit btn bg-gradient-primary" href="{{ url('/admin/breadcrumbs/'.$breadcrumb->id.'/edit') }}"><i class="fa fa-edit text-white"></i></a>
                              </div>
                              <div class="col-md-6">
                                  <a class="delete btn bg-gradient-danger m-1" href="javascript:void(0)" data-delete-id="{{ $breadcrumb->id }}"><i class="fa fa-trash text-white"></i></a>
                              </div>
                          </div>
                      </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<!-- DataTables -->
<script src="{{url('/')}}/public/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/public/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/')}}/public/admin/dist/js/demo.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script type="text/javascript">
    $('.delete').on('click',function(e){
      id = $(this).attr('data-delete-id');
      console.log(id);
        e.preventDefault();
        Swal.fire({
          title: "@lang('site.alert_confirm_message')",
          text: "@lang('site.alert_irreversible_message')",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: "@lang('site.alert_delete')",
          cancelButtonText: "@lang('site.alert_cancel')"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type:'POST',
                dataType: 'json',
                data:{ id:id, _method: 'DELETE', _token:"{{ csrf_token() }}" },
                url: "{!! url('admin/breadcrumbs/' ) !!}" + "/" + id,
                success:function(data){
                    Swal.fire({
                        position: 'center',
                        icon: data['alert']['icon'],
                        title: data['alert']['title'],
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    if(data['err'] == 0){
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    }
                },
                error:function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }
    });
});
</script>
@endsection