@extends('Store::layouts.store-admin')
@section('styles')
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
@stop
@section('content')
@include('Admin::alert.alert')
<div class="col-md-12">
    <div class="row">
        <div class="form-group">
            <h1>Add Tax Category</h1>
            @if(Session::has('message'))
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-danger', 'alert-info') }}" aria-label="close">&times;</a>
                    <strong>Error!</strong> {{ Session::get('message') }}
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-success', 'alert-info') }}" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{ Session::get('success') }}
                </div>
            @endif
                <div class="pull-right">
                    <a class="btn btn-primary"
                       href="{{url("store/".Auth::user()->username."/admin/all-tax-categories/")}}"
                       title="All Tax Categories">All Tax Categories</a>
                </div>
        </div>
                <style>
                    .add-form-block div.user-input input{
                        padding: 2px 0px 0px 8px !important;
                    }
                </style>
                <script type="text/javascript">
                    $(function() {

                        setTimeout(function() {
                            $('#display-success').fadeOut('slow');
                        }, 3000);
                        setTimeout(function() {
                            $('#display-error').fadeOut('slow');
                        }, 3000);
                    });
                </script>
</div>
</div>
            <div class="col-md-12">
                <div class="row">
                    <div style="text-align: center;">
                        <img id="loading-div" style="display: none; " src="{{asset('local/public/images/loading.gif')}}" />
                    </div>

                    {!! Form::model(null , ['method' => 'POST', 'url' => "store/".Auth::user()->username."/admin/add-tax-categories","id" =>"addTaxCategory"]) !!}
                        <div class="form-group">
                            <label for="list-item">Name *</label>
                            <input class="form-control" required="required"  value="" type="text" name="name" placeholder="Tax Category Name e.g: GST">
                        </div>

                    <div class="form-group">
                        <label for="list-item">Value * </label>
                        <input class="form-control" value="" required="required"  type="text" name="value" placeholder="Enter Tax Value. e.g: 10">
                    </div>

                    <div class="form-group">
                        <label for="list-item">Tax Code * </label>
                        <input class="form-control" value="" required="required"  type="text" name="tax_code" placeholder="Enter Tax Code. e.g GST8">
                    </div>


                    <div class="form-group">
                            <div class="user-title">In Percent * :</div>
                            <label class="checkbox-inline"><input type="radio" name="is_percent" checked="checked" value="0">&nbsp;In Percent</label>
                            <label class="checkbox-inline"><input type="radio" name="is_percent" value="1">&nbsp; In Value</label>
                        </div>

                        <div class="form-group">
                                <button id="btn-proceed" class="btn btn-success saveTax" type="submit">Save</button>
                                <a href="{{url("store/".Auth::user()->username."/admin/all-tax-categories/")}}" id="btn-proceed" class="btn btn-primary" type="submit">Cancel</a>

                        </div>

                    {!! Form::close() !!}
                </div>
    </div>

<style>
    .user-table div.role {
        width: 120px;
    }
</style>

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
            jQuery('#addTaxCategory').validate({
                errorElement : 'span',
                rules : {
                    'name'         : {required:true,maxlength:25},
                    'tax_code'         : {required:true,maxlength:4 ,alphanum:true},
                    'value' : {number:true}
                }
            });
        });
        jQuery.validator.addMethod("alphanum", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/);
        },'Code can contain alphanumeric value only');

        jQuery(document).on('click','.saveTax',function(e){
            jQuery('#addTaxCategory').submit();
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
