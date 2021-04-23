<?php
/**
 * Created by PhpStorm.
 * User: ubaid.ullah
 * Date: 6/8/2016
 * Time: 2:09 PM
 */


Route::group(array('prefix' => config('constants_api.API_ROUTE_PREFIX'),'middleware' => ['api-middleware']), function () {
    Route::post('/logout', 'Auth\AuthController@logout');
    Route::post('/login', 'ApiController@login');
    Route::post('/register', 'ApiController@signUp');
    Route::post('/product-detail', 'ApiController@getProductDetail');
    Route::post('/product-reviews', 'ApiController@getRating');
    Route::get('/all-categories',  'ApiController@getCategoriesList');
    Route::get('/all-countries',  'ApiController@getCountriesList');
    Route::post('/category', 'ApiController@getCategoryIndex');
    Route::post('/category-filters', 'ApiController@getCategoryFilters');
    Route::post('/home', 'HomeController@index');

    Route::get('new-arrivals', 'ApiController@getNewArrivals');
    Route::get('best-seller', 'ApiController@getBestSeller');

    Route::get('store/checkout/{cart_token}', 'ApiController@getPaymentInfo');
    Route::post('store/make-payment/checkout/{sellerBrandId}/{cart_token}/{message?}', '\Cartimatic\Store\Http\PaymentController@makePayment');
});

Route::group(array('prefix' => config('constants_api.API_ROUTE_PREFIX'), 'middleware' => ['oauth','data', 'api-private-middleware']), function () {
    //==================================== get Order Detail ==============================================//
    Route::post('/customer-orders', '\Cartimatic\Store\Http\StoreOrderController@getMyOrdersApi');
    Route::post('/order-detail', '\Cartimatic\Store\Http\StoreOrderController@getMyOrderApi');
    Route::post('change-status/order-received', '\Cartimatic\Store\Http\StoreOrderController@changeStatusApi');
    //==================================== Add Cart ==============================================//
    Route::post('/add-product-to-cart', '\Cartimatic\Store\Http\StoreController@addCartProduct');
    Route::post('/save-product-review', '\Cartimatic\Store\Http\StoreController@ProductReviewAjax');
    //==================================== Shipping Address ==============================================//
    Route::post('/shipping-addresses', '\Cartimatic\Store\Http\StoreController@getOnlyShippingAddress');
    Route::post('store/add/shipping/address', '\Cartimatic\Store\Http\StoreController@addNewApiStoreOrderDeliveryAddress');
    Route::post('store/update/shipping/address', '\Cartimatic\Store\Http\StoreController@updateExistingApiStoreOrderDeliveryAddress');
    Route::post('store/sofDeleteAddressInfo', '\Cartimatic\Store\Http\StoreController@softApiDeleteAddressInfo');
    //==================================== WishList ==============================================//
    Route::post('wishlist/{perPage?}', '\Cartimatic\Store\Http\StoreController@wishList');
    Route::post('wishlistDelete', '\Cartimatic\Store\Http\StoreController@wishListDelete');
    Route::post('wishlistFilter/{perPage?}', '\Cartimatic\Store\Http\StoreController@wishListFilter');
    //==================================== Change Password ==============================================//
    Route::post('settings/change-password', 'UsersController@userPasswordChange');

    //==================== Profile Changes============================
    Route::post('store/user-profile-changes', 'UsersController@getProfile');
    Route::post('store/update-profile-changes', 'UsersController@updateProfile');
    //==================== Checkout =======================================
    Route::post('store/payment-info/checkout', '\Cartimatic\Store\Http\StoreController@savePaymentInfo');
});
