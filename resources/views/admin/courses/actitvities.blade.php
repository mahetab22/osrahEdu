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
            <h1>@lang('site.activities')</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin">@lang('site.admin_panel')</a></li>
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/courses">@lang('site.courses')</a></li>
                <li class="active">@lang('site.activities')</li>
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
            <a class="btn bg-gradient-primary text-white" data-toggle="modal" data-target="#add-activity" >@lang('site.create new')</a>
            <button class="btn bg-gradient-primary text-white delete_all"> {{ __('site.Delete All Selected') }}</button>
                <h3 class="card-title">@lang('site.activities')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" id="master"></th>
                        <th>#</th>
                        <th>@lang('site.title')</th>
                        <th>@lang('site.activity')</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($course->activties as $i => $activity)
                  <tr data-row-id='{{ $activity->id }}'>
                      <td><input type="checkbox" name="activties[]" class="sub_chk" data-id="{{$activity->id}}"></td>
                      <td>{{$i+1}}</td>
                      <td>{{$activity->title}}</td>
                      <td><a href="{{url('/')}}/public/{{$activity->acivity}}" download><i class="fa fa-download"></i></a></td>

                      <td>
                          <div class="row">
                              <div class="col-md-4">
                                  <a class="edit btn bg-gradient-primary" data-toggle="modal" data-target="#update-activity{{$i}}"><i class="fa fa-edit text-white"></i></a>
                              </div>
                              <div class="col-md-4">
                                  <a class="delete btn bg-gradient-danger " href="javascript:void(0)" data-delete-id="{{ $activity->id }}"><i class="fa fa-trash text-white"></i></a>
                              </div>
                              <div class="col-md-4">
                                  <a class="btn bg-gradient-info text-white" href="{{url('/')}}/admin/activities/{{$activity->id}}/student_activity" >أنشطه الطلاب</a>
                              </div>
                          </div>
                      </td>
                  </tr>
                  <div id="update-activity{{$i}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">@lang('site.new')</h4>
                                </div>
                                <form method="post" action="{{url('/')}}/admin/activities/update/{{$activity->id}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="course_id" value="{{$course->id}}"/>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="field-1" class="control-label">@lang('site.title')</label>
                                                <input type="text" class="form-control" name="title"id="field-1"value="{{$activity->title}}" placeholder="@lang('site.title')">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="file" class="custom-file-input @error('file') {{  'is-invalid'  }} @enderror" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">@lang('site.choose file')</label>
                                                </div>

                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="">@lang('site.choose file')</span>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@lang('site.close')</button>
                                    <button type="submit" class="btn btn-info waves-effect waves-light">@lang('site.update')</button>
                                </div>
                                </form>
                            </div>
                        </div>
                 </div><!-- /.modal -->

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
<div id="add-activity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">@lang('site.new')</h4>
            </div>
            <form method="post" action="{{url('/')}}/admin/activities/create" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="course_id" value="{{$course->id}}"/>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">@lang('site.title')</label>
                            <input type="text" class="form-control" name="title"id="field-1" placeholder="@lang('site.title')">
                        </div>
                    </div>
                </div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input @error('file') {{  'is-invalid'  }} @enderror" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">@lang('site.choose file')</label>
                            </div>

                            <div class="input-group-append">
                                <span class="input-group-text" id="">@lang('site.choose file')</span>
                            </div>
                        </div>
                   </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">@lang('site.close')</button>
                <button type="submit" class="btn btn-info waves-effect waves-light">@lang('site.add')</button>
            </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->
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
<script>


$('#master').on('click', function(e) {
    if($(this).is(':checked',true))
    {
       $(".sub_chk").prop('checked', true);
    } else {
       $(".sub_chk").prop('checked',false);
    }
});


$('.delete_all').on('click', function(e) {


    var allVals = [];
    $(".sub_chk:checked").each(function() {
        allVals.push($(this).attr('data-id'));
    });

    if(allVals.length <=0)
    {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: "{{ __('site.no activties checked') }}",
            showConfirmButton: false,
            timer: 1500,
        })
    }  else {
            //var users_id = allVals.join(",");
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
                        url: "{!! url('admin/activities/delete_all' ) !!}",
                        type: 'POST',
                        data: { ids: allVals, _token:"{{ csrf_token() }}" },
                        success: function (data) {
                            console.log(data);

                            Swal.fire({
                                position: 'center',
                                icon: data['alert']['icon'],
                                title: data['alert']['title'],
                                showConfirmButton: false,
                                timer: 1500,
                            })
                            if(data['err'] == 0){
                            //location.reload();
                                $.each(allVals, function( index, value ) {
                                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                                });
                            }
                        },
                        error: function (data) {
                            console.log(data.responseText);
                        }
                    });
                }
            })
    }



});

</script>
//var id = $(this).attr('data-delete-id');
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
                url: "{!! url('admin/activities/delete/' ) !!}" + "/" + id,
                success:function(data){
                    Swal.fire({
                        position: 'center',
                        icon: data['alert']['icon'],
                        title: data['alert']['title'],
                        showConfirmButton: false,
                        timer: 1500,
                    })
                    if(data['err'] == 0){
                    location.reload();
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
