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
                <h1>All GRN</h1>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="ajax-error"></div>
        @include('includes.alerts')

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Products</h2>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{url('admin/store/grn/generate')}}">
                                <i class="fa fa-plus-circle"></i>
                                Add GRN
                            </a>
                            <a class="btn btn-primary" href="{{url('admin/store/grn/upload')}}">
                                <i class="fa fa-plus-circle"></i>
                                Upload GRN
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal" method="get" action="{{url('admin/store/grn')}}"
                              id="searchForm">

                            <label class="col-md-1 control-label">Supplier:</label>
                            <div class="col-md-2">
                                {!! Form::select('supplier', $suppliers, $supplier, ['class'=> 'form-control' , 'placeholder'=>'Select', 'id'=>'suppliers']) !!}
                            </div>

                            <label class="col-md-1 control-label">Date From:</label>
                            <div class="col-md-2">
                                <input type="text" value="{{$start}}" name="start" class="form-control input-sm date-picker">
                            </div>

                            <label class="col-md-1 control-label">Date To:</label>
                            <div class="col-md-2">
                                <input type="text" value="{{$end}}" name="end" class="form-control input-sm date-picker">
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i>&nbsp;Search</button>
                                <a href="{{url('store/'.$store_id.'/admin/purchase-orders')}}" class="btn btn-link">Clear</a>
                            </div>
                        </form>
                        <div class="ln_solid"></div>
                        <table id="products" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Bill ID</th>
                                <th>Bill Date</th>
                                <th>Supplier</th>
                                <th>Invoice Id</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Batch No</th>
                                <th>PO</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($grns as $grn)
                                <tr>
                                    <td>{{$grn->bill_no}}</td>
                                    <td>{{\Carbon\Carbon::parse($grn->bill_date)->format('d-m-Y')}}</td>
                                    <td>{{$grn->supplier->name}}</td>
                                    <td>{{$grn->invoice_number}}</td>
                                    <td>{{$grn->total_quantity}}</td>
                                    <td>{{$grn->total_amount}}</td>
                                    <td>{{$grn->id}}</td>
                                    <td>{{($grn->object_value !=0 ?$grn->object_value:'')}}</td>
                                    <td>
                                        <a href="{{url('admin/store/grn/edit/'.$grn->id)}}" class="btn btn-app" title="Press to edit GRN">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{url('admin/store/grn/generate-pdf/'.$grn->id)}}" class="btn btn-app" title="Press to generate PDF">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
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

    <script>

        $("#products").DataTable({
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
            responsive: !0,
            "columnDefs": [
                {
                    "targets": [6],
                    "visible": false,
                    "searchable": false
                }
            ]
        });
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
