<?php

$orders = (strpos($_SERVER['REQUEST_URI'], '/orders') !== false) ? 'active' : '';
$categories = (strpos($_SERVER['REQUEST_URI'], '/categories') !== false) ? 'active' : '';
$add_product = (strpos($_SERVER['REQUEST_URI'], '/add-product') !== false) ? 'active' : '';
$subCategory = (strpos($_SERVER['REQUEST_URI'], '/Subcategories') !== false) ? 'active' : '';
$manage_products = (strpos($_SERVER['REQUEST_URI'], '/manage-product') !== false) ? 'active' : '';
$products_analytics = (strpos($_SERVER['REQUEST_URI'], '/product_analytics') !== false) ? 'active' : '';
$page_analytics = (strpos($_SERVER['REQUEST_URI'], '/page_analytics') !== false) ? 'active' : '';
$withdrawal = (strpos($_SERVER['REQUEST_URI'], '/withdrawals') !== false) ? 'active' : '';
$statement = (strpos($_SERVER['REQUEST_URI'], '/statement') !== false) ? 'active' : '';
$feedback = (strpos($_SERVER['REQUEST_URI'], '/manage_reviews') !== false) ? 'active' : '';
$categories2 = $categories3 = 'class="btn"';
$storePreview = (strpos($_SERVER['REQUEST_URI'], '/store-preview') !== false) ? 'active' : '';
?>
<div class="leftPnl" id="store-sidebar" style="top: 50px" data-page="store-admin">
    <div class="box">
        <div id="cssmenu">
            <h2>Admin</h2>
            <ul>
                <?php $user = getUserDetail($url_user_id) ?>

                <li class="{{$orders}}">
                    <a href="{{url('store/'.$user->username.'/admin/orders/')}}">
                        <?php $pendingOrders = getPendingOrders($user->id); ?>
                        <span>Orders &nbsp;@if(!empty($pendingOrders))<span class="pending-orders">{{$pendingOrders}}</span>@endif</span>
                    </a>
                </li>

                <li class="{{$storePreview}}">
                    <a href="{{url('/')}}">
                        <span>Store Preview</span>
                    </a>
                </li>

                <li class="{{$add_product}}"><a
                            href="{{ url('store/'.$user->username.'/admin/add-product/') }}" {{$add_product}}><span>Add Product</span></a>
                </li>

                <li class="{{$manage_products}}"><a
                            href="{{ url('store/'.$user->username.'/admin/manage-product/') }}" {{$manage_products}}><span>Manage Products</span></a>
                </li>

                <li class="{{@$page_analytics}}"><a
                            href="{{ url('store/'.$user->username.'/admin/page_analytics') }}" {{@$page_analytics}}><span>Page Analytics</span></a>
                </li>
                <li class="{{$feedback}}"><a
                            href="{{ url('store/'.$user->username.'/admin/manage_reviews') }}" {{@$feedback}}><span class="pending_reviews_requests">Feedbacks</span></a>
                </li>
                <li class="{{@$withdrawal}} last">
                    <a href="{{url('store/withdrawals')}}" ><span>Withdrawals</span></a>
                </li>
                <li class="{{$statement}}"><a href="{{ url('store/'.$user->username.'/admin/statement') }}" {{@$statement}}><span>Statement</span></a></li>

            </ul>
        </div>
    </div>
</div>