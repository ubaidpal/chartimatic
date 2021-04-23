<?php

use App\StorageFile;
use App\User;
use Carbon\Carbon;
use Cartimatic\POS\Http\Models\PosProductKeeping;
use Cartimatic\Store\Category;
use Cartimatic\Store\ProductFavorites;
use Cartimatic\Store\StoreAlbumPhotos;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreOrderItems;
use Cartimatic\Store\StoreProduct;
use Cartimatic\Store\StoreProductKeeping;
use Cartimatic\Store\StoreProductKeepingLog;
use Cartimatic\Store\StoreProductReview;
use Cartimatic\Store\StoreShippingCost;
use Cartimatic\Store\StoreShippingCountry;
use Cartimatic\Store\StoreShippingRegion;
use Cartimatic\Store\StoreStorageFiles;

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 1/15/2016
 * Time: 4:12 PM
 */

//=======================Zahid code ============================

function getStatusForBuyerOrderById($status_id) {
    $data[ 'status' ]   = '';
    $data[ 'reminder' ] = '';

    switch ($status_id) {
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_CANCELED"):
            $data[ 'status' ]   = 'Order Canceled';
            $data[ 'reminder' ] = 'Order Canceled by you or either by seller.';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_AWAITING_PAYMENT"):
            $data[ 'status' ]   = 'Awaiting for Payment';
            $data[ 'reminder' ] = 'You should pay for further processing.';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_BEING_VERIFIED"):
            $data[ 'status' ]   = 'Payment to be verified';
            $data[ 'reminder' ] = \Config::get("constants.SITE_DISPLAY_NAME").' is verifying your payment.';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_VERIFIED"):
            $data[ 'status' ]   = 'Payment approved';
            $data[ 'reminder' ] = 'Waiting for Seller to approve your order.';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_AWAITING_SHIPMENT"):
            $data[ 'status' ]   = 'Awaiting Shipment';
            $data[ 'reminder' ] = 'Order is approved, waiting to be dispatched by seller.';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPATCHED"):
            $data[ 'status' ]   = 'Dispatched';
            $data[ 'reminder' ] = 'Order dispatched by seller, Waiting for your confirmation. ';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"):
            $data[ 'status' ]   = 'Finished';
            $data[ 'reminder' ] = 'You have confirmed order received.';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED"):
            $data[ 'status' ]   = 'Refund Requsted';
            $data[ 'reminder' ] = 'You have requested refund for the order';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_REJECTED"):
            $data[ 'status' ]   = 'Request Refund Rejected';
            $data[ 'reminder' ] = 'Your refund request has been rejected';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_ACCEPTED"):
            $data[ 'status' ]   = 'Request Refund Accepted';
            $data[ 'reminder' ] = 'Your refund request has been accepted';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_CLAIMED"):
            $data[ 'status' ]   = 'Dispute Opened';
            $data[ 'reminder' ] = 'You have opened claimed for this order';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_RESOLVED"):
            $data[ 'status' ]   = 'Dispute Resolved';
            $data[ 'reminder' ] = 'The dispute for this order has been resolved';
            break;
    }

    return $data;
}

function getPaymentGateway($gateway_id) {
    $data[ 'gateway' ] = '';
    switch ($gateway_id) {
        case \Config::get("constants_brandstore.PAYMENT_GATEWAY.PAYPAL"):
            $data[ 'gateway' ] = 'Pay Pal';
            break;

        case \Config::get("constants_brandstore.PAYMENT_GATEWAY.WORLD_PAY"):
            $data[ 'gateway' ] = 'World Pay';
            break;
    }

    return $data[ 'gateway' ];
}

function checkProductShippingCountryByProductsIds($product_ids, $country_id) {
    $data[ 'allowedProducts' ]    = [];
    $data[ 'notAllowedProducts' ] = [];
    $data[ 'totalShippingCost' ]  = 0;

    foreach ($product_ids as $product_id) {
        $isAllow = StoreShippingCountry::select('region_id')
                                       ->where('country_id', $country_id)
                                       ->where('product_id', $product_id)
                                       ->first();

        if(isset($isAllow->region_id)) {
            $totalShippingCost         = StoreShippingCost::select('shipping_cost')->where('region_id', $isAllow->region_id)->where('product_id', $product_id)->first();
            $data[ 'allowedProducts' ] = $data[ 'allowedProducts' ] + [$product_id];

            if(isset($totalShippingCost->shipping_cost)) {
                $data[ 'totalShippingCost' ] = $data[ 'totalShippingCost' ] + $totalShippingCost->shipping_cost;
            }
        } else {
            $data[ 'notAllowedProducts' ] = $data[ 'notAllowedProducts' ] + [$product_id];
        }
    }

    return $data;
}

function getRegionCostByProductId($region_id, $product_id) {
    $costInfo = StoreShippingCost::select('shipping_cost', 'status')
                                 ->where('product_id', $product_id)
                                 ->where('region_id', $region_id)
                                 ->first();

    if(isset($costInfo->shipping_cost)) {
        return $costInfo;
    }

    return FALSE;
}

function getCurrentUserRegionId($userTimezone) {
    $region = currentUserRegion('', $userTimezone);

    $regionInfo = \Cartimatic\Store\StoreShippingRegion::select('id')->where('name', $region)
                                                       ->first();
    if(isset($regionInfo->id)) {
        return $regionInfo->id;
    }
    return FALSE;
}

function allCountriesList() {
    $allCountriesList = DB::table('countries')
                          ->get();
    return $allCountriesList;
}

function allCountriesOfRegion($region_name) {
    $allCountriesOfRegion = DB::table('countries')->where('region', $region_name)->lists('name', 'id');
    if(is_array($allCountriesOfRegion)) {
        return $allCountriesOfRegion;
//		return [0 => 'Select All'] + $allCountriesOfRegion;
    }

    return $allCountriesOfRegion;
}

function selectedProductShippingCountriesOfRegion($region_id, $product_id) {
    $countriesIds = StoreShippingCountry::where('region_id', $region_id)->where('product_id', $product_id)->lists('country_id');
    return $allCountriesOfRegion = DB::table('countries')->whereIn('id', $countriesIds)->lists('id');
}

function allCountriesOfRegionHtml($region_name, $product_id = '', $region_id = '') {

    $allCountries               = allCountriesOfRegion($region_name);
    $selectedCountriesCountries = selectedProductShippingCountriesOfRegion($region_id, $product_id);

    $html = '
<div id="countryListOfRegion_' . $region_name . '" class="cssPopup_overlay">
	<div class="cssPopup_popup" style="width: 290px;">
	 	<a class="cssPopup_close" id="cssPopup_close_' . $region_name . '" href="#work">&times;</a>
		<div id="all_countries_list">
			<h1 style="font-size:16px;">Select countries to add in shipping country.</h1>
			<br />
		';
    $html .= Form::select('country_' . $region_name . '[]', $allCountries, $selectedCountriesCountries, array('multiple' => 'multiple',
                                                                                                              'id'       => 'country_' . $region_name,
                                                                                                              'name'     => 'country[' . $region_name . '][]'));
    $html .= '
		<div>
			<a class="btn blue mt10" href="#work">Done</a>
		</div>
	</div>
	</div>
</div>
<script>
$("#donePopBtn_' . $region_name . '").click(function(e){
	e.preventDefault();
	$("#cssPopup_close_' . $region_name . '").click();
});

$("#country_' . $region_name . '").multiselect({
            columns: 1,
            search: true,
            selectedList : 1,
            placeholder: "Select Country",
            selectAll:true,
});

</script>';

    return $html;
}

function humanDifferenceInDateNow($date) {
    $date = new Carbon($date);
    $now  = Carbon::now();
    return $date->diffInDays($now) . ' Days';
}

function getProductShippingCost($product_id = NULL) {
    $product = getProductDetailsByID($product_id);
    if(isset($product->shipping_cost)) {
        return $product->shipping_cost;
    }

    return 0;

}

function currentUserRegion($userObj = NULL, $timezone = NULL) {
    if($userObj != NULL AND isset($userObj->timezone)) {
        $timezone = $userObj->timezone;
        $region   = explode('/', $timezone);
        return strtolower($region[ 0 ]);
    }

    if($timezone != NULL) {
        $region = explode('/', $timezone);
        return strtolower($region[ 0 ]);
    }

}

function getStatusForSellerOrderById($status_id) {
    $data[ 'status' ]   = '';
    $data[ 'reminder' ] = '';

    switch ($status_id) {
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_CANCELED"):
            $data[ 'status' ]   = 'Order Canceled';
            $data[ 'reminder' ] = 'Order Canceled';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_AWAITING_PAYMENT"):
            $data[ 'status' ]   = 'Awaiting for Payment';
            $data[ 'reminder' ] = 'Awaiting for Payment';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_BEING_VERIFIED"):
            $data[ 'status' ]   = 'Payment to be verified';
            $data[ 'reminder' ] = 'Payment to be verified';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_VERIFIED"):
            $data[ 'status' ]   = 'Payment approved';
            $data[ 'reminder' ] = 'The payment for this order has been verified';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_AWAITING_SHIPMENT"):
            $data[ 'status' ]   = 'Awaiting Shipment';
            $data[ 'reminder' ] = 'The Buyer is waiting for the order to be shipped';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPATCHED"):
            $data[ 'status' ]   = 'Dispatched';
            $data[ 'reminder' ] = 'The order is dispatched and awaiting for buyer acceptance';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"):
            $data[ 'status' ]   = 'Finished';
            $data[ 'reminder' ] = 'The buyer has confirmed order received.';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_REJECTED"):
            $data[ 'status' ]   = 'Refund Request Rejected';
            $data[ 'reminder' ] = 'You have rejected the refund request from buyer';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_ACCEPTED"):
            $data[ 'status' ]   = 'Refund Request Accepted';
            $data[ 'reminder' ] = 'You have accepted the refund request form buyer';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_CLAIMED"):
            $data[ 'status' ]   = 'Dispute Opended';
            $data[ 'reminder' ] = 'The buyer has opened dispute for this order';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_RESOLVED"):
            $data[ 'status' ]   = 'Dispute Resolved';
            $data[ 'reminder' ] = 'The dispute for this order has been resolved';
            break;
    }

    return $data;
}

function getOrderStatusForBuyer($order_id, $status_id, $order) {
    $data[ 'class' ]        = '';
    $data[ 'status' ]       = '';
    $data[ 'action_btn_1' ] = '';
    $data[ 'action_btn_2' ] = '';

    switch ($status_id) {
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_CANCELED"):
            $data[ 'class' ]        = 'cancel';
            $data[ 'status' ]       = 'Order Canceled';
            $data[ 'action_btn_1' ] = '<a class="btn btn-primary order_delete_btn order_action_btn_' . $order_id . '" id="deleteOrder_' . $order_id . '" href="javascript:void(0)">Delete</a>';
            $data[ 'action_btn_2' ] = '';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_AWAITING_PAYMENT"):
            $data[ 'class' ]        = 'inprogress';
            $data[ 'status' ]       = 'Payment being verified';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_status_btns order_action_brn_' . $order_id . '" id="" href="' . route('store.order-status', [$order_id, Auth::user()->username, 'order-cancel-buyer']) . '" data-header="Order Cancellation" data-toggle="modal" data-target="#myModal">Cancel</a>';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_BEING_VERIFIED"):
            $data[ 'class' ]        = 'inprogress';
            $data[ 'status' ]       = 'Payment to be verified';
            $data[ 'action_btn_1' ] = '';

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_status_btns order_action_brn_' . $order_id . '" id="" href="' . route('store.order-status', [$order_id, Auth::user()->username, 'order-cancel-buyer']) . '" data-header="Order Cancellation" data-toggle="modal" data-target="#myModal">Cancel</a>';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_VERIFIED"):
            $data[ 'class' ]        = 'awaiting_dispatch';
            $data[ 'status' ]       = 'Awaiting Shipment';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '';//'<a class="btn btn-primary order_status_btns order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="#orderCancelationInfo_'.$order_id.'">Cancel</a>'.cancelOrderBuyerFormHtml($order_id);
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_AWAITING_SHIPMENT"):
            $data[ 'class' ]        = 'awaiting_shipment';
            $data[ 'status' ]       = 'Awaiting Shipment';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '';//'<a class="btn btn-primary order_status_btns order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="#orderCancelationInfo_'.$order_id.'">Cancel</a>'.cancelOrderBuyerFormHtml($order_id);
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPATCHED"):
            $data[ 'class' ]  = 'shipped';
            $data[ 'status' ] = 'Awaiting Delivery';
            //$data['action_btn_1'] = '<a class="btn" href="#confirmationOfOrderReceived_'.$order_id.'">Order Received</a>'.confirmationOfOrderReceivedBuyerFormHtml($order_id);
            $data[ 'action_btn_1' ] = '<a class="btn btn-primary order_status_btns order_action_brn_' . $order_id . '" id="" href="' . route('store.order-status', [$order_id, Auth::user()->username, 'order-received']) . '" data-header="Confirmation Of Order Received" data-toggle="modal" data-target="#myModal">Order Received</a>';
            if(isset($order->delivery)) {
                $days = date_difference($order->delivery->date_to_be_delivered);
            }

            //if($days < 0){
            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '">Request Refund</a>';
            //}else{
            /*$data['action_btn_2'] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="#courierServiceInfo_'.$order_id.'">Open Dispute</a>'.timeRemainingPopUp( date_difference_human($order->delivery->date_to_be_delivered), $order_id );
        }*/

            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = 'Refund request is created';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '<a class="btn btn-primary " id="" href="' . url('store/order/dispute/' . $order_id) . '">Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_REJECTED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = 'Dispute has been rejected by seller';
            $data[ 'action_btn_1' ] = '<a class="btn btn-primary order_status_btn order_action_brn_' . $order_id . '" id="approve_6_order_' . $order_id . '" href="javascript:void(0)">Order Received</a>' . confirmationOfOrderReceivedBuyerFormHtml($order_id);;

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_CANCELLED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = 'Dispute has been cancelled';
            $data[ 'action_btn_1' ] = '<a class="btn order_status_btn order_action_brn_' . $order_id . '" id="approve_6_order_' . $order_id . '" href="javascript:void(0)">Order Received</a>' . confirmationOfOrderReceivedBuyerFormHtml($order_id);;

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_ACCEPTED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = config("constants_brandstore.ORDER_STATUS_MESSAGE." . $status_id);
            $data[ 'action_btn_1' ] = '';//'<a class="btn order_status_btn order_action_brn_' . $order_id . '" id="approve_6_order_' . $order_id . '" href="javascript:void(0)">Order Received</a>'.confirmationOfOrderReceivedBuyerFormHtml($order_id);

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"):
            $data[ 'class' ]        = 'finished';
            $data[ 'status' ]       = 'Order Finished';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_CLAIMED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = 'Refund request has been disputed';
            $data[ 'action_btn_1' ] = '';

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_RESOLVED"):
            $data[ 'class' ] = 'disputed';

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" id="cancel_0_order_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Dispute Detail</a>';;

            $data[ 'status' ]       = \Config::get("constants_brandstore.ORDER_STATUS_MESSAGE." . $status_id);
            $data[ 'action_btn_1' ] = '';//'<a class="btn order_status_btn order_action_brn_' . $order_id . '" id="approve_6_order_' . $order_id . '" href="javascript:void(0)">Order Received</a>'.confirmationOfOrderReceivedBuyerFormHtml($order_id);;
            break;
    }

    return $data;
}

function countOrdersCurrentUser() {
    $user_id = Auth::user()->id;
    return StoreOrder::where('seller_id', $user_id)->count();
}

function getOrderStatusForSeller($order_id, $status_id) {

    $data[ 'class' ]        = '';
    $data[ 'status' ]       = '';
    $data[ 'action_btn_1' ] = '';
    $data[ 'action_btn_2' ] = '';

    switch ($status_id) {
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_CANCELED"):
            $data[ 'class' ]        = 'cancel';
            $data[ 'status' ]       = 'Order Canceled';
            $data[ 'action_btn_1' ] = '<a class="btn btn-primary order_delete_btn order_action_btn_' . $order_id . '" id="deleteOrder_' . $order_id . '" href="javascript:void(0)">Delete</a>';
            $data[ 'action_btn_2' ] = '';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_AWAITING_PAYMENT"):
            $data[ 'class' ]        = 'inprogress';
            $data[ 'status' ]       = 'Awaiting for Payment';
            $data[ 'action_btn_1' ] = '<a class="btn btn-primary order_request_pay_btn order_action_brn_' . $order_id . '" id="order_' . $order_id . '" href="javascript:void(0)">Request to Pay</a>';
            $data[ 'action_btn_2' ] = '';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_BEING_VERIFIED"):
            $data[ 'class' ]        = 'inprogress';
            $data[ 'status' ]       = 'Payment to be verified';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_VERIFIED"):
            $data[ 'class' ]        = 'awaiting_dispatch';
            $data[ 'status' ]       = 'Payment approved';
            $data[ 'action_btn_1' ] = '<a class="btn btn-primary order_status_btn order_action_brn_' . $order_id . '" id="approve_4_order_' . $order_id . '" href="javascript:void(0)">Approve</a>';
            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_status_btns order_action_brn_' . $order_id . '" id="" href="' . route('store.order-status', [$order_id, Auth::user()->username, 'order-cancel']) . '" data-header="Cancel Order" data-toggle="modal"
       data-target="#myModal">Cancel</a>';
            break;

        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_AWAITING_SHIPMENT"):
            $data[ 'class' ]        = 'awaiting_shipment';
            $data[ 'status' ]       = 'Awaiting Shipment';
            $data[ 'action_btn_1' ] = '<a class="btn btn-primary order_status_btns order_action_brn_' . $order_id . '" id="" href="' . route('store.order-status', [$order_id, 5, 'send-order']) . '" data-header="Add Courier Service Information" data-toggle="modal"
       data-target="#myModal">Send Order</a>';
            $data[ 'action_btn_2' ] = '';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPATCHED"):
            $data[ 'class' ]        = 'shipped';
            $data[ 'status' ]       = 'Awaiting receiver approval';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = 'Refund request has been created';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '<a class="btn " id="" href="' . url('store/order/dispute/' . $order_id) . '">Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_ACCEPTED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = config("constants_brandstore.ORDER_STATUS_MESSAGE." . $status_id);
            $data[ 'action_btn_2' ] = '<a class="btn " id="" href="' . url('store/order/dispute/' . $order_id) . '">Refund Detail</a>';

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_REJECTED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = 'Refund request has been rejected';
            $data[ 'action_btn_1' ] = '';

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTED_CANCELLED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = 'Refund request has been cancelled by buyer';
            $data[ 'action_btn_1' ] = '';

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"):
            $data[ 'class' ]        = 'finished';
            $data[ 'status' ]       = 'Goods Deliverd';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_CLAIMED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'status' ]       = 'Refund request has been disputed by buyer';
            $data[ 'action_btn_1' ] = '';

            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '" href="' . url('store/order/dispute/' . $order_id) . '"> Refund Detail</a>';
            break;
        case \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DISPUTE_RESOLVED"):
            $data[ 'class' ]        = 'disputed';
            $data[ 'action_btn_2' ] = '<a class="btn btn-primary order_dispute_btn order_action_brn_' . $order_id . '"  href="' . url('store/order/dispute/' . $order_id) . '"> Dispute Detail</a>';;

            $data[ 'status' ]       = \Config::get("constants_brandstore.ORDER_STATUS_MESSAGE." . $status_id);
            $data[ 'action_btn_1' ] = '';

            break;

    }

    return $data;

}

function getOrderCourierServiceInformationForm($order_id, $order_status) {
    return '<script>
        function validCadsUrl(s, trackUrl){
					var message;
					var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
            var urlToValidate = s;
            var trackUrlUrlToValidate = trackUrl;

            if (!myRegExp.test(urlToValidate)){
							return "serviceLink";
						}

            if (!myRegExp.test(trackUrlUrlToValidate)){
							//return "trackUrl";
						}

			return true;

            alert(message);
        }

        $("#addOrderDeliveryButton_' . $order_id . '").click(function(evt){

					var serviceUrl = $("#courier_service_url_' . $order_id . '").val();
					var trackUrl   = $("#order_tracking_number_' . $order_id . '").val();

					var isValidUrl = validCadsUrl(serviceUrl, trackUrl);

					if(isValidUrl != true){
						$("#urlLinkError_' . $order_id . '").html("Please enter valid \'Courier Service website link\' (e.g: http://www.dhl.com.pk) ");
						//alert("Please enter valid \'Courier Service website link\' (e.g: http://www.dhl.com.pk) ");
						//return false;
					}

					if(trackUrl == ""){
						$("#urlTrackOrdrError_' . $order_id . '").html("Please enter  \'Order Tracking Number \'");
						//alert("Please enter valid \'Order Tracking website link\' (e.g: http://www.dhl.com.pk/order=ASW98234) ");
						//return false;
					}
					if(isValidUrl != true){
						return false;
					}
					$("#linkSpan").remove();
					var isEmpty = false;

					$("#add_courier_service_info_' . $order_id . ' input").each(function() {
						if(!$(this).val()){

							if(isEmpty !== true){
								alert("Some fields are empty, please fill all fields.");
							}
							isEmpty = true;
						}
					});

					var selectedDeliveryDate = $("#date_to_be_delivered_' . $order_id . '").val();

					if(date > selectedDeliveryDate){
						alert("Please enter future date from now for delivery");
						isEmpty = true;
					}

					if(isEmpty === true){
						return false;
					}
					evt.preventDefault();
					$.ajax({type:\'POST\', url: "' . url("store/" . Auth::user()->username . '/admin/add-courier-service-info/' . $order_id . '/' . $order_status) . '", data:$(\'#add_courier_service_info_' . $order_id . '\').serialize(), success: function(data) {
    $(".order_action_brn_"+data.order_id).remove();
                $(".order_action_"+data.order_id).html(data.action_btn_1 + data.action_btn_2);
                $(".order_status_"+data.order_id).html(data.status);
}});
});

        </script>

<script>
	var today = new Date();
	var dd = today.getDate();
	if(dd < 10){
		dd = "0"+dd;
	}
    var mm = today.getMonth()+1;
    if(mm < 10){
		mm = "0"+mm;
	}
    var yy = today.getFullYear();
	var date  = yy+"-"+mm+"-"+dd;

	$(function(){
        $("#date_to_be_delivered_' . $order_id . '").datepicker({
            inline: true,
            showOtherMonths: true,
            minDate: 0,
			onSelect: function(theDate) {
				$("#dataEnd").datepicker(\'option\', \'minDate\', new Date(theDate));
			},
            dateFormat: \'yy-mm-dd\' ,
            dayNamesMin: [\'Sun\', \'Mon\', \'Tue\', \'Wed\', \'Thu\', \'Fri\', \'Sat\'],

        });
    });
</script>';
}

function isEmailExists($email) {

    $userEmailInfo = User::where('email', $email)->first();

    if(isset($userEmailInfo->id)) {
        return $userEmailInfo;
    }

    return '';
}

function sendFeedbackReminder($order_id, $product_id, $storeName) {
    return '<script>
	$("#sendFeedbackReminder_' . $order_id . $product_id . '").click(function(evt){
		evt.preventDefault();
		$.ajax({type:"POST", url: "' . url("store/feedback/reminder/ajax/" . $product_id . "/" . $order_id) . '", success: function(data) {
			$(".order_action_brn_"+data.order_id).remove();
			$(".order_action_"+data.order_id).html(data.action_btn_1 + data.action_btn_2);
			$(".order_status_"+data.order_id).html(data.status);
		}, error: function(data){alert("error: "+data);}
});
});
</script>';
}

function getOrderNumber($order_id) {
    $info = StoreOrder::select("order_number")->where('id', $order_id)->first();
    if(isset($info->order_number)) {
        return $info->order_number;
    }
    return "N/A";
}

function giveFeedbackFormHtml($order_id = NULL, $product_id = NULL, $storeName = NULL) {
    $html = '<div class="modal fade" id="giveFeedbackInfo_' . $order_id . $product_id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Give Feedback</h4>
            </div>
            <div class="modal-body">
                    <label class="form-control-label">Order ID: ' . getOrderNumber($order_id) . '
                    ' . Form::open(['url'     => url(''),
                                    "id"      => "giveFeedbackForm_" . $order_id . $product_id,
                                    "enctype" => "multipart/form-data"
        ]) . '
                <input type="hidden" value="' . $product_id . '" name="product_id" />
                <input type="hidden" value="' . $order_id . '" name="order_id" />
                <input type="hidden" value="' . $storeName . '" name="store_name" />';

    $inputStars = '<div>
                    <input type="text" style="display: none" id="stars_rating_' . $order_id . $product_id . '" name="stars_rating">
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                </div>';

    $html .= '
                    <label class="form-control-label">How would you give your rating for this product?</label>
                    <div class="">' . $inputStars . '</div>
                    <label class="form-control-label">Comment</label>
                    <textarea class="form-control" name="description"></textarea>
                </form>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="giveSubmitBtn_' . $order_id . $product_id . '" class="btn btn-primary save_changes" data-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script src="' . asset("local/public/assets/bootstrap/javascripts/jquery-2.1.3.js") . '"></script>

            <script>
        $("#giveSubmitBtn_' . $order_id . $product_id . '").click(function(evt){
            evt.preventDefault();
             $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name=\'csrf-token\']").attr("content")
                }
            });//for token purpose in laravel

        $.ajax({type:"POST", url: "' . url("store/review/ajax/" . $product_id) . '", data:$("#giveFeedbackForm_"+' . $order_id . $product_id . ').serialize(), success: function(data) {
        		$("#giveFeedbackInfo_' . $order_id . $product_id . '").modal("toggle");
            $(".order_action_"+data.order_id).html(data.action_btn_1 + data.action_btn_2);
            $(".order_status_"+data.order_id).html(data.status);
            $("#rating_status_"+data.order_id).html("Rating saved");
            document.location.reload(true);
            window.location = "' . url("store/manage-feedbacks") . '";
}, error: function(data){alert("error: "+data);}
});
});

//Rating star script
$(".rating_stars_' . $order_id . $product_id . '").hover(
    // Handles the mouseover
    function() {
        $(this).prevAll().andSelf().attr("src" , "' . asset('local/public/assets/images/rattingstar.png') . '");
        $(this).nextAll().attr("src" , "' . asset('local/public/assets/images/star.png') . '");
    },
    // Handles the mouseout
    function() {
        $(this).prevAll().andSelf().attr("src" , "' . asset('local/public/assets/images/rattingstar.png') . '");
    },

    $(".rating_stars_' . $order_id . $product_id . '").click(function(){
        var count =  $(this).prevAll().length;
        document.getElementById("stars_rating_' . $order_id . $product_id . '").value = count;
        var var1= document.getElementById("stars_rating_' . $order_id . $product_id . '").value;
    })
);

        </script>
';
    return $html;
}

function getCartProductCost($product_id, $quantity, $size_id = 0, $color_id = 0, $package_id = 0) {
    $orderProductSelectedPackage = '';
    $orderProductSelectedSize    = '';
    $orderProductSelectedColor   = '';

    if($package_id > 0) {
        $orderProductSelectedPackage = StoreProductKeeping::where('id', $package_id)->select(['id', 'package'])->first();

        if(isset($orderProductSelectedPackage->package)) {
            $orderProductSelectedPackage = $orderProductSelectedPackage->package;
        }
    }

    if($size_id > 0) {
        $orderProductSelectedSize = StoreProductKeeping::where('id', $size_id)->select(['id', 'size'])->first();
        if(isset($orderProductSelectedSize->size)) {
            $orderProductSelectedSize = $orderProductSelectedSize->size;
        }
    }

    if($color_id > 0) {
        $orderProductSelectedColor = StoreProductKeeping::where('id', $color_id)->select(['id', 'color'])->first();
        if(isset($orderProductSelectedColor->color)) {
            $orderProductSelectedColor = $orderProductSelectedColor->color;
        }
    }

    $orderProductDetail = DB::table('store_products_keeping');

    $orderProductDetail->where('product_id', $product_id);

    if($orderProductSelectedColor != '') {
        $orderProductDetail->Where('color', $orderProductSelectedColor);
    }

    if($orderProductSelectedSize != '') {
        $orderProductDetail->Where('size', $orderProductSelectedSize);
    }

    if($orderProductSelectedPackage != '') {
        $orderProductDetail->Where('package', $orderProductSelectedPackage);
    }

    $orderProductDetail = $orderProductDetail->first();

    if(isset($orderProductDetail->id)) {
        return ($orderProductDetail->price * $quantity);
    }
    return 0;
}

function getCartProductKeepingObject($product_id, $size_id = 0, $color_id = 0, $package_id = 0) {
    $orderProductSelectedPackage = '';
    $orderProductSelectedSize    = '';
    $orderProductSelectedColor   = '';

    if($package_id > 0) {
        $orderProductSelectedPackage = StoreProductKeeping::where('id', $package_id)->select(['id', 'package'])->first();

        if(isset($orderProductSelectedPackage->package)) {
            $orderProductSelectedPackage = $orderProductSelectedPackage->package;
        }
    }

    if($size_id > 0) {
        $orderProductSelectedSize = StoreProductKeeping::where('id', $size_id)->select(['id', 'size'])->first();
        if(isset($orderProductSelectedSize->size)) {
            $orderProductSelectedSize = $orderProductSelectedSize->size;
        }
    }

    if($color_id > 0) {
        $orderProductSelectedColor = StoreProductKeeping::where('id', $color_id)->select(['id', 'color'])->first();
        if(isset($orderProductSelectedColor->color)) {
            $orderProductSelectedColor = $orderProductSelectedColor->color;
        }
    }

    $orderProductDetail = DB::table('store_products_keeping');

    $orderProductDetail->where('product_id', $product_id);

    if($orderProductSelectedColor != '') {
        $orderProductDetail->Where('color', $orderProductSelectedColor);
    }

    if($orderProductSelectedSize != '') {
        $orderProductDetail->Where('size', $orderProductSelectedSize);
    }

    if($orderProductSelectedPackage != '') {
        $orderProductDetail->Where('package', $orderProductSelectedPackage);
    }

    $orderProductDetail = $orderProductDetail->first();

    if(isset($orderProductDetail->id)) {
        return ($orderProductDetail);
    }
    return 0;
}

function getProductKeepingDetail($productKeepingId) {
    $detail = StoreProductKeeping::where('id', $productKeepingId)->first();
    if(isset($detail->id)) {
        return $detail;
    }
    return '';
}

function reviseFeedbackFormHtml($order_id, $review, $storeName, $product_id, $reasons = [1, 2, 3]) {

    $html = '<div class="modal fade" id="reviseFeedbackInfo_' . $order_id . $product_id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Revise Feedback</h4>
            </div>
            <div class="modal-body">
                    <label class="form-control-label">Order ID: ' . getOrderNumber($order_id) . '
                    ' . Form::open(['url'     => url(),
                                    "id"      => "reviseFeedbackForm_" . $order_id . $product_id,
                                    "enctype" => "multipart/form-data"
        ]) . '
                <input type="hidden" value="' . $product_id . '" name="product_id" />
                <input type="hidden" value="' . $order_id . '" name="order_id" />
                <input type="hidden" value="' . $review->id . '" name="review_id" />
                <input type="hidden" value="' . $storeName . '" name="store_name" />
                    <label class="form-control-label">*Select a reason why you need to revise feedback</label>
                        <select class="form-control" name="reason">
                            ';

    foreach ($reasons as $reason) {
        $html .= '<option value="">Reason goes here</option>';
    }
    $inputStars = '<div>
                    <input type="text" style="display: none" id="stars_rating_' . $order_id . $product_id . '" name="stars_rating">
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                    <img class="rating_stars_' . $order_id . $product_id . '" src="' . asset('local/public/assets/images/star.png') . '" alt="Rating" />
                </div>';

    $html .= '</select>
                    <label class="form-control-label">How would you revise your rating for this product?</label>
                    <div class="">' . $inputStars . '</div>
                    <label class="form-control-label">Comment</label>
                    <textarea class="form-control" name="description">' . $review->description . '</textarea>
                </form>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="reviseSubmitBtn_' . $order_id . $product_id . '" class="btn btn-primary save_revise_feed_changes" data-dismiss="modal"> Save changes</button>
            </div>
        </div>
    </div>
</div>
<script src="' . asset("local/public/assets/bootstrap/javascripts/jquery-2.1.3.js") . '"></script>

            <script>
        $("#reviseSubmitBtn_' . $order_id . $product_id . '").click(function(evt){
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name=\'csrf-token\']").attr("content")
                }
            });//for token purpose in laravel
        $.ajax({type:"POST", url: "' . url("store/" . $storeName . "/reviseFeedback/" . $order_id) . '", data:$("#reviseFeedbackForm_"+' . $order_id . $product_id . ').serialize(), success: function(data) {
        		$("#reviseFeedbackInfo_' . $order_id . $product_id . '").modal("toggle");
                $(".order_action_"+data.order_id).html(data.action_btn_1 + data.action_btn_2);
                $(".order_status_"+data.order_id).html(data.status);
                $("#rating_status_"+data.order_id).html("Rating revised");
                document.location.reload(true);
                window.location = "' . url("store/manage-feedbacks") . '";
}, error: function(data){alert("error: "+data);}
});
});

//Rating star script
$(".rating_stars_' . $order_id . $product_id . '").hover(
    // Handles the mouseover
    function() {
        $(this).prevAll().andSelf().attr("src" , "' . asset('local/public/assets/images/rattingstar.png') . '");
        $(this).nextAll().attr("src" , "' . asset('local/public/assets/images/star.png') . '");
    },
    // Handles the mouseout
    function() {
        $(this).prevAll().andSelf().attr("src" , "' . asset('local/public/assets/images/rattingstar.png') . '");
    },

    $(".rating_stars_' . $order_id . $product_id . '").click(function(){
        var count =  $(this).prevAll().length;
        document.getElementById("stars_rating_' . $order_id . $product_id . '").value = count;
        var var1= document.getElementById("stars_rating_' . $order_id . $product_id . '").value;
    })
);

        </script>
';
    return $html;
}

function getProductUrlByIdAndOwnerId($id, $ownerId) {
    //Get Product owner username
    $username = getUserNameByUserId($ownerId);
    if(isset($username)) {
        return url('store/' . $username . '/product/' . $id);
    } else {
        return url('javascript:void(0);');
    }
}

function getProductPhotoSrc($file_id = NULL, $photo_id = NULL, $owner_id = NULL, $image_size_type = NULL) {

//	if ( isset( $owner_id ) ) {
//		$photo = StoreAlbumPhotos::where( 'owner_id', $owner_id )
//		                         ->where( 'owner_type', 'product' )
//		                         ->select( 'file_id' )
//		                         ->orderBy( 'album_id', 'DESC' )
//		                         ->first();
//
//		if ( isset( $photo->file_id ) ) {
    if($image_size_type != NULL) {
        $file = StoreStorageFiles::where('type', $image_size_type)->where('parent_id', $owner_id)->first();
    } else {
        $file = StoreStorageFiles::where('parent_id', $owner_id)->first();
    }

    if(isset($file->storage_path)) {
        return \Config::get('constants_activity.PHOTO_URL') . $file->storage_path . '?type=' . urlencode($file->mime_type);
    }

    return '';
    //}
    //}
}

function getPreviousStoreUrl() {
    $url = \Config::get("constants_brandstore.PREVIOUS_STORE_URL");
    if($url != '') {
        return 'store/' . $url;
    } else {
        return '';
    }
}

function setPreviousStoreUrl($storeName) {
    \Config::set("constants_brandstore.PREVIOUS_STORE_URL", $storeName);

    return 1;
}

function product_image_src($product_id = NULL) {
    if(isset($product_id)) {
//		$photo = StoreAlbumPhotos::where( 'owner_id', $product_id )
//		                         ->where( 'owner_type', 'product' )
//		                         ->select( 'file_id' )
//		                         ->first();

        //if ( isset( $photo->file_id ) ) {
        $file = StoreStorageFiles::where('parent_id', $product_id)->where('type', 'product_profile')->first();

        if(isset($file->storage_path)) {
            return \Config::get('constants_activity.PHOTO_URL') . $file->storage_path . '?type=' . urlencode($file->mime_type);
        }
        //}
    }

    return asset('/local/packages/Cartimatic/assets/images/no_photo.png');
}

function getUserDetail($id) {
    $User = User::where('id', $id)->orWhere('username', $id)->first();
    if(isset($User)) {
        return $User;
    } else {
        return FALSE;
    }
}

function getUserEmailAndUsername($id) {
    $User = User::select('email', 'username')->where('id', $id)->orWhere('username', $id)->first();
    if(isset($User)) {
        return $User;
    } else {
        return FALSE;
    }
}

function getUserNameByUserId($id) {
    $User = User::select('username')->where('id', $id)->first();
    if(isset($User)) {
        return $User->username;
    } else {
        return FALSE;
    }
}

function profileAddress($ownerInfo) {
    if(isset($ownerInfo->user_type)) {
        if($ownerInfo->user_type == \Config::get('constants.BRAND_USER')) {
            return $profileUrl = url('brand' . '/' . $ownerInfo->username);
        } else {
            return $profileUrl = url('profile' . '/' . $ownerInfo->username);
        }
    }

    return $profileUrl = url('home');

}

function getThumbSrcWithProductId($product_id = 0, $thumb_type = 'product_thumb') {
//	$productPhoto = StoreAlbumPhotos::where( 'owner_id', $product_id )
//	                                ->where( 'owner_type', 'product' )
//	                                ->select( 'photo_id' )
//	                                ->first();
//	if ( ! empty( $productPhoto ) ) {
//		return getPhotoUrl( $productPhoto->photo_id, '', 'product', $thumb_type );
//	}
//

    $file = StoreStorageFiles::where('parent_id', $product_id)
                             ->where('type', $thumb_type)->first();
    if(isset($file->storage_path)) {
        return \Config::get('constants_activity.PHOTO_URL') . $file->storage_path . '?type=' . urlencode($file->mime_type);
    } else {
        return asset('/local/public/images/login-page/no_image.jpg');
    }

}

function getPhotoUrl($photo_id = NULL, $user_id, $type = NULL, $thumb_type = NULL) {
//		return asset('/local/public/images/login-page/upload-img.png');

    if(isset($photo_id)) {
//		$photo                = StoreAlbumPhotos::where( 'photo_id', $photo_id )
//		                                        ->select( 'file_id' )
//		                                        ->first();
        $tryForPhotFromFileId = 0;
        if(!isset($photo)) {
            $tryForPhotFromFileId = 1;
            $file                 = StoreStorageFiles::where('file_id', $photo_id)->first();
        }//try once more to find if it it file_id only

        if(isset($thumb_type) AND isset($photo->file_id) AND $tryForPhotFromFileId == 0) {
            $file = StoreStorageFiles::where('parent_file_id', $photo->file_id)
                                     ->where('type', $thumb_type)->first();
        } else if(isset($photo->file_id) AND $tryForPhotFromFileId == 0) {
            $file = StoreStorageFiles::where('file_id', $photo->file_id)->first();
        }

        if(!isset($file->storage_path)) {
            if($type == 'ads') {
                return asset('/local/storage/images/ads/ad-default 170x170.png');
            } else if($type == 'brand') {
                return asset('/local/public/brands/thumb_brand_default.jpg');
            } else if($type == 'event') {
                return asset('/local/public/assets/images/left-menu-img-header.jpg');
            } else {
                return asset('/local/public/images/login-page/upload-img.png');
            }
        }

        if(isset($file->storage_path)) {
            return \Config::get('constants_activity.PHOTO_URL') . $file->storage_path . '?type=' . urlencode($file->mime_type);
        } else {
            return asset('/local/public/images/login-page/no_image.jpg');
        }
    }

    return asset('/local/public/images/login-page/no_image.jpg');
}

function getPhotoUrlRegularUser($photo_id = NULL, $user_id, $type = NULL, $thumb_type = NULL) {
//		return asset('/local/public/images/login-page/upload-img.png');
//dd($photo_id .' <> '. $user_id .' <> '. $type .' <> '. $thumb_type .' <> ');
    if(isset($photo_id)) {
        $photo                = AlbumPhoto::where('photo_id', $photo_id)
                                          ->select('file_id')
                                          ->first();
        $tryForPhotFromFileId = 0;
        if(!isset($photo)) {
            $tryForPhotFromFileId = 1;
            $file                 = StorageFile::where('file_id', $photo_id)->first();
        }//try once more to find if it it file_id only

        if(isset($thumb_type) AND isset($photo->file_id) AND $tryForPhotFromFileId == 0) {
            $file = StorageFile::where('parent_file_id', $photo->file_id)
                               ->where('type', $thumb_type)->first();
        } else if(isset($photo->file_id) AND $tryForPhotFromFileId == 0) {
            $file = StorageFile::where('file_id', $photo->file_id)->first();
        }

        if(!isset($file->storage_path)) {
            if($type == 'ads') {
                return asset('/local/storage/images/ads/ad-default 170x170.png');
            } else if($type == 'brand') {
                return asset('/local/public/brands/thumb_brand_default.jpg');
            } else if($type == 'event') {
                return asset('/local/public/assets/images/left-menu-img-header.jpg');
            } else {
                return asset('/local/public/images/login-page/upload-img.png');
            }
        }

        if(isset($file->storage_path)) {
            return \Config::get('constants_activity.PHOTO_URL') . $file->storage_path . '?type=' . urlencode($file->mime_type);
        } else {
            return asset('/local/public/images/login-page/no_image.jpg');
        }
    }

    return asset('/local/public/images/login-page/no_image.jpg');
}

function product_images_src($product_id = NULL) {
    $productImagesSrc = '';

    if(isset($product_id)) {
//		$fileIds = StoreAlbumPhotos::where( 'owner_id', $product_id )
//		                           ->where( 'owner_type', 'product' )
//		                           ->lists( 'file_id' );

//		if ( count( $fileIds ) > 0 ) {

        $data[ 'mainImageFiles' ] = StoreStorageFiles::select('file_id', 'type', 'storage_path', 'mime_type')
                                                     ->where('type', NULL)
                                                     ->where('parent_id', $product_id)
                                                     ->orderBy('file_id', 'ASC')
//					->whereIn( 'file_id', $fileIds )
                                                     ->get();
//			$data['thumbImageFiles'] = StorageFile::select('file_id', 'type', 'storage_path', 'mime_type')->where('type', '=', 'product_thumb')->whereIn( 'parent_file_id', $fileIds )->get();
//			return array_merge( array($data['thumbImageFiles']), array($data['mainImageFiles'])) ;

        return $data;
//		}
    }

    $productImagesSrc[ 0 ] = asset('/local/packages/Cartimatic/assets/images/no_photo.png');

    return $productImagesSrc;
}

function product_images_edit_src($product_id = NULL) {
    $productImagesSrc = '';

    if(isset($product_id)) {
//		$fileIds = StoreAlbumPhotos::where( 'owner_id', $product_id )
//		                           ->where( 'owner_type', 'product' )
//		                           ->lists( 'file_id' );
//
//		if ( count( $fileIds ) > 0 ) {

//			$files = StoreStorageFiles::whereIn( 'file_id', $fileIds )->get();
        $files = StoreStorageFiles::where('type', 'product_profile')
                                  ->where('parent_id', $product_id)->get();

        foreach ($files as $file) {
            if(isset($file->storage_path)) {
                $productImagesSrc[ $file->parent_file_id ] = \Config::get('constants_activity.PHOTO_URL') . $file->storage_path . '?type=' . urlencode($file->mime_type);
            }
        }

        return $productImagesSrc;
        //}
    }

    $productImagesSrc[ 0 ] = asset('/local/packages/Cartimatic/assets/images/no_photo.png');

    return $productImagesSrc;
}

function isProductRatingExist($product_id) {
    $rate = StoreProductReview::select('id')->where('product_id', $product_id)->first();

    if(isset($rate->id)) {
        return 1;
    } else {
        return 0;
    }
}

function getRatings($product_id) {
    $rate = StoreProductReview::where('product_id', $product_id)->first();
    if($rate == NULL) {
        return 0;
    } else {
        $ratings = StoreProductReview::where('product_id', $product_id)->get();
        $sum     = 0;
        $count   = sizeof($ratings);
        foreach ($ratings as $rating) {
            $sum = $sum + $rating->rating;
        }

        return ($sum / $count);
    }
}

function getRatingOfUserById($user_id, $product_id) {
    $review = StoreProductReview::where('product_id', $product_id)->where('owner_id', $user_id)->first();
    if(isset($review->id)) {
        return $review;
    } else {
        return 0;
    }
}

function isStoreBrand($brand_id) {
    $brand = User::select(['user_type'])->select('id')->where('id', $brand_id)->orWhere('username', $brand_id)->first();
}

function getUserIpAddress() {
    // Get user IP address
    if(isset($_SERVER[ 'HTTP_CLIENT_IP' ]) && !empty($_SERVER[ 'HTTP_CLIENT_IP' ])) {
        $ip = $_SERVER[ 'HTTP_CLIENT_IP' ];
    } elseif(isset($_SERVER[ 'HTTP_X_FORWARDED_FOR' ]) && !empty($_SERVER[ 'HTTP_X_FORWARDED_FOR' ])) {
        $ip = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
    } else {
        $ip = (isset($_SERVER[ 'REMOTE_ADDR' ])) ? $_SERVER[ 'REMOTE_ADDR' ] : '0.0.0.0';
    }

    $ip = filter_var($ip, FILTER_VALIDATE_IP);

    return $ip = ($ip === FALSE) ? '0.0.0.0' : $ip;
}

function getUserGender() {
    $user = \App\Consumer::select('id', 'gender')->where('id', (isset(Auth::user()->id)) ? Auth::user()->userable_id : -1)->first();
    if(isset($user->gender)) {
        return $user->gender;
    }
    return 0;
}

function getUserAge() {
    $userDob = \App\Consumer::select('id', 'birthdate')->where('id', (isset(Auth::user()->id)) ? Auth::user()->userable_id : -1)->first();

    if(isset($userDob->birthdate)) {
        return Carbon::now()->toDateString() - $userDob->birthdate;
    }

    return 0;

}

function getUserAgeCarbon() {
    return \App\Consumer::select('birthdate')->where('id', Auth::user()->userable_id)->first();
}

//====================== End of Zahid code =====================

//=======================Ubaid code ============================

//====================== End of Ubaid code =====================

//=======================Mustabeen code ============================

function getCatByID($id) {
    // User id => $id
    $owner = getUserDetail($id);

    $category_ids = StoreProduct::where('owner_id', $owner[ 'id' ])
                                ->orderByRaw("RAND()")
                                ->take(5)
                                ->distinct()
                                ->lists('category_id', 'category_id');
    if($category_ids->isEmpty()) {
        return $category_ids;
    } else {
        return Category::whereIn('id', $category_ids)->get();
    }
}

function getSubByCatID($id) {
    return Category::where('category_parent_id', $id)->orderBy("name", 'ASC')->get();
}

function myBrands($take = NULL) {
    if(is_null($take)) {
        $take = 6;
    }
    $userFollowingBrandIds = DB::table('brand_memberships')
                               ->where('user_approved', 1)
                               ->where('brand_approved', 1)
                               ->where('user_id', Auth::user()[ 'id' ])
                               ->lists('brand_id');
    if(count($userFollowingBrandIds) > 0) {
        return $brands = User::where('user_type', \Config::get('constants.BRAND_USER'))
                             ->with('brand_detail')
                             ->whereIn('id', $userFollowingBrandIds)
                             ->orderByRaw("RAND()")->take($take)->get();
    }

    return FALSE;
}

function recomendedBrands($take = NULL) {
    if(is_null($take)) {
        $take = 6;
    }
    $userFollowingBrandIds = DB::table('brand_memberships')
                               ->where('user_approved', 1)
                               ->where('brand_approved', 1)
                               ->where('user_id', Auth::user()[ 'id' ])
                               ->lists('brand_id');

    return $brands = User::where('user_type', \Config::get('constants.BRAND_USER'))
                         ->whereNotIn('id', $userFollowingBrandIds)
                         ->with('brand_detail')
                         ->take($take)->get();

    return FALSE;
}

function getProductDetailsByID($product_id) {
    return DB::table('store_products')->where('id', $product_id)->first();
}

function isStoreHaveProducts($store_name) {
    $storeOwner = getUserDetail($store_name);
    if(!isset($storeOwner->id)) {
        return 0;
    }
    $product = DB::table('store_products')->where('owner_id', $storeOwner->id)->first();

    if(isset($product->id)) {
        return 1;
    } else {
        return 0;
    }
}

function getBrandDetailsByProductID($product_id) {
    $brand = DB::table('store_products')->where('id', $product_id)->first();

    return DB::table('users')->where('id', $brand->owner_id)->first();
}

function CheckIfReviewAlreadyGiven($product_id, $user_id) {
    $review = DB::table('store_product_reviews')->where('product_id', $product_id)->where('owner_id', $user_id)->first();
    if($review == []) {
        return 1;
    } else {
        return 0;
    }
}

function getOrderAllProducts($order_id = 0) {
    return $orderAllProductsIds = StoreOrderItems::where('order_id', $order_id)->get();
}

function getRegionName($countryId) {
    $country = DB::table('countries')->select('nicename')->where('id', $countryId)->first();

    if(isset($country->nicename)) {
        return $country->nicename;
    }
    return '';
}

function getCountryIso($countryId) {
    $country = DB::table('countries')->select('iso')->where('id', $countryId)->first();

    if(isset($country->iso)) {
        return $country->iso;
    }
    return '';
}

function getRegionId($countryId) {
    $country = DB::table('countries')->select('region')->where('id', $countryId)->first();

    if(isset($country->region)) {
        $regionName = strtolower($country->region);
        $region     = StoreShippingRegion::where('name', $regionName)->first();

        if(isset($region->id)) {
            return $region->id;
        }
    }
    return '';
}

function getReviewStatusForBuyer($review = NULL, $storeName = NULL, $order_id = NULL, $product_id = NULL) {
    $data[ 'class' ]        = '';
    $data[ 'status' ]       = '';
    $data[ 'action_btn_1' ] = '';
    $data[ 'action_btn_2' ] = '';
    $data[ 'popUpHtml' ]    = '';

    if(!isset($review->id)) {
        $data[ 'class' ]        = 'not_reviewd';
        $data[ 'status' ]       = '';
        $data[ 'action_btn_1' ] = 'Awaiting for Feedback<br /><a class="btn btn-primary" data-toggle="modal" data-target="#giveFeedbackInfo_' . $order_id . $product_id . '">Give Feedbacks</a>';
        $data[ 'action_btn_2' ] = '';
        $data[ 'popUpHtml' ]    = giveFeedbackFormHtml($order_id, $product_id, $storeName);
    }

    if(isset($review->id)) {
        if($review->is_revise_request == 1 AND $review->is_revised != 1) {
            $data[ 'class' ]        = 'reviewed_not_revised';
            $data[ 'status' ]       = '';
            $data[ 'action_btn_1' ] = 'Active<br /><a class="btn btn-primary" data-toggle="modal" data-target="#reviseFeedbackInfo_' . $order_id . $product_id . '">Revise Feedback</a>';
            $data[ 'action_btn_2' ] = '';
            $data[ 'popUpHtml' ]    = reviseFeedbackFormHtml($order_id, $review, $storeName, $product_id);
        } else {
            $data[ 'class' ]        = 'reviewed';
            $data[ 'status' ]       = '';
            $data[ 'action_btn_1' ] = 'Active';
            $data[ 'action_btn_2' ] = '';
            $data[ 'popUpHtml' ]    = '';
        }
    }

    return $data;
}

function getReviewStatusForSeller($review, $orderBuyer, $storeName, $order_id, $product_id = NULL) {
    $data[ 'class' ]        = '';
    $data[ 'status' ]       = '';
    $data[ 'action_btn_1' ] = '';
    $data[ 'action_btn_2' ] = '';
    $data[ 'popUpHtml' ]    = '';

    if(!isset($review->id)) {
        $data[ 'class' ]        = 'not_reviewd';
        $data[ 'status' ]       = 'Awaiting for Feedback <br>';
        $data[ 'action_btn_1' ] = '';
        $data[ 'action_btn_2' ] = '<a class="blueBtn" id="sendFeedbackReminder_' . $order_id . $product_id . '" href="javascript:void(0);">Send Reminder</a>';
        $data[ 'popUpHtml' ]    = sendFeedbackReminder($order_id, $product_id, $storeName);
    }

    if(isset($review->id)) {
        if($review->is_revise_request == 0 AND $review->rating < 5) {
            $data[ 'class' ]        = 'reviewed_not_revised';
            $data[ 'status' ]       = 'Active <br>';
            $data[ 'action_btn_1' ] = '<a class="greyBtn" id="" href="' . url("store/" . $storeName . "/admin/send-request-revise-feedback/" . $review->id) . '">Request to Revise</a>';
            $data[ 'action_btn_2' ] = '';
        } else if($review->is_revise_request == 1 AND $review->is_revised == 0) {
            $data[ 'class' ]        = 'request_sent';
            $data[ 'status' ]       = 'Request Sent';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '';
        } else {
            $data[ 'class' ]        = 'reviewed';
            $data[ 'status' ]       = 'Active <br>';
            $data[ 'action_btn_1' ] = '';
            $data[ 'action_btn_2' ] = '';
        }
    }

    return $data;
}

function confirmationOfOrderReceivedBuyerFormHtml($order_id) {
    $html = '
<div id="confirmationOfOrderReceived_' . $order_id . '" class="cssPopup_overlay">
	<div class="cssPopup_popup" style="width:430px;">
	 	<a class="cssPopup_close" href="#">&times;</a>
<div class="sd-popup">
                <div class="sdp-header">Confirmation Of Order Received</div>
                <div class="sd-orderId">Order ID: ' . getOrderNumber($order_id) . '</div>
                ' . Form::open(['url'     => url(),
                                "id"      => "confirmationOfOrderReceived_" . $order_id,
                                "class"   => "form-container wA",
                                "enctype" => "multipart/form-data"
        ]) . '
                <p>If you have issue with received goods, you can request refund now.</p>
                    <a href="javascript:void(0);" class="blueBtn order_status_btn order_action_brn_' . $order_id . ' confirm_order_btns" id="approve_6_order_' . $order_id . '">Order Received</a>
                    <a href="javascript:void(0);" class="greyBtn confirm_order_btns" id="disputeBtn_' . $order_id . '">Request Refund</a>
                    <a href="#" class="blueBtn confirm_order_btns">Cancel</a>
                </form>
            </div>
</div>
</div>
<script>
        $("#disputeBtn_' . $order_id . '").click(function(evt){
            evt.preventDefault();
            var urlToSubmit = "' . url("store/order/dispute/" . $order_id) . '";
        	window.location.href = urlToSubmit;
		});
</script >
            ';
    return $html;
}

function cancelOrderBuyerFormHtml($order_id) {
    $html = '
<div id="orderCancelationInfo_' . $order_id . '" class="cssPopup_overlay">
	<div class="cssPopup_popup" style="width:430px;">
	 	<a class="cssPopup_close" href="#">&times;</a>
<div class="sd-popup">
                <div class="sdp-header">Order Cancellation</div>
                <div class="sd-orderId">Order ID: ' . getOrderNumber($order_id) . '</div>
                ' . Form::open(['url'     => url(),
                                "id"      => "cancelOrderForm_" . $order_id,
                                "class"   => "form-container wA",
                                "enctype" => "multipart/form-data"
        ]) . '
                <p>If you have made payment for this order but not arrived to '.\Config::get("constants.SITE_DISPLAY_NAME").'  yet, please do not cancel this order.</p>
                    <input type="hidden" name="order_id" value = "' . $order_id . '" />
                    <label>*Select a reason For cancellation:</label>
                    <div class="field-item">
                        <select name="reason">
                        	<option value="1">Reason goes here</option>
                        	<option value="2">Reason goes here</option>
						</select>
                    </div>
                    <input type="button" class="btn" value="Submit" id="cancelOrderBtn_' . $order_id . '" />
                </form>
            </div>
</div>
</div>
<script>
        $("#cancelOrderBtn_' . $order_id . '").click(function(evt){
            evt.preventDefault();
        $.ajax({type:"POST", url: "' . url("store/cancelOrder/" . $order_id) . '", data:$("#cancelOrderForm_"+' . $order_id . ').serialize(), success: function(data) {
        		
        		if(data.status == "success"){
   					$(".order_action_brn_"+data.order_id).remove();
                	$(".order_action_"+data.order_id).html(data.action_btn_1 + data.action_btn_2);
                	$(".order_status_"+data.order_id).html(data.status);
                	$("#orderCancelationInfo_' . $order_id . '").remove();
                }else{
                	jQuery("#error_mesage_"' . $order_id . ').text(data.message_text).show().css("color","#FF0000");
                }

}, error: function(data){alert("error: "+data);}
});
});
        </script >
            ';
    return $html;
}

function countryNameById($id) {
    $country = DB::table('countries')->where('id', $id)->first();

    if(isset($country->name)) {
        return $country->name;
    }

    return '';
}

//====================== End of mustabeen code =====================

//====================== Start of yasir's code =====================

function getPhotoUrlByFile($file) {
    if(isset($file->storage_path)) {
        return $path = url() . '/local/storage/app/photos' . "/" . $file->storage_path;
    }

    return '';
}

function dispute_status($status, $user_type) {
    if(is_null($status)) {
        if($user_type == Config::get('constants.REGULAR_USER')) {
            return 'You request a refund for this order. Please wait for the supplier to respond.';
        }
        return 'Buyer request a refund against this order';
    } else {
        return Config::get('constants_brandstore.DISPUTE_STATUS_STRING.' . $status);
    }
}

function timeRemainingPopUp($time, $order_id) {
    return '<div id="courierServiceInfo_' . $order_id . '" class="cssPopup_overlay">
        <div class="cssPopup_popup">
            <a class="cssPopup_close" href="#">&times;</a>

            <div class="courierServiceInfoWrap">

                <div class="addProduct">
                    <h1>Time Remaining</h1>


                    <div id="delivery_info_form_wrap" class="selectdiv delivery_info_form_wrap">

						You cannot Open a dispute against your order. Order reached you ' . $time . '.
                    </div>
                </div>
            </div>
        </div>
    </div>';
}

function getOrderAllProductsDetail($order_id = 0) {
    $orderAllProductsIds = StoreOrderItems::where('order_id', $order_id)->lists('product_id');
    return $orderAllProducts = StoreProduct::whereIn('id', $orderAllProductsIds)->get();
}

//====================== End of yasir's code =====================
function getAvailableBalance($user_id) {
    $srObj = new \Cartimatic\Store\Repository\StoreRepository();
    return $srObj->getAvailableBalance($user_id);
}

function getPendingOrders($user_id) {
    $order_status = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_VERIFIED');
    $soObj        = new \Cartimatic\Store\StoreOrder();
    return $soObj->where('seller_id', $user_id)->where('status', $order_status)->count();
}

function getBrandInfo($brand_id) {
    return User::where('id', $brand_id)->select(['id', 'displayname', 'username'])->first();
}
function getStoreBrandInfo($brand_id) {
  $brand = \Cartimatic\Store\StoreBrand::where('id', $brand_id)->first();
  if(!isset($brand->id)){
    return '';
  }
  return $brand;
}
function getStoreSupplierInfo($supplier_id) {
  $supplier = \Cartimatic\Store\StoreSupplier::where('id', $supplier_id)->first();
  if(!isset($supplier->id)){
    return '';
  }
  return $supplier;
}

function countRequestToReviseCurrentUser() {
    $productReviewCount = 0;

    $usder_id = Auth::user()->id;
    $orderIds = StoreOrder::where('status', \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED"))->where('customer_id', $usder_id)->lists('id');

    $orderProductsIds = StoreOrderItems::whereIn('order_id', $orderIds)->groupBy("product_id")->lists('product_id');

    foreach ($orderProductsIds as $orderProductsId) {
        $review = StoreProductReview::where('product_id', $orderProductsId)->where('owner_id', $usder_id)->first();
        if(isset($review->id)) {
            if($review->is_revised == 0 AND $review->is_revise_request == 1) {
                $productReviewCount++;
            }
        } else {
            $productReviewCount++;
        }
    }
    return $productReviewCount;
}

function getProductAttribute($id) {

    return \Cartimatic\Store\StoreProductAttribute::where('id', $id)->first();
}

function getCategorySlug($category_id = 0) {
    $slug = Category::select("slug")->where("id", $category_id)->first();
    if(isset($slug->slug)) {
        return $slug->slug;
    }
    return '';
}

function getCategoryById($category_id = 0) {
    $category = Category::where("id", $category_id)->first();
    if(isset($category->id)) {
        return $category;
    }
    return '';
}

function product_price_info($product_id = 0) {
    $minimum_price = getProductKeepingMinimumPrice($product_id);
    return $minimum_price;
}

function getProductKeepingMinimumPrice($product_id) {
    $price = \Cartimatic\Store\StoreProductKeeping::where('product_id', $product_id)->whereNull('deleted_at')->min('price');

    $keeping = \Cartimatic\Store\StoreProductKeeping::where('product_id', $product_id)
                                                    ->where('price', $price)
                                                    ->orderBy('price', "ASC")
                                                    ->first();
    return $keeping;
}

function getProductKeepingRecords($product_id) {
    $keeping = \Cartimatic\Store\StoreProductKeeping::where('product_id', $product_id)
                                                    ->whereNull('deleted_at')
                                                    ->get();
    return json_encode($keeping);
}

function getProductKeeping($product_id, $master_attribute_1, $master_attribute_2) {
    $keeping = \Cartimatic\Store\StoreProductKeeping::select('id', 'price', 'quantity', 'discount')
                                                    ->where('product_id', $product_id)
                                                    ->whereNull('deleted_at')
                                                    ->where('master_attribute_1_value', $master_attribute_1)
                                                    ->where('master_attribute_2_value', $master_attribute_2)
                                                    ->first();
    return $keeping;
}

function getProductKeepingById($keeping_id) {
    $keeping = \Cartimatic\Store\StoreProductKeeping::select('id', 'price', 'quantity', 'discount')
                                                    ->where('id', $keeping_id)
                                                    ->whereNotNull('deleted_at')
                                                    ->orWhereNull('deleted_at')
                                                    ->first();
    return $keeping;
}

function getStoreItemAttributes($order_item_id) {
    return \Cartimatic\Store\StoreOrderItemAttribute::where('store_order_item_id', $order_item_id)->lists('store_product_attribute_id', 'store_product_attribute_id');
}

function productFavoriteHtml($product_id) {
    if($product_id > 0) {
        $favorite = ProductFavorites::where('product_id', $product_id)
                                    ->where('poster_id', (isset(Auth::user()->id) ? Auth::user()->id : -1))
                                    ->first();
        if(isset($favorite->product_id)) {
            return '<a href="javascript:void(0);" title="Un-Favorite me"><img src="' . asset("local/public/assets/image/favourite-icon-orange.png") . '" class="product-un-favorite-btn" id="' . $product_id . '" title="Un-Favorite" alt="Un-Favorite"/></a>';
        } else {
            return '<a href="javascript:void(0);" title="Favorite me"><img src="' . asset("local/public/assets/image/favourite-icon.png") . '" class="product-favorite-btn" id="' . $product_id . '" title="Favorite it" alt="Favorite it"/></a>';
        }
    }
    return '';
}


function productFavoriteCategory($product_id) {
    if($product_id > 0) {
        $favorite = ProductFavorites::where('product_id', $product_id)
                                    ->where('poster_id', (isset(Auth::user()->id) ? Auth::user()->id : -1))
                                    ->first();
        if(isset($favorite->product_id)) {
            return '<a href="javascript:void(0);" title="Un-Favorite me"><img src="' . asset("local/public/assets/image/favourite-icon-orange.png") . '" class="product-un-favorite-btn" id="' . $product_id . '" title="Un-Favorite" alt="Un-Favorite" style="width: 28px;padding: 3px 0px 0px 2px;"/></a>';
        } else {
            return '<a href="javascript:void(0);" title="Favorite me"><img src="' . asset("local/public/assets/image/favourite-icon.png") . '" class="product-favorite-btn" id="' . $product_id . '" title="Favorite it" alt="Favorite it"
            style="width: 28px;padding: 3px 0px 0px 2px;"/></a>';
        }
    }
    return '';
}
function isProductFavorite($product_id)
{
    return ProductFavorites::where('product_id', $product_id)->where('poster_id', (isset(Auth::user()->id) ? Auth::user()->id : -1))->count();
}

function wishListCounter() {

    if(isset(Auth::user()->id)) {
        $user_id       = Auth::user()->id;
        $favoriteCount = ProductFavorites::where('poster_id', $user_id)->count();
        return $favoriteCount;
    } else {
        return 0;
    }

}

function wishListPrice($product_id) {

    $price = DB::table('store_products_keeping')->where('product_id', $product_id)->min('price');
    return $price;
}

function quantityPrice($product_id) {
    $price = DB::table('store_products_keeping')->where('product_id', $product_id)->max('quantity');
    return $price;
}

function allCategory() {
    $categories     = ['0' => 'All Categories'];
    $CategoriesList = DB::table('store_product_categories')->whereNull('deleted_at')->where('category_parent_id', 0)->lists('name', 'id');
    return $categories + $CategoriesList;

}

function getImagePathUseByProductId($product_id) {
    $image_path = DB::table('store_product_images')->select('image_path')->where('product_id', $product_id)->first();

    if(empty($image_path) || is_null($image_path)) {
        return asset('local/public/assets/images/cartimatic/product-large-image.jpg');
    } else {
        return url('photo/' . $image_path->image_path);
    }

}

function getFilterCategoryIds($category_id = 0) {
    $productCategoryIds = Category::where('category_parent_id', $category_id)->lists('id');

    if(count($productCategoryIds) < 1) {
        $productCategoryIds = [$category_id];
    }

    return $productCategoryIds;
}

function countAttributeProducts($category_ids, $attrbute_value_id = 0) {

    $productIds          = StoreProduct::where('category_id', '!=', 0)->where('is_published', 1)->whereIn('category_id', $category_ids)->whereNull('deleted_at')->lists('id');
    $productAttributeIds = \Cartimatic\Store\StoreProductAttribute::where('is_deleted', 0)->whereIn('product_id', $productIds)->lists('id');
    return \Cartimatic\Store\StoreProductAttributeValue::whereIn('store_product_attribute_id', $productAttributeIds)->where('store_attribute_value_id', $attrbute_value_id)->count();
}

function countCartProducts() {
    $all_products  = Session::get('cart.products');
    $totalProducts = 0;
    if(count($all_products) > 0) {
        foreach ($all_products as $brand_id => $products) {
            foreach ($products as $product) {
                $totalProducts++;
            }
        }
    }

    return $totalProducts;
}

function availableProducts($productID, $productKeepingId, $objectType, $objectId) {
    return $dataCredit = \Cartimatic\Store\StoreProductKeepingLog::whereProductId($productID)
                                                                 ->where('product_keeping_id', $productKeepingId)
                                                                 ->where('object_type', $objectType)
                                                                 ->where('object_id', $objectId)
                                                                 ->where('type', 'credit')
                                                                 ->sum('quantity');

    $dataDebit = \Cartimatic\Store\StoreProductKeepingLog::whereProductId($productID)
                                                         ->where('product_keeping_id', $productKeepingId)
                                                         ->select('SUM(quantity as debit) where type = debit')
                                                         ->get();
}

function getInStock($productId) {
    return StoreProductKeeping::whereProductId($productId)->sum('quantity');
}

function getInStockPos($productId, $pos_id) {

    return PosProductKeeping::whereProductId($productId)->where('pos_id', $pos_id)->sum('quantity');
}

function getTotal($productId, $objectType = NULL, $objectId = NULL, $keeping_id = null) {
    $query = StoreProductKeepingLog::whereProductId($productId)
                                   ->where('type', 'credit');
    //if(!is_null($objectType) && !is_null($objectId)) {
    $query->where('object_type', $objectType)
          ->where('object_id', $objectId);
    //};

    if(!is_null($keeping_id)){
        $query->where('product_keeping_id', $keeping_id);
    }

    return $query->sum('quantity');
}

function getTotalByVariant($productId, $keepingId, $objectType = NULL, $objectId = NULL) {
    $query = StoreProductKeepingLog::whereProductId($productId)
                                   ->whereProductKeepingId($keepingId)
                                   ->where('type', 'credit');
    //if(!is_null($objectType) && !is_null($objectId)) {
    $query->where('object_type', $objectType)
          ->where('object_id', $objectId);
    //};

    return $query->sum('quantity');
}

function getSentToPos($productId) {
    $query = StoreProductKeepingLog::whereProductId($productId)
                                   ->where('type', 'credit');
    $query->where('object_type', 'pos');

    return $query->sum('quantity');
}

function getSentToPosByVariant($productId, $keepingId) {
    $query = StoreProductKeepingLog::whereProductId($productId)
                                   ->whereStoreProductKeepingId($keepingId)
                                   ->where('type', 'credit');
    $query->where('object_type', 'pos');

    return $query->sum('quantity');
}

function countNotifications($user_id) {
    return \Cartimatic\Store\Notification::whereResourceId($user_id)->whereRead('0')->count();
}

function getOutOfStockProducts($id, $is_to_notify = '') {
    if(Auth::user()->id == $id) {
        $products = StoreProduct::where('store_products.owner_id', $id);
        $products->join('store_products_keeping as sk', 'store_products.id', '=', 'sk.product_id');

        $products->whereNull('sk.deleted_at');

        $products->where('sk.quantity', '<', DB::raw('sk.stock_alert_quantity'));
        $products->whereNull('store_products.deleted_at');

        $products->groupBy('store_products.id');

        $results = $products->count('store_products.id');

        if($is_to_notify != '' AND $results > 0) {
            return '<div id="custom_notifications" class="custom-notifications">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
      <li><a id="ntlink18" class="alert-error" href="#ntf18"><i class="fa fa-bell animated shake"></i></a></li></ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"><div id="ntf18" class="text alert-error" style=""><h2><i class="fa fa-bell"></i> Product Out Of Stock</h2><div class="close"><a href="javascript:void(0);" class="notification_close"><i class="fa fa-close out_of_stock_fa_close"></i></a></div><p>Your ' . $results . ' Product(s) is/are Out Of Stock. You can update them by clicking given link.</p><a class="btn btn-warning" href="' . url("store/" . Auth::user()->username . "/admin/manage-product?out_of_stock=1") . '">
                        Out of Stock</a></div></div>
    </div><script>
            $(document).on("click", ".out_of_stock_fa_close", function (evt) {
                var element = document.getElementById("custom_notifications").remove();
            });
        </script>';
        }

        return $results;
    }
    return 0;
}

function getStoreName($store_id) {
    $key = \Config::get('constants_theme.STORE_URL');
    $option = \App\StoreOption::where('store_id',$store_id)->where('key','like',$key)->select(['value'])->first();

    return ucfirst(@$option->value);
}

function dateFormat($datetime)
{
    return date('Y-m-d',strtotime($datetime));
}
function getSupplierNameByID($supplier_id)
{
    return \Cartimatic\Store\StoreSupplier::where('id',$supplier_id)->value('name');
}

function convertArrayToString($array=[], $delimiter=','){
    $arrayToString = '';
    foreach($array as $k => $arrItem):
        $arrayToString .= $arrItem.$delimiter.' ';
    endforeach;

    return $arrayToString;
}

function is_deletable_product($product_id=0){
  if($product_id > 0){
    $hasQuantity = productHasKeepingQuantity($product_id);
    $isSold = StoreOrderItems::select('id')->where('product_id', $product_id)->first();
    $isInGrnProduct = \Cartimatic\Store\StoreGrnProduct::select('id')->where('product_id', $product_id)->first();
 //   $isInPurchaseOrder = \Cartimatic\Store\StorePurchaseOrderProducts::select('id')->where('product_id', $product_id)->first();
    if(
      $hasQuantity != 1
      AND !isset($isSold->id)
      AND !isset($isInGrnProduct->id)
      //AND !isset($isInPurchaseOrder->id)
    ){
      return 1;
    }
    return 0;
  }
}

function productHasKeepingQuantity($product_id=0){
  $products_keeping = StoreProductKeeping::where('product_id', $product_id)->get();
  foreach ($products_keeping as $product_keeping){
    if($product_keeping->quantity > 0){
      return 1;
    }
  }
  return 0;
}
