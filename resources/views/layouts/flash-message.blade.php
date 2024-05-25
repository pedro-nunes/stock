@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="fas fa-fw fa-check"></i> <strong>Tudo certo. </strong>{!! $message !!}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="fas fa-fw fa-ban"></i> <strong>Erro! </strong>{!! $message !!}
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="fas fa-fw fa-exclamation-triangle"></i> <strong>Atenção: </strong>{!! $message !!}
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="fas fa-fw fa-info"></i> <strong>Opps! </strong>{!! $message !!}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul class="nav flex-column">
            @foreach ($errors->all() as $error)
                <li class="nav-item"><i class="fas fa-fw fa-ban"></i> <strong>Erro! </strong>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif
