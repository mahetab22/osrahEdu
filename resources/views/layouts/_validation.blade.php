<div style="position: absolute;z-index:99999999;margin:auto;right: 0;left: 0;width: 50%;">
    @if(Session::has('success'))
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><i style="cursor:pointer" class="fa fa-times-circle-o" aria-hidden="true"></i></a>
            <li style="font-weight: bold !important;font-size: 20px !important;">{{Session::get('success')}}</li>
        </div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><i style="cursor:pointer" class="fa fa-times-circle-o" aria-hidden="true"></i></a>
            <li style="font-weight: bold !important;font-size: 20px !important;">{{Session::get('fail')}}</li>
        </div>
    @endif
 </div>
<div style="position: absolute;z-index:99999999;margin:auto;right: 0;left: 0;width: 50%;">
    @if (count($errors) > 0)
        <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"><i style="cursor:pointer" class="fa fa-times-circle-o" aria-hidden="true"></i></a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="font-weight: bold !important;font-size: 20px !important;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div 

