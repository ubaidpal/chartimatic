<?php
// Add this route for checkout or submit form to pass the item into paypal
Route::get( 'order/paypal/{order_id}', 'Cartimatic\Store\Http\PaymentController@postPayment' );

Route::get( 'order/payment', array(
'as'   => 'store_order_payment',
'uses' => 'Cartimatic\Store\Http\PaymentController@postPayment',
) );

// this is after make the payment, PayPal redirect back to your site
Route::get( 'order/payment/status/{order_id?}', array(
'as'   => 'store_order_payment.status',
'uses' => 'Cartimatic\Store\Http\PaymentController@getPaymentStatus',
) );
