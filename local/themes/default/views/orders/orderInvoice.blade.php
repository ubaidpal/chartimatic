@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <h1>My Orders</h1>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            @include('includes.inner-sidebar')

            <div class="col-md-9">
                <div class="row">
                    @if(isset($order->order_number))
                    <div class="od-wrapper">
                        <div class="od-inner-wrapper">
                            <div class="od-form-box">
                                <div class="col-md-2">
                                    <label>Order Number:</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="values">
                                        {{$order->order_number}}
                                    </div>
                                </div>
                            </div>
                            <div class="od-form-box">
                                <div class="col-md-2">
                                    <label>Status:</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="values">
                                        <?php $orderStatus = getStatusForBuyerOrderById($order->status);
                                        echo $orderStatus['status'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="od-form-box">
                                <div class="col-md-2">
                                    <label>Reminder:</label>
                                </div>
                                <div class="col-md-10">
                                    <div class="values">
                                        {{ $orderStatus['reminder']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="heading-bar">Shipping information</div>

                        <div class="od-inner-wrapper">
                            <div class="col-md-3">
                                <div class="sp-box">
                                    <div class="title">Courier Company</div>
                                    @if(isset($orderCourier->id))
                                        <div class="text">{{$orderCourier->courier_service_name}}</div>
                                    @else
                                        <div class="ods-ct-item">Order is not dispatched.</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="sp-box">
                                    <div class="title">Tracking Number</div>
                                    @if(isset($orderCourier->id))
                                        <div class="text">{{$orderCourier->order_tracking_number}}</div>
                                    @else
                                        <div class="ods-ct-item">Order is not dispatched.</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="sp-box">
                                    <div class="title">Estimated Delivery Time</div>
                                    @if(isset($orderCourier->id))
                                        <div class="text">{{$orderCourier->delivery_estimated_time}}</div>
                                    @else
                                        <div class="ods-ct-item">Order is not dispatched.</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="sp-box">
                                    <div class="title">Processing Time</div>
                                    @if(isset($orderCourier->id))
                                        <div class="text">{{humanDifferenceInDateNow($orderCourier->date_to_be_delivered)}}</div>
                                    @else
                                        <div class="ods-ct-item">Order is not dispatched.</div>
                                    @endif
                                </div>
                            </div>
                            <div class="clrfix"></div>
                            <div class="shipTo">
                                @foreach($orderAddresses as $orderAddress)
                                    <div class="col-md-8">
                                        <div class="heading">Ship to:</div>
                                        <div class="od-form-box">
                                            <div class="col-md-3">
                                                <label>Contact Name:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="values">
                                                    {{$orderAddress->first_name.' '. $orderAddress->last_name}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="od-form-box">
                                            <div class="col-md-3">
                                                <label>Address:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="values">
                                                    {{$orderAddress->st_address_1.' '.$orderAddress->st_address_2}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="od-form-box">
                                            <div class="col-md-3">
                                                <label>Zip Code:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="values">
                                                    {{$orderAddress->zip_code}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="od-form-box">
                                            <div class="col-md-3">
                                                <label>Mobile:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="values">
                                                    {{$orderAddress->phone_number}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="od-form-box">
                                            <div class="col-md-3">
                                                <label>Tel:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="values">
                                                    {{$orderAddress->phone_number}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="store-name">Buyer Name:{{$orderAddress->first_name.' '. $orderAddress->last_name}}</div>
                                        <!--<div><a href="java">View Profile</a></div>-->
                                    </div>
                                @endforeach
                            </div>

                            <div class="heading-bar">Financial information</div>

                            <div class="od-inner-wrapper">
                                <div class="financial-box">
                                    <div class="head">Total Amount:</div>
                                    <div class="col-md-6">
                                        <div class="sp-box">
                                            <div class="title">Price</div>
                                            <div class="text">{{format_currency($order->total_price - $order->total_shiping_cost)}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Shipping Cost</div>
                                            <div class="text">{{format_currency($order->total_shiping_cost)}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Total Amount</div>
                                            <div class="text">{{format_currency($order->total_price - $order->total_discount) }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="financial-box">
                                    <div class="head">Payment Received:</div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Total</div>
                                            @foreach($orderPayments as $orderPayment)
                                                <div class="text">{{format_currency($orderPayment->total_amount)}}</div>
                                            @endforeach                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Received</div>
                                            @foreach($orderPayments as $orderPayment)
                                                <div class="text">{{format_currency($orderPayment->amount)}}</div>
                                            @endforeach                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Payment Method</div>
                                            @foreach($orderPayments as $orderPayment)
                                                <div class="text">{{getPaymentGateway($orderPayment->gateway_id)}}</div>
                                            @endforeach                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Date</div>
                                            @foreach($orderPayments as $orderPayment)
                                                <div class="text">{{$orderPayment->created_at}}</div>
                                            @endforeach                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="heading-bar">Order details</div>

                            <div class="od-inner-wrapper">
                                <?php $orderAllProducts = getOrderAllProducts( $order->id ); ?>
                                @foreach($orderAllProducts as $orderProduct)
                                    <?php $product = getProductDetailsByID( $orderProduct->product_id );//Complete detail of product ?>

                                    <div class="product-list">
                                    <div class="col-md-5">
                                        <div class="sp-box row">
                                            <div class="title">Product Details</div>
                                            <div class="text">
                                                <div class="col-md-4">
                                                    <?php $imageThumb = getRandomImageOfProduct($product->id, 'product_thumb' ); ?>
                                                    <img alt="a" class="img-responsive" src="{{$imageThumb}}">
                                                </div>
                                                <div class="col-md-8">
                                                    {{$product->title}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-2">
                                            <div class="sp-box">
                                                <div class="title">Price Per Unit</div>
                                                <div class="text"> <?php
                                                    $productKeeping = getProductKeepingDetail($orderProduct->product_keeping_id);

                                                    $discountValue = ($productKeeping->price / 100) * $productKeeping->discount ?>{{format_currency($productKeeping->price)}}</div>
                                            </div>
                                        </div>
                                    <div class="col-md-1">
                                        <div class="sp-box row">
                                            <div class="title">Quantity</div>
                                            <div class="text">{{$orderProduct->quantity}} Piece</div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="sp-box">
                                            <div class="title">Order Total</div>
                                            <div class="text">{{format_currency(($productKeeping->price - $discountValue ) * $orderProduct->quantity)}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="sp-box">
                                            <div class="title">Status</div>
                                            <div class="text"><?php echo $orderStatus['status'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="total-amount">
                                <div class="col-md-3 col-md-offset-5">
                                    <div class="txt">
                                        Product Amount
                                    </div>
                                    <div class="amount">
                                        {{format_currency($order->total_price - $order->total_shiping_cost)}}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="txt">
                                            Shipping Cost
                                        </div>
                                        <div class="amount">
                                            {{format_currency($order->total_shiping_cost)}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="txt">
                                        Total Amount
                                    </div>
                                    <div class="amount">
                                        {{format_currency($order->total_price - $order->total_discount)}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <h3>No Order Invoice Found</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
