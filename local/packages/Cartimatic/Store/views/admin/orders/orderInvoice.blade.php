@extends('Store::layouts.store-admin')
<?php use Vinkla\Hashids\Facades\Hashids;
?>
<link rel="stylesheet" href="{!! asset('local/public/assets/css/cartimatic-main.css') !!}">
<link rel="stylesheet" href="{!! asset('local/public/assets/bootstrap/style.css') !!}">

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <h1>Order Invoice</h1>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">

            <div class="col-md-12">
                <div class="row">
                    <div class="od-wrapper">
                        <div class="dispute-wrapper">
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
                                            echo $orderStatus[ 'status' ] ?>
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
                        </div>

                        <div class="dispute-wrapper">
                            <div class="messages-title bdrB">Shipping information</div>
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
                                            <div class="store-name">Store
                                                Name: {{ucwords($url_user_id)}}</div>
                                            <div><a href="{{url('store/'.$url_user_id)}}">View Profile</a></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="dispute-wrapper">
                            <div class="messages-title bdrB">Financial information</div>
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
                                            <div class="title">Affiliate Amount</div>
                                            <div class="text">{{format_currency($order->total_affiliate_amount)}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Total Amount</div>
                                            <div class="text">{{format_currency($order->total_price - $order->total_discount - $order->total_affiliate_amount) }}</div>
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
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Received</div>
                                            @foreach($orderPayments as $orderPayment)
                                                <div class="text">{{format_currency($orderPayment->amount)}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Payment Method</div>
                                            @foreach($orderPayments as $orderPayment)
                                                <div class="text">{{getPaymentGateway($orderPayment->gateway_id)}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-box">
                                            <div class="title">Date</div>
                                            @foreach($orderPayments as $orderPayment)
                                                <div class="text">{{$orderPayment->created_at}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dispute-wrapper">
                            <div class="messages-title bdrB">Order details</div>
                            <div class="od-inner-wrapper">
                                <div class="od-inner-wrapper">

                                <?php $orderAllProducts = getOrderAllProducts($order->id); ?>
                                @foreach($orderAllProducts as $orderProduct)
                                    <?php
                                        $product = getProductDetailsByID($orderProduct->product_id);//Complete detail of product
                                        $productKeepingInfo = getProductKeepingById($orderProduct->product_keeping_id);
                                    ?>
                                    <div class="product-list">
                                        <div class="col-md-5">
                                            <div class="sp-box row">
                                                <div class="title">Product Details</div>
                                                    <div class="text">
                                                        <div class="col-md-4">
                                                            <?php $imageThumb = getRandomImageOfProduct($product->id) ?>
                                                            <img alt="a" class="img-responsive" onError="this.onerror=null;this.src='{{getProductDefaultImage()}}';" src="{{$imageThumb}}">
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
                                                <div class="text"> <?php $discountValue = ($productKeepingInfo->price / 100) * $productKeepingInfo->discount ?>
                                                    {{format_currency($orderProduct->product_price)}}</div>
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
                                                <div class="text">{{format_currency(($orderProduct->product_price - $discountValue ) * $orderProduct->quantity)}}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="sp-box">
                                                <div class="title">Affiliate Amount</div>
                                                <div class="text">{{format_currency($orderProduct->affiliate_reward_amount)}}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="sp-box">
                                                <div class="title">Status</div>
                                                <div class="text"><?php echo $orderStatus[ 'status' ] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="total-amount">
                                    <div class="col-md-2 col-md-offset-4">
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
                                        <div class="row">
                                            <div class="txt">
                                                Affiliate Amount
                                            </div>
                                            <div class="amount">
                                                {{format_currency($order->total_affiliate_amount)}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="txt">
                                            Total Amount
                                        </div>
                                        <div class="amount">
                                            {{format_currency($order->total_price - $order->total_discount  - $order->total_affiliate_amount)}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dispute-wrapper">
                            <div class="messages-title bdrB">Messages</div>
                            <div class="msgs-box" id="messageBox">
                                @if(isset($messages) && $messages !=  'No more Message')
                                    @foreach($messages as $msg)
                                        <div class="msg-list">
                                            <div class="col-md-2">
                                                <div class="name">
                                                    @if($msg['sender_id'] == $user->id)
                                                        Me
                                                    @else
                                                        {{$msg['sender_name']}}
                                                    @endif

                                                </div>
                                                <div class="td">{{getTimeByTZ($msg['created_at'], 'M d | H:i A')}}</div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="msg @if($msg['sender_id'] == $user->id) me @endif">
                                                    @if(isset($msg['file_name']) && !empty($msg['file_name']))
                                                        <span class="attachment-icon"></span>

                                                        <div class="linkDownload mar-bt-10">
                                                            <span class="attachment-name">{{$msg['file_name']}}</span>
                                    <span class="attachment-url"><a href="{{url('photo/'.$msg['url'])}}"
                                                                    download="">Download</a></span>
                                                        </div>
                                                    @endif
                                                    {{$msg['content']}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div id="no-data">
                                        No record found
                                    </div>

                                @endif
                            </div>
                        </div>
                        <div class="dispute-wrapper">
                            <div class="messages-title">Leave a Message</div>

                            {!! Form::open(['url' => 'store/order/messages', 'id' => 'msg-form']) !!}
                            <input type="file" accept="" id="postFiles" name="attachment"
                                   style="position: fixed; top: -30px;"/>
                            @if(is_null($order->conv_id))
                                {!! Form::hidden('receiver_id',$order->customer_id) !!}
                                {!! Form::hidden('order_id',Hashids::connection('store')->encode($order->id)) !!}
                            @else
                                {!! Form::hidden('conv_id',$order->conv_id) !!}
                            @endif
                            <div class="write-msg">
                                <textarea class="form-control" name="body" rows="5" id="msg-body"
                                          placeholder="Type you message here . . ."></textarea>
                            </div>
                            <div class="btn-box">
                                <button class="btn btn-primary" type="button" id="send-msg">Send</button>
                                <button class="btn btn-primary" type="button" id="chat-attachment">Attach</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .od-wrapper {
            background: none;
            border: none;
            margin-bottom: 15px;
            overflow: hidden;
        }
    </style>
@endsection
@section('scripts')
    {!! HTML::script('local/public/assets/js/pages/dispute.js') !!}
@endsection
