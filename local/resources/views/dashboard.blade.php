@extends('layouts.dashboard')

@section('content')

    <!-- Cartimatic Header html-->
    <div class="top-bg">
        @include('includes.header-dashboard')

        <div class="container signup-message">
            <?php $email = Session::get('email') ?>
            @if($email)
                <div><a href="{{url('/')}}">{{ Lang::get('titles.home') }}</a></div>

                <div class="account-success">
                    <p>{{ Lang::get('auth.sentEmail',
                ['email' => $email] ) }}</p>

                    <p>{{ Lang::get('auth.clickInEmail') }}</p>
                </div>
            @else
                <div class="search-areas">
                    <h2>An ecommerce platform made for you</h2>
                    <p>Whether you sell online, in store, or out of the trunk of your car,<br/>Cartimatic has you covered.</p>
                    <div class="input-group get-started">
                        <input type="text" class="form-control" placeholder="Enter your business email" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id=""><a href="#">Get Started</a></span>
                    </div>
                    <div class="free-trail">Try Cartimatic free for 14 days. No risk, and no credit card required.</div>
                </div>
            @endif
        </div>

        <div class="container nopadding header-features">
            <div class="col-md-12 nopadding">
                <div class="col-md-4 nopadding">
                    <div class="feature-box one">
                        <div class="f-icons"></div>
                        <div class="title">Online Store</div>
                        <p>Pick a template, customize your store and give it a touch of yourself</p>
                    </div>
                </div>
                <div class="col-md-4 nopadding">
                    <div class="feature-box two">
                        <div class="f-icons"></div>
                        <div class="title">Marketplace</div>
                        <p>Be a part of a platform that encourages sales, brings business and gives you visibility</p>
                    </div>
                </div>
                <div class="col-md-4 nopadding">
                    <div class="feature-box three">
                        <div class="f-icons"></div>
                        <div class="title">POS</div>
                        <p>From receipts, to barcodes, balance sheets to inventory, delivery to exchange policies, everything made easier to serve your business</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container nopadding">
        <div class="img-wrapper">
            <img src="{!! asset('local/public/assets/bootstrap/images/laptop-mobile.png') !!}" />
        </div>
        <div class="feature-text-wrapper">
            <h2>We facilitate you to generate larger revenue</h2>
            <p>With Cartimatic market place, POS software along with its hardware, and website building features you have all the tools to represents the philosophy of your business, attracts your target audience and take total control of the look and feel of your store. All this combines to empower your business to generate lager revenues faster than ever.</p>
            <span class="sep-line"></span>
        </div>
    </div>

    <div class="container nopadding">
        <div class="more-revenue">
            <div class="col-md-12 nopadding">
                <div class="col-md-6 nopadding">
                    <p>At Cartimatic, managing stores at multiple locations is as easy as managing one. The synergy induced platform by Cartimatic allows you to run your business smoothly and effectively like never before along with seamless social integration.</p>
                    <ul>
                        <li>Order management in a single step</li>
                        <li>Manage sales reports</li>
                        <li>Complete analytical transparency</li>
                        <li>Total control over inventory management</li>
                    </ul>
                </div>
                <div class="col-md-6 nopadding">
                    <div class="graph-img">
                        <img src="{!! asset('local/public/assets/bootstrap/images/graph.png') !!}" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container nopadding">
        <div class="feature-text-wrapper">
            <h2>Everything your business demands</h2>
            <p>Cartimatic manages all factors of ecommerce, ideal for startups and established businesses.</p>
            <span class="sep-line"></span>
        </div>

        <div class="row features-box">
            <div class="col-md-4 f-single">
                <div class="icon waytosell"></div>
                <div class="f-head">Ways to sell</div>
                <p class="f-text">Through Cartimatic you can now sell on the vast online market place or through your own website (online store) which makes this single platform twice as beneficial.</p>
            </div>
            <div class="col-md-4 f-single">
                <div class="icon toolstogrow"></div>
                <div class="f-head">Tools to help you grow</div>
                <p class="f-text">Cartimatic manages everything from marketing and payments, to secure checkout and shipping.</p>
            </div>
            <div class="col-md-4 f-single">
                <div class="icon ownyouronlinestore"></div>
                <div class="f-head">Own your online store</div>
                <p class="f-text">In today’s overpowering competition in retail, it’s indispensable to have your own online store to reach out to a larger audience.</p>
            </div>
            <div class="col-md-4 f-single">
                <div class="icon manageyourcashflow"></div>
                <div class="f-head">Manage your daily cash flow</div>
                <p class="f-text">Conveniently observe all staff activity on the cash register throughout the day. (Retail Package only)</p>
            </div>
            <div class="col-md-4 f-single">
                <div class="icon storemanagement"></div>
                <div class="f-head">Store management</div>
                <p class="f-text">Feel total control with cartimatic store management tools while handling refunds, staff accounts, cash flow, account integration, order histories, inventory, shipping and a lot more.</p>
            </div>
            <div class="col-md-4 f-single">
                <div class="icon global"></div>
                <div class="f-head">Unlimited products</div>
                <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
            </div>
        </div>
    </div>

    <div class="stay-wrapper">
        <div class="container nopadding">
            <div class="col-md-5 nopadding">
                <div class="stay-on-top">
                    <h2>Stay in control of your sales</h2>
                    <h4>Cater to orders in second</h4>
                    <p>Get an alert with every new sale in occurrence. Manage multiple orders in a blink of an eye.</p>
                    <h4>Shipping made simpler</h4>
                    <p>Provide tracking info to your customers against their orders when you integrate shipping with major carriers.</p>
                </div>
            </div>
            <div class="col-md-7 nopadding">
                <div class="f-img">
                    <img src="{!! asset('local/public/assets/bootstrap/images/image-2.jpg') !!}" />
                </div>
            </div>
        </div>
    </div>

    <div class="container nopadding">
        <div class="feature-text-wrapper">
            <h2>Cartimatic ecommerce app</h2>
            <p>Allow your customers to take their business wherever they go with Cartimatic mobile app</p>
            <span class="sep-line"></span>
        </div>
        <div class="img-wrapper mt0">
            <img src="{!! asset('local/public/assets/bootstrap/images/iphones.png') !!}" />
        </div>
    </div>

    <div class="customer-reviews">
        <div class="container nopadding">
            <div class="dt">
                <div class="left">
                    <h1>What our Customers are Saying</h1>
                </div>
                <div class="right">
                    <div class="c-review">
                        <h2>They’ve helped us achieve our marketing goals about my store</h2>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                        <div class="c-writers">
                            <h4>Harvey Dent</h4>
                            <div class="user-images">
                                <a href="#" class="active"><img src="{!! asset('local/public/assets/bootstrap/images/apple_416x416.jpg') !!}" width="50" height="50" /></a>
                                <a href="#"><img src="{!! asset('local/public/assets/bootstrap/images/apple_416x416.jpg') !!}" width="50" height="50" /></a>
                                <a href="#"><img src="{!! asset('local/public/assets/bootstrap/images/apple_416x416.jpg') !!}" width="50" height="50" /></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-powers">
        <div class="container nopadding">
            <div class="feature-text-wrapper">
                <h2>Cartimatic powers over 50+ businesses and counting</h2>
                <p>We've helped our customers sell their products</p>
                <span class="sep-line"></span>
            </div>
        </div>
        <div class="brand-logos">
            <div class="container nopadding">
                <div class="col-md-2 nopadding">
                    <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/asus-logo.png') !!}" />
                </div>
                <div class="col-md-2 nopadding">
                    <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/rockport-logo.png') !!}" />
                </div>
                <div class="col-md-2 nopadding">
                    <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/nike-logo.png') !!}" />
                </div>
                <div class="col-md-2 nopadding">
                    <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/Virgin.png') !!}" />
                </div>
                <div class="col-md-2 nopadding">
                    <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/cnn-hd-logo-png-sk.png') !!}" />
                </div>
                <div class="col-md-2 nopadding">
                    <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/Cadburys-logo.png') !!}" />
                </div>
            </div>
        </div>
    </div>

@endsection