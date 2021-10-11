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
            <h1>@lang('site.services')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin">@lang('site.admin_panel')</a></li>
              <li class="breadcrumb-item"></li>
              <li class="active">@lang('site.services')</li>
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
            <button class="btn bg-gradient-primary text-white delete_all"> {{ __('site.Delete All Selected') }}</button>
                <h3 class="card-title">@lang('site.survey')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" id="master"></th>
                        <th>@lang('site.username')</th>
                        <th>@lang('site.course')</th>
                        <th>@lang('site.course rate')</th>
                        <th>@lang('site.teacher rate')</th>
                        <th>@lang('site.site rate')</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($survey as $i => $ser)
                  <tr data-row-id='{{ $ser->id }}'>
                      <td><input type="checkbox" name="servey[]" class="sub_chk" data-id="{{$ser->id}}"></td>
                      <td>{{$ser->user->name}}</td>
                      <td>{{$ser->Course->title}}</td>
                      <td>{{$ser->course_rate}}</td>
                      <td>{{$ser->teacher_rate}}</td>
                      <td>{{$ser->site_rate}}</td>

                      <td>
                         
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
            title: "{{ __('site.no service checked') }}",
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
                        url: "{!! url('admin/survey/delete_all' ) !!}",
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
                url: "{!! url('admin/services/' ) !!}" + "/" + id,
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
