@if(session('exception'))
<div class="alert alert-danger">
    <ul>
        <li>{{'Error description: ' . session('exception')->getDescription()}}</li>
        <li>{{'Error message: ' . session('exception')->getMessage()}}</li>
    </ul>

</div>
@endif
@if(session('message'))
<div class="alert alert-danger">
    <ul>
        <li>
            {{session('message')}}
        </li>
    </ul>
</div>
@endif
@if(session('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    {{session('success')}}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    {{session('error')}}
</div>
@endif

