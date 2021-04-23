@extends('Store::layouts.store-admin')
@section('styles')

@stop
@section('content')

    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Add New Role</h3>
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

                        {!! Form::model($role,['url' => 'admin/store/employees/update-role/'.$role->id,'class' => 'form-horizontal form-label-left','data-parsley-validate', 'enctype'=>"multipart/form-data" ,'id' => 'storeRole']) !!}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Role Name <span
                                        class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                {!! Form::text('name', NULL, ['class' => 'form-control col-md-7 col-xs-12', 'required']) !!}
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn btn-success" id="save_role">Submit</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(e){
            jQuery('#storeRole').validate({
                errorElement : 'span',
                rules : {
                    'name' : {required:true}
                }

            });
        });
        jQuery(document).on('click','#save_role',function(e){
            e.preventDefault();
            jQuery('#storeRole').submit();
        });
    </script>
@stop
