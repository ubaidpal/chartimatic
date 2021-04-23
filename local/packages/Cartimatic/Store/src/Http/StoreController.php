<?php

namespace Cartimatic\Store\Http;

use App\Classes\UrlFilter;
use App\Conversation;
use App\Country;
use App\Events\SendEmail;
use App\Http\Controllers\Controller;
use App\Repository\Eloquent\MessageRepository;
use Cartimatic\Admin\Traits\Cropper;

use Cartimatic\Store\Category;
use Cartimatic\Store\StoreProductFeature;
use Cartimatic\Store\StoreProductImage;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use app\Http\Requests;
//use App\StorageFile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Cartimatic\Store\ProductFavorites;
use Cartimatic\Store\StoreOrder;
use Cartimatic\Store\StoreProduct;
use Cartimatic\Store\StoreProductStat;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Validator;
use Vinkla\Hashids\Facades\Hashids;
use Session;

class StoreController extends Controller
{
    use Cropper;
    private   $is_api;
    protected $storeRepository;
    protected $storeAdminRepository;
    protected $storeOrderRepository;
    protected $storeAdminOrderRepository;
    protected $storeProductStatRepository;

    public function __construct(
        \Cartimatic\Store\Repository\StoreRepository $storeRepository,
        \Cartimatic\Store\Repository\admin\StoreAdminRepository $storeAdminRepository,
        \Cartimatic\Store\Repository\StoreProductStatRepository $storeProductStatRepository,
        \Cartimatic\Store\Repository\StoreOrderRepository $storeOrderRepository,
        \Cartimatic\Store\Repository\admin\StoreAdminOrderRepository $storeAdminOrderRepository,
        Request $middleware
    ) {
        parent::__construct();
        $this->storeRepository            = $storeRepository;
        $this->storeAdminRepository       = $storeAdminRepository;
        $this->storeProductStatRepository = $storeProductStatRepository;
        $this->storeOrderRepository       = $storeOrderRepository;
        $this->storeAdminOrderRepository  = $storeAdminOrderRepository;
        $this->user_id                    = (isset(Auth::user()->id)) ? Auth::user()->id : 0;

        $this->is_api = UrlFilter::filter();

        $is_public = false;
        if(isset($request['middleware']['is_public'])){
            $is_public = true;
        }

        if ($this->is_api AND !$is_public) {
            $this->user_id = Authorizer::getResourceOwnerId();
            @$this->data->user = User::findOrNew($this->user_id);
        } else {
            if (Auth::check()) {
                @$this->data->user = Auth::user();
                $this->user_id = $this->data->user->id;
            }
        }

        if(isset( $middleware['middleware']['is_api'])) {
            $this->is_api =  $middleware['middleware']['is_api'];
        }
    }

    /**
     * @param null $brand_id
     *
     * @return mixed
     */
    public function index($brand_id = NULL) {

        $brand = $this->storeRepository->isStoreBrand($brand_id);
        if($brand[ 'user_type' ] == 2) {
            $data[ 'url_user_id' ] = $brand->id;

            $data[ 'allProducts' ]         = $this->storeRepository->currentBrandProducts($brand->id, 8);
            $data['storeOwner']            = getUserDetail($brand_id);

            //Adding profile view stat
            $this->storeRepository->addProfilePageStat($brand->id);

            return view('Store::index', $data);
        } else {
            return redirect()->back()->with('info', 'Record Saved Successfully.');
        }

    }

    public function getProductDetail($product_id) {

        $user_id    = (isset(Auth::user()->id)) ? Auth::user()->id:-1;
        $user_type  = (isset(Auth::user()->id))?Auth::user()->user_type:-1;
        $country    = (isset(Auth::user()->id))?Auth::user()->country:-1;
        $ip         = getUserIpAddress();
        $userGender = getUserGender();
        $userAge    = getUserAge();

        $data['key_feature']            = $this->storeAdminRepository->key_feature($product_id);
        $data[ 'productDetail' ]        = $product = $this->storeAdminRepository->getProductDetail($product_id);
        $data[ 'productKeepingDetail' ] = $allAttributes = $this->storeAdminRepository->getProductMasterAttribute($product_id);

        $masterAttribute1    = '';
        $masterAttribute2    = '';

        $allMasterAttribute  = '';

        foreach ($allAttributes['masterAttribut1'] as $attr) {
            if(isset($attr->attr_id)) {
                $masterAttribute1 .= $attr->attr_id.'_'.$attr->label .'_'.$attr->value_id.'_' . $attr->value . '_' . $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ', ';
                $allMasterAttribute .= $attr->value_id_2.$attr->value_id.'_'. $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ',';
            }
        }

        foreach ($allAttributes['masterAttribut2'] as $attr) {
            if(isset($attr->attr_id)) {
                $masterAttribute2 .= $attr->attr_id.'_'.$attr->label .'_'.$attr->value_id.'_' . $attr->value . '_' . $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ', ';
                $allMasterAttribute .= $attr->value_id_1.$attr->value_id.'_'. $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ',';
            }
        }

        $data[ 'masterAttribute1' ]     = $masterAttribute1;
        $data[ 'masterAttribute2' ]     = $masterAttribute2;
        $data[ 'allMasterAttribute' ]   = $allMasterAttribute;

        if(!isset($product->id)) {
            $data[ 'productDetail' ]    = $product = $this->storeAdminRepository->getDeletedProductDetail($product_id);

            if(!isset($product->id)) {
                return abort("404");
            }

            return view('Store::products.storeDeletedProductMessage', $data);
        }

        $brand = $this->storeAdminRepository->isStoreBrand($product->owner_id);

        $data[ 'isStoreOwner' ]      = $this->storeAdminRepository->is_product_owner($product_id);
        $data[ 'storeName' ]         = getUserNameByUserId($product->owner_id);
        $data[ 'brand' ]             = $this->storeAdminRepository->storeBrand($product->owner_id);
        $data[ "user" ][ "country" ] = Country::where("id", $country)->first();

        $data[ 'key_feature' ]    = $this->storeAdminRepository->key_feature($product_id);
        $data[ 'tech_spechs' ]    = $this->storeAdminRepository->tech_spechs($product_id);
        $data[ 'reviews' ]        = $this->storeAdminRepository->getReviews($product_id);
        $data[ 'isAbleToReview' ] = $this->storeAdminRepository->isAbleToReview($user_id, $product_id);
        $data[ 'isReviewed' ]     = $this->storeAdminRepository->isReviewed($user_id, $product_id);

        $productAttributes    = $data[ 'productAttributes' ] = $this->storeAdminRepository->getProductAttributes($product_id);
        $data[ 'attributes' ] = [];
        if($productAttributes != 0) {
            foreach ($productAttributes as $productAttribute) {
                if(!empty($productAttribute->value)) {
                    $data[ 'attributes' ][ $productAttribute->attribute ][] = $productAttribute;
                }
            }
        }

        $data[ 'url_user_id' ] = $brand[ 'id' ];

        //Add statics
        $this->storeProductStatRepository->addProductStat('view', $user_id, $user_type, $userAge, $userGender, $country, $ip, $product->owner_id, $product->id);

        $data[ 'favourites' ] = ProductFavorites::where('product_id', $product_id)
                                                ->where('poster_type', 'user')
                                                ->where('poster_id', $user_id)->get();

        return view("Store::products.storeProductDetail", $data);
    }

    public function getAffiliateProductById($product_id)
    {

        $user_id    = (isset(Auth::user()->id))?Auth::user()->id:-1;
        $user_type  = (isset(Auth::user()->id))?Auth::user()->user_type:-1;
        $country    = (isset(Auth::user()->id))?Auth::user()->country:-1;
        $ip         = getUserIpAddress();
        $userGender = getUserGender();
        $userAge    = getUserAge();

        $data['key_feature']            = $this->storeAdminRepository->key_feature($product_id);
        $data[ 'productDetail' ]        = $product = $this->storeAdminRepository->getProductDetail($product_id);
        $data[ 'productKeepingDetail' ] = $allAttributes = $this->storeAdminRepository->getProductMasterAttribute($product_id);

        $masterAttribute1    = '';
        $masterAttribute2    = '';

        $allMasterAttribute  = '';

        foreach ($allAttributes['masterAttribut1'] as $attr) {
            if(isset($attr->attr_id)) {
                $masterAttribute1 .= $attr->attr_id.'_'.$attr->label .'_'.$attr->value_id.'_' . $attr->value . '_' . $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ', ';
                $allMasterAttribute .= $attr->value_id_2.$attr->value_id.'_'. $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ',';
            }
        }

        foreach ($allAttributes['masterAttribut2'] as $attr) {
            if(isset($attr->attr_id)) {
                $masterAttribute2 .= $attr->attr_id.'_'.$attr->label .'_'.$attr->value_id.'_' . $attr->value . '_' . $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ', ';
                $allMasterAttribute .= $attr->value_id_1.$attr->value_id.'_'. $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ',';
            }
        }

        $data[ 'masterAttribute1' ]     = $masterAttribute1;
        $data[ 'masterAttribute2' ]     = $masterAttribute2;
        $data[ 'allMasterAttribute' ]   = $allMasterAttribute;

        if(!isset($product->id)) {
            $data[ 'productDetail' ]    = $product = $this->storeAdminRepository->getDeletedProductDetail($product_id);

            if(!isset($product->id)) {
                return abort("404");
            }
            return response()->view("Store::products.affiliateProductDetail.storeAffiliateProductDetail", $data)->header('Access-Control-Allow-Origin', "http://affiliate-program.blueorcastudios.com");
            //return view('Store::products.storeDeletedProductMessage', $data);
        }

        $brand = $this->storeAdminRepository->isStoreBrand($product->owner_id);

        $data[ 'isStoreOwner' ]      = $this->storeAdminRepository->is_product_owner($product_id);
        $data[ 'storeName' ]         = getUserNameByUserId($product->owner_id);
        $data[ 'brand' ]             = $this->storeAdminRepository->storeBrand($product->owner_id);
        $data[ "user" ][ "country" ] = Country::where("id", $country)->first();

        $data[ 'key_feature' ]    = $this->storeAdminRepository->key_feature($product_id);
        $data[ 'tech_spechs' ]    = $this->storeAdminRepository->tech_spechs($product_id);
        $data[ 'reviews' ]        = $this->storeAdminRepository->getReviews($product_id);
        $data[ 'isAbleToReview' ] = $this->storeAdminRepository->isAbleToReview($user_id, $product_id);
        $data[ 'isReviewed' ]     = $this->storeAdminRepository->isReviewed($user_id, $product_id);

        $productAttributes    = $data[ 'productAttributes' ] = $this->storeAdminRepository->getProductAttributes($product_id);
        $data[ 'attributes' ] = [];
        if($productAttributes != 0) {
            foreach ($productAttributes as $productAttribute) {
                if(!empty($productAttribute->value)) {
                    $data[ 'attributes' ][ $productAttribute->attribute ][] = $productAttribute;
                }
            }
        }

        $data[ 'url_user_id' ] = $brand[ 'id' ];

        //Add statics
        $this->storeProductStatRepository->addProductStat('view', $user_id, $user_type, $userAge, $userGender, $country, $ip, $product->owner_id, $product->id);

        $data[ 'favourites' ] = ProductFavorites::where('product_id', $product_id)
                                                ->where('poster_type', 'user')
                                                ->where('poster_id', $user_id)->get();

        return response()->view("Store::products.affiliateProductDetail.storeAffiliateProductDetail", $data)->header('Access-Control-Allow-Origin', "http://affiliate-program.blueorcastudios.com");
        //return view("Store::products.storeProductDetail", $data);

    }

    public function updateReviewDetail(Request $request) {
        $user_id    = Auth::user()->id;
        $data['reviews']  = $this->storeAdminRepository->saveProductsReviews($request,$user_id);
        return redirect("product/".$request->product_id."/updateReview");
}
    public function getProductById($id) {
        $product = $this->storeAdminRepository->getProductDetail($id);
        if(!isset($product->id)) {
            return redirect("store/" . $id . '/no-product-found')->with('info', 'no product found.');
        }
        $user = User::where("id", $product->owner_id)->first();
        return redirect('product/' . $id . '/' . preg_replace('/\s+/', '-', $product->title));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function  subCategoryProducts(Request $request) {
        $data[ 'url_user_id' ]     = $request->storeBrandId;
        $data[ 'sub_category_id' ] = $sub_category_id = $request->sub_category_id;
        $data[ 'categoryName' ]    = $request->category_name;

        $data[ 'parent_category_id' ] = $this->storeRepository->getPrarentCategory($sub_category_id);
        $data[ 'allProducts' ]        = $allProducts = $this->storeRepository->subCategoryProducts($sub_category_id);

        $user_id         = $this->user_id;
        $data[ 'brand' ] = $this->storeRepository->isStoreBrand($user_id);

        return view('Store::products.sub_category_products', $data)->with('info', 'Subcategory Products');
    }

    public function getShippingInfo(Request $request) {

        $data[ 'cartProductsCount' ] = Session::get('cart.total_items');
        (isset($request->buy_it_now)) ? $data['buy_it_now']=Hashids::decode($request->buy_it_now)[0]: $data['buy_it_now'] =0;
        if($request->sellerBrandId != "buy-all") {
            $data[ 'sellerBrandIdEncoded' ] = $request->sellerBrandId;

            $data[ 'sellerBrandId' ] = Hashids::decode($request->sellerBrandId);
            $data[ 'sellerBrandId' ] = $data[ 'sellerBrandId' ][ 0 ];

            $data[ 'cartProducts' ][ $data[ 'sellerBrandId' ] ] = $this->storeRepository->getCartProducts($data[ 'sellerBrandId' ], $data['buy_it_now']);
        } else {
            $data[ 'sellerBrandIdEncoded' ] = $request->sellerBrandId;

            $data[ 'sellerBrandId' ] = $request->sellerBrandId;

            $data[ 'cartProducts' ] = $this->storeRepository->getCartProducts();
        }

        if(count($data[ 'cartProducts' ]) < 1) {
            if($this->is_api){
                return \Api::other_error("sorry-your-session-expired");
            }
            redirect('store/cart/your-session-expired');
        }

        $default       = ['0' => 'Select Country'];
        $countriesList = DB::table('countries')->lists('name', 'id');
        $countriesList = $default + $countriesList;

        $data[ 'previousAddresses' ] = $this->storeRepository->getAddressesOfUserById($this->user_id);


        $address_id                  = $this->storeRepository->getCartDeliverAddress();
        $data[ 'addressData' ]       = [];
        if($address_id) {
            $data[ 'addressData' ] = $this->storeRepository->getDeliveryAddressByID($address_id);
        }

        if($this->is_api){
            $data['countriesList'] = $countriesList;
            return \Api::success($data);
        }
        $data['buy_it_now'] = ($request->buy_it_now != '')? $request->buy_it_now: 'no';
        if(!empty($this->theme_id))
        {
            return view("cart.shippingAddress", $data)->with('countries', $countriesList);
        }else{
            return view("Store::Cart.shippingAddress", $data)->with('countries', $countriesList);
        }

    }
    public function  getOnlyShippingAddress(){

        $data['previousAddresses']=   $this->storeRepository->getAddressesOfUserByIdToArray($this->user_id);
        return $data;
    }

    /**
     * @param $product_id
     *
     * @return mixed
     */
    public function addCartProduct(Request $request) {

        $product_id = Input::get('product_id');

        if($product_id) {
            $quantity   = \Request::get('quantity');
            $master_attribute_1    = \Request::get('master_attribute_1');
            $master_attribute_2   = \Request::get('master_attribute_2');

            (\Request::get('buy_it_now') != null)? $buy_it_now = $product_id: $buy_it_now = '';

            $master_attribute_1_label   = \Request::get('master_attribute_1_label');
            $master_attribute_1_value   = \Request::get('master_attribute_1_value');
            $master_attribute_2_label   = \Request::get('master_attribute_2_label');
            $master_attribute_2_value   = \Request::get('master_attribute_2_value');
            $token   = \Request::get('token');


            $package_id = \Request::get('productPackageId');
            $response                  = $this->storeRepository->updateCart($buy_it_now, $token, $product_id, $quantity, $master_attribute_1, $master_attribute_2, $package_id, $master_attribute_1_label, $master_attribute_1_value, $master_attribute_2_label, $master_attribute_2_value);
            $product_count             = $this->storeRepository->getCartProductsCount();
            $response[ 'total_items' ] = [$product_count];

            if($this->is_api){
                return \Api::success($response);
            }

            return response()->json($response);
        }
    }

    public function cartProductQuantityCheck() {

        $product_id = Input::get('product_id');
        $qtyToCheck = Input::get('qtyToCheck');
        $record     = StoreProduct::where('id', $product_id)->first();
        if($record->quantity < $qtyToCheck) {
            return 0;
        } else {
            return 1;
        }

    }

    /**
     * @return mixed
     */
    public function getCart() {
        //Not show cart to Admin of store
         $data[ 'url_user_id' ] = '';

        if(Auth::check()){
            if(Auth::user()->user_type == 2) {
                return redirect("/store/" . Auth::user()->username . "/admin/orders");
            }
            $data[ 'url_user_id' ]  = Auth::user()->username;
        }

        $data[ 'cartProducts' ] = Session::get('cart.products');
        $data[ 'countCartProducts' ] = Session::get('cart.total_items');
        return view('Store::Cart.shoppingCart', $data);
    }

    public function saveUserBeforeAddingAddress($request)
    {
        $user = new User();

        $activation_code = str_random(60) . $request['email_address'];

        $username = \Kinnect2::slugify($request['first_name']. '-' . $request['last_name'], ['table' => 'users', 'field' => 'username']);

        $user->name            = $request['first_name'] . ' ' . $request['last_name'];
        $user->first_name      = $request['first_name'];
        $user->last_name       = $request['last_name'];
        $user->email           = $request['email_address'];
        $user->password        = '';
        $user->activation_code = $activation_code;
        $user->user_type       = 1;
        $user->displayname     = $request['first_name'] . ' ' . $request['last_name'];
        $user->username        = $username;
        $user->website         = 'http://www.cartimatic.com';
        $user->facebook        = 'http://www.cartimatic.com';
        $user->twitter         = 'http://www.cartimatic.com';
        $user->country         = '161';
        $user->timezone        = 'asia';

        $user->save();

        return $user;
    }
    public function saveUserApiAddingAddress(Request $request)
    {
        $user = new User();

        $activation_code = str_random(60) . $request['email_address'];

        $username = \Kinnect2::slugify($request['first_name']. '-' . $request['last_name'], ['table' => 'users', 'field' => 'username']);

        $user->name            = $request['first_name'] . ' ' . $request['last_name'];
        $user->first_name      = $request['first_name'];
        $user->last_name       = $request['last_name'];
        $user->email           = $request['email_address'];
        $user->password        = '';
        $user->activation_code = $activation_code;
        $user->user_type       = 1;
        $user->displayname     = $request['first_name'] . ' ' . $request['last_name'];
        $user->username        = $username;
        $user->website         = 'http://www.cartimatic.com';
        $user->facebook        = 'http://www.cartimatic.com';
        $user->twitter         = 'http://www.cartimatic.com';
        $user->country         = '161';
        $user->timezone        = 'asia';

        $user->save();
        return \Api::success_data($user);

    }

    /**
     * @return mixed
     */
    public function addShippingInfo(Request $request) {
        //For manage address page
        $user_id = $this->user_id;
        if(!Auth::check()){
           $userEmailInfo = isEmailExists($request->email_address);

           if(!isset($userEmailInfo->email)){ // if no email already registered
                   $userInfo = $this->saveUserBeforeAddingAddress($request->all());

                   if(isset($userInfo->id)){
                       $user_id = $userInfo->id;
                   }
           }

            if(isset($userEmailInfo->id)){ //if already user exists
                $user_id = $userEmailInfo->id;
            }
        }

        if($request->address_id > 0 AND isset($request->fromManagePage)) {
            $this->storeRepository->updateExistingStoreOrderDeliveryAddress($request, $user_id);
            if($this->is_api) {
                return \Api::success_with_message();
            }
            return redirect('shipping-addresses');
        }
        //End manage address page


        if($request->sellerBrandId != "buy-all") {
            $data[ 'sellerBrandIdEncoded' ] = $request->sellerBrandId;

            $data[ 'sellerBrandId' ] = Hashids::decode($request->sellerBrandId);
            $data[ 'sellerBrandId' ] = $data[ 'sellerBrandId' ][ 0 ];
        } else {
            $data[ 'sellerBrandIdEncoded' ] = $request->sellerBrandId;

            $data[ 'sellerBrandId' ] = $request->sellerBrandId;
        }

        if($this->is_api) {
            $validation = Validator::make($request->all(), [
                'first_name'     => 'required',
                'last_name'      => 'required',
                'st_address_1'   => 'required',
                'city'           => 'required',
                'email_address'  => 'required|email',
                're_enter_email' => 'required|email',
            ]);
            if($validation->fails()) {
                return \Api::invalid_param();
            }
        } else {
            $this->validate($request, [
                'first_name'     => 'required',
                'last_name'      => 'required',
                'st_address_1'   => 'required',
                'city'           => 'required',
                'email_address'  => 'required|email',
                're_enter_email' => 'required|email',
            ]);
        }

          $orderDeliveryAddressId = $request->address_id;

        if($orderDeliveryAddressId > 0) {
            $this->storeRepository->updateExistingStoreOrderDeliveryAddress($request, $user_id);
            $orderDeliveryAddressId = $request->address_id;
        }


        if ($orderDeliveryAddressId < 1 ) {
            $orderDeliveryAddressId = $this->storeRepository->storeDeliveryAddress( $request , $user_id);
        }

        Session::put('cart.order_address', $orderDeliveryAddressId);

        $data[ 'cartProducts' ]      = $this->storeRepository->getCartProducts();
        $data[ 'cartProductsCount' ] = $this->storeRepository->getCartProductsCount();

        if($this->is_api) {
            return \Api::success_with_message();
        }

        if(count($data[ 'cartProductsCount' ]) > 0) {
            return redirect("store/ship/to/address/" . $data[ 'sellerBrandIdEncoded' ].'/'.$orderDeliveryAddressId);
            //return redirect("store/pay/" . $data[ 'sellerBrandIdEncoded' ] . '?payment_type=card');
        } else {
            return redirect("store/cart/Session-expired-please-shop-again.");
        }
    }

    public function addShippingInfoFromGet(Request $request) {
        $data[ 'user_id' ] = $this->user_id;
        $buy_it_now = 'no';
        if(isset($request->buy_it_now)){
                $buy_it_now = $request->buy_it_now;
        }

        if($request->sellerBrandId != "buy-all") {
            $data[ 'sellerBrandIdEncoded' ] = $request->sellerBrandId;

            $data[ 'sellerBrandId' ] = Hashids::decode($request->sellerBrandId);
            $data[ 'sellerBrandId' ] = $data[ 'sellerBrandId' ][ 0 ];
        } else {
            $data[ 'sellerBrandIdEncoded' ] = $request->sellerBrandId;

            $data[ 'sellerBrandId' ] = $request->sellerBrandId;
        }

        $data[ 'address_id' ]  = $orderDeliveryAddressId = $request->address_id;
        $data[ 'cartAddress' ] = $_POST;

        Session::put('cart.order_address', $orderDeliveryAddressId);

        $data[ 'cartProducts' ]      = $this->storeRepository->getCartProducts();
        $data[ 'cartProductsCount' ] = $this->storeRepository->getCartProductsCount();

        if(count($data[ 'cartProductsCount' ]) > 0) {
            return redirect("add/payment/information/" . $data[ 'sellerBrandIdEncoded' ] .'/'.$buy_it_now.'/'. '?payment_type=cash-on-delivery&sellerBrandIdEncoded='.$data[ 'sellerBrandIdEncoded' ].'&buy_it_now='.$buy_it_now);
        } else {
            return redirect("store/cart/Session-expired-please-shop-again.");
        }
    }

    public function reviewOrder(Request $request) {

        if($request->sellerBrandId != "buy-all") {
            $data[ 'sellerBrandIdEncoded' ] = $request->sellerBrandId;

            $data[ 'sellerBrandId' ] = Hashids::decode($request->sellerBrandId);
            $data[ 'sellerBrandId' ] = $data[ 'sellerBrandId' ][ 0 ];
        } else {
            $data[ 'sellerBrandIdEncoded' ] = $request->sellerBrandId;

            $data[ 'sellerBrandId' ] = $request->sellerBrandId;
        }

        $data[ 'cartProducts' ] = Session::get('cart.products');
        $data[ 'address' ]      = Session::get('cart.order_address');
        $data[ 'address' ]      = end($data[ 'address' ]);

        $data[ 'totalShippingCost' ] = $this->storeOrderRepository->getOrderTotalShippingCost($data[ 'cartProducts' ], $data[ 'address' ][ 'countries' ], $data[ 'sellerBrandId' ]);
        return view("Store::Cart.reviewOrder", $data);
    }

    // ==================== End of Ubaid code ============================

    // ==================== Mustabeen code ============================
    public function searchMyOrders(Request $request) {
        $is_address_owner = $this->storeOrderRepository->searchMyOrders($request->order_number, $request->product_name);

        return $is_address_owner;
    }

    public function searchMyReviews(Request $request) {
        $serchedOrders = $this->storeOrderRepository->searchMyReviews($request->order_number, $request->product_name);

        return $serchedOrders;
    }

    public function sofDeleteAddressInfo(Request $request) {

        if(!isset($request->address_id)) {
            return 0;
        }
        $user_id = $this->user_id;
        $id               = $request->address_id;
        $is_address_owner = $this->storeRepository->isAddressOwner($id,$user_id);

        if($is_address_owner > 0) {
            return $is_address_owner = $this->storeRepository->sofDeleteAddressInfo($id,$user_id);
        }

        return 0;
    }
    public function softApiDeleteAddressInfo(Request $request) {

        if ( $this->is_api ) {
            if ( Input::has($request->address_id) ) {
                return \Api::invalid_param();
            }
            $id = $request->address_id;

            $user_id = $this->user_id;

            $is_address_owner = $this->storeRepository->isAddressOwner( $id, $user_id );

            if ( $is_address_owner > 0 ) {
                $this->storeRepository->sofDeleteAddressInfo( $id, $user_id );

                return \Api::item_deleted();

            }
        }
    }

    public function deleteCartProductByRedirect($product_id) {

        $this->storeRepository->deleteProductFromCart($product_id);
        $total_items = $this->storeRepository->getCartProductsCount();
        $response    = ['status' => 1, 'total_items' => $total_items];
        return redirect('store/cart');
    }

    /**
     * @param $product_id
     *
     * @return mixed
     */
    public function deleteCartProduct($product_id) {

        $this->storeRepository->deleteProductFromCart($product_id);
        $total_items = $this->storeRepository->getCartProductsCount();
        $response    = ['status' => 1, 'total_items' => $total_items];
        return response()->json($response);
    }

    // ==================== End of Mustabeen code ============================

    /**
     * @param Request $request
     */
    public function UpdateQuantityCartProduct(Request $request) {
        $product_id                = $request->get('product_id');
        $quantity                  = $request->get('quantity');

        $master_attribute_1        = $request->get('master_attribute_1');
        $master_attribute_1_label  = $request->get('master_attribute_1_label');
        $master_attribute_1_value  = $request->get('master_attribute_1_value');

        $master_attribute_2        = $request->get('master_attribute_2');
        $master_attribute_2_label  = $request->get('master_attribute_2_label');
        $master_attribute_2_value  = $request->get('master_attribute_2_value');

        $response                  = $this->storeRepository->updateCart('', $product_id, $quantity, $master_attribute_1, $master_attribute_2,'', $master_attribute_1_label, $master_attribute_1_value, $master_attribute_2_label, $master_attribute_2_value);
        $total_items               = $this->storeRepository->getCartProductsCount();
        $response[ 'total_items' ] = $total_items;

        return response()->json($response);
    }

    /**
     * @param $review_id
     *
     * @return mixed
     */
    public function editProductReview($review_id) {
        $description = Input::get('edited_review_description');
        $rating      = Input::get('stars_rating_updated');
        $review      = $this->storeRepository->getReview($review_id);

        if($this->storeRepository->is_review_owner($review_id)) {
            $this->storeRepository->editProductReview($description, $rating, $review_id);

            $storeName = $this->storeAdminRepository->getProductStoreName($review->product_id);

            return redirect('store/' . $storeName . '/product/' . $review->product_id);
        }

        return redirect()->back();
    }

    public function getOrderCompleted($order_id) {
        $data[ 'order_id' ]    = $order_id;
        $data[ 'url_user_id' ] = (isset(Auth::user()->username) ? Auth::user()->username:'Not Logged In');
        if(!empty($this->theme_id)){
            return view('orders.storeOrderSuccessful', $data);
        }else {
            return view('Store::orders.storeOrderSuccessful', $data);
        }
    }

    // ==================== Zahid code ============================
    public function updateOrderStatusAjax(Request $request) {
        $order_info = explode('_', $request->order_info);
        $status     = $order_info[ 1 ];
        $order_id   = $order_info[ 3 ];

        $isOrderCustomer = $this->storeAdminOrderRepository->isOrderCustomer($order_id, Auth::user()->id);
        if($isOrderCustomer < 1) {
            return 'This order does not belongs to you? Please contact to Admin if problem persists.';
        }

        $newStatusData = $this->updateOrderStatus($order_id, $status, 'buyer');

        if(is_array($newStatusData)) {
            $sale = \Config::get('constants_brandstore.STATEMENT_TYPES.SALE');
            $this->storeAdminRepository->updateStatement($sale, 'store_order', $order_id, 'credit', 'USD');
            $fee = \Config::get('constants_brandstore.STATEMENT_TYPES.ORDER_SHIPPING_FEE');
            $this->storeAdminRepository->updateStatement($fee, 'store_order', $order_id, 'credit', 'USD');
            return array_merge($newStatusData, ['order_id' => $order_id]);
        } else {
            return 'something wrong happened try again.';
        }
    }

    public function updateOrderStatus($order_id, $status, $subject) {
        $is_updated = $this->storeAdminOrderRepository->updateOrderStatus($order_id, $status, $subject);
        $order      = $this->storeAdminOrderRepository->getOrderStatus($order_id);

        if($is_updated > 0) {
            if(Auth::user()->user_type == 1) {
                $user_type = 1;
                $data      = getOrderStatusForBuyer($order_id, $order->status, $order);
            } else {
                $user_type = 2;
                $data      = getOrderStatusForSeller($order_id, $order->status);
            }

            //Update product record and add statistics if product status is finished
            if($order->status == \Config::get("constants_brandstore.ORDER_STATUS.ORDER_DELIVERED")) {
                $country    = Auth::user()->country;
                $ip         = getUserIpAddress();
                $userGender = getUserGender();
                $userAge    = getUserAge();

                $soldProducts = $this->storeAdminOrderRepository->getOrderAllProducts($order_id);
                foreach ($soldProducts as $soldProduct) {
                    $this->storeProductStatRepository->addProductStat('sale', Auth::user()->id, $user_type, $userAge, $userGender, $country, $ip, $soldProduct->owner_id, $soldProduct->id);

                    $soldQuantity = $this->storeAdminOrderRepository->getOrderProductItemQuantity($order_id, $soldProduct->id);

//					$this->storeAdminRepository->updateProductQuantityByOperation($soldProduct->id, '-', $soldQuantity->quantity);
                    //$this->storeAdminRepository->updateProductSoldProductByOperation($soldProduct->id, '+', $soldQuantity->quantity);
                }

            }
            return $data;
        }

        return 'Please try again.';
    }

    public function softDeleteOrder(Request $request) {
        $order_info = explode('_', $request->order_info);
        $order_id   = $order_info[ 1 ];

        $isOrderCustomer = $this->storeAdminOrderRepository->isOrderCustomer($order_id, Auth::user()->id);
        if($isOrderCustomer < 1) {
            return 'This order does not belongs to you? Please contact to Admin if problem persists.';
        }

        $isOrderDeleted = $this->storeAdminOrderRepository->softDeleteOrder($order_id);

        if($isOrderDeleted > 0) {
            return $isOrderDeleted;
        } else {
            return "Something wrong happened please try again.";
        }
    }

    public function manageFeedbacks($perPage = null) {
        $data[ 'url_user_id' ] = $user_id = Auth::user()->id;

        $data[ 'allOrders' ]            = $this->storeAdminRepository->getFinishedOrdersCurrentUserBuyerPaginated($user_id);
        $data[ 'countRequestToRevise' ] = $this->storeOrderRepository->countRequestToReviseCurrentUser($data[ 'url_user_id' ]);
        $data[ 'reviews' ]              = $reviews = $this->storeAdminRepository->getCurrentBuyerUserProductsReviews($user_id, $perPage);

        if(!empty($this->theme_id))
        {
            return view('reviews.manageReviews', $data);
        }else{
            return view('Store::reviews.manageReviews', $data);
        }
    }

    public function feedbackReminder(Request $request) {
        $data[ 'class' ]        = '';
        $data[ 'action_btn_1' ] = '';
        $data[ 'action_btn_2' ] = 'Awaiting for Feedback<br /><a class="btn btng" href="javascript:void(0);">Reminder Sent</a>';

        $data[ 'order_id' ] = $request->order_id . $request->product_id;

        return $data;
    }

    public function reviseFeedback(Request $request) {
        $review             = $this->storeAdminRepository->updateFeedBack($request);
        $data               = getReviewStatusForBuyer($review, $request->store_name, $request->order_id);
        $data[ 'order_id' ] = $request->order_id . $request->product_id;
        return $data;
    }

    public function cancelOrder(Request $request) {
        //return $request->all();
        $status   = 0;
        $order_id = $request->order_id;

        $isOrderCustomer = $this->storeAdminOrderRepository->isOrderCustomer($order_id, Auth::user()->id);
        if($isOrderCustomer < 1) {
            return 'This order does not belongs to you? Please contact to Admin if problem persists.';
        }

        $newStatusData = $this->updateOrderStatus($order_id, $status, 'buyer');
        if(is_array($newStatusData)) {
            return array_merge($newStatusData, ['order_id' => $order_id]);
        } else {
            return 'something wrong happened try again.';
        }
    }

    public function getOrderInvoice(Request $request) {
        $data[ 'order_id' ]    = $order_id = $request->order_id;
        $data[ 'url_user_id' ] = $store_owner = Auth::user()->username;

        $data[ 'order' ]          = $this->storeAdminOrderRepository->getOrderById($order_id);
        $data[ 'orderCourier' ]   = $order = $this->storeAdminOrderRepository->getOrderCourierByOrderId($order_id);
        $delivery_address_id = 0;
        if(isset($data[ 'order' ]->delivery_address_id)){
            $delivery_address_id = $data[ 'order' ]->delivery_address_id;
        }
        $data[ 'orderAddresses' ] = $order = $this->storeRepository->getOrderAddressesByOrderId($delivery_address_id);
        $data[ 'orderPayments' ]  = $order = $this->storeAdminOrderRepository->getOrderPaymentByOrderId($order_id);
        if(isset($data[ 'order' ]->conv_id)){
            if(!is_null($data[ 'order' ]->conv_id)) {
                $messageRepo        = new MessageRepository();
                $data[ 'messages' ] = $messageRepo->getConvAllMessages($data[ 'order' ]->conv_id, 'ASC');
            }
        }

        if(!empty($this->theme_id))
        {
            return view('orders.orderInvoice', $data);
        }else {
            return view('Store::orders.orderInvoice', $data);
        }
    }

    public function checkProductShippingCountry(Request $request) {

        $data = $this->storeOrderRepository->checkProductShippingCountry($request->products_ids, $request->country_id, $request->sub_total);

        return $data;
    }

    public function checkProductShippingCountryByISO(Request $request) { //echo $request->country_iso;
        $country = Country::where("iso", $request->country_iso)->first();
        //echo "<pre>";
        //echo ($country->id);
        //die(000);
        //$request->products_ids, $request->country_id,$request->sub_total
        $data = $this->storeOrderRepository->checkProductShippingCountry($request->products_ids, $country->id);

        return $data;
    }

    public function getEditAddressFormInfo(Request $request) {
        $data[ 'userAddressesInfo' ] = $order = $this->storeRepository->getEditAddressFormInfo($request);

        return $data;
    }

    // ==================== End of Zahid code ============================

    public function ProductReviewAjax(Request $request, $product_id = NULL) {
        if($product_id == null){
            $product_id = $request->product_id;
        }

        $owner_id = Auth::user()->id;

        if(isset($request->owner_id)){
            $owner_id = $request->owner_id;
        }

        $review = $this->storeAdminRepository->storeReview($request, $product_id, 1, $owner_id);

        if($this->is_api){
            return \Api::success($review);
        }

        $data               = getReviewStatusForBuyer($review, $request->store_name, $request->order_id);
        $data[ 'order_id' ] = $request->order_id . $product_id;

        return $data;
    }

    public function addProductFavorites(Request $request) {
        $favoriteProduct = new ProductFavorites();

        $favoriteProduct->product_id  = $request->product_id;
        $favoriteProduct->poster_type = 'user';
        $favoriteProduct->poster_id   = $this->user_id;

        $favoriteProduct->save();

        $html = productFavoriteHtml($request->product_id);
        return $html;
    }

    public function removeProductFavorites(Request $request) {
        ProductFavorites::where('poster_id', $this->user_id)
                        ->where('product_id', $request->product_id)
                        ->delete();

        $html = productFavoriteHtml($request->product_id);
        return $html;
    }

    public function saveMessage(Request $request) {
        $messageRepository = new MessageRepository();
        if(!$request->has('conv_id')) {
            $messageRepository = new MessageRepository();
            $conv              = $messageRepository->createConversation([$this->user_id, $request->receiver_id], $this->user_id, 'group');

            $request[ 'conv_id' ] = $conv[ 'convId' ];
            $conv_id              = $conv[ 'convId' ];
            $conv                 = Conversation::find($conv_id);
            $conv->conv_for       = \Config::get('constants.ORDER_MESSAGES_TYPE');
            $conv->save();
            $orderID          = Hashids::connection('store')->decode($request->order_id);
            $dispute          = StoreOrder::find($orderID[ 0 ]);
            $dispute->conv_id = $conv_id;
            $dispute->save();
        }

        return $messageRepository->saveOtherMessage($request);
    }

    public function filterProducts() {

        $searchRecord = Input::get( 'searchRecord' );
        $categories = Input::get( 'categories' );
        $products = $this->storeAdminRepository->searchFilter($categories,$searchRecord,$this->store_id);

        return json_encode($products);

    }

    public function searchRecord(Request $request) {
        $data['breadCrumb'] = '';

        $data['products'] = $products = $this->storeAdminRepository->searchRecords(0, $request->search);

        if(isset($request->category_id)){
            $data['breadCrumb'] = getBreadCrumbsBySubCategoryId($request->category_id);

            $data['products'] = $products = $this->storeAdminRepository->searchRecords($request->category_id, $request->search);
            $data['parent_category_id'] = $request->category_id;
        }

        return view('Store::search.search' ,$data);

    }

    public function searchHotUrl( Request $request ) {

        $data['products'] = $this->storeAdminRepository->searchHotUrl($request);
        return view('Store::search.search' ,$data);
    }

    public function hotSearch(Request $request) {

        $hotSearch = $this->storeAdminRepository->hotSearch();
        return $hotSearch;

    }


    public function wishList(Request $request ,$perPage = 10)
    {
        $user_id = $this->user_id;

        $favoriteIds = ProductFavorites::where( 'poster_id', $user_id )
                                       ->lists('product_id');

        $data['favoriteProducts'] = $this->storeAdminRepository->wishList($favoriteIds, $perPage,$user_id);
        $data["perPage"]  = $perPage;
        $wish             = [ '0' => 'All Categories' ];
        $wishList         = DB::table( 'store_product_categories' )->where( 'category_parent_id', 0 )->lists( 'name', 'id' );
        $data['wishList'] = $wish + $wishList;
        if($this->is_api){
            return \Api::success_data($data);
        }
        if(!empty($this->theme_id))
        {
            return view('wishlist.wishlist', $data);
        }else {
            return view('Store::wishlist.wishlist', $data);
        }
    }
    public function wishListDelete() {
        $delWishList = Input::get( 'delWishList' );
        if($this->is_api) {
            if(!Input::has('product_id')) {
                return \Api::invalid_param();
            }
            $delWishList = Input::get('product_id');
        }
        $user_id     = $this->user_id;
        $wishList = ProductFavorites::where( 'poster_id', $user_id )->where( 'product_id', $delWishList )->delete();
        if($this->is_api){
            if(count($wishList) > 0){
                return \Api::item_deleted();
            }

        }
        return $wishList;
    }

    public function wishListFilter($perPage = 10 ) {

        $user_id     = $this->user_id;
        $category_id = Input::get( 'category' );

        if($this->is_api) {
            if(!Input::has('category_id')) {
                return \Api::invalid_param();
            }
            $category_id = Input::get('category_id');
            $perPage = Input::get('perPage');
        }
        if($category_id > 0){
            $products = $this->storeAdminRepository->filtersWishList($category_id,$user_id,$perPage);
            if($this->is_api){
                return \Api::success_data($products);
            }
            return $products;
            //return json_encode($products);

        }else{
            $products = $this->storeAdminRepository->filtersWishAllList($user_id,$perPage);
            if($this->is_api){
                return \Api::success_data($products);
            }
            return $products;
            //return json_encode($products);

        }


    }

    public function getShippingAddresses()
    {
        $data[ 'previousAddresses' ] = $this->storeRepository->getAddressesOfUserById($this->user_id);
        $default       = ['0' => 'Select Country'];
        $countriesList = DB::table('countries')->lists('name', 'id');
        $countriesList = $default + $countriesList;
        $data['countries'] = $countriesList;
        if(!empty($this->theme_id)){
            return view("shiping_address.index", $data);
        }else{
            return view("Store::shiping_address.index", $data);
        }
    }
    public function addNewApiStoreOrderDeliveryAddress(Request $request)
    {

        $validation = Validator::make( $request->all(), [
            'first_name'     => 'required',
            'last_name'      => 'required',
            'st_address_1'   => 'required',
            'city'           => 'required',
            'email_address'  => 'required|email',
            're_enter_email' => 'required|email',
        ] );
        if ( $validation->fails() ) {
            return \Api::invalid_param();
        }

        $user_email = DB::table('store_delivery_addresses')->where('email' , $request->email_address)->first();
        
            $user_id  = $this->user_id;
            $userInfo = $this->storeRepository->storeDeliveryAddress( $request, $user_id );
            return \Api::success_data($userInfo);


    }
    public function updateExistingApiStoreOrderDeliveryAddress(Request $request)
    {
        $user_id = $this->user_id;
        $orderDeliveryAddressId = $this->storeRepository->updateExistingStoreOrderDeliveryAddress($request,$user_id);

        return \Api::success_data($orderDeliveryAddressId);
    }

    public function getMessages() {
        $is_get_message = \Input::get('conv_id');
        if($is_get_message != 0) {
            $conv_id      = \Input::get('conv_id');
            $last_time = \Input::get('last_update_time');
            $message_repo = new MessageRepository();

            if(!empty($last_time)) {
                $last_time = date('Y-m-d H:i:s',strtotime($last_time));
                $data = $message_repo->getConvAllMessages( $conv_id,'ASC');
            }else {
                $data = $message_repo->getConvAllMessages( $conv_id,'ASC');
            }
            $msg['messages'] = $data;
            return $messages = view('messages.conversation-messages', $msg)->render();
        }
    }

    public function savePaymentInfo(Request $request)
    {
        $str = $request->variables_string;
        $cart_token = str_random(60);
        $user_id =$this->user_id;

        DB::table('cart_sessions')
          ->where( 'user_id', $user_id )
          ->delete();

        $insert_id = DB::table('cart_sessions')->insert([
            'meta' => $str,
            'cart_token' => $cart_token,
            'user_id' => $user_id,
        ]);

        $data['next_url'] = url(config('constants_api.API_ROUTE_PREFIX').'/store/checkout/'.$cart_token);

        return $data;
    }

    public function myProfile(Request $request)
    {
        $data['countries'] = ['0' => 'Select Country *'];
        $data['countries'] = array_merge($data['countries'], $this->allCountries());

        $data['user'] = User::find($this->user_id);
        if(!isset($data['user']->id)){
            return abort(404);
        }
        return view('my_profile', $data);
    }

    public function saveMyProfile(Request $request)
    {
        $user = User::find($this->user_id);
        if(!isset($user)){
            return abort(404);
        }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        //$user->email = $request->email;
        $user->gender = $request->gender;
        $user->contact_info = $request->contact_info;
        $user->postal_zip_code = $request->postal_zip_code;
        $user->country = $request->country;
        $user->city_state_county = $request->city_state_county;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;

        $user->save();

        return redirect('my-profile');
    }

    public function allCountries() {
        return DB::table('countries')->lists('name', 'id');
    }

    public function saveMyProfilePhoto(Request $request)
    {
        $user = User::find($this->user_id);
        if(!isset($user)){
            return url('local/storage/app/product-images/default.jpg');
        }

        $data = $this->crop(\Config::get('constants.IMAGE_TYPES.USERS'));
        $data[ 'image_path' ]       = $data[ 'result' ];
        $user->profile_photo_url    = $data[ 'image_path' ];
        $user->save();

        $data[ 'result' ]           = url($data[ 'result' ]);
        return $data;
    }

    
}
