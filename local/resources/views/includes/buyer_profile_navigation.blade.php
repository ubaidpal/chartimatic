<?php
$myProfile = (strpos($_SERVER['REQUEST_URI'], '/my-profile') !== false) ? 'active' : '';
$myOrders = (strpos($_SERVER['REQUEST_URI'], '/my-orders') !== false) ? 'active' : '';
$shippingAddress = (strpos($_SERVER['REQUEST_URI'], '/shipping-addresses') !== false) ? 'active' : '';
$myFeedback = (strpos($_SERVER['REQUEST_URI'], '/my-feedback') !== false) ? 'active' : '';
$wishlist = (strpos($_SERVER['REQUEST_URI'], '/wishlist') !== false) ? 'active' : '';

?>

@include('includes.inner-sidebar')
