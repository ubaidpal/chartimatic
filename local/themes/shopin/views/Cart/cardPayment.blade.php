@extends('layouts.default')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <h1>Payment</h1>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="cart-box mr15">
                        <div class="title-box bdrB">
                            <h1>Pay with card</h1>

                            <div class="payment_options"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="shipping-form">
                                @if(isset($e))
                                    <div>
                                        {{'Error description: ' . $e->getDescription()}}
                                    </div>
                                    <div>
                                        {{'Error message: ' . $e->getMessage()}}
                                    </div>
                                @endif
                                {!! Form::open(['url' => url('store/makePayment/'.$sellerBrandIdEncoded.'?method='.$method), "id" => "paymentForm",  "class"=>"form-block"]) !!}
                                <div id="paymentErrors" style="margin-bottom: 10px; color: red; font-weight: bold;"></div>
                                <div class="form-box">
                                    <label for="name">Card holder’s name <span>(Required)</span></label>
                                    <input data-worldpay="name" placeholder="Name on Card" name="name" type="text" class="form-control" />
                                </div>

                                <div class="form-box">
                                    <label for="name">Card number <span>(Required)</span></label>
                                    <input class="form-control" data-worldpay="number" placeholder="Card Number" size="20" type="text">
                                </div>

                                <div class="form-box">
                                    <label for="name">Expiration date <span>(Required)</span></label>

                                    <div class="clrfix"></div>
                                    <input data-worldpay="exp-month" placeholder="MM" size="2" type="text" />

                                    <input data-worldpay="exp-year" placeholder="YYYY" size="4" type="text" />

                                    <div class="clrfix"></div>
                                </div>

                                <div class="form-box">
                                    <label for="name">Card verification code <span>(Required)</span></label>
                                    <input class="form-control vcode" data-worldpay="cvc" size="4" type="text" placeholder="cvc">
                                </div>
                                <div id="loadingIcon" style="text-align:center; display: none;"><img src="{!! asset('local/public/images/loading.gif') !!}" title="Loading please wait.."/></div>
                                <button class="btn btn-default payNowBtn" type="submit">Pay now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="cart-box">
                        <div class="title-box bdrB">
                            <h1>ORDER SUMMARY</h1>
                        </div>
                        <?php $totatlPrice = 0; ?>
                        @if($cartProductsCount > 0)
                            <?php $shippingCost = 0; ?>
                            @foreach($cartProducts as $brand_id => $products)
                                @foreach($products as $p)
                                        <?php $productKeeping = getProductKeeping($p[ 'product_id' ], $p[ 'master_attribute_1' ], $p[ 'master_attribute_2' ]); ?>
                                    <?php
                                    $product   = getProductDetailsByID($p['product_id']);
                                    if(isset($product->shipping_cost)){$shippingCost = $shippingCost + $product->shipping_cost ;}
                                    $productOwner = getBrandInfo($product->owner_id);
                                    $price = 0;
                                    if(isset($productKeeping->price)){
                                        $price = $productKeeping->price;
                                    }

                                    if(!empty($productKeeping->discount)){
                                        $discount = ($price * $productKeeping->discount)/100;
                                        $price = $price - $discount;
                                    }
                                    $totatlPrice = $totatlPrice + ($price * $p['quantity']);
                                    ?>
                                        <div class="pro-list-wraper">
                                            <div class="col-md-8">
                                                <div class="product-information">
                                                    <div class="os">Product Id. <span>{{$product->id}}</span></div>
                                                    <p>{{$product->title}}</p>

                                                    <div class="os">Seller: <span>{{$productOwner->displayname}}</span></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="pr">Price: {{format_currency($price)}}</div>
                                            </div>
                                        </div>
                                @endforeach
                            @endforeach
                        @endif

                        <div class="subT">
                            <div>Total: {{format_currency($totatlPrice)}}</div>
                            <div>+ Shipping: {{format_currency($shippingCost)}}</div>
                        </div>

                        <div class="gt">
                            <div>Grand Total: <span>{{format_currency($totatlPrice + $shippingCost)}}</span></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #loading-div-background
        {
            display:none;
            position:fixed;
            top:0;
            left:0;
            background:black;
            width:100%;
            height:100%;
        }#loading-div
         {
             width: 300px;
             height: 200px;
             text-align:center;
             position:absolute;
             left: 50%;
             top: 50%;
             margin-left:-150px;
             margin-top: -100px;
         }


    </style>
    <div id="loading-div-background">
        <div id="loading-div" class="ui-corner-all" >
            <img style="width: 38px;" src="{!! asset('local/public/images/loading.gif') !!}" alt="Loading.."/>
            <h2 style="color:gray;font-weight:normal;margin-top: 25px;">Please wait....</h2>
        </div>
    </div>

    <?php
    $client_key = \Config::get('constants_brandstore.WORLDPAY_CLIENT_KEY');
    ?>
@section('footer-scripts')
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
    @endsection
@endsection
