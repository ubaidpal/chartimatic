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
<div class="leftPnl" id="store-sidebar" data-page="store-admin">
    <div class="box">
        <div id="cssmenu">
            <h2>Admin</h2>
            <ul>
                <?php $user = getUserDetail($url_user_id) ?>

                <li class="{{$categories}}"><a href="{{url('store/'.$user->username.'/super-admin/categories/')}}"><span>Categories</span></a>
                </li>
                <li class="{{$subCategory}}"><a
                            href="{{ url('store/'.$user->username.'/super-admin/Subcategories/') }}"><span>Sub-Categories</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
