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
            <h1>@lang('site.exams')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin">@lang('site.admin_panel')</a></li>
              <li class="breadcrumb-item"></li>
              <li class="active">@lang('site.exams')</li>
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
            <a class="btn bg-gradient-primary text-white" href="{{url('/admin/exams/create')}}">@lang('site.create new exam')</a>
            <button class="btn bg-gradient-primary text-white delete_all"> {{ __('site.Delete All Selected') }}</button>
                <h3 class="card-title">@lang('site.exams')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" id="master"></th>
                        <th>@lang('site.exam logo')</th>
                        <th>@lang('site.exam code')</th>
                        <th>@lang('site.exam title')</th>
                        <th>@lang('site.exam user')</th>
                        <th>@lang('site.exam course')</th>
                        <th>@lang('site.exam level')</th>
                        <th>@lang('site.exam lesson')</th>
                        <th>@lang('site.exam view')</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($exams as $i => $exam)
                <tr data-row-id='{{ $exam->id }}'>
                    <td><input type="checkbox" name="exams[]" class="sub_chk" data-id="{{$exam->id}}"></td>
                    <td><img src="{{url('/')}}/{{$exam->logo}}" width="100px"/></td>
                    <td>{{ $exam->code }}</td>
                    <td>{{ $exam->title }}</td>
                    <td>{{ $exam->user->name }}</td>
                    <td>{{ $exam->course->title ?? ''}}</td>
                    <td>{{ $exam->levels->title ?? ''}}</td>
                    <td>{{ $exam->lesson->title ?? '' }}</td>
                    <td>{{ $exam->view }}</td>

                    <td>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="edit btn bg-gradient-primary m-1" href="{{ url('/admin/exams/'.$exam->id.'/edit') }}"><i class="fa fa-edit text-white"></i></a>
                                </div>
                                <div class="col-md-4">
                                    <a class="delete btn bg-gradient-danger m-1" href="javascript:void(0)" data-delete-id="{{ $exam->id }}"><i class="fa fa-trash text-white"></i></a>
                                </div>
                                <div class="col-md-4">
                                    <a class="questions btn bg-gradient-info m-1 text-white" href="{{ url('/admin/exam/'.$exam->id.'/questions') }}" data-exam-id="{{ $exam->id }}"><i class="fa fa-question text-white"></i></a>
                                </div>
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
                        url: "{!! url('admin/exam/delete_all' ) !!}",
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

    $('.delete').on('click',function(e){
      id = $(this).attr('data-delete-id');
      console.log(id);
        e.preventDefault();
        Swal.fire({
          title: "@lang('site.alert_confirm_message')",
          text: "@lang('site.alert_exam_delete')",
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
                url: "{!! url('admin/exams/' ) !!}" + "/" + id,
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
