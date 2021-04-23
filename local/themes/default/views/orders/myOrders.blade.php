@extends('layouts.main')

@section('content')
    <div class="col-md-12">
    <div class="row">
      <div class="pro-header">
        <h1>Manage Orders</h1>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="row">
        <div class="row">
          <div class="order-link-wrapper">
            @foreach($countOrdersStatusWise as $key => $value)
              <?php
              $class = '';
              if ($key == $status) {
                $class = 'filter-tab-active';
              }
              if (empty($status) && $key == 'All') {
                $class = 'filter-tab-active';
              }
              ?>
              @if($key == 'ORDER_DISPATCHED')
                <a href="{{url('my-orders?status='.$key)}}" style="text-transform: capitalize;"
                   class="filter_orders {{$class}}" title="Awaiting Delivery">Awaiting Delivery ({{$value}})</a>
              @elseif($key == 'ORDER_DISPUTED')
                <a href="{{url('my-orders?status='.$key)}}" style="text-transform: capitalize;"
                   class="filter_orders {{$class}}" title="Refund Requested ">Refund Requested ({{$value}})</a>
              @else
                <?php $mod_key = strtolower(str_replace('_', ' ', str_replace('ORDER_', '', $key))); ?>
                <a href="{{url('my-orders?status='.$key)}}" style="text-transform: capitalize;"
                   class="filter_orders {{$class}}" title="{{$mod_key}}">{{$mod_key}} ({{$value}})</a>
              @endif
            @endforeach
          </div>

          <div class="order-title-box">
            <div class="col-md-6">Product</div>

            <div class="col-md-4">
              <div class="row">
                <span>Unit Price</span>

                <span>Discount</span>

                <span>Quantity</span>
              </div>
            </div>

            <div class="col-md-2">
              <div class="row">Order Amount</div>
            </div>
          </div>
          @foreach($allOrders as $order)
              <!-- Order Brand Item -->
          <?php $orderAllProducts = getOrderAllProducts($order->id); ?>
          <div class="order-wrapper order_item_{{$order->id}}">


            @foreach($orderAllProducts as $orderProduct)
              <div class="order-list-wrapper">
                <div class="col-md-6">
                  <div class="col-md-3">
                    <?php $product = getProductDetailsByID($orderProduct->product_id);//Complete detail of product
                    if (!isset($product->id)) {
                      continue;
                    }?>
                    <?php
                    if (!isset($orderProduct->product_keeping_id)) {
                      continue;
                    }
                    $productKeeping = getProductKeepingDetail($orderProduct->product_keeping_id);
                    $discountedPercentage = ($productKeeping->price / 100) * $orderProduct->product_discount; ?>
                    <div class="row">
                      <img alt="a" class="img-responsive"
                           src="{{getRandomImageOfProduct($orderProduct->product_id)}}" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';">
                    </div>
                  </div>
                  <div class="col-md-9">
                    <p class="product-det-txt">{{$product->title}}</p>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="row finance">
                    <span> {{format_currency($productKeeping->price)}}</span>

                    <span>{{format_currency($discountedPercentage)}}</span>


                    <span>{{$orderProduct->quantity}}</span>
                  </div>
                </div>

                <div class="col-md-2">
                  <div
                      class="row unit-price">{{format_currency(($productKeeping->price - $discountedPercentage) * $orderProduct->quantity)}}</div>
                </div>
              </div>
            @endforeach

            <div class="order-detail-wrapper">
              <div class="left-col">
                <?php if (isset($product->owner_id)) {
                  $storeName = getUserNameByUserId($product->owner_id);
                } ?>

                <div class="status">Order Status <a
                      href="{{url('order-invoice/'.$order->id)}}" title="View Detail">View
                    Detail</a></div>
                <div>Date: {{$order->created_at}}  </div>
              </div>
              <div class="right-col">
                <div class="sc">Shipment Cost: <span>{{format_currency($order->total_shiping_cost)}}</span></div>
                <div>Order Amount: <span>{{format_currency($order->total_price - $order->total_discount)}}</span></div>
              </div>
            </div>

            <div class="order-status-wrapper">
              <div class="col-md-5">
                <?php
                if (!isset($product->id)) {
                  $data['class']        = '';
                  $data['action_btn_1'] = '';
                  $data['action_btn_2'] = '';
                  $data['status']       = 'Product Deleted';
                  $productPrice         = '';
                } else {
                  $data = getOrderStatusForBuyer($order->id, $order->status, $order);
                }?>
                <div class="status-title order_status_{{$order->id}}">Order Status</div>
                <div class="order-status">{{$data['status']}}</div>
              </div>
              <div class="col-md-5">
                <?php /*<div class="seller-name">Seller name: <a target="_blank"
                                                         href="{{url('store/'.$storeName)}}"> <?php echo $storeName = ucfirst($storeName); ?></a>
                </div>
                <div><a href="{{url('store/'.$storeName)}}">View Profile</a></div>*/?>
              </div>
              <div class="col-md-2 order_action_{{$order->id}} {{$data['class']}}">
                {!! $data['action_btn_1'] !!}
                {!! $data['action_btn_2'] !!}
              </div>
            </div>
          </div>
          @endforeach

          <div class="pagination-wrapper">
            <div class="pages-limit">
              <div class="input-group">
                <label>Show</label>
                <select name="show-record-limit" class="show-record-limit form-control">
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
                <label>per page</label>
              </div>
            </div>

            <div class="pagination-box">
              {!! $allOrders->appends(['status' => $status])->render() !!}
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('footer-scripts')
  @include('includes.searchQueryScript.searchScript')
  <script type="text/javascript">
    $(".show-record-limit").change(function(evt){
      var url = '{{url('my-orders')}}/';
      window.location.href = url+$(".show-record-limit").val();
    });

    $(document).on('click', ".order_delete_btn", function (evt) {
      if (confirm('Are you sure to delete this order?') === false) {
        return false;
      }
      var order_info = evt.target.id;
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      jQuery.ajax({
        url: '{{url("store/order/delete")}}',
        type: "Post",
        data: {order_info: order_info},
        success: function (data) {
          if (/^\d+$/.test(data) != 1) {
            return false;
          }
          $(".order_item_" + data).remove();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert("ERROR:" + xhr.responseText + " - " + thrownError);
        }
      });
    });
    $(document).on('click', ".order_status_btn", function (evt) {
      var order_info = evt.target.id;
      evt.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      jQuery.ajax({
        url: '{{url("store/order/update/order-status")}}',
        type: "Post",
        data: {order_info: order_info},
        success: function (data) {
          if (typeof  data === 'string') {

            return false;
          }
          //{"class":"shipped","status":"Awaiting receiver approval","action_btn_1":"","action_btn_2":""}
          $(".order_action_brn_" + data.order_id).remove();
          $(".order_action_" + data.order_id).html(data.action_btn_1 + data.action_btn_2);
          $(".order_status_" + data.order_id).html(data.status);
          $('#myModal').modal('toggle');
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert("ERROR:" + xhr.responseText + " - " + thrownError);
          return false;
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
        url: '{{url("store/serach-my-orders")}}',
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
@endsection

