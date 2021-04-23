@extends('Store::layouts.store-admin')
@section('styles')

@stop
@section('content')

    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Enable Custom Domain and Theme for your store</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! Form::open(['url' => 'store/'.$store_id.'/admin/postStoreEnable/','class' => 'form-horizontal form-label-left','data-parsley-validate', 'enctype'=>"multipart/form-data" , 'id' => 'empForm']) !!}
                        @if(empty($db_name->value))
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6" for="first-name">Store Name:<span class="required">*</span></label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                                {!! Form::text('store_name',Null, ['class' => 'form-control','required']) !!}
                            </div>
                            <div class="col-md-3">
                                <button type="submit" id="emp_save" class="btn btn-success">Save</button>
                            </div>
                        </div>
                        @else
                        <div class="form-group">
                            <div>
                                <label class="col-md-4 control-label">{{$url_protocol.@$db_name->value . '.'. config('app.url')}}</label>
                                <div class="col-md-4">
                                    <button type="submit" id="emp_save" class="btn btn-success">Enable</button>
                                </div>
                            </div>
                        </div>
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')

    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">

        jQuery(document).ready(function(e){
            jQuery('#empForm').validate({
                errorElement : 'span',
                rules : {
                    'store_name'         :  {
                        required:true,
                        minlength : 4,
                        remote : {
                            type: "post",
                            url : '{{url('store/'.$store_id.'/admin/checkStoreName')}}',
                            data : {user_type:2}
                        }
                    },
                },
            });
        });

    </script>
@stop
