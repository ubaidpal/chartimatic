@extends('Store::layouts.store-admin')

@section('content')
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Purchase Orders</h3>
            </div>
            <div class="pull-right">
                <a href="{{url('store/'.$store_id.'/admin/purchase-order')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Add PO</a>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div>
                            <form class="form-horizontal" method="get" action="{{url('store/'.$store_id.'/admin/purchase-orders')}}" id="searchForm">

                                <label class="col-md-1 control-label">Supplier:</label>
                                <div class="col-md-2">
                                    <select class="form-control input-sm" name="supplier_id">
                                        <option value="">--Select--</option>
                                        @foreach($suppliers as $id => $name)
                                        <option @if($id == $supplier_id) selected @endif value="{{$id}}">{{ucfirst($name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-md-1 control-label">Date From:</label>
                                <div class="col-md-2">
                                    <input type="text" value="{{$invoice_date_start}}" name="invoice_date_start" class="form-control input-sm">
                                </div>

                                <label class="col-md-1 control-label">Date To:</label>
                                <div class="col-md-2">
                                    <input type="text" value="{{$invoice_date_end}}" name="invoice_date_end" class="form-control input-sm">
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-search"></i>&nbsp;Search</button>
                                    <a href="{{url('store/'.$store_id.'/admin/purchase-orders')}}" class="btn btn-link">Clear</a>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Supplier</th>
                                    <th class="text-center" width="5%">PO No</th>
                                    <th class="text-center" width="10%">Total</th>
                                    <th width="12%" class="text-center">Invoice Date</th>
                                    <th width="12%" class="text-center">Delivery Date</th>
                                    <th width="7%">Status</th>
                                    <th>Destination Address</th>
                                    <th class="text-center" width="5%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!$purchase_orders->isEmpty())
                            <?php
                            $count = $purchase_orders->count();
                            $currentPage = $purchase_orders->currentPage();
                            $perPage = $purchase_orders->perPage();
                            $counter = ($perPage * ($currentPage - 1));
                            ?>
                            @foreach($purchase_orders as $purchase_order)
                                <tr>
                                    <td class="text-center">{{++$counter}}</td>
                                    <td class="text-left">{{ucfirst(getSupplierNameByID(ucfirst($purchase_order->supplier_id)))}}</td>
                                    <td class="text-center">{{$purchase_order->id}}</td>
                                    <td class="text-center">{{$purchase_order->po_total}}</td>
                                    <td class="text-center">{{$purchase_order->invoice_date}}</td>
                                    <td class="text-center">{{$purchase_order->delivery_date}}</td>
                                    <td>{{ucfirst($purchase_order->status)}}</td>
                                    <td>{{ucfirst($purchase_order->destination_address)}}</td>
                                    <td class="text-center">
                                        @if($purchase_order->status == 'open')
                                        <a href="{{url('store/'.$store_id.'/admin/purchase-order?po='.$purchase_order->id)}}" class="text-danger"><i class="fa fa-pencil-square-o"></i></a>
                                        @endif
                                        &nbsp;<a href="{{url('store/'.$store_id.'/admin/generatePDF?po='.$purchase_order->id)}}" class=""><i class="fa fa-file-pdf-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="9">No record found.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="pagination">
                            {{$purchase_orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/jquery-ui.min.css') !!}">
    <script type="text/javascript" src="{!! asset('local/public/assets/js/jquery-ui.min.js') !!}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function (e) {
            jQuery('input[name="invoice_date_start"]').datepicker({
                onSelect : function (dateTxt,datepicker) {
                    var minDate = $(this).datepicker('getDate');
                    jQuery('input[name="invoice_date_end"]').datepicker('option','minDate',minDate);
                }
            });
            jQuery('input[name="invoice_date_end"]').datepicker({
                onSelect : function (dateTxt,datepicker) {
                    var maxDate = $(this).datepicker('getDate');
                    jQuery('input[name="invoice_date_start"]').datepicker('option','maxDate',maxDate);
                }
            });
        });
        jQuery(document).on('change','select[name="supplier_id"]',function (e) {
            //$('#searchForm').submit();
        });
        jQuery(document).on('click','.remove-po',function (e) {
            e.preventDefault();
            if(confirm('Are you sure to remove po')){

            }
        });
    </script>
@endsection