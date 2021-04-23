@extends('Store::layouts.store-admin')
@section('styles')

@stop
@section('content')

    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Domain Manager</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_content">

                        @if($domain)
                        <div class="clearfix">
                            <div class="pull-left">
                                <h4>{{$domain->name}}</h4>
                            </div>
                            <div class="pull-right">
                                <a data-toggle="modal" data-target="#myModal" href="#"><h4 class="fa fa-edit"></h4></a>&nbsp;|&nbsp;
                                <a class="remove-domain" href="{{url('store/'.$store_id.'/admin/removeDomain/'.$domain->id)}}"><h4 class="fa fa-remove"></h4></a>
                            </div>
                            @if(!empty($domain->is_setup_completed))
                            <div class="label label-success">Ok</div>
                            @else
                            <div class="label label-warning">Setup Required</div>
                            @endif
                        </div>
                        @if(empty($domain->is_setup_completed))
                        <div class="bg-info">
                            <p>Log in to your domain provider account.</p>
                            <p>Set your CNAME record for www to {{$store_db_name.'.'.config('app.url')}}</p>
                        </div>
                        @endif
                        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Edit</h4>
                                    </div>

                                    {!! Form::open(['url' => 'store/'.$store_id.'/admin/addDomain','class' => 'form-horizontal form-label-left','data-parsley-validate', 'enctype'=>"multipart/form-data" , 'id' => 'editForm']) !!}
                                    <div class="modal-body">

                                        <input type="hidden" name="domain-id" value="{{$domain->id}}">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Domain Name:</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon1">http://</span>
                                                    <input type="text" name="name" class="form-control" value="{{$domain->name}}">
                                                </div>
                                                <label class="error edit-error-container">{{$errors->first('name')}}</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>

                        @else
                        {!! Form::open(['url' => 'store/'.$store_id.'/admin/addDomain','class' => 'form-horizontal form-label-left','data-parsley-validate', 'enctype'=>"multipart/form-data" , 'id' => 'empForm']) !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Domain Name:</label>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">http://</span>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <label class="error">{{$errors->first('name')}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                            <button type="submit" class="btn btn-primary pull-right">Add</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop
@section('scripts')
    <script src="{{url('local/public/assets/js/jquery.form.min.js')}}"></script>
    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        jQuery('#editForm').ajaxForm({
            success : function showResponse(responseText, statusText, xhr, $form)  {
                if(typeof responseText.success != 'undefined')
                {
                    $('#myModal').modal('hide');
                    window.location.reload();
                }else if(typeof responseText.name != 'undefined')
                {
                    $('.edit-error-container').text(responseText.name[0]);
                }
            }
        });

        jQuery(document).on('click','.remove-domain',function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            if(confirm('Are you sure?'))
            {
                window.location.href = url;
            }
        });

    </script>
@stop
