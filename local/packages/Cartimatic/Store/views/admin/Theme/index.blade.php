@extends('Store::layouts.store-admin')

@section('content')

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <label>{{$theme->name}}</label>
            </div>
            <div class="panel-body">
                <img src="{{url('local/public/theme/gallery/'.$theme->thumb)}}">
            </div>
            <div class="panel-footer">
                <a class="btn btn-info" href="{{url('store/'.$username.'/admin/theme/edit/'.$theme->id)}}">Edit</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    @foreach($themes as $row)
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <label>{{$row->name}}</label>
            </div>
            <div class="panel-body">
                <img src="{{url('local/public/theme/gallery/'.$row->thumb)}}">
            </div>
            <div class="panel-footer">
                @if(@$theme->path == @$row->path)
                    <a class="btn btn-info" href="{{url('store/'.$username.'/admin/theme/edit/'.$theme->id)}}">Edit</a>
                @else
                <a class="btn btn-primary" href="{{url('store/'.$username.'/admin/theme/setAsDefault/'.$row->id)}}">Set as Default</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    <div class="clearfix"></div>
@endsection