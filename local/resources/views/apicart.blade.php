<!doctype html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
  <title>Singal Category Products</title>
  <link rel="stylesheet" type="text/css" href="{{asset('local/public/assets/api_assets/style.css')}}" />
</head>
<body>
<div class="top-heading-wrapper">
  <div class="back"><a href="#">Back</a></div>
  <div class="title"><h1>Payment</h1></div>
  <div class="misc"></div>
</div>
<div class="cart-detail">
  <div class="select-all">
    <label>Order Summary</label>
  </div>
  <div class="buy-all-wrapper">
    <div class="sub-total">
      <div class="label">Subtotal <span>({{(isset($orderAmountInfo['total_items_in_cart'])?$orderAmountInfo['total_items_in_cart']:'1')}} items)</span></div>
      <div class="amount">{{format_currency((isset($orderAmountInfo['subtotal'])?$orderAmountInfo['subtotal']:'n/a'))}}</div>
    </div>
    <div class="sub-total">
      <div class="label">Shipping</div>
      <div class="amount">{{format_currency((isset($orderAmountInfo['shipping'])?$orderAmountInfo['shipping']:'00'))}}</div>
    </div>
    <div class="total">
      <div class="label">Grand Total</div>
      <div class="amount">{{format_currency($orderAmountInfo['subtotal']+$orderAmountInfo['shipping'])}}</div>
    </div>
  </div>

  <div class="select-all">
    <label>Pay with credit card</label>
  </div>
  <div class="shipping-form">
    @if(isset($e))
      <div>
        {{'Error description: ' . $e->getDescription()}}
      </div>
      <div>
        {{'Error message: ' . $e->getMessage()}}
      </div>
    @endif
    {!! Form::open(['url' => url($prefix.'/store/make-payment/checkout/'.$sellerBrandId.'/'.$cart_token.'?method='.$method), "id" => "paymentForm",  "class"=>"form-wrapper"]) !!}

    <div id="paymentErrors" style="margin-bottom: 10px; color: red; font-weight: bold;"></div>
    <div class="form-item">
      <label for="name">Card holder’s name <span>(Required)</span></label>
      <input data-worldpay="name" placeholder="Name on Card" name="name" type="text" class="form-control" />
    </div>

    <div class="form-item">
      <label for="name">Card number <span>(Required)</span></label>
      <input class="form-control" data-worldpay="number" placeholder="Card Number" size="20" type="text">
    </div>

    <div class="form-item">
      <label for="name">Expiration date <span>(Required)</span></label>

      <div class="clrfix"></div>
      <input data-worldpay="exp-month" class="dy mr20" placeholder="MM" size="2" type="text" />

      <input data-worldpay="exp-year" class="dy" placeholder="YYYY" size="4" type="text" />

      <div class="clrfix"></div>
    </div>

    <div class="form-item">
      <label for="name">Card verification code <span>(Required)</span></label>
      <input class="form-control vcode" data-worldpay="cvc" size="4" type="text" placeholder="cvc">
    </div>
    <div id="loadingIcon" style="text-align:center; display: none;"><img src="{!! asset('local/public/images/loading.gif') !!}" title="Loading please wait.."/></div>
    <a href="javascript:void(0);" id="place_order" class="green-btn payNowBtn">Pay now</a>
    </form>
  </div>
</div>
<?php
$client_key = \Config::get('constants_brandstore.WORLDPAY_CLIENT_KEY');
?>
  <script src="{{asset('local/public/assets/js/jquery.min.js')}}"></script>

  <script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
  <script type="text/javascript">
    $('.payNowBtn').click(function(){
      $("#loadingIcon").show();
      $(".payNowBtn").hide();
    });
    jQuery(document).on("click",'#place_order',function(e){
      e.preventDefault();
      $("#loadingIcon").show();
      $(".payNowBtn").hide();

      $("#loading-div-background").css({ opacity: 0.8 });
      $("#loading-div-background").show();
      //$("#loading-div-background").hide();

      jQuery('#paymentForm').submit();
    });

    var form = document.getElementById('paymentForm');

    Worldpay.useOwnForm({
      'clientKey': '{{$client_key}}',
      'form': form,
      'reusable': true,
      'callback': function(status, response) {
        document.getElementById('paymentErrors').innerHTML = '';
        if (response.error) {
          $("#loadingIcon").hide();
          $(".payNowBtn").show();
          $("#loading-div-background").css({ opacity: 0 });
          $("#loading-div-background").hide();
          Worldpay.handleError(form, document.getElementById('paymentErrors'), response.error);
        } else {
          $("#loadingIcon").show();
          $(".payNowBtn").hide();
          var token = response.token;
          Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
          form.submit();
        }
      }
    });
  </script>

</body>
</html>
