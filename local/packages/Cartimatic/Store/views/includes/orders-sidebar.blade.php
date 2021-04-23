{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 25-May-16 12:00 PM
    * File Name    : 

--}}
<div class="col-md-3">
    <div class="row">
        <div class="cart-left-nav">
            <nav>
                <ul class="nav">
                    <li><a href="{{url('store/my-orders')}}">All Orders</a></li>
                    @if(Auth::user()->user_type == \Config::get('constants.REGULAR_USER'))
                    <li><a href="{{url('shipping-addresses')}}">Shipping Address</a></li>
                    <li><a href="{{url('messages')}}">Messages</a></li>
                    @endif
                    <li><a href="{{url('my-feedback')}}">Manage Feedbacks</a></li>
                    <li><a href="{{url('wishlist')}}">Wishlist</a></li>
                    <!--<li><a href="#" class="active">Invoices</a></li>-->
                </ul>
            </nav>
        </div>
    </div>
</div>
