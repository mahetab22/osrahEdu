@extends('admin.layouts.app')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('/')}}/public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@lang('site.students')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin">@lang('site.admin_panel')</a></li>
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/courses">@lang('site.courses')</a></li>
              <li class="breadcrumb-item active">@lang('site.students')</li>
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
            <button class="btn bg-gradient-primary text-white attend_all"> {{ __('site.Attend All Selected') }}</button>  
            <h3 class="card-title">@lang('site.students')</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" id="master"></th>
                        <th>#</th>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.amount')</th>
                        <th>@lang('site.subscripe date')</th>
                        <th>@lang('site.count attending')</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                @foreach($course->subscriptioncourses as $i => $student)
                  <tr data-row-id='{{ $student->id }}'>
                      <td><input type="checkbox" name="students[]" class="sub_chk" data-id="{{$student->id}}"></td>
                      <td>{{$i+1}}</td>
                      <td>{{$student->user->name}}</td>
                      <td>{{$student->amount}}</td>
                      <td>{{$student->created_at}}</td>
                      <td>{{$student->Attending->count()}}</td>
                      <td><a href="{{url('/')}}/admin/course/student/reports/{{$student->id}}" class="btn btn-primary">@lang('site.reports')</a></td>
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
<!-- DataTables  & Plugins -->
<script src="{{url('/')}}/public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/jszip/jszip.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{url('/')}}/public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": [
            {
                "extend": "excel",
                "text": "Excel",
                "filename": "users osrah",
                "className": "btn btn-green",
                "charset": "utf-8",
                "bom": "true",
                init: function(api, node, config) {
                    $(node).removeClass("btn-default");
                }
            },
            {
                "extend": "pdf",
                "text": "PDF",
                "filename": "users osrah",
                "className": "btn btn-green",
                "charset": "utf-8",
                "bom": "true",
                init: function(api, node, config) {
                    $(node).removeClass("btn-default");
                }
            }, "colvis"
          ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

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
            title: "{{ __('site.no students checked') }}",
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
                        url: "{!! url('admin/course/student/delete_all' ) !!}",
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

$('.attend_all').on('click', function(e) {

var allVals = [];
$(".sub_chk:checked").each(function() {
    allVals.push($(this).attr('data-id'));
});
if(allVals.length <=0)
{
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: "{{ __('site.no students checked') }}",
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
            confirmButtonText: "@lang('site.alert_attend')",
            cancelButtonText: "@lang('site.alert_cancel')"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{!! url('admin/course/student/attend_all' ) !!}",
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
                        // window.reload();
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

@endsection
