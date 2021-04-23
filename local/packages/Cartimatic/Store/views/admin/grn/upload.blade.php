{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 29-Nov-16 12:58 PM
    * File Name    :

--}}
@extends('Store::layouts.store-admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/assets/gentelella/css/maps/jquery-jvectormap-2.0.3.css')!!}"/>
@stop

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h1>Upload GRN</h1>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="ajax-error"></div>
        @include('includes.alerts')
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">

            {!! Form::open(['url'=> 'admin/store/grn/upload','class'=>'','enctype'=>"multipart/form-data"]) !!}
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        Upload GRN
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label for="supplier" class="label-cover">Supplier: </label>
                                    {!! Form::select('supplier', $suppliers, NULL, ['class'=> 'form-control' , 'placeholder'=>'Select', 'id'=>'suppliers', 'required']) !!}
                                </div>

                                <div class="form-group" style="margin-top: 10px">
                                    <label for="batch_number" class="label-cover">PO Number: </label>
                                    {!! Form::select('purchase_order', [], NULL, ['class'=> 'form-control', 'placeholder'=>'', 'id' => 'purchase-order']) !!}
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="supplier" class="label-cover">GRN File: </label>
                                    <input type="file" class="form-control " placeholder=""
                                           aria-describedby="" name="grn_file"
                                           value="">
                                </div>

                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group col-sm-12">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            {!! Form::close() !!}
        </div>
        @stop
        @section('styles')
            {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
            {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
        @stop
        @section('scripts')
            <style>
                .label-cover {
                    width: 116px;
                }

                textarea {
                    resize: vertical;
                }

                .margin-top-10 {
                    margin-top: 10px
                }

                .btn.btn-app {

                    height: auto;
                    margin: 0;
                    min-width: inherit;
                    padding: 6px;
                }
            </style>
            <link rel="stylesheet" href="{!! asset('local/public/assets/css/jquery-ui.min.css') !!}">
            <script type="text/javascript" src="{!! asset('local/public/assets/js/jquery-ui.min.js') !!}"></script>
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
            {!! HTML::script('local/public/assets/gentelella/js/moment/moment.min.js') !!}
            {!! HTML::script('local/public/assets/gentelella/js/datepicker/daterangepicker.js') !!}
            {!! HTML::script('local/public/assets/store/grn.js') !!}

            <script>


                $('.date-picker').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_4",
                    format: 'YYYY-MM-DD'

                });
            </script>
            <script type="text/javascript">
                //TableManageButtons.init();
            </script>
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content row">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>

                    </div>
                </div>
            </div>

@stop
