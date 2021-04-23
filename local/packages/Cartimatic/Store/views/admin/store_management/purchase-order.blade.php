@extends('Store::layouts.store-admin')
@section('styles')
    <style type="text/css">
        .overlay{z-index:50;background: rgba(255,255,255,0.5);display: none;}
        .overlay .fa{position: absolute;left: 50%;top: 50%;z-index: 50;}
    </style>
@endsection
@section('content')
    <div>
        <div class="page-title">
            <div class="title_left">
                <h3>Add Purchase Order</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm save-po" href="#">Save</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin fa-3x"></i>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal" id="addPOForm" method="post" action="{{url('store/'.$store_id.'/admin/postPurchaseOrder')}}">
                            <input type="hidden" name="po_id" @if(!empty($po->id)) value="{{$po->id}}" @endif>
                            <div class="form-group">
                                <label class="control-label col-md-3">Supplier : <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <select class="form-control" name="supplier">
                                        <option value="">--Select--</option>
                                        @foreach($suppliers as $id => $name)
                                            <?php $selected = ''; ?>
                                            @if(old('supplier') == $id)
                                                <?php $selected = 'selected'; ?>
                                            @elseif(!empty($po->id) && $po->supplier_id == $id)
                                                <?php $selected = 'selected'; ?>
                                            @endif
                                        <option {{$selected}} value="{{$id}}">{{ucfirst($name)}}</option>
                                        @endforeach
                                    </select>
                                    <label id="supplier-error" class="error text-danger" for="supplier">{{@$errors->first('supplier')}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Reference No:</label>
                                <div class="col-md-4">
                                    <input type="text" name="reference_no" class="form-control" placeholder="Reference Number" @if(!empty($po->reference_no)) value="{{$po->reference_no}}" @endif>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Invoice Date : <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <?php $invoice_date = ''; ?>
                                    @if(old('invoice_date'))
                                    <?php $invoice_date = old('invoice_date'); ?>
                                    @elseif(!empty($po->invoice_date))
                                    <?php $invoice_date = $po->invoice_date; ?>
                                    @endif
                                    <input type="text" name="invoice_date" class="form-control" readonly placeholder="Invoice Date" value="{{$invoice_date}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Delivery Date : <span class="text-danger">*</span></label>
                                <div class="col-md-4">
                                    <?php $delivery_date = ''; ?>
                                    @if(old('delivery_date'))
                                        <?php $delivery_date = old('delivery_date'); ?>
                                    @elseif(!empty($po->delivery_date))
                                        <?php $delivery_date = $po->delivery_date; ?>
                                    @endif
                                    <input type="text" name="delivery_date" class="form-control" readonly placeholder="Delivery Date" value="{{$delivery_date}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Destination Address:</label>
                                <div class="col-md-4">
                                    <textarea cols="8" placeholder="Destination Address" name="destination_address" class="form-control">@if(!empty($po->destination_address)){{$po->destination_address}} @endif</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Product</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control search-product" placeholder="Search products">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary trigger-file">Load Products</button>
                                    <label class="text-danger file-upload-error"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-2">
                                    <table class="table table-condensed table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Name</th>
                                                <th class="text-left">&nbsp;</th>
                                                <th class="text-left">&nbsp;</th>
                                                <th class="text-left" width="10%">Unit Price</th>
                                                <th class="text-center" width="4%">Quantity</th>
                                                <th>Comments</th>
                                                <th class="text-center" width="5%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="poProductsContainer">
                                            @if(!empty($poProducts))
                                            @foreach($poProducts as $product)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="items[{{$product->product_keeping_id}}][product_id]" value="{{$product->product_id}}">
                                                    <input type="hidden" name="items[{{$product->product_keeping_id}}][id]" value="{{$product->id}}">
                                                    <input type="hidden" name="items[{{$product->product_keeping_id}}][keeping_id]" value="{{$product->product_keeping_id}}">
                                                    {{$product->name}}
                                                </td>
                                                <td>{{$product->master_attribute_1}}</td>
                                                <td>{{$product->master_attribute_2}}</td>
                                                <td><input type="text" name="items[{{$product->product_keeping_id}}][unit_price]" value="{{$product->unit_price}}"></td>
                                                <td><input type="number" name="items[{{$product->product_keeping_id}}][quantity]" value="{{$product->quantity}}"></td>
                                                <td><textarea rows="1" name="items[{{$product->product_keeping_id}}][comments]">{{$product->comments}}</textarea></td>
                                                <td>
                                                    <a href="#" class="remove-row text-danger"><i class="fa fa-remove"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @if($errors->has('items'))
                                    <label class="text-danger product-selection-error">Please select atleast one product</label>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-7">&nbsp;</label>
                                <div class="col-md-2">
                                    <a href="{{url('store/'.$store_id.'/admin/purchase-orders')}}" class="btn btn-link">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="file" style="visibility: hidden;" id="file_upload" name="po_file">
@endsection

@section('scripts')
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/jquery-ui.min.css') !!}">
    <script type="text/javascript" src="{!! asset('local/public/assets/js/jquery-ui.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/js/jquery.validate.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/js/jquery.fileupload.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/js/jquery.iframe-transport.js') !!}"></script>

    <script type="text/javascript">
        $(document).ajaxStart(function () {
            $(".overlay").show();
        });

        $(document).ajaxStop(function () {
            $(".overlay").hide();
        });
        jQuery(document).ready(function (e) {

            $('#file_upload').fileupload({
                url: '{{url('store/'.$store_id.'/admin/upload')}}',
                done : function (e, data) {
                    $('.file-upload-error').text('');
                    if (typeof data.result.error != 'undefined' && data.result.error == 1) {
                        $('.file-upload-error').text(data.result.message);
                    } else {
                        $.each(data.result, function (index, val) {
                            po.addPOProduct(
                                    val.product_id,
                                    val.keeping_id,
                                    val.cost_price,
                                    val.title,
                                    val.master_attribute_1,
                                    val.master_attribute_1_value,
                                    val.master_attribute_2,
                                    val.master_attribute_2_value,
                                    val.quantity
                            );
                        })
                    }
                }
            });

            jQuery('input[name="invoice_date"]').datepicker({
                dateFormat : 'yy-mm-dd',
                maxDate : '{{$delivery_date}}',
                onSelect : function (dateTxt,datepicker) {
                    var minDate = $(this).datepicker('getDate');
                    jQuery('input[name="delivery_date"]').datepicker('option','minDate',minDate);
                }
            });
            jQuery('input[name="delivery_date"]').datepicker({
                dateFormat : 'yy-mm-dd',
                minDate : '{{$invoice_date}}',
                onSelect : function (dateTxt,datepicker) {
                    var maxDate = $(this).datepicker('getDate');
                    jQuery('input[name="invoice_date"]').datepicker('option','maxDate',maxDate);
                }
            });

            jQuery('.search-product').autocomplete({
                source : '{{url('store/'.$store_id.'/admin/searchProducts')}}'
            })
            .data( "ui-autocomplete" )._renderItem = function (ul, item) {
                return $("<li class='add-po-product'>")
                        .data("item.ui-autocomplete", item)
                        .append("<a data-master-attribute-2-value='"+item.master_attribute_2_value+"' data-master-attribute-1-value='"+item.master_attribute_1_value+"'  data-master-attribute-1='"+item.master_attribute_1+"' data-master-attribute-2='"+item.master_attribute_2+"' data-title='"+item.title+"' data-id='"+item.id+"' data-keeping-id='"+item.keeping_id+"' data-unit-price='"+item.cost_price+"'>" + item.title + '<br>' + item.master_attribute_1 + '&nbsp;:&nbsp;' + item.master_attribute_1_value + '&nbsp;|&nbsp;' + item.master_attribute_2 + '&nbsp;:&nbsp;' + item.master_attribute_2_value + "</a>")
                        .appendTo(ul);
            };
        });
        jQuery('#addPOForm').validate({
            rules : {
                'supplier' : {required:true},
                'invoice_date' : {required:true},
                'delivery_date' : {required:true},
            }
        });
        jQuery(document).on('click','.save-po',function (e) {
            $('#addPOForm').submit();
        });
        jQuery('body').on('click','.add-po-product',function (e) {
            $this = $(this).find('a');
            var product_id = $this.data('id');
            var keeping_id = $this.data('keeping-id');
            var unit_price = $this.data('unit-price');
            var title = $this.data('title');
            var master_attribute_1 = $this.data('master-attribute-1');
            var master_attribute_1_value = $this.data('master-attribute-1-value');

            var master_attribute_2 = $this.data('master-attribute-2');
            var master_attribute_2_value = $this.data('master-attribute-2-value');

            po.addPOProduct(product_id,keeping_id,unit_price,title,master_attribute_1,master_attribute_1_value,master_attribute_2,master_attribute_2_value);
        });

        jQuery(document).on('click','.remove-row',function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        jQuery(document).on('click','.trigger-file',function (e) {
            $('#file_upload').trigger('click');
        });

        po = {
            addPOProduct : function (product_id,keeping_id,unit_price,title,master_attribute_1,master_attribute_1_value,master_attribute_2,master_attribute_2_value,quntity) {
                quntity = typeof quntity != 'undefined' ? quntity : 1;
                myHtml = '<tr>';
                myHtml += '<input type="hidden" name="items['+keeping_id+'][product_id]" value="'+product_id+'">';
                myHtml += '<input type="hidden" name="items['+keeping_id+'][keeping_id]" value="'+keeping_id+'">';
                myHtml += '<input type="hidden" name="items['+keeping_id+'][name]" value="'+title+'">';
                myHtml += '<input type="hidden" name="items['+keeping_id+'][master_attribute_1]" value="' + master_attribute_1 +'&nbsp;:&nbsp;'+ master_attribute_1_value + '">';
                myHtml += '<input type="hidden" name="items['+keeping_id+'][master_attribute_2]" value="' + master_attribute_2 +'&nbsp;:&nbsp;'+ master_attribute_2_value + '">';
                myHtml += '<td>' + title + '</td>';
                myHtml += '<td>'+ master_attribute_1 + '&nbsp;:&nbsp;' + master_attribute_1_value + '</td>';
                myHtml += '<td>'+ master_attribute_2 + '&nbsp;:&nbsp;' + master_attribute_2_value + '</td>';
                myHtml += '<td><input type="text" name="items['+keeping_id+'][unit_price]" value="' + unit_price + '"></td>';
                myHtml += '<td><input type="number" name="items['+keeping_id+'][quantity]" min="0" value="' +quntity + '"></td>';
                myHtml += '<td><textarea rows="1" name="items['+keeping_id+'][comments]"></textarea></td>';
                myHtml += '<td><a href="#" class="remove-row text-danger"><i class="fa fa-remove"></i></a></td>';
                myHtml += '</tr>';

                $('#poProductsContainer').append(myHtml);
                $('.product-selection-error').hide();
            }
        }
    </script>
@endsection