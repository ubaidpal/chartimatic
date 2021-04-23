<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 1/6/2016
 * Time: 9:31 PM
 */
namespace Cartimatic\Store\Repository;

use App\Http\Requests\Request;
use Cartimatic\Store\Category;
use Cartimatic\Store\StoreDeliveryAddress;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreOrderItems;
use Cartimatic\Store\StoreOrderItemAttribute;
use Cartimatic\Store\StoreProductKeeping;
use Cartimatic\Store\StoreProductReview;
use Cartimatic\Store\StoreWithdrawal;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Cartimatic\Store\StoreProduct;
use App\Facades\UrlFilter;
use App\StorageFile;

use Carbon\Carbon;

use App\User;
use Cartimatic\Store\StoreReversal;
use Session;
use Auth;
use DB;
use Vinkla\Hashids\Facades\Hashids;
use Cartimatic\Store\StoreWithdrawalMethod;
use Cartimatic\Store\StoreTransaction;

class StoreRepository
{
    protected $store;

    protected $data;

    public function getPrarentCategory($sub_category_id)
    {
         $cat = Category::select('category_parent_id')->where( 'id', $sub_category_id )->first();
        if(isset($cat->category_parent_id)){
            return $cat->category_parent_id;
        }
    }
    /**
     * @param $sub_category_id
     *
     * @return int
     */
    public function subCategoryProducts($sub_category_id)
    {

        $products = StoreProduct::select('id', 'title', 'description', 'price', 'category_id as image', 'discount', 'owner_id')->where('sub_category_id', $sub_category_id)->get();

        if (is_object($this->returnValidData($products))) {
            foreach ($products as $product) {
                $product->image = getProductPhotoSrc('', '', $product->id, 'product_profile');
            }

            return $products;
        }

        return 0;
    }


    /**
     * @param $data
     *
     * @return int
     */
    public function returnValidData($data)
    {
        if (count($data) > 0) {
            return $data;
        } else {
            return 0;
        }
    }

    /*public function getShippingInfo($cartProducts) {

        $data = StoreProduct::where('id' , $cartProducts )->get();
        return $this->returnValidData($data);
    }*/
    public function storeOrder($brand_id = 0,$user_id, $cash_on_delivery = 0, $buy_it_now = 'no')
    {
        $address_id = $this->getCartDeliverAddress();
        $country_id = $this->getAddressFieldByID($address_id,'country_id');
        $order_ids = [];
        if($brand_id == 0){
            $allProducts = $this->getCartProducts(0, $buy_it_now);
            $affiliate_reward = 0;
            foreach ($allProducts as $brand_id => $products){
                $affiliate_reward = $orderCost = $total_affiliate_amount = $orderQuantity = $orderDiscount = $orderShippingCost = 0;
                $status = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_VERIFIED');
                $store_order_id = $this->saveOrder($user_id,$brand_id,$address_id,$status);
                $order_ids[$store_order_id] = $store_order_id;
                foreach ($products as $product){
                    $orderProductDetail = StoreProduct::where('id', $product['product_id'])->select(['id', 'affiliate_reward'])->first();
                    $orderQuantity = $product['quantity'] + $orderQuantity;
                    $productCostObject = getProductKeeping($product[ 'product_id' ], $product[ 'master_attribute_1' ], $product[ 'master_attribute_2' ]);
                    $orderCost = ($productCostObject->price * $product['quantity']) + $orderCost;

                    if(!empty($product['token'])){
                        $affiliate_reward = ($productCostObject->price / 100) * $orderProductDetail->affiliate_reward;
                        $total_affiliate_amount = ($productCostObject->price / 100) * $orderProductDetail->affiliate_reward +$total_affiliate_amount;
                    }
                    $productDiscount = ($productCostObject->price / 100) * $productCostObject->discount;

                    $this->storeOrdersItem($product['token'], $affiliate_reward, $product['product_id'], $store_order_id, $product['quantity'], $productCostObject->price, $productDiscount, $productCostObject->id);

                    $shippingCost = getProductShippingCost($product['product_id']);
                    //$shippingCost = $this->getProductRegionShippingCost($country_id,$product['product_id']);
                    if($product['quantity'] > 0) {
                        $shippingCost = $shippingCost * $product['quantity'];
                    }
                    $orderShippingCost = $orderShippingCost + $shippingCost;

                    $orderDiscount = $productDiscount + $orderDiscount;
                }
                $orderCost = $orderCost + $orderShippingCost;
                $this->updateStoreOrders($store_order_id, $orderCost, $total_affiliate_amount, $orderQuantity, $orderDiscount, $orderShippingCost);
                $this->addOrderNumber($store_order_id);
            }
//            if($buy_it_now != 0){
//                $this->deleteBuyItNowProductFromCart();
//            }
//            $this->empryCart();
            
        }else{
            $brandProducts = $this->getCartProducts($brand_id, $buy_it_now);
            $status = \Config::get('constants_brandstore.ORDER_STATUS.ORDER_PAYMENT_VERIFIED');
            $store_order_id = $this->saveOrder($user_id,$brand_id,$address_id,$status, $cash_on_delivery);
            $order_ids[$store_order_id] = $store_order_id;

            $orderCost = $total_affiliate_amount = $orderQuantity = $orderDiscount = $orderShippingCost = 0;
            foreach ($brandProducts as $product_id => $product){
                $orderProductDetail = StoreProduct::where('id', $product['product_id'])->select(['id', 'affiliate_reward'])->first();
                $orderQuantity = $product['quantity'] + $orderQuantity;


                $productCostObject = getProductKeeping($product[ 'product_id' ], $product[ 'master_attribute_1' ], $product[ 'master_attribute_2' ]);
                // $shippingCost = $this->getProductRegionShippingCost($country_id,$product['product_id']);
                //$productCost = $this->getCartProductCost($product['product_id'],$product['quantity']);
                $orderCost = $productCostObject->price * $product['quantity'] + $orderCost;
                $affiliate_reward = 0;
                if(!empty($product['token'])) {
                    $affiliate_reward       = ($productCostObject->price / 100) * $orderProductDetail->affiliate_reward;
                    $total_affiliate_amount = ($productCostObject->price / 100) * $orderProductDetail->affiliate_reward + $total_affiliate_amount;
                }

                $productDiscount = ($productCostObject->price / 100) * $productCostObject->discount;

                $this->storeOrdersItem($product['token'], $affiliate_reward, $product['product_id'], $store_order_id, $product['quantity'], $productCostObject->price, $productDiscount, $productCostObject->id);

                $shippingCost = getProductShippingCost($product['product_id']);
                //$shippingCost = $this->getProductRegionShippingCost($country_id,$product['product_id']);

                if($product['quantity'] > 0) {
                    $shippingCost = $shippingCost * $product['quantity'];
                }

                $orderShippingCost = $orderShippingCost + $shippingCost;

                $orderDiscount = $productDiscount + $orderDiscount;

            }

            //$this->deleteCartBrandProducts($brand_id);
            $orderCost = $orderCost + $orderShippingCost;
            $this->updateStoreOrders($store_order_id, $orderCost, $total_affiliate_amount, $orderQuantity, $orderDiscount, $orderShippingCost);
            $this->addOrderNumber($store_order_id);
        }

        if($buy_it_now != 'no'){
            $this->deleteBuyItNowProductFromCart($brand_id, $buy_it_now);
        }else{
            $this->empryCart();
        }
        return $order_ids;
    }
    public function saveOrder($user_id,$brand_id,$address_id,$status, $cash_on_delivery=1){
        $soObj = new StoreOrder();
        $soObj->customer_id = $user_id;
        $soObj->seller_id = $brand_id;
        $soObj->delivery_address_id = $address_id;
        ($cash_on_delivery == 1)? $soObj->payment_type = '2':$soObj->payment_type = 1;
        $soObj->status = $status;
        $soObj->total_price = 0;
        $soObj->total_discount = 0;
        $soObj->total_quantity = 0;
        $soObj->save();
        return $soObj->id;
    }
    public function getOrderTotal($brand_id = 0){

        $address_id = $this->getCartDeliverAddress();
        $country_id = $this->getAddressFieldByID($address_id,'country_id');
        $orderCost = 0;
        if($brand_id == 0){
            $allProducts = $this->getCartProducts();
            foreach ($allProducts as $brand_id => $products){
                foreach ($products as $product){
                    $productDetailShipping_cost   = getProductShippingCost($product['product_id']);

                    $productCostObject = getProductKeeping($product[ 'product_id' ], $product[ 'master_attribute_1' ], $product[ 'master_attribute_2' ]);
                    $shippingCost = $productDetailShipping_cost;
                    if($product['quantity'] > 0) {
                        $shippingCost = $shippingCost * $product['quantity'];
                    }
                    $productDiscount = $this->getCartProductDiscount($productCostObject->price, $productCostObject->discount,$product['quantity']);

                    $orderCost += (($productCostObject->price * $product['quantity'] - $productDiscount) + $shippingCost);
                }
            }
        }else{
            $brandProducts = $this->getBrandCartProducts($brand_id);
            foreach ($brandProducts as $product){
                $productDetailShipping_cost   = getProductShippingCost($product['product_id']);
                $productCostObject = getProductKeeping($product[ 'product_id' ], $product[ 'master_attribute_1' ], $product[ 'master_attribute_2' ]);
                $shippingCost = $productDetailShipping_cost;

                if($product['quantity'] > 0){
                    $shippingCost = $shippingCost * $product['quantity'];
                }

                $productDiscount = $this->getCartProductDiscount($productCostObject->price, $productCostObject->discount,$product['quantity']);
                $orderCost += (($productCostObject->price * $product['quantity'] - $productDiscount) + $shippingCost);
            }
        }
        return $orderCost;
    }
    public function getCartProductDiscount($discount, $productPrice, $quantity){
            return ($productPrice * $discount / 100) * $quantity;
    }

    public function getCartProductCost($product_id,$quantity, $size_id=0, $color_id=0, $package_id=0){

        if($package_id > 0){
            $orderProductSelectedPackage  = StoreProductKeeping::where('id', $size_id)->select(['id','package'])->first();

            if(isset($orderProductSelectedPackage->package)){
                $orderProductSelectedPackage = $orderProductSelectedPackage->package;
            }else{
                $orderProductSelectedPackage = '';
            }
        }

        if($size_id > 0){
            $orderProductSelectedSize  = StoreProductKeeping::where('id', $size_id)->select(['id','size'])->first();
            if(isset($orderProductSelectedSize->size)){
                $orderProductSelectedSize = $orderProductSelectedSize->size;
            }else{
                $orderProductSelectedSize = '';
            }
        }

        if($color_id > 0){
            $orderProductSelectedColor = StoreProductKeeping::where('id', $color_id)->select(['id','color'])->first();
            if(isset($orderProductSelectedColor->color)){
                $orderProductSelectedColor = $orderProductSelectedColor->color;
            }else{
                $orderProductSelectedColor = '';
            }
        }

        $orderProductDetail = DB::table('store_products_keeping');

        $orderProductDetail->where('product_id', $product_id);

        if($orderProductSelectedColor != ''){
            $orderProductDetail->Where('color', $orderProductSelectedColor);
        }

        if($orderProductSelectedSize != ''){
            $orderProductDetail->Where('size', $orderProductSelectedColor);
        }

        if($orderProductSelectedPackage != ''){
            $orderProductDetail->Where('package', $orderProductSelectedPackage);
        }

        $orderProductDetail->select(['id','price'])->first();
        $orderProductDetail->first();

        if(isset($orderProductDetail->id)){
            return ($orderProductDetail->price * $quantity);
        }
        return 0;
    }

    public function getCartProductCostObject($product_id, $size_id=0, $color_id=0, $package_id=0){
        $orderProductSelectedPackage = '';
        $orderProductSelectedSize = '';
        $orderProductSelectedColor = '';

        if($package_id > 0){
            $orderProductSelectedPackage  = StoreProductKeeping::where('id', $size_id)->select(['id','package'])->first();

            if(isset($orderProductSelectedPackage->package)){
                $orderProductSelectedPackage = $orderProductSelectedPackage->package;
            }
        }

        if($size_id > 0){
            $orderProductSelectedSize  = StoreProductKeeping::where('id', $size_id)->select(['id','size'])->first();
            if(isset($orderProductSelectedSize->size)){
                $orderProductSelectedSize = $orderProductSelectedSize->size;
            }
        }

        if($color_id > 0){
            $orderProductSelectedColor = StoreProductKeeping::where('id', $color_id)->select(['id','color'])->first();
            if(isset($orderProductSelectedColor->color)){
                $orderProductSelectedColor = $orderProductSelectedColor->color;
            }
        }

        $orderProductDetail = DB::table('store_products_keeping');

        $orderProductDetail->where('product_id', $product_id);

        if($orderProductSelectedColor != ''){
            $orderProductDetail->Where('color', $orderProductSelectedColor);
        }

        if($orderProductSelectedSize != ''){
            $orderProductDetail->Where('size', $orderProductSelectedSize);
        }

        if($orderProductSelectedPackage != ''){
            $orderProductDetail->Where('package', $orderProductSelectedPackage);
        }

        $orderProductDetail = $orderProductDetail->first();

        if(isset($orderProductDetail->id)){
            return $orderProductDetail;
        }
        return 0;
    }
    public function getBrandCartProducts($brand_id){
        return Session::get('cart.products.'.$brand_id);
    }
    public function getProductRegionShippingCost($country_id, $product_id)
    {
        // Calculate shipping cost every time, whenever it is needed.
        $region_id = getRegionId($country_id);

        $regionCostInfo = getRegionCostByProductId($region_id, $product_id);

        if (isset($regionCostInfo->shipping_cost)) {
            return $regionCostInfo->shipping_cost;
        }

        return 0;
    }

    protected function addOrderNumber($order_id)
    {
        if (empty($order_id)) {
            return false;
        }
        $order = StoreOrder::where('id', $order_id)->select(['id', 'order_number'])->first();

        if (!empty($order->id)) {
            $order->order_number = Hashids::encode($order->id, 10, 10);
            $order->save();
        }

    }

    public function storeOrdersItem($token='', $affiliate_reward=0, $product_id = '', $store_order_id, $quantity = '', $price = '', $discount = '', $product_keeping_id)
    {
        $tokenId = DB::table('affiliate_products')->select('id')->where('get_user_token', $token)->where('product_id', $product_id)->first();

        $soObj = new StoreOrderItems();

        $soObj->product_price = $price;
        $soObj->product_discount = $discount;
        $soObj->quantity = $quantity;
        $soObj->product_id = $product_id;
        $soObj->affiliate_item_id = (isset($tokenId->id))?$tokenId->id:'';
        $soObj->affiliate_reward_amount = (isset($tokenId->id))?$affiliate_reward:'0';;
        $soObj->product_keeping_id = $product_keeping_id;
        $soObj->order_id = $store_order_id;
        if($soObj->save()){

            if(!empty($size_id)) {
                $spItemObj = new StoreOrderItemAttribute();
                $spItemObj->store_order_item_id = $soObj->id;
                $spItemObj->store_product_attribute_id = $size_id;
                
                $spItemObj->save();
            }
            if(!empty($color_id)) {
                $spItemObj = new StoreOrderItemAttribute();
                $spItemObj->store_order_item_id = $soObj->id;
                $spItemObj->store_product_attribute_id = $color_id;
                $spItemObj->save();
            }
        }

        return $soObj->id;
    }

    public function updateStoreOrders($order_id, $total_price, $total_affiliate_amount, $quantity, $discount, $totalShippingCostOfThisOrder, $delivery_address_id = '')
    {
        $storeOrder = StoreOrder::where('id',$order_id)->first();

        if(!empty($storeOrder->id)){
            $storeOrder->total_price = $total_price;
            $storeOrder->total_affiliate_amount = (isset($tokenId->id))?$affiliate_reward:'0';;

            $storeOrder->total_quantity = $quantity;
            $storeOrder->total_discount = $discount;
            $storeOrder->total_shiping_cost = $totalShippingCostOfThisOrder;
            $storeOrder->save();
            return $storeOrder->id;
        }

        return False;
    }

    public function updateStoreOrderAddress($order_id, $orderDeliveryAddressId)
    {

        $updateAddress = DB::table('store_orders')->where('id', $order_id)->update(['delivery_address_id' => $orderDeliveryAddressId]);

        return $updateAddress;
    }

    public function storeDeliveryAddress($request, $user_id=0)
    {

        $orderDeliveryAddressId = DB::table('store_delivery_addresses')->insertGetId(
            [
                'country_id'   => $request->countries,
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'user_id'      => $user_id,
                'st_address_1' => $request->st_address_1,
                'st_address_2' => $request->st_address_2,
                'city'         => $request->city,
                'state'        => $request->state,
                'zip_code'     => $request->zip_code,
                'phone_number' => $request->phone_number,
                'email'        => $request->email_address
            ]);

        return $orderDeliveryAddressId;
    }



    public function updateExistingStoreOrderDeliveryAddress($request, $user_id=0)
    {
        $orderDeliveryAddressId = DB::table('store_delivery_addresses')->where('id', $request->address_id)->update(
            [
                'country_id'   => $request->countries,
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'user_id'      => $user_id,
                'st_address_1' => $request->st_address_1,
                'st_address_2' => $request->st_address_2,
                'city'         => $request->city,
                'state'        => $request->state,
                'zip_code'     => $request->zip_code,
                'phone_number' => $request->phone_number,
                'email'        => $request->email_address
            ]);

        return $orderDeliveryAddressId;
    }


// ==================== end of Ubaid Code =====================


// ==================== Mustabeen code ============================

    /**
     * @param $product_id
     *
     * @return mixed
     */
    public function deleteProductFromCart($product_id)
    {
        $owner_id = $this->getProductOwnerIDByProductID($product_id);
        $quantity = Session::get('cart.products.'.$owner_id.'.'.$product_id.'.quantity');
        Session::forget('cart.products.'.$owner_id.'.'.$product_id);
        if(empty(Session::get('cart.products.'.$owner_id))){
            Session::forget('cart.products.'.$owner_id);
        }
        $total_items = Session::get('cart.total_items');

        $total_items = $total_items - $quantity;
        Session::put('cart.total_items',$total_items);
    }
    public function empryCart(){
        return Session::forget('cart');
    }

    public function deleteBuyItNowProductFromCart($brand_id=0, $buy_it_now='no'){
        return Session::forget('cart.products.'.$brand_id.'.'.$buy_it_now);
    }
    public function deleteCartBrandProducts($brand_id){
        $brandProducts = $this->getCartProducts($brand_id);

        foreach ($brandProducts as $product){
            $this->deleteProductFromCart($product['product_id']);
        }
        return Session::forget('cart.products.'.$brand_id);
    }

    public function getProductDetail($product_id) {
        return $product = StoreProduct::select('id', 'title', 'description', 'shipping_cost', 'affiliate', 'affiliate_reward', 'category_id', 'owner_id')->where('id', $product_id)->first();
    }

    public function storeProductKeeping($product_id)
    {
        return StoreProductKeeping::select('store_products_keeping.id', 'store_products_keeping.price', 'store_products_keeping.discount', 'store_products_keeping.quantity', 'store_products_keeping.price',

          'tbl_attr_1.id as attr_id_1',
          'tbl_attr_1.label as label_1',

          'tbl_attr_val_1.id as attr_value_id_1',
          'tbl_attr_val_1.value as value_1',

          'tbl_attr_2.id as attr_id_2',
          'tbl_attr_2.label as label_2',

          'tbl_attr_val_2.id as attr_value_id_2',
          'tbl_attr_val_2.value as value_2'
        )
          ->where('product_id', $product_id)
          ->join('store_attributes as tbl_attr_1', 'store_products_keeping.master_attribute_1', '=', 'tbl_attr_1.id')
          ->join('store_attributes as tbl_attr_2', 'store_products_keeping.master_attribute_2', '=', 'tbl_attr_2.id')
          ->join('store_attribute_values as tbl_attr_val_1', 'store_products_keeping.master_attribute_1_value', '=', 'tbl_attr_val_1.id')
          ->join('store_attribute_values as tbl_attr_val_2', 'store_products_keeping.master_attribute_2_value', '=', 'tbl_attr_val_2.id')

          ->get();
    }

    public function getProductMasterAttribute($product_id)
    {
        $data['masterAttribut1'] = $this->getProductMasterAttribute1($product_id);
        $data['masterAttribut2'] = $this->getProductMasterAttribute2($product_id);
        return $data;
    }
    public function getProductMasterAttribute1($product_id) {
        return $productKeepingDetail = DB::table('store_products_keeping')
          ->select('store_products_keeping.id as keeping_id', 'store_products_keeping.quantity', 'store_products_keeping.price', 'store_attributes.id as attr_id', 'store_attributes.label', 'store_products_keeping.master_attribute_2_value as value_id_2', 'store_attribute_values.id as value_id', 'store_attribute_values.value')

          ->join('store_attributes', function ($join) {
              $join->on('store_products_keeping.master_attribute_1', '=', 'store_attributes.id');
          })

          ->join('store_attribute_values', function ($join) {
              $join->on('store_products_keeping.master_attribute_1_value', '=', 'store_attribute_values.id');
          })
          ->where('store_products_keeping.product_id', $product_id)
          ->get();
    }

    public function getProductMasterAttribute2($product_id) {
        return $productKeepingDetail = DB::table('store_products_keeping')
          ->select('store_products_keeping.id as keeping_id', 'store_products_keeping.quantity', 'store_products_keeping.price', 'store_attributes.id as attr_id', 'store_attributes.label', 'store_products_keeping.master_attribute_1_value as value_id_1','store_attribute_values.id as value_id', 'store_attribute_values.value')

          ->join('store_attributes', function ($join) {
              $join->on('store_products_keeping.master_attribute_2', '=', 'store_attributes.id');
          })

          ->join('store_attribute_values', function ($join) {
              $join->on('store_products_keeping.master_attribute_2_value', '=', 'store_attribute_values.id');
          })
          ->where('store_products_keeping.product_id', $product_id)
          ->get();//master2
    }

    public function storeBrandInfo($brand_id) {
        return $storeBrandInfo = User::select('displayname', 'username', 'first_name', 'last_name')->where('id', $brand_id)->orWhere('username', $brand_id)->first();
    }

    /**
     * @param $product_id
     * @param $quantity
     */
    public function updateCart($buy_it_now='no',$token="", $product_id, $quantity, $master_attribute_1 = 0, $master_attribute_2 = 0, $package_id = 0, $master_attribute_1_label='', $master_attribute_1_value='', $master_attribute_2_label='', $master_attribute_2_value='')
    {
        $productInf = getProductDetailsByID($product_id);

        if(empty($productInf->owner_id)){
            return false;
        }
        $quantity_old = Session::get('cart.products.'.$productInf->owner_id.'.'.$productInf->id.'.quantity');
        if($master_attribute_1 == 0){
            $master_attribute_1 = Session::get('cart.products.'.$productInf->owner_id.'.'.$productInf->id.'.master_attribute_1');
            $master_attribute_2 = Session::get('cart.products.'.$productInf->owner_id.'.'.$productInf->id.'.master_attribute_2');
        }

        //$productKeepingInf = getCartProductKeepingObject($product_id, $master_attribute_1, $master_attribute_2, $package_id);
        $productKeepingInf = getProductKeeping($product_id, $master_attribute_1, $master_attribute_2);

        if(isset($productKeepingInf->quantity)){
            if($quantity > $productKeepingInf->quantity){
                return ['message' => 'quantity_overflow','units_available' => $productKeepingInf->quantity,'message_text' => 'There are maximum '.$productKeepingInf->quantity.' unit(s) available of this product'];
            }
        }


        Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.token', $token);
        Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.product_id',$product_id);
        Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.quantity',$quantity);
        Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.discount',$productKeepingInf->discount);
        Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.price', $productKeepingInf->price);
        Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.master_attribute_1', $master_attribute_1);
        Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.master_attribute_2', $master_attribute_2);
        if($master_attribute_1_label != ''){
            Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.master_attribute_1_label', $master_attribute_1_label);
            Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.master_attribute_1_value', $master_attribute_1_value);
        }
        if($buy_it_now != 'no'){
            Session::put('cart.products.'.$productInf->owner_id.'.'.$product_id.'.buy_it_now', $buy_it_now);
        }
        if($master_attribute_2_label != '') {
            Session::put('cart.products.' . $productInf->owner_id . '.' . $product_id . '.master_attribute_2_label', $master_attribute_2_label);
            Session::put('cart.products.' . $productInf->owner_id . '.' . $product_id . '.master_attribute_2_value', $master_attribute_2_value);
        }

        $product_count = Session::get('cart.total_items');
        
        $product_count = ($product_count - $quantity_old) + $quantity;
        Session::put('cart.total_items', $product_count);
        return ['message' => 'added_to_cart'];
    }

    public function orderAmountInfoInSession($cartItems = null)
    {
        $data['total_items_in_cart'] = $data['subtotal'] = $data['shipping'] = 0;

        foreach($cartItems as $cartItem){
            $productInfo = getProductDetailsByID($cartItem['product_id']);
            if(!isset($productInfo->id)){
                continue;
            }
            $productKeepingInf = getProductKeeping($productInfo->id, $cartItem['master_attribute_1'], $cartItem['master_attribute_2']);
            if(!isset($productKeepingInf->id)){
               continue;
            }

            $discountedPrice = $productKeepingInf->price;

            if($productKeepingInf->discount > 0){
                $discountedPrice = ($productKeepingInf->price / 100) * $productKeepingInf->discount;
                $discountedPrice = $productKeepingInf->price - $discountedPrice;
            }

            $data['total_items_in_cart'] = $data['total_items_in_cart'] + $cartItem['quantity'];
            $data['subtotal']            = $data['subtotal'] + ($discountedPrice * $cartItem['quantity']);
            $data['shipping']            = $data['shipping'] + $productInfo->shipping_cost;
        }

        return $data;
    }

    public function getCartProductsCount(){
        return Session::get('cart.total_items');
    }
    public function getCartProducts($brand_id = 0, $buy_it_now='no'){
        if($brand_id > 0 AND $brand_id != "buy-all"){
            if($buy_it_now != 'no'){
                $singleProduct = [];
                return $singleProduct[] = [ $buy_it_now => Session::get('cart.products.'.$brand_id.'.'.$buy_it_now)];
            }
            return Session::get('cart.products.'.$brand_id);
        }
        return Session::get('cart.products');
    }
    /**
     * @param $review_id
     *
     * @return null
     */
    public function is_review_owner($review_id)
    {
        $review = StoreProductReview::where('id', $review_id)->first();

        if (isset($review->id)) {
            if ($review->owner_id == Auth::user()->id) {
                return $review->id;
            }
        } else {
            return null;
        }
    }

    /**
     * @param $description
     * @param $rating
     * @param $review_id
     */
    public function editProductReview($description, $rating, $review_id)
    {
        $review = StoreProductReview::where('id', $review_id)->first();
        if ($description == "") {
        } else {
            $review->description = $description;
        }

        $review->rating = $rating;
        $review->updated_at = Carbon::now();
        $review->save();
    }

    /**
     * @param $review_id
     *
     * @return null
     */
    public function getReview($review_id)
    {
        $review = StoreProductReview::where('id', $review_id)->first();
        if (isset($review->id)) {
            if ($review->owner_id == Auth::user()->id) {
                return $review;
            }
        } else {
            return null;
        }
    }


// ==================== End of Mustabeen code ============================


// ==================== Zahid code ============================


    /**
     * @param $user_id
     *
     * @return mixed
     */
    public function currentBrandCategories($user_id, $number_of_category=10)
    {
       $category_ids = DB::table('store_products')
            ->where('owner_id', $user_id)
            ->orderByRaw("RAND()")
            ->take($number_of_category)
            ->lists('category_id');

        $cates = DB::table('store_product_categories')
            ->whereIn('id', $category_ids)
            ->take($number_of_category)
            ->get();
        return $cates;
    }

    public function productHavingShippingCosts()
    {

    }

    public function currentBrandFeaturedProducts($owner_id)
    {
        return StoreProduct::where('is_featured', 1)
            ->where('quantity', '!=', 0)
            ->where('owner_id', $owner_id)
            ->orderByRaw("RAND()")
            ->take(3)->get();
    }

    public function currentBrandBestSellingProducts($owner_id)
    {
        return StoreProduct::where('sold', '>', 0)
            ->where('owner_id', $owner_id)
            ->where('quantity', '!=', 0)
            ->orderBy('sold', 'DESC')
            ->take(3)->get();
    }
    public function currentBrandRecord($owner_id)
    {
        return StoreProduct::where('owner_id', $owner_id)->first();
    }
    /**
     * @param $user_id
     *
     * @return string
     */
    public function currentBrandProducts($user_id, $number_of_category = 10)
    {
        $categories = $this->currentBrandCategories($user_id, $number_of_category);
        $products = '';

        foreach ($categories as $category) {

            $products[$category->id . '_' . $category->name] = DB::table('store_products')
                ->select('store_products.id', 'sk.quantity','store_products.title', 'sk.price', 'store_products.description', 'store_products.owner_id', 'store_products.category_id', 'store_products.sub_category_id', 'sk.discount')
              ->join('store_products_keeping as sk', 'sk.product_id', '=', 'store_products.id' )
                ->where('store_products.category_id', $category->id)
                ->where('store_products.owner_id', $user_id)
                ->where('store_products.is_published', 1)
                ->whereNull('store_products.deleted_at')
                ->groupBy('store_products.id')
                ->take($number_of_category)
                ->get();
        }

        return $products;

    }

    /**
     * @param $brand_id
     *
     * @return mixed
     */
    public function isStoreBrand($brand_id)
    {
        return $brand = User::select([
            'user_type',
            'id'
        ])->where('id', $brand_id)->orWhere('username', $brand_id)->first();
    }

    public function addProfilePageStat($owner_id)
    {
        if(isset(\Auth::user()->id)){
            DB::table('profile_page_stats')->insert([
              ['user_id' => \Auth::user()->id, 'owner_id' => $owner_id]
            ]);
        }

    }

    public function getAddressesOfUserById($user_id)
    {
        return StoreDeliveryAddress::where('is_deleted', '!=', 1)->where('user_id', $user_id)->orderBy('id', 'DESC')->paginate(5);
    }

    public function getAddressesOfUserByIdToArray($user_id)
    {
        return StoreDeliveryAddress::where('is_deleted', '!=', 1)->select('store_delivery_addresses.id' , 'store_delivery_addresses.user_id','store_delivery_addresses.country_id' ,'store_delivery_addresses.first_name' ,'store_delivery_addresses.last_name' , 'store_delivery_addresses.st_address_1' ,'store_delivery_addresses.st_address_2' ,'store_delivery_addresses.city' ,'store_delivery_addresses.state' , 'store_delivery_addresses.zip_code' , 'store_delivery_addresses.phone_number', 'store_delivery_addresses.email', 'countries.name as country_name')->where('user_id', $user_id)->join('countries' , 'countries.id' , '=' , 'store_delivery_addresses.country_id')->orderBy('store_delivery_addresses.id', 'DESC')->paginate(5)->toArray();
    }

    public function getOrderAddressesByOrderId($id)
    {
        return StoreDeliveryAddress::where('id', $id)->paginate(5);
    }

    public function getOrderAddressByOrderId($order_id)
    {
        return StoreDeliveryAddress::where('order_id', $order_id)->first();
    }

    public function getEditAddressFormInfo($request)
    {
        if (isset($request->address_id)) {
            return StoreDeliveryAddress::where('id', $request->address_id)->first();
        }

        return '';
    }

    public function isAddressOwner($id, $user_id=0)
    {
        $isOwner = StoreDeliveryAddress::select('user_id')->where('id', $id)->first();

        if (isset($isOwner->user_id)) {
            if ($isOwner->user_id == $user_id) {
                return 1;
            }
        }

        return 0;
    }

    public function sofDeleteAddressInfo($id,$user_id=0)
    {
        if (StoreDeliveryAddress::where('id', $id)->where('user_id', $user_id)->update([
                'is_deleted' => 1
            ]) > 0
        ) {
            Session::forget('cart.order_address');
            return $id;
        }

        return 0;
    }
// ==================== End of Zahid code ============================
    public function getAvailableBalance($user_id){
        $debit = StoreTransaction::where('user_id',$user_id)->where('transaction_type','debit')->sum('amount');
        $credit = StoreTransaction::where('user_id',$user_id)->where('transaction_type','credit')->sum('amount');
        $balance = $credit - $debit;
        return $balance;
    }
    public function getDisputedBalance($user_id){
        return StoreTransaction::where('user_id',$user_id)->where('transaction_type','disputed')->sum('amount');
    }
    public function getPendingAmount($user_id){
        $pending_amount = StoreWithdrawal::where('seller_id',$user_id)->where('status','pending')->sum('amount');
        return $pending_amount;
    }
    public function getKinnect2Fee(){
        $fee_percentage = 10;
        return $fee_percentage;
    }
    public function getDefaultWithdrawalMethod($user_id){
        $method = StoreWithdrawalMethod::where('is_default',1)
            ->select(['id','seller_id'])
            ->where('seller_id',$user_id)
            ->first();
        if(empty($method->id)) {
            $method = StoreWithdrawalMethod::where('seller_id', $user_id)
                ->select(['id','seller_id'])
                ->first();
        }
        return @$method->id;
    }
    public function getDeliveryAddressByID($address_id){
        return StoreDeliveryAddress::where('id',$address_id)->first();
    }
    public function getAddressFieldByID($address_id,$field){
        $select =  StoreDeliveryAddress::where('id',$address_id)->select([$field])->first();
        return @$select->$field;
    }
    public function getCartDeliverAddress(){
        return Session::get( 'cart.order_address');
    }
    public function getProductOwnerIDByProductID($product_id){
        $owner = StoreProduct::where('id',$product_id)->select(['id','owner_id'])->first();
        return @$owner->owner_id;
    }
    public function logStoreReversal($data){
        $srObj = new StoreReversal();
        
        $srObj->parent_type = $data['parent_type'];
        $srObj->parent_id = $data['parent_id'];
        $srObj->user_id = $data['user_id'];
        $srObj->seller_id = $data['seller_id'];
        $srObj->amount = $data['amount'];
        
        return $srObj->save();
    }
}
