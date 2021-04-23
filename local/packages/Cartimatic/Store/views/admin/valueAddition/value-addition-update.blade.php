
@extends('Store::layouts.store-admin')
@section('styles')
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
@stop
@section('content')

    <div class="col-md-12" style="background-color: #fff">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Update {{Session::get('SYSTEM_CONFIGURATION.PRODUCT_VARIABLE_5')}}
                    <small>
                    </small>
                </h3>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-3">
            <div class="row">
                {!! Form::model(null , ['method' => 'POST', 'url' => "store/$store_id/admin/updateValueAddition/$valueAddition->id","id" =>"updateValueAddition"]) !!}
                @if(Session::has('message'))
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-success', 'alert-info') }}" aria-label="close">&times;</a>
                        <strong>Error!</strong> {{ Session::get('message') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-error" style="width:100%;line-height: 20px;
                color: #fff;">
                        <a href="#" class="close">&times;</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <span>
                        <li>{{ $error }}</li>
                        </span>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">Name</label>
                    <div class="col-xs-10">
                        <input class="form-control" value="{{$valueAddition->name}}" disabled="disabled" type="text" name="name" placeholder="Name">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="code" class="col-xs-2 col-form-label">Code</label>
                    <div class="col-xs-10">
                        <input class="form-control" value="{{$valueAddition->code}}" disabled="disabled" type="text"
                               name="code" placeholder="Code">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sort" class="col-xs-2 col-form-label">Sort Order</label>
                    <div class="col-xs-10">
                    <input class="form-control" value="{{$valueAddition->sort_number}}" type="text" name="sort_number" placeholder="Sort Order">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="comments" class="col-xs-2 col-form-label">Comments</label>
                    <div class="col-xs-10">
                    <textarea class="form-control"  name="comments" placeholder="Type your comments">{{$valueAddition->comments}}</textarea>
                    </div>
                </div>

                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-success updateValueAddition">Update</button>
                    <a href="{{url('store/'.$store_id.'/admin/valueAddition')}}" class="btn btn-primary">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="clearfix"></div>

    </div>

@stop
@section('scripts')
    {!! HTML::script('local/public/assets/gentelella/js/datatables/jquery.dataTables.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/dataTables.bootstrap.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/dataTables.buttons.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/jszip.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/pdfmake.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/vfs_fonts.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.html5.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datatables/buttons.print.min.js') !!}
    {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/bootstrap-tooltip.js') !!}
    {!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/confirmation.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/pace/pace.min.js') !!}
    {!! HTML::script('local/public/assets/js/jquery.validate.min.js') !!}
    <script>
        var handleDataTableButtons = function () {
                    "use strict";
                    0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "copy",
                            className: "btn-sm"
                        }, {
                            extend: "csv",
                            className: "btn-sm"
                        }, {
                            extend: "excel",
                            className: "btn-sm"
                        }, {
                            extend: "pdf",
                            className: "btn-sm"
                        }, {
                            extend: "print",
                            className: "btn-sm"
                        }],
                        responsive: !0
                    })
                },
                TableManageButtons = function () {
                    "use strict";
                    return {
                        init: function () {
                            handleDataTableButtons()
                        }
                    }
                }();

        jQuery(document).ready(function(e){
            jQuery('#updateValueAddition').validate({
                errorElement : 'span',
                rules : {
                    'name'         : {required:true, alphabet:true,maxlength:25},
                    'code'         : {required:true,maxlength:4 ,alphanumeric:true},
                    'sort_number' : {maxlength:2 ,number:true},
                }
            });
        });
        jQuery.validator.addMethod("alphabet", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);

        },'Name can contain alphabets value only');
        jQuery.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/);
        },'Code can contain alphanumeric value only');

        jQuery(document).on('click','.updateValueAddition',function(e){
            e.preventDefault();
            jQuery('#updateValueAddition').submit();
        });
        $('.close').click(function(e){
            $('.alert').hide('slow');
            $('.alert-error').hide('slow');
        });
    </script>
    <script type="text/javascript">
        TableManageButtons.init();
    </script>

@stop
