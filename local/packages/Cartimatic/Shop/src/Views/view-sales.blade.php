@extends('Store::layouts.store-admin')
@section('styles')
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
    {!! HTML::style('local/public/assets/gentelella/js/datatables/buttons.bootstrap.min.css') !!}
@stop
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    View Sales
                    <small>
                        ({{$shop->location}})
                    </small>
                </h3>
            </div>
            <div class="title_right">
                <a href="{{URL::previous()}}" class="btn btn-success pull-right" type="button">Back</a>

                {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Item...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>--}}

            </div>

        </div>
        <div class="clearfix"></div>
        @include('includes.alerts')
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row line-solid">
                            <form action="{{url('admin/store/shop/view-sales/'.$shop->id)}}" novalidate="" id="demo-form2"
                                  data-parsley-validate="" class="form-horizontal form-label-left" method="post">
                                {!! csrf_field()!!}

                                <div class="form-group col-md-4">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start Date<span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" data-parsley-id="4864" id="start_date" required="required"
                                               class="form-control col-md-7 col-xs-12" name="start_date" value="{{$start_date}}">
                                        <ul id="parsley-id-4864" class="parsley-errors-list"></ul>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">End Date <span
                                                class="required">*</span>
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" data-parsley-id="4117" id="end_date" name="end_date" required="required"
                                               class="form-control col-md-7 col-xs-12" value="{{$end_date}}">
                                        <ul id="parsley-id-4117" class="parsley-errors-list"></ul>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="ln_solid"></div>
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th rowspan="2">Order No.</th>
                                <th rowspan="2">Shop Name</th>
                                <th rowspan="2">Purchaser Name</th>
                                <th rowspan="2">Payment Type</th>
                                <th colspan="5">Amount</th>
                                <th rowspan="2">Date & Time</th>
                                <th rowspan="2">Items(Count)</th>
                            </tr>
                            <tr>
                                <th>Total Price</th>
                                <th>Card</th>
                                <th>Cash</th>
                                <th>Discount</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        <a href="{{url('store/'.$user->username.'/admin/order-invoice/'.$order->id)}}">
                                            {{$order->order_number}}
                                        </a>

                                    </td>
                                    <td>
                                        @if(!empty($order->shop))
                                            {{$order->shop->shop_name}}
                                        @else
                                            Web Store
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($order->customer))
                                            {{$order->customer->displayname}}
                                        @else
                                            {{ucfirst($order->customer_name)}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->payment_type == 'cashANDcard')
                                            Cash & Card
                                        @else
                                            {{ucfirst($order->payment_type)}}
                                        @endif
                                    </td>
                                    <td>{{format_currency($order->total_price)}}</td>
                                    <td>{{format_currency($order->card_price)}}</td>
                                    <td>{{format_currency($order->cash_price)}}</td>
                                    <td>{{format_currency($order->total_discount)}}</td>
                                    <td>{{format_currency($order->total_price- $order->total_discount)}}</td>
                                    <td>
                                        {{\Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i A')}}
                                    </td>
                                    <td>{{$order->total_quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {!! $orders->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')
    <!-- daterangepicker -->
    {!! HTML::script('local/public/assets/gentelella/js/moment/moment.min.js') !!}
    {!! HTML::script('local/public/assets/gentelella/js/datepicker/daterangepicker.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#start_date, #end_date').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>

@stop
