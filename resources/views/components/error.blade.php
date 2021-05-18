@if ($errors->any())
<div id="closeablecard" class="alert alert-danger">
    {{ __('Whoops! Something went wrong.') }}
    <button data-dismiss="alert" data-target="#closeablecard" type="button" class="close" aria-label="Close">
        <span aria-hidden="true" title="Click here to close the dialogue box">&times;</span>
    </button>

    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif

@if(session()->has('success'))
<div id="closeablecard" class="alert alert-success">
    {{ session('success') }}
    <button data-dismiss="alert" data-target="#closeablecard" type="button" class="close" aria-label="Close">
        <span aria-hidden="true" title="Click here to close the dialogue box">&times;</span>
    </button>
</div>
@endif

@if(session()->has('message'))
<div id="closeablecard" class="alert alert-success">
    {{ session('message') }}
    <button data-dismiss="alert" data-target="#closeablecard" type="button" class="close" aria-label="Close">
        <span aria-hidden="true" title="Click here to close the dialogue box">&times;</span>
    </button>
</div>
@endif

@if(session()->has('warning'))
<div id="closeablecard" class="alert alert-warning">
    {{ session('warning') }}
    <button data-dismiss="alert" data-target="#closeablecard" type="button" class="close" aria-label="Close">
        <span aria-hidden="true" title="Click here to close the dialogue box">&times;</span>
    </button>
</div>
@endif

@if(session()->has('error'))
<div id="closeablecard" class="alert alert-danger">
    {{ session('error') }}
    <button data-dismiss="alert" data-target="#closeablecard" type="button" class="close" aria-label="Close">
        <span aria-hidden="true" title="Click here to close the dialogue box">&times;</span>
    </button>
</div>
@endif