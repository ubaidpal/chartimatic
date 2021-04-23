@extends('layouts.dashboard')

@section('content')

    <!-- Cartimatic Header html-->
    <div class="top-bg subscription-plan">
        @include('includes.header-dashboard')
    </div>

    <div class="feature-text-wrapper">
        <h2>Set up your store, pick a subscription plan</h2>
        <p>A Limited Time Offer - try Cartimatic free, no credit card required. </p>
        <span class="sep-line"></span>
    </div>

    <div class="psi-container">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="col-sm-4">
                <div class="pick-subscription-item">
                    <div class="offer-ribbon"></div>

                    <div class="header">
                        <span class="currency-type">Rs.</span>
                        <span class="amount">0</span>
                        <span class="plan-for">month</span>
                    </div>
                    <div class="item-content">
                        <div class="heading">Cartimatic Basic</div>
                        <p class="main">Start selling your products on your secure and beautiful online store with low credit card rates.</p>
                        <p>Marketplace</p>
                        <p>Online Support</p>
                        <p>Unlimited Products</p>
                        <p>2 Categories</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="pick-subscription-item">
                    <div class="header blue">
                        <span class="currency-type">Rs.</span>
                        <span class="amount">1999</span>
                        <span class="plan-for">month</span>
                    </div>
                    <div class="item-content">
                        <div class="heading">Cartimatic <span>+</span></div>
                        <p class="main">Start selling your products on your secure and beautiful online store with low credit card rates.</p>
                        <p>Marketplace</p>
                        <p>Online Support</p>
                        <p>Unlimited Products</p>
                        <p>2 Categories</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="pick-subscription-item">
                    <div class="header red">
                        <span class="currency-type">Rs.</span>
                        <span class="amount">3999</span>
                        <span class="plan-for">month</span>
                    </div>
                    <div class="item-content">
                        <div class="heading">Elite</div>
                        <p class="main">Start selling your products on your secure and beautiful online store with low credit card rates.</p>
                        <p>Marketplace</p>
                        <p>Online Support</p>
                        <p>Unlimited Products</p>
                        <p>2 Categories</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pick-a-plan">
        <div class="lead">Set up your store, pick a plan</div>

        <div class="b-email">
            <div class="input-group get-started">
                <input type="text" class="form-control" placeholder="Enter your business email" aria-describedby="basic-addon2">
                <span class="input-group-addon" id="">Get Started</span>
            </div>
        </div>
    </div>

    <div class="clrfix"></div>
@endsection