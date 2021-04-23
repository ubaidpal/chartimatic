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
                <h1>Generate GRN</h1>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="ajax-error"></div>
        @include('includes.alerts')

        <div class="row">
            {!! Form::open(['url'=> 'admin/store/grn/update','class'=>'form-inline','method'=>'put']) !!}
            {!! Form::hidden('grn_id',$grn['id'],['id' => 'grn-edit', 'data-type' => 'grn-edit']) !!}
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        Generate GRN
                    </div>
                    <div class="x_content">

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="supplier" class="label-cover">Supplier: </label>
                                    {!! Form::select('supplier', $suppliers, $grn['supplier_id'], ['class'=> 'form-control' , 'placeholder'=>'Select', 'id'=>'suppliers']) !!}
                                </div>

                                <div class="form-group" style="margin-top: 10px">
                                    <label for="batch_number" class="label-cover">Batch No: </label>
                                    <input class="form-control" value="{{$grn['id']}}" name="batch_number" id="batch_number" readonly>
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="supplier" class="label-cover">Date: </label>
                                    <input type="text" class="form-control date-picker" placeholder=""
                                           aria-describedby="inputSuccess2Status4" name="date"
                                           value="{{\Carbon\Carbon::parse($grn['date'])->format('Y-m-d')}}">
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="bill_no" class="label-cover">Bill No: </label>
                                    <input class="form-control" name="bill_no" id="bill_no" value="{{$grn['bill_no']}}">
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="bill_date" class="label-cover">Bill Date: </label>
                                    <input class="form-control date-picker" name="bill_date" id="bill_date"
                                           value="{{\Carbon\Carbon::parse($grn['bill_date'])->format('Y-m-d')}}">
                                </div>
                            </div>

                            <div class="col-sm-3">

                                <div class="form-group">
                                    <label for="due_date" class="label-cover">Due Date: </label>
                                    <input class="form-control date-picker" name="due_date" id="due_date"
                                           value="{{\Carbon\Carbon::parse($grn['due_date'])->format('Y-m-d')}}">
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="supplier" class="label-cover">Payment Mode: </label>
                                    <label class="radio-inline">
                                        <input name="payment_mode" type="radio" id="inlineCheckbox1"
                                               value="cash" {{($grn['payment_mode'] == 'cash' ? 'checked':'')}}> Cash
                                    </label>
                                    <label class="radio-inline">
                                        <input name="payment_mode" type="radio" id="inlineCheckbox1"
                                               value="credit" {{($grn['payment_mode'] == 'credit' ? 'checked':'')}}> Credit
                                    </label>
                                </div>
                                <div class="form-group margin-top-10">
                                    <label for="comment" class="label-cover">Comment: </label>
                                    <textarea name="comment" class="form-control" id="comment" rows="5">{{$grn['comment']}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="invoice_number" class="label-cover">Invoice No: </label>

                                    <input class="form-control" name="invoice_number" id="invoice_number"
                                           value="{{$grn['invoice_number']}}">
                                </div>

                                <div class="form-group" style="margin-top: 10px">
                                    <label for="invoice_amount" class="label-cover">Invoice Amount: </label>
                                    <input class="form-control " name="invoice_amount" id="invoice_amount" readonly
                                           value="{{$grn['invoice_amount']}}">
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="loading" class="label-cover">Loading Expense: </label>
                                    <input class="form-control other-expense" name="loading" id="loading"
                                           value="{{$grn['loading_expense']}}">
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="freight" class="label-cover">Freight Expense: </label>
                                    <input class="form-control other-expense" name="freight" id="freight"
                                           value="{{$grn['freight_expense']}}">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="other_expense" class="label-cover">Other Expense: </label>

                                    <input class="form-control other-expense" name="other_expense" id="other_expense"
                                           value="{{$grn['other_expense']}}">
                                </div>

                                <div class="form-group" style="margin-top: 10px">
                                    <label for="adj_amount" class="label-cover">Adj Amount: </label>
                                    <input class="form-control other-expense" name="adj_amount" id="adj_amount" readonly
                                           value="{{$grn['adj_amount']}}">
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="sales_tax" class="label-cover">Sales Tax(%): </label>
                                    <input type="text" class="form-control other-expense" name="sales_tax" id="sales_tax_p"
                                           value="{{$grn['sales_tax']}}">
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="sales_tax_amount" class="label-cover">Sales Tax: </label>
                                    <input type="text" class="form-control" name="sales_tax_amount" id="sales_tax_amount" readonly
                                           value="{{$grn['sales_tax_amount']}}">
                                </div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="total_amount" class="label-cover">Total Amount: </label>
                                    <input type="text" class="form-control" name="total_amount" id="total_amount" readonly
                                           value="{{$grn['total_amount']}}">
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="product_code" class="label-cover">Product Code: </label>

                                    <input class="form-control" name="product_code" id="product_code">
                                    <a class="btn btn-app" title="Type for suggestions">
                                        <i class="fa fa-question-circle"></i>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group" style="margin-top: 10px">
                                    <label for="purchase_order" class="label-cover">Purchase Order: </label>
                                    {!! Form::select('purchase_order',$po, ($grn['object_type']=='purchase_order'?$grn['object_value']:NULL), ['class'=> 'form-control', 'placeholder'=>'Select', 'id' => 'purchase-order','disabled']) !!}
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Products</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="products" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Barcode</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Cost Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(count($grn['products'])> 0)
                                @foreach($grn['products'] as $product)
                                    <tr>
                                        <td>{{$product['product_id']}}</td>
                                        <td>{{$product['product_name']}}</td>
                                        <td>{{$product['barcode']}}</td>
                                        <td>
                                            <input type="number" class="form-control" value="{{$product['quantity']}}"
                                                   name="products{{'['.$product['id'].']['.$product['keeping_id'].']'}}[quantity]">
                                        </td>
                                        <td><input type="number" class="form-control" value="{{$product['price']}}"
                                                   name="products{{'['.$product['id'].']['.$product['keeping_id'].']'}}[price]"></td>
                                        <td>{{$product['cost_price']}}</td>
                                        <td>
                                            <a class="remove-row update" data-id="{{$product['id']}}" data-keeping="{{$product['keeping_id']}}"
                                               title="Delete" href="javascript:void(0)" data-grn="{{$grn['id']}}">
                                                <i class="fa fa-times-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group col-sm-12">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <a href="{{URL::previous()}}" class="btn btn-primary">Cancel</a>
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </div>

                {!! Form::close() !!}
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
