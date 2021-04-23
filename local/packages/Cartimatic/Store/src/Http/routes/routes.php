<?php

// ==================== Ubaid code ============================
if(env("STORE_ENABLED", TRUE)){
  Route::get('order/completed/{order_id?}', 'Cartimatic\Store\Http\StoreController@getOrderCompleted');
  Route::get('store/order/completed/{order_id?}', 'Cartimatic\Store\Http\StoreController@getOrderCompleted');

  Route::get('product/{product_id}/{message?}', 'Cartimatic\Store\Http\StoreController@getProductDetail');
    Route::get('affiliate-product/{product_id}/', 'Cartimatic\Store\Http\StoreController@getAffiliateProductById');

  Route::get('store/cart/delete-product/{product_id}', 'Cartimatic\Store\Http\StoreController@deleteCartProduct');
  Route::post('store/cart/quantityUpdate', 'Cartimatic\Store\Http\StoreController@UpdateQuantityCartProduct');
  Route::get('store/cart/{message?}', 'Cartimatic\Store\Http\StoreController@getCart');
  Route::post('cart/product-quantity-check/{message?}', 'Cartimatic\Store\Http\StoreController@cartProductQuantityCheck');
  Route::get('store/{storeBrandId}/{message?}', 'Cartimatic\Store\Http\StoreController@index');
  Route::get('store/{storeBrandId}/products/{category_name}/{sub_category_id}', 'Cartimatic\Store\Http\StoreController@subCategoryProducts');

  Route::post('store/cart/add-product', '\Cartimatic\Store\Http\StoreController@addCartProduct');
  Route::get('store/shipping-address/', 'Cartimatic\Store\Http\StoreController@getShippingAddress');
  Route::get('store/cart/add-product/{product_id}', 'Cartimatic\Store\Http\StoreController@addCartProduct');

  Route::get('store/{storeBrandId}/shipping/address/{sellerBrandId}/{buy_it_now?}', 'Cartimatic\Store\Http\StoreController@getShippingInfo');
  Route::post('store/add/shipping/address/{sellerBrandId}/{buy_it_now?}', '\Cartimatic\Store\Http\StoreController@addShippingInfo');
  Route::get('store/ship/to/address/{sellerBrandId}/{address_id}/{buy_it_now?}', 'Cartimatic\Store\Http\StoreController@addShippingInfoFromGet');
  Route::get('add/payment/information/{sellerBrandId}/{get_it_now}/{message?}', '\Cartimatic\Store\Http\PaymentController@pay');
  Route::get('store/reviewOrder/{sellerBrandId}/{message?}', '\Cartimatic\Store\Http\StoreController@reviewOrder');
  Route::post('store/makePayment/{sellerBrandId}/{message?}', '\Cartimatic\Store\Http\PaymentController@makePayment');
  Route::post('store/cash-on-delivery-payment/{sellerBrandId}/{buy_it_now?}/{message?}', '\Cartimatic\Store\Http\PaymentController@cashOnDeliveryPayment');

  Route::group(['middleware' => ['auth', 'data']], function () {
      Route::get('store/managerPanel/orders', 'Cartimatic\Store\Http\StoreOrderController@getOrderMangerPanel');

      Route::post('store/add-product-favorites', 'Cartimatic\Store\Http\StoreController@addProductFavorites');
      Route::post('store/remove-product-favorites', '\Cartimatic\Store\Http\StoreController@removeProductFavorites');



        Route::get('store/order/dispute/{id}', '\Cartimatic\Store\Http\StoreOrderController@getOrderDispute');
        //Route::get('store/order/dispute/{id}/admin', 'Cartimatic\Store\Http\StoreOrderController@getOrderDispute');
        Route::get('store/managerPanel/orders', '\Cartimatic\Store\Http\StoreOrderController@getOrderMangerPanel');

       // Route::get('store/order/dispute', 'Cartimatic\Store\Http\StoreOrderController@getOrderDispute');
        Route::get('my-orders/{message?}', '\Cartimatic\Store\Http\StoreOrderController@getMyOrders');
        Route::get('my-feedback/{message?}', '\Cartimatic\Store\Http\StoreController@manageFeedbacks');

        //Route::get('store/bankAccount', 'Cartimatic\Store\Http\StoreManagementController@getBankAccount');
        Route::post('store/addBankAccount', 'Cartimatic\Store\Http\StoreManagementController@addBankAccount');
        Route::get('store/withdrawals', 'Cartimatic\Store\Http\StoreManagementController@requestWithdrawal');
        Route::post('store/sendWithdrawalRequest', 'Cartimatic\Store\Http\StoreManagementController@sendWithdrawalRequest');
        Route::post('store/cancelWithdrawalRequest', 'Cartimatic\Store\Http\StoreManagementController@cancelWithdrawalRequest');
    // ==================== End of Ubaid code ============================

    // ==================== Zahid code ===================================

        Route::get('shipping-addresses/{message?}', 'Cartimatic\Store\Http\StoreController@getShippingAddresses');
        Route::post('store/feedback/reminder/ajax/{product_id}/{order_id}/{message?}', 'Cartimatic\Store\Http\StoreController@feedbackReminder');
        Route::post('stores/review/{product_id}/', 'Cartimatic\Store\Http\admin\StoreAdminController@ProductReview');
        Route::post('store/review/ajax/{product_id}/', 'Cartimatic\Store\Http\StoreController@ProductReviewAjax');
        Route::get('store/cart/delete-product/by-url/{product_id}', 'Cartimatic\Store\Http\StoreController@deleteCartProductByRedirect');

        Route::patch('store/edit/ProductReview/{review_id}', 'Cartimatic\Store\Http\StoreController@editProductReview');

        //save Review
        Route::post('updateReview/{product_id}', 'Cartimatic\Store\Http\StoreController@updateReviewDetail');

        Route::get('store/{storeBrandId}/product/{product_id}/{message?}', 'Cartimatic\Store\Http\StoreController@getProductDetail');
        Route::post('store/order/update/order-status/{message?}', 'Cartimatic\Store\Http\StoreController@updateOrderStatusAjax');
        Route::post('store/order/delete/{message?}', 'Cartimatic\Store\Http\StoreController@softDeleteOrder');
        Route::post('store/{storeBrandId}/reviseFeedback/{order_id}/{message?}', 'Cartimatic\Store\Http\StoreController@reviseFeedback');
       Route::post('store/cancelOrder/{order_id}/{message?}', 'Cartimatic\Store\Http\StoreController@cancelOrder');

        Route::get('order-invoice/{order_id}/{message?}', 'Cartimatic\Store\Http\StoreController@getOrderInvoice');
        Route::post('store/order/messages', 'Cartimatic\Store\Http\StoreController@saveMessage');

        Route::post('store/checkProductShippingCountry/{message?}', 'Cartimatic\Store\Http\StoreController@checkProductShippingCountry');
        Route::post('store/checkProductShippingCountryByISO/{message?}', 'Cartimatic\Store\Http\StoreController@checkProductShippingCountryByISO');
        Route::post('store/getEditAddressFormInfo/{message?}', 'Cartimatic\Store\Http\StoreController@getEditAddressFormInfo');
        Route::post('store/sofDeleteAddressInfo/{message?}', 'Cartimatic\Store\Http\StoreController@sofDeleteAddressInfo');
        Route::post('store/serach-my-orders/{message?}', 'Cartimatic\Store\Http\StoreController@searchMyOrders');
        Route::post('store/reviews/serach-my-reviews/{message?}', 'Cartimatic\Store\Http\StoreController@searchMyReviews');
        Route::get('wishlist/{perPage?}', 'Cartimatic\Store\Http\StoreController@wishList');
        Route::post('wishlist/delete', 'Cartimatic\Store\Http\StoreController@wishListDelete');
        Route::post('wishlist/filter/{perPage?}', 'Cartimatic\Store\Http\StoreController@wishListFilter');

    //Admin Routes

        include(__DIR__ . DIRECTORY_SEPARATOR . 'admin_routes.php');
    //Paypal Routes
        include(__DIR__ . DIRECTORY_SEPARATOR . 'paypal_routes.php');

        include(__DIR__ . DIRECTORY_SEPARATOR . 'yasir_routes.php');

    });
// search
  Route::post('filter/products', 'Cartimatic\Store\Http\StoreController@filterProducts');
  Route::post('search-products/{searchRecord?}', 'Cartimatic\Store\Http\StoreController@searchRecord');
  Route::get('search-products-name/{search?}/{category_id?}/', 'Cartimatic\Store\Http\StoreController@searchRecord');
  Route::get('search-product-click/{product_id?}', 'Cartimatic\Store\Http\StoreController@searchHotUrl');
  Route::get('hot-search', 'Cartimatic\Store\Http\StoreController@hotSearch');
// ==================== End of Zahid code ============================

//    Route::get('configuration', 'StoreManagementController@configuration');
   
}
