@extends('layouts.shopper-main')

@section('content')

  <div class="span12">
    <div class="row">
        <div class="span9">
          <div class="row">
            <h1>Shopping Cart</h1>
          </div>
        </div>
        <div class="span3">
          <div class="row">
            <a href="{{url('/')}}" class="continue-link">Continue Shopping &nbsp; &gt;</a>
          </div>
        </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <?php $totalItems = $subTotal = $totalSaving = $grandTotalItems = $grandTotal = $grandTotalSaving = 0; ?>

  <div class="span12">
    <div class="row">
      @if($countCartProducts > 0)
      <?php $totalSellers = 0; ?>
      @foreach($cartProducts as $brand_id => $products)
      <?php $totalSellers++; ?>
      <div class="cart-box">
            <div class="cart-title-box">
              <div class="seller"><?php
                $brand = getBrandInfo($brand_id);
                ?>

              </div>
              <div class="product-head">
                <div class="span6">
                  <div class="row">Product Name &amp; Details</div>
                </div>
                <div class="span3">Quantity</div>
                <div class="span3">Price</div>
              </div>
            </div>
            @foreach($products as $product)
              <?php $pro = getProductDetailsByID($product['product_id']); ?>

              <div class="product-added-box">
                <div class="span2">
                  <div class="thumb"><img src="{{getRandomImageOfProduct($pro->id)}}" alt="product-image-thumb"></div>
                </div>
                <div class="span4">
                  <div class="product-name">
                    <h1>@if(isset($pro->title)){{ucwords($pro->title)}}@endif</h1>
                    <?php $master_attribute_1 = ''; $master_attribute_2 = ''; $package_id = ''; ?>
                    @if(!empty($product['master_attribute_1']))
                      <?php $productKeeping = getProductKeeping($product['product_id'], $product['master_attribute_1'], $product['master_attribute_2']); ?>
                      <div class="cs">
                        {{ucwords($product['master_attribute_1_label'])}}
                        <span>{{ucwords($product['master_attribute_1_value'])}}</span>
                      </div>
                    @endif
                    <div class="cs">
                      {{ucwords($product['master_attribute_2_label'])}}
                      <span>{{ucwords($product['master_attribute_2_value'])}}</span>
                    </div>
                  </div>
                </div>
                <div class="span3">
                  <div class="input-group select-qty">
                      <span class="input-group-btn">
                          <button type="button" class="btn bdrL glyphicon-minus-btn" data-type="plus" data-field="product_quatity_<?php echo $pro->id ?>">
                            <span class="glyphicon glyphicon-minus" data-field="product_quatity_<?php echo $pro->id ?>"></span>
                          </button>
                      </span>
                    <input id="product_quatity_<?php echo $pro->id ?>" name="product_quatity"
                           value="{{$product['quantity']}}"
                           oninput="quantityUpdate('<?php echo $product['quantity'] ?>','<?php echo $pro->id ?>', event)"
                           type="text" min="1" class="form-control input-number" style="
                text-align: center;
            ">
                      <span class="input-group-btn">
                          <button type="button" class="btn bdrL glyphicon-plus-btn" data-type="plus" data-field="product_quatity_<?php echo $pro->id ?>">
                            <span class="glyphicon glyphicon-plus" data-field="product_quatity_<?php echo $pro->id ?>"></span>
                          </button>
                      </span>
                  </div>
                </div>
                <div class="span2">
                  <?php
                  $price = $productKeeping->price;
                  $discount = 0.00;
                  if ($productKeeping->discount > 0) {
                    $discount = ($productKeeping->discount * $productKeeping->price) / 100;
                    $price    = $price - $discount;
                  }
                  ?>
                  <div class="price row">{{format_currency($price)}} <sub>/ piece</sub></div>
                  <?php
                  $totalItems = $totalItems + ($product['quantity']);
                  $subTotal = $subTotal + ($price * $product['quantity']);
                  $totalSaving = $totalSaving + ($discount * $product['quantity']);

                  $grandTotalItems = $grandTotalItems + ($product['quantity']);
                  $grandTotal = $grandTotal + ($price * $product['quantity']);
                  $grandTotalSaving = $grandTotalSaving + ($discount * $product['quantity']);
                  ?>
                </div>
                <div class="span1">
                  <a class="del-product delete-product"
                     href="{{url('cart/delete/'.$product['product_id'])}}">Delete</a>
                </div>
              </div>
              <div class="clearfix"></div>
            @endforeach
            <div class="span8"></div>
            <div class="span4 t-amount">
              <div class="sep">
                <div class="row">
                  <div class="span2">
                    <div class="subTotal">
                      Subtotal <span>(@if($countCartProducts > 0){{$totalItems}}@else 0 @endif
                        Items)</span>
                    </div>
                  </div>
                  <div class="span2">
                    <div class="sub-price">{{format_currency($subTotal)}}</div>
                  </div>
                  <div class="clrfix"></div>
                  <div class="total-wraper">
                    <div class="span2">
                      <div class="total">
                        Total
                      </div>
                    </div>
                    <div class="span2">
                      <div class="total-price">{{format_currency($subTotal)}}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              @if($countCartProducts > 0)

                <div class="buy-this span3">
                  <a class="btn-proceed btn btn-inverse pull-right" id="btn-proceed"
                     href="{{url('checkout/'.$brand->username.'/'.\Vinkla\Hashids\Facades\Hashids::encode($brand_id))}}">Buy
                  </a>

                </div>
              @endif
            </div>
            <?php $totalItems = $subTotal = $totalSaving = 0; ?>

          </div>
      @endforeach
      @else
        <h1>You have no items in your cart.</h1>
      @endif
    </div>
  </div>
  <div class="clearfix"></div>
      <style type="text/css">
        .error {color: #FF0000}
      </style>
@endsection
@section('footer-scripts')
  <script type="text/javascript">
  $(".glyphicon-minus-btn").click(function(evt){
    var inputId = $(this).data("field");
    var oldValue =  $("#"+inputId).val();
    $("#"+inputId).val(parseInt(oldValue,10) - 1);
    var product_id = inputId.match(/\d+/)[0];
    quantityUpdate(oldValue, product_id, evt);
  });

  $(".glyphicon-plus-btn").click(function(evt){
    var inputId = $(this).data("field");
    var oldValue =  $("#"+inputId).val();
    $("#"+inputId).val(parseInt(oldValue,10) + 1);
    var product_id = inputId.match(/\d+/)[0];
    quantityUpdate(oldValue, product_id, evt);
  });
    var timer = null;
    function quantityUpdate(prev_quantity, product_id, e) {
      e.preventDefault();
      window.clearTimeout(timer);
      timer = window.setTimeout(function () {
        updateProductQuantity(prev_quantity, product_id);
      }, 500);
    }

    updateProductQuantity = function (prev_quantity, product_id) {
      var quantity = $('#product_quatity_' + product_id).val();
      if (prev_quantity == quantity) {
        return false;
      }
      else {
        var a = quantity - prev_quantity;
      }
      var dataString = {
        quantity: quantity,
        product_id: product_id
      };

      $.ajax({
        type: 'POST',
        url: '{{url('store/cart/quantityUpdate')}}',
        data: dataString,
        success: function (response) {
          if (response.message == 'quantity_overflow') {
            jQuery('#over_flow_' + product_id).text(response.message_text).addClass('error');
          } else {
            jQuery('#over_flow_' + product_id).text('');
            location.reload();
          }
        }
      });
    }
    /*updateCart = function () {
      jQuery('#shopping_cart_details').load("{{url('/store/cart #shopping_cart_container')}}", function (response, status, xhr) {
        jQuery('#the_cart').html(jQuery(response).find('#the_cart').html());
      });
    }*/

  </script>
@endsection