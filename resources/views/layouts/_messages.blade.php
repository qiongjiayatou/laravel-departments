@if(session('message-success'))
<div class="alert alert-success" role="alert">
    {{ session('message-success') }}
</div>
@endif

@if(session('message-error'))
<div class="alert alert-danger" role="alert">
    {{ session('message-danger') }}
</div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif