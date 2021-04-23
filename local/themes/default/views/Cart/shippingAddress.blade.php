@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <div class="col-md-12">
                    <div class="row">
                        <h1>Checkout</h1>
                        <div id="shippingProductsInfo"></div>
                    </div>
                </div>
                <div class="col-md-3 pull-right">
                    <div class="row">
                        <a href="{{url('store/cart')}}" class="continue-link">Return to Shopping Cart &nbsp; &gt;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="cart-box">
                <div class="head-title">
                    <h1>Select shipping address</h1>
                </div>
                <div class="col-md-12">
                    <div class="row" id="previousUsedAddresses">
                        @foreach($previousAddresses as $previousAddress)
                            <div id="presetShippingAddress_{{$previousAddress->id}}" class="col-md-4">
                                <input id="selectPresetAddress_{{$previousAddress->id}}"
                                       value="{{$previousAddress->id}}" class="addressSelectionRadio" name="prevAddress"
                                       type="hidden">

                                <div class="shiping-address">
                                    <div class="buyer-name">{{ucfirst($previousAddress->first_name).' '.ucfirst($previousAddress->last_name)}}</div>
                                    <address>
                                        {{$previousAddress->st_address_1.' '.$previousAddress->st_address_2}}
                                        <abbr title="Phone">P:</abbr> {{$previousAddress->phone_number}}
                                    </address>

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url("store/add/shipping/address/".$sellerBrandIdEncoded)}}" id="address_box_{{$previousAddress->id}}" data-country="{{$previousAddress->country_id}}" class="btn btn-primary ship_to_btn">Ship to this address</a>
                                        <a href="#" id="{{$previousAddress->id}}" class="btn btn-edit addressSelectionRadio">Edit</a>
                                        <a href="#" class="btn btn-delete delete-address" data-toggle="modal" data-target="#deleteAddress" id="{{$previousAddress->id}}">Delete</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if(count($previousAddresses) == 0)
                            <h1>No Address found, fill below form to create new address.</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="row">
            <div class="cart-box mr15">
                <div class="head-title">
                    <h1>Add New Address</h1>
                </div>
                <div class="col-md-7">
                    <div class="shipping-form mt30">
                        {!! Form::open(['url' => url("store/add/shipping/address/".$sellerBrandIdEncoded), 'class' => 'form-block form-horizontal', 'role' => 'form', 'id' => 'new_shipping_detail', "enctype"=>"multipart/form-data"]) !!}
                    <input type="hidden" id="address_id" name="address_id">
                        <div class="form-box">
                            <label for="full_name">Full name <span>(Required)</span></label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter Full Name">
                            @if($errors->has('first_name'))
                                <span id="cat-error" style="color: red;">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>

                        <div class="form-box">
                            <label for="last_name">Last name <span>(Required)</span></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name">
                            @if($errors->has('last_name'))
                                <span id="cat-error" style="color: red;">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>

                            <div class="form-box">
                                <label for="country_id">Country <span>(Required)</span></label>
                                <?php if(isset($addressData['country_id'])){$countryToBeDeliverd = $addressData['country_id'];}else{$countryToBeDeliverd = (isset(Auth::user()->country))?Auth::user()->country:0;}?>
                                {!!  Form::select('countries', $countries, $countryToBeDeliverd, ['class' => 'form-control' , 'id' => 'countryToBeShipped' ,'required' => 'required'])!!}
                                @if($errors->has('countries'))
                                    <span id="cat-error" style="color: red;">{{ $errors->first('countries') }}</span>
                                @endif
                            </div>

                            <div class="form-box">
                                <label for="st_address_1">Address line 1</label>
                                <input type="text" class="form-control" id="st_address_1" name="st_address_1" placeholder="Enter Address line 1">
                                @if($errors->has('st_address_1'))
                                    <span id="cat-error" style="color: red;">{{ $errors->first('st_address_1') }}</span>
                                @endif
                            </div>

                            <div class="form-box">
                                <label for="address_2">Address line 2</label>
                                <input type="text" class="form-control" id="st_address_2" name="st_address_2" placeholder="Enter Address line 2">
                                @if($errors->has('st_address_2'))
                                    <span id="cat-error" style="color: red;">{{ $errors->first('st_address_2') }}</span>
                                @endif
                            </div>

                            <div class="form-box">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
                                @if($errors->has('city'))
                                    <span id="cat-error" style="color: red;">{{ $errors->first('city') }}</span>
                                @endif
                            </div>


                            <div class="form-box">
                                <label for="name">State/Province/Region</label>
                                <input type="province" class="form-control" id="state" name="state" placeholder="Enter State">
                                @if($errors->has('state'))
                                    <span id="cat-error" style="color: red;">{{ $errors->first('state') }}</span>
                                @endif
                            </div>

                            <div class="form-box">
                                <label for="postal_code">Postal code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter Postal Code">
                                @if($errors->has('zip_code'))
                                    <span id="cat-error" style="color: red;">{{ $errors->first('zip_code') }}</span>
                                @endif
                            </div>

                            <div class="form-box">
                                <label for="phone_number">Phone number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number">
                                @if($errors->has('phone_number'))
                                    <span id="cat-error" style="color: red;">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>

                        <div class="form-box">
                            <label for="email_address">Email address</label>
                            <input class="form-control" type="text" value="{{ @$addressData['email_address']}}" id="email_txt" name="email_address"
                                   placeholder="Email address">
                            @if($errors->has('email_address'))
                                <span id="cat-error" style="color: red;">{{ $errors->first('email_address') }}</span>
                            @endif
                        </div>

                        <div class="form-box">
                            <label for="re_enter_email">Re-enter your email address</label>
                            <input class="form-control" type="text" id="re_enter_email"  name="re_enter_email" value="{{ @$addressData['re_enter_email']}}"
                                   placeholder="Re-enter your email address">
                            @if($errors->has('re_enter_email'))
                                <span id="cat-error" style="color: red;">{{ $errors->first('re_enter_email') }}</span>
                            @endif
                        </div>

                            <button class="btn btn-primary mb15" style="margin-top:0;" type="submit">Ship to this address</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="cart-box">
                <div class="head-title">
                    <h1>ORDER SUMMARY</h1>
                </div>
                <?php $totatlPrice = 0; ?>
                @if($cartProductsCount > 0)
                    <?php $shippingCost = 0; ?>
                    @foreach($cartProducts as $brand_id => $products)
                        @foreach($products as $p)
                                <?php $productKeeping = getProductKeeping($p[ 'product_id' ], $p[ 'master_attribute_1' ], $p[ 'master_attribute_2' ]); ?>
                            <?php
                            $product = getProductDetailsByID($p['product_id']);
                            if(isset($product->shipping_cost)){$shippingCost = $shippingCost + $product->shipping_cost ;}
                            $productOwner = getBrandInfo($brand_id);
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
                <div class="pro-list-wraper productsToBeOrder" id="product_in_cart_{{$product->id}}" data-id="{{$product->id}}">
                    <div class="col-md-6">
                        <div class="product-information">
                            <div class="os">Product Id. <span>{{\Vinkla\Hashids\Facades\Hashids::encode($product->id)}}</span></div>
                            <p>{{$product->title}}</p>
                            <div class="os">Seller: <span>{{$productOwner->displayname}}</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pr">Quantity: {{$p['quantity']}}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="pr">Price: {{format_currency($price)}}</div>
                    </div>
                </div>
                        @endforeach
                    @endforeach
                @endif

                <!--<div class="pro-list-wraper">
                    <div class="col-md-6">
                        <div class="product-information">
                            <div class="os">Order NO. <span>75116634156047</span></div>
                            <p>Striped T Shirts Men Designer Clothes Cross Flag...</p>
                            <div class="os">Seller: <span>Samsung</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="pr">Price: 299.00</div>
                    </div>
                    <div class="col-md-3">
                        <div class="pr">Price: 299.00</div>
                    </div>
                </div>-->

                <div class="subT">
                    <div>Total: <span id="sub_total" class="sub_total">{{format_currency($totatlPrice)}}</span></div>
                    <div>+ Shipping: <span id="shippingCost" class="shippingCost">{{format_currency($shippingCost)}}</span></div>
                </div>

                <div class="gt">
                    <div>Grand Total: <span id="new_total" class="new_total">{{format_currency($totatlPrice+$shippingCost)}}</span></div>
                </div>

            </div>
        </div>
    </div>

    <div id="deleteAddress" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Record</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product in your shipping Address.</p>
                </div>
                <div class="modal-footer">
                    <input class="address_id" type="hidden" name="delParent" value="">
                    <a href="#" class="btn btn-danger delP" data-dismiss="modal">Delete</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('footer-scripts')

    <script src="{!! asset('/local/public/assets/js/jquery.validate.min.js') !!}"></script>

    <script type="text/javascript">

        <?php
        if(isset($productOwner->username)){
                $lastStore = url('store/'.$productOwner->username);
        }else{
                $lastStore = url('/');
        }
        ?>
                jQuery(document).ready(function (e) {
            var lastStoreName = '{{$lastStore}}';

            $("#backToLastStore").attr('href', lastStoreName);
            $.validator.addMethod('customphone', function (value, element) {
                return this.optional(element) || /^[+]?([0-9]*[\.\s\-\(\)]|[0-9]+){3,24}$/.test(value);
            }, "Please enter a valid phone number");

            jQuery('#new_shipping_detail').validate({
                'errorElement': 'span',
                rules: {
                    'countryToBeShipped': {required: true},
                    'first_name': {required: true},
                    'last_name': {required: true},
                    'st_address_1': {required: true},
                    //'st_address_2': {required: true},
                    'city': {required: true},
                    'state': {required: true},
                    'zip_code': {
                        required: true,
                        minlength: 4,
                        digits: true
                    },
                    phone_number: 'customphone',
                    'email_address': { required: true, email: true},
                    're_enter_email': {required: true, equalTo: '#email_txt'}
                }

            });
        });

    </script>
    <script type="text/javascript">
        var notAllowedToContinue = false;

        function checkAvailAbiliity(clicked, address_id) {
            var countryId = $("#countryToBeShipped").val();

            if (countryId == 0) {
                return false;
            }

            var productsToBeOrder = [];

            $(".productsToBeOrder").each(function () {
                productsToBeOrder.push($(this).attr('data-id'));
            });

            if(productsToBeOrder.length < 1){
                var url1 = '{{url('store/cart/your-cart-is-empty' )}}';
                window.location.href = url1;
            }
            var subTotal = $(".sub_total").html();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '{{url("store/checkProductShippingCountry")}}',
                type: "Post",
                data: {products_ids: productsToBeOrder, country_id: countryId, sub_total:subTotal},

                success: function (data) {

                    //var shippingCost = $(".shippingCost").html(data.totalShippingCost);

                    var newTotal = data.grand_total;

                    $(".new_total").html(newTotal);

                    var productsAllowed = '<div id="allowedCountry">';

                    $.each(data.allowedProducts, function (key, val) {
                        productsAllowed += '<div class="allowedProducts">';
                        productsAllowed += $("#product_in_cart_" + val).html();
                        productsAllowed += '</div>';
                    });

                    productsAllowed += "</div>";

                    var countNotAllowedProduct = 0;
                    var productsNotAllowed = '<div class="product-alert"><div class="alert-div">Following items does not deliver to your selected Country/Region.</div>';

                    $.each(data.notAllowedProducts, function (key, val) {
                        countNotAllowedProduct++;
                        productsNotAllowed += '<div class="notAllowedItem">';
                        productsNotAllowed += '<a href="{{url('store/cart/delete-product/')}}/'+val+'" class="remove-items remove-product">Click here to remove</a>';
                        productsNotAllowed += $("#product_in_cart_" + val).html();
                        productsNotAllowed += '</div>';
                    });

                    productsNotAllowed += "</div>";

                    if (countNotAllowedProduct > 0) {

                        notAllowedToContinue = true;
                        $("#shippingProductsInfo").html(productsAllowed + productsNotAllowed);
                    } else {
                        notAllowedToContinue = false;
                        $("#shippingProductsInfo").html('');
                    }

                    if (notAllowedToContinue == false && clicked) {
                        var urlToGo = '<?php echo url("store/add/shipping/address/".$sellerBrandIdEncoded)?>';
                        window.location = urlToGo+"/"+address_id;
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                    console.log("ERROR:" + xhr.responseText + " - " + thrownError);
                    if (notAllowedToContinue) {
                        evt.preventDefault();
                    }
                }
            });
        }

        $(document).ready(function () {
            $(".shipping-address-from-wrap").hide();
            //checkAvailAbiliity();
        });

        jQuery(document).on('change', '#countryToBeShipped', function (e) {
            //checkAvailAbiliity();
        });

        jQuery(document).on('click','.remove-product',function (e) {
            e.preventDefault();
            var url = jQuery(this).attr('href');
            jQuery.ajax({
                url : url
            }).done(function (data) {
                window.location.reload();
            });
        });

        jQuery(document).on('click', '.new_shipping_address_btn', function (e) {
            var country = $("#countryToBeShipped").val();

            if(country == 0){
                $("#countryToBeShipped").val('');
            }
            if (notAllowedToContinue === true) {
                alert('Your order product are not allowed to be shipped in your addressed country, please try again with different country.');
                return false;
            }

            e.preventDefault();
            if (jQuery('#new_shipping_detail').valid()) {
                $(".shipping-address-from-wrap").show();
                jQuery('#new_shipping_detail').submit();
            }else{
                jQuery('.shipping-address-from-wrap').css('display','block')
            }
        });

        jQuery(document).on('click', '#payment_redirect_2', function (e) {
            var country = $("#countryToBeShipped").val();

            if(country == 0){
                $("#countryToBeShipped").val('');
            }
            if (notAllowedToContinue === true) {
                alert('Your order product are not allowed to be shipped in your addressed country, please try again with different country.');
                return false;
            }
            e.preventDefault();
            if (jQuery('#new_shipping_detail').valid()) {
                jQuery('#new_shipping_detail').submit();
            }
        });

        function validate() {
            var country = document.getElementById("form-control").value;
            if (country == 0) {
                document.getElementById("form-control").value = '';
                return false;
            }
        }

        jQuery(document).on('click', '.add-new-address-btn', function (e) {
            $(".shipping-address-from-wrap").show();

            $('#new_shipping_detail').find("input[type=text], input[type=hidden], textarea, tel").val("");

        });

        jQuery(document).on('click', '.addressSelectionRadio', function (e) {
            var id = e.target.id;

            id = id.match(/\d+/)[0];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: '{{url("store/getEditAddressFormInfo")}}',
                type: "Post",
                data: {address_id: id},

                success: function (data) {

                    $.each(data.userAddressesInfo, function (key, val) {

                        if(key==='id'){
                            $("#address_id").val(val);
                        }
                        if(key==='first_name'){
                            $("#first_name").val(val);
                        }
                        if(key==='last_name'){
                            $("#last_name").val(val);
                        }

                        if(key==='country_id'){
                            $("#countryToBeShipped").val(val);
                        }
                        if(key==='st_address_1'){
                            $("#st_address_1").val(val);
                        }
                        if(key==='st_address_2'){
                            $("#st_address_2").val(val);
                        }
                        if(key==='state'){
                            $("#state").val(val);
                        }
                        if(key==='zip_code'){
                            $("#zip_code").val(val);
                        }

                        if( $("#"+key) != undefined){
                            $("#"+key).val(val);

                            if(key==='email'){
                                $("#email_txt").val(val);
                                $("#re_enter_email").val(val);
                            }
                        }
                    });

                   // checkAvailAbiliity();
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });

        $(document).on("click", ".delete-address", function (e) {

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            var address_id = e.target.id;
            $(".address_id").val(address_id);
            return false;
        });

        $('.delP').click(function (e) {
            e.preventDefault();
            var id =  $('.address_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            jQuery.ajax({
                type: "Post",
                url: '{{url('store/sofDeleteAddressInfo')}}',
                data: {address_id: id},
                success: function (data) {
                    if (data > 0) {
                        $("#deleteAddress").hide();
                        $("#presetShippingAddress_" +id).remove();
                    } else {
                        return false;
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });


        jQuery(document).on('click', '.add-new-address-btn', function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();

            $(".payment_redirect_2").remove();

            $("#new_shipping_detail").append('<div class="proceed-container payment_redirect_2"><span class="review-order">Continue to review your order</span><a href="javascript:void(0);" id="payment_redirect_2" class="btn-proceed ">Continue »</a></div>');

            var target = "#new_shipping_detail";
            $('html, body').animate({
                scrollTop: $(target).offset().top - 100
            }, 2000);

        });

        jQuery(document).on('click', '.edit-address', function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".shipping-address-from-wrap").show();

            var id = e.target.id;

            id = id.match(/\d+/)[0];
            $("#selectPresetAddress_"+id).click();

            event.preventDefault();

            $(".payment_redirect_2").remove();

            $("#new_shipping_detail").append('<div class="proceed-container payment_redirect_2"><span class="review-order">Continue to review your order</span><a href="javascript:void(0);" id="payment_redirect_2" class="btn-proceed ">Continue »</a></div>');

            var target = "#new_shipping_detail";
            $('html, body').animate({
                scrollTop: $(target).offset().top - 100
            }, 2000);

        });

        $(".ship_to_btn").click(function(evt){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            evt.preventDefault();
            var btn_id = evt.target.id;

            //var  country_id = $( "#"+btn_id ).data( "country" );
            //$("#countryToBeShipped").val(country_id);
            address_id = btn_id.match(/\d+/)[0];
            var urlToGo = '<?php echo url("store/ship/to/address/".$sellerBrandIdEncoded)?>';
            var goUrl = urlToGo+"/"+address_id;
            window.location.href = goUrl;
            //checkAvailAbiliity(true, address_id);
        });

        $(document).ready(function () {
            var form =  $( "input[name*='selectPresetAddress']" ).val();
            if(form == 'on')
            {
                $(".shipping-address-from-wrap").hide();
            }else{
                $(".shipping-address-from-wrap").show();
            }

        });
    </script>
@endsection
