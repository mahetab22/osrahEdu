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
            <h1>@lang('site.users')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin">@lang('site.admin_panel')</a></li>
              <li class="breadcrumb-item"></li>
              <li class="active">@lang('site.users')</li>
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
                    <a class="btn bg-gradient-primary text-white" href="{{url('/admin/users/create')}}">@lang('site.create new user')</a>
                    <button class="btn bg-gradient-primary text-white delete_all"> {{ __('site.Delete All Selected') }}</button>
                    <h3 class="card-title">@lang('site.users')</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width:50px"><input type="checkbox" id="master"></th>
                        <th style="width:50px">ID</th>
                        <th>@lang('site.image')</th>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.email')</th>
                        <th>@lang('site.phone')</th>
                        <th>@lang('site.role')</th>
                        <th>@lang('site.gender')</th>
                        <th>@lang('site.active')</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $i=>$user)
                    <tr data-row-id='{{ $user->id }}'>
                        <td><input type="checkbox" name="users[]" class="sub_chk" data-id="{{$user->id}}"></td>
                        <td>{{$i+1}}</td>
                        <td><img src="{{url('/')}}/{{$user->avatar ?? 'public/storage/users/default.jpeg'}}" width="100px"/></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->Role->display_name}}</td>
                        <td>
                            @if($user->gender== 'male')
                                @lang('site.male')
                            @else
                                @lang('site.female')
                            @endif
                        </td>
                        <td>
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input activeIn" data-id="{{$user->id}}" id="customSwitch{{$i}}" {{$user->s==1?'checked':''}}>
                                <label class="custom-control-label" for="customSwitch{{$i}}"></label>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="edit btn bg-gradient-primary" href="{{ url('/admin/users/'.$user->id.'/edit') }}"><i class="fa fa-edit text-white"></i></a>
                                </div>
                                @if($user->role_id!=1 and $user->id!=1 and $user->id!=auth()->user()->id)
                                    <div class="col-md-6">
                                        <a class="delete btn bg-gradient-danger m-1" href="javascript:void(0)" data-delete-id="{{ $user->id }}"><i class="fa fa-trash text-white"></i></a>
                                    </div>
                                @endif
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
$('.activeIn').on('change',function(){
  var id=$(this).attr('data-id');
  $.ajax({
        url:'{{ route('userActive') }}',
        type:'post',
        data: {
            id : id,
            _token: "{{ csrf_token() }}"
         },success:function(res){
            //  console.log(res);
            },error(er){
              console.log(er);
            }

    });
});

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
            title: '{{ __('site.no user checked') }}',
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
                        url: "{!! url('admin/user/delete_all' ) !!}",
                        type: 'POST',
                        data: { ids: allVals, _token:"{{ csrf_token() }}" },
                        success: function (data) {
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
                url: "{!! url('admin/users/' ) !!}" + "/" + id,
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
