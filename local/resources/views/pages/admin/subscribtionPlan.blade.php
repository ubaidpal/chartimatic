@extends('Store::layouts.static')
@section('content')
    <div class="sale-channel-container">
        <div class="page-heading">Subscribtion Plan</div>

        <div class="subscription-plan-container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sc_left">
                        <div class="sub-heading">Order Confirmation</div>

                        <div class="order-confirmation">
                            <div class="order-confirmation-item">Elite Subscription</div>
                            <div class="order-confirmation-item">
                                <div class="pull-left">Subtotal</div>
                                <div class="pull-right">Rs. 3099</div>
                            </div>
                            <div class="order-confirmation-item">
                                <div class="amount-container">
                                    <div class="total-txt">
                                        <div>Total</div>
                                        <div class="smal">(PKR)</div>
                                    </div>
                                    <div class="amount">Rs. 3000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-md-offset-1">
                    <div class="sc-right-content">
                        <div class="subscription-plan-block">
                            <div class="subscription-plan-item inactive"><span class="txt">Marketplace</span></div>
                            <div class="subscription-plan-item inactive"><span class="txt">Online Store</span></div>
                            <div class="subscription-plan-item">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="txt">POS (Point of Sale)</span>
                                    </div>
                                    <div class="col-md-7">
                                        <label class="with-info">How many POS you want?
                                            <span class="info-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                            <span class="info-tooltip">Price vary dependant on number of POS</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select class="form-control">
                                                    <option>01</option>
                                                    <option>02</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="subscription-plan-item">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="txt">Online Support</span>
                                    </div>
                                    <div class="col-md-7">
                                        <label class="with-info">How many years of online support?
                                            <span class="info-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                            <span class="info-tooltip">Price vary dependant on number of years</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select class="form-control">
                                                    <option>01 years</option>
                                                    <option>02 years</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="subscription-plan-item">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="txt">Categories</span>
                                    </div>
                                    <div class="col-md-7">
                                        <label class="with-info">How many categories you need?
                                            <span class="info-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                            <span class="info-tooltip">Price vary dependant on number of categories</span>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select class="form-control">
                                                    <option>01</option>
                                                    <option>02</option>
                                                    <option>03</option>
                                                    <option>04</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-subscription-plan">
            <a href="javascript:void(0);" class="btn green">Confirm & Proceed</a>
            <a href="javascript:void(0);" class="btn">Cancel</a>
        </div>
    </div>
@endsection
