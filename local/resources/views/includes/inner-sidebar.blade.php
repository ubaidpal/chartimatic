{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 22-Sep-16 4:49 PM
    * File Name    : 

--}}
<div class="col-md-3">
    <div class="row">
        <div class="cart-left-nav">
            <nav>
                <ul class="nav">
                    <li><a href="{{url('my-orders')}}" class="@if(Request::is('my-orders')) active @endif">All Orders</a></li>
                    @if(Auth::user()->user_type == \Config::get('constants.REGULAR_USER'))
                    <li><a href="{{url('shipping-addresses')}}" class="@if(Request::is('shipping-addresses')) active @endif">Shipping Address</a></li>

                    <li><a href="{{url('messages')}}" class="@if(Request::is('messages') || Request::is('messages/show/*')) active @endif">Messages</a></li>
                    @endif
                    <li><a href="{{url('my-feedback')}}" class="@if(Request::is('my-feedback')) active @endif">Manage Feedbacks</a></li>
                    <li><a href="{{url('wishlist')}}" class="@if(Request::is('wishlist')) active @endif">Wishlist</a></li>
                    <!--<li><a href="#" class="active">Invoices</a></li>-->
                </ul>
            </nav>
        </div>
    </div>
</div>
