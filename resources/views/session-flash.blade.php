@if (Session::has('success'))
    <div class="alert alert-sm alert-border-left alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-info pr10"></i>
        <strong>Well done: </strong> {!! Session::get('success') !!}
    </div>
@endif

@if (Session::has('failed'))
    <div class="alert alert-sm alert-border-left alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-info pr10"></i>
        <strong>Warning: </strong> {!! Session::get('failed') !!}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-sm alert-border-left alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-info pr10"></i>
        <strong>Warning: </strong> {!! Session::get('error') !!}
    </div>
@endif

@if ($errors->all())
    <div class="alert alert-sm alert-border-left alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-info pr10"></i>
        <strong>Warning: </strong> Please check the form carefully for errors!
    </div>
@endif
