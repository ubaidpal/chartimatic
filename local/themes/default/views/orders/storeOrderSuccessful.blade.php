@extends('layouts.main')

@section('content')
    <div class="container category">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="pro-header">
                        <div class="col-md-9">
                            <div class="row">
                                <h1>Order Successful</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-box ">
                <div class="col-sm-12 pro-header">
                    <br>
                    <strong class="text-success pro-header">Thank you for your order!</strong>
                    @if(Session::has('order_numbers'))
                        <div class="text-success pro-header">You order(s) numbers are below.</div>
                        <?php $order_numbers = Session::get('order_numbers');?>
                        @foreach($order_numbers as $order_number)
                            <div class="pro-header">
                                <label class="font-weight-bold">Seller: {{$order_number->seller->displayname}}</label>
                                <label class="font-weight-bold">Order Number: {{$order_number->order_number}}</label>
                            </div>

                        @endforeach
                    @endif
                    <div class="">Your order has been placed and is being processed. When the item(s) are shipped, you
                        will receive an email with the details. You can track this order through <a
                                href="{{url('my-orders/')}}">My Orders</a> page
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
