@extends('Store::layouts.static')
@section('content')
    <div class="sale-channel-container">
        <div class="page-heading">Sale Channels</div>

        <div class="row">
            <div class="col-md-3">
                <div class="sc_left">
                    <div class="sub-heading">Enable / disable sale channels</div>
                    <p>Channels let you sell to your customers online, on marketplace, through online store, and in person.</p>
                    <p>Go to your subscription panel to change your plan.</p>
                    <a href="javascript:void(0);" class="btn btn-link">Change subscription plan</a>
                </div>
            </div>

            <!-- Sales Channel Right Content -->
            <div class="col-md-8 col-md-offset-1">
                <div class="sc-right-content">
                    <div class="sales-channel-block">

                        <div class="item">
                            <div class="item-icon online-store"></div>
                            <div class="content-block">
                                <div class="head">Online Store</div>
                                <p>Sell online with a beautiful ecommerce website and integrated checkout. Choose from hundreds of professional themes that look great on any device.</p>
                            </div>
                            <div class="btn green">Enable</div>
                        </div>

                        <div class="item">
                            <div class="item-icon marketplace"></div>
                            <div class="content-block">
                                <div class="head">Marketplace</div>
                                <p>Sell online using Cartimatic Marketplace with integrated checkout..</p>
                            </div>
                            <div class="btn red">Disable</div>
                        </div>

                        <div class="item">
                            <div class="item-icon buy-pos"></div>
                            <div class="content-block">
                                <div class="head">Buy pos (point of sale)</div>
                                <p>Sell in person anywhere, and on any device with the Cartimatic POS app.</p>
                                <p class="disabled">** You need to change your subscription plan to active this channel</p>
                            </div>
                            <div class="btn disabled">Enable</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
