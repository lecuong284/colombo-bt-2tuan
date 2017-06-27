{{--thông báo lỗi khi nhận request--}}
@if(count($errors) > 0)
    <div class="alert alert-danger custom">
        {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
        <ul class="list-unstyled">
            @foreach($errors->all() as $error)
                <li class="cus-alert"><i class="icon fa fa-ban"></i> {!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

{{--các thông báo khác--}}
@if(Session::has('flash_message'))
    <div class="alert alert-{!! Session::get('flash_level') !!} custom">
        <span class="cus-alert"><i class="icon fa {!! (Session::get('flash_level') == 'danger') ? 'fa-exclamation-triangle' : 'fa-check' !!}"></i> {!! Session::get('flash_message') !!}</span>
    </div>
@endif