<?php
$url = '';
if(isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
    if(strpos($uri, config('constants_api.API_ROUTE_PREFIX')) !== FALSE) {
        $url = '';
    } else {
        $url = config('app.url');
    }
}
return [
    'SITE_DISPLAY_NAME' => 'Cartimatic',
    'REGULAR_USER' => 1,
    'BRAND_USER'   => 2,

    'SUPER_ADMIN'      => 100,
    'ADMIN'            => 101,
    'ACCOUNTS MANAGER' => 102,
    'DISPUTE MANAGER'  => 103,
    'ARBITRATOR'       => 105,
    'ACCOUNTANT'       => 106,

    'USER_TYPES'       => [
        1   => 'Normal',
        2   => 'Brand',
        100 => 'Super Admin',
        101 => 'Admin',
        102 => 'Accounts Manager',
        103 => 'Dispute Manager',
        105 => 'Arbitrator',
        106 => 'Accountant',
    ],
    'ADMIN_URL_PREFIX' => 'admin/',

    'IMAGE_TYPES' => [
        'PRODUCTS'       => 'products',
        'BANNERS'        => 'banners',
        'USERS'          => 'users',
        'PRODUCT_IMAGES' => 'product-images',
    ],

    'ATTACHMENT_PATH'          => storage_path(),
    'ATTACHMENT_THUMB'         => $url . '/attachment_thumb/',

    'MESSAGES_ATTACHMENT_WIDTH' => 480,
    'ORDER_MESSAGES_TYPE'=>'orders'
];

