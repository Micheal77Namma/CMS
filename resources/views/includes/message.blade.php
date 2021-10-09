@if (count($errors) > 0)
    @foreach ($errors->all() as $r)
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Oh snap!</strong>     {{$r}} and try submitting again.
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Well done!</strong> {{session('success')}}</a>.
    </div>
@endif

@if (session('error'))
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Oh snap!</strong> {{session('error')}} and try submitting again.
    </div>

@endif
