@extends('Store::layouts.store-admin')
@section('content')
        <!-- page content -->
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Orders
            </h3>
        </div>

        <div class="title_right">
            {!! Form::open(['url'=>url('store/'.Auth::user()->username.'/admin/orders')]) !!}
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" name="order_number" value="{{$order_number}}" class="order_number_txt form-control" placeholder="Enter order number">
                  <span class="input-group-btn">
                            <button type="submit" class="btn btn-default" type="button">Go!</button>
                        </span>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="bsm-nav">
                        @foreach($countOrdersStatusWise as $key => $value)
                            <?php
                            $class = '';
                            if($key == $status){
                                $class = 'filter-tab-active';
                            }
                            if(empty($status) && $key == 'All'){
                                $class = 'filter-tab-active';
                            }
                            ?>
                            @if($key == 'ORDER_DISPATCHED')
                                <a href="{{url('store/'.Auth::user()->username.'/admin/orders?status='.$key)}}" style="text-transform: capitalize;" class="filter_orders {{$class}}">Awaiting Acceptance ({{$value}})</a>
                            @elseif($key == 'ORDER_DISPUTED')
                                <a href="{{url('store/'.Auth::user()->username.'/admin/orders?status='.$key)}}" style="text-transform: capitalize;" class="filter_orders {{$class}}">Refund Requests ({{$value}})</a>
                            @else
                                <a href="{{url('store/'.Auth::user()->username.'/admin/orders?status='.$key)}}" style="text-transform: capitalize;" class="filter_orders {{$class}}">{{strtolower(str_replace('_',' ',str_replace('ORDER_','',$key)))}} ({{$value}})</a>
                            @endif
                        @endforeach
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <section class="content invoice">


                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Product Title</th>
                                        <th>Unit Price</th>
                                        <th>Discount #</th>
                                        <th>Qty</th>
                                        <th>Affiliate Amount</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($allOrders as $order)
                                        <?php $orderAllProducts = getOrderAllProducts($order->id); ?>
                                        @foreach($orderAllProducts as $orderProduct)
                                            <?php
                                            //Complete detail of product
                                            $product = getProductDetailsByID($orderProduct->product_id);
                                            if (!isset($product->id)) {
                                                    continue;
                                            }
                                            ?>
                                            @if(isset($product))
                                                <tr>

                                                    <td>
                                                        <a href="{{url('product/'.$product->id)}}">
                                                            <img src="{{getRandomImageOfProduct($product->id)}}"
                                                                 class="thumbnail img-responsive" onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';">
                                                        </a>


                                                    </td>
                                                    <td> {{$product->title}}</td>
                                                    <?php $discountedPercented =  $orderProduct->product_discount; ?>
                                                    <td>{{format_currency($orderProduct->product_price)}}</td>
                                                    <td>{{format_currency($discountedPercented)}}</td>
                                                    <td class="order_product_qty_{{$order->id}}">{{$orderProduct->quantity}}</td>
                                                    <td>{{format_currency($orderProduct->affiliate_reward_amount)}}</td>
                                                    <td>{{format_currency($orderProduct->product_price - $discountedPercented)}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <?php if(!isset($product->owner_id)) {
                                            $storeName = 'Kinnect2 Store';
                                        } else {
                                            $storeName = getUserNameByUserId($product->owner_id);
                                        }
                                        $buyer = getUserDetail($order->customer_id);
                                        ?>
                                        <tr>
                                            <td>
                                                Order ID: {{$order->order_number}}
                                                <a href="{{url('store/'.$storeName.'/admin/order-invoice/'.$order->id)}}"
                                                   class="text-primary">
                                                    View Detail
                                                </a>

                                                <div class="clearfix"></div>
                                                Order time & date: {{getTimeByTZ($order->created_at,'H:m | M. d Y')}}
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                @if(isset($product->owner_id))
                                                    Buyer Name:
                                                    <!--<a href="{{profileAddress( $buyer )}}" class="text-primary">-->
                                                        @if(isset($buyer->id))
                                                            {{ucfirst($buyer->displayname)}}
                                                        @else {{ \Config::get("constants.SITE_DISPLAY_NAME") }} User
                                                        @endif
                                                    <!--</a>-->
                                                @endif
                                            </td>
                                            <?php $productPrice = $order->total_price - $order->total_discount; ?>
                                            <td class="text-right" colspan="4">Shipping
                                                Cost: {{format_currency($order->total_shiping_cost)}}
                                                <div class="clearfix"></div>
                                                Total Affiliate Amount: {{format_currency($order->total_affiliate_amount)}}
                                                <div class="clearfix"></div>
                                                Order Amount: {{format_currency($productPrice - $order->total_affiliate_amount)}}
                                            </td>
                                        </tr>
                                        <?php
                                        if(!isset($product->id)) {
                                            $data[ 'class' ]        = '';
                                            $data[ 'action_btn_1' ] = '';
                                            $data[ 'action_btn_2' ] = '';
                                            $data[ 'status' ]       = 'Product Deleted';
                                            $productPrice           = '';
                                        } else {
                                            $data = getOrderStatusForSeller($order->id, $order->status);
                                        }?>
                                        <tr class="" style="background-color: #373a3c; color: #FFFFFF">
                                            <td colspan="3" class="">
                                                Order Status
                                                <div class="clearfix"></div>
                                                <strong class="order_status_{{$order->id}}">{{$data['status']}}</strong>
                                            </td>

                                            <td class="text-right order_action_{{$order->id}} {{$data['class']}}"
                                                colspan="5">
                                                {!! $data['action_btn_1'] !!}
                                                {!! $data['action_btn_2'] !!}
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on('click', ".order_delete_btn", function (evt) {
            jQuery('#delete_order_id').val(evt.target.id);
            var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
            $("body").append(appendthis);
            $(".modal-overlay").fadeTo(500, 0.7);
            jQuery('#confirmationOfOrderDelete').show();
        });

        jQuery(document).on('click','.confrim_delete_order',function (e) {
            var order_info = jQuery('#delete_order_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '{{url("store/".Auth::user()->username."/admin/order/delete")}}',
                type: "Post",
                data: {order_info: order_info},
                success: function (data) {
                    if (/^\d+$/.test(data) != 1) {
                        alert(data);
                        return false;
                    }
                    $(".order_item_" + data).remove();

                    $(".modal-box, .modal-overlay").fadeOut(500, function () {
                        $(".modal-overlay").remove();
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });

        $(document).on('click', ".order_status_btn", function (evt) {
            var order_info = evt.target.id;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '{{url("store/".$user->username."/admin/update/order-status")}}',
                type: "Post",
                data: {order_info: order_info},
                success: function (data) {
                    //{"class":"shipped","status":"Awaiting receiver approval","action_btn_1":"","action_btn_2":""}
                    $(".order_action_brn_" + data.order_id).remove();
                    $(".order_action_" + data.order_id).html(data.action_btn_1 + data.action_btn_2);
                    $(".order_status_" + data.order_id).html(data.status);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });
        $(document).on('keyup', ".search_order", function (evt) {
            var order_number = $("#search_order_number").val();
            var product_name = $("#search_product_name").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '{{url("store/".Auth::user()->username."/admin/serach-my-orders")}}',
                type: "Post",
                data: {order_number: order_number, product_name: product_name},
                success: function (data) {
                    $("#nothing_found").remove();
                    if (typeof  data === 'string') {
                        $(".orderb-item").remove();
                        $(data).insertAfter(".bsmo-nav");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });
    </script>
    @if(Auth::Check())
        <script>
            $(document).on("click", ".out_of_stock_fa_close", function (evt) {
                $("#custom_notifications").fadeOut();
            });
        </script>
        {!! getOutOfStockProducts(Auth::user()->id, 1) !!}
    @endif
@endsection
