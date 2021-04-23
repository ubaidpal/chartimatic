<?php

namespace App\Http\Controllers;

use App\ContactRequest;
use App\Country;
use App\Events\SendEmail;
use App\Page;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\GeneralRepository;
use App\Services\StorageManager;
use App\StoreContactUs;
use Cartimatic\Store\ProductFavorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    /**
     * @var \App\Repository\Eloquent\GeneralRepository
     */
    private $generalRepository;
    private $categoryRepository;
    private $is_api;

    public function __construct(CategoryRepository $categoryRepository, GeneralRepository $generalRepository, Request $middleware) {
        parent::__construct();
        if(isset($middleware[ 'middleware' ][ 'is_api' ])) {
            $this->is_api = $middleware[ 'middleware' ][ 'is_api' ];
        }

        $this->generalRepository  = $generalRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index() {
        if(!$this->is_market_place) {
            $this->redirectToStore();
        }

        $blocks = $this->generalRepository->getCategoryBlocks();

        foreach ($blocks as $block) {
            if(isset($block->id)) {
                $categoryInfo = getCategoryById($block->category_id);

                if(isset($categoryInfo->id)) {
                    $block->title = $categoryInfo->name;
                }

                $block->banner_path = url($block->banner_path);
                $block->base_path   = url('local/storage/app') . '/';

                foreach ($block->items as $item) {
                    if(isset($item->id)) {
                        $item->banner_path = url($item->banner_path);
                    }
                }
            }
        }

        $data[ 'categoriesBlock' ] = $blocks;

        $data[ 'categories' ] = $this->categoryRepository->getCategories();
        $products             = $this->generalRepository->bestSellingProducts();

        foreach ($products as $product) {
            if(isset($product->id)) {
                $product->image_path = getRandomImageOfProduct($product->id);
            }
        }

        $data[ 'bestSellingProducts' ] = $products;

        $sliderItems = $this->generalRepository->getSlider();

        foreach ($sliderItems as $sliderItem) {
            $sliderItem->banner_path = url('local/storage/app') . '/' . $sliderItem->banner_path;
        }

        $data[ 'slider' ] = $sliderItems;

        if($this->is_api) {
            return \Api::success($data);
        }
        if(!$this->is_market_place) {
            if(empty($this->theme_id) && empty(Auth::user()->id)) {
                return view('dashboard');

            } elseif((!empty(Auth::user()->id))) {
                if(!empty($this->store_db_name) && strtolower($this->store_db_name) != strtolower($this->store_name) && !$this->is_custom_domain) {
                    return view('dashboard');
                }
            }
        }

        return view('home', $data);

    }

    public function allCategories() {

        return view('category.all_categories');
    }

    public function getCategoryIndex(Request $request, $category, $sorting = 'id', $perPage = '12') {

        $data[ 'category' ] = $category = $this->categoryRepository->getCategoryBySlug($category);

        if(!isset($category->id)) {
            return redirect('not found');
        }

        $data[ 'subCategories' ] = $this->categoryRepository->getSubCategories($category->slug);
        $data[ 'categoryName' ]  = ucfirst($category->name);
        $data[ 'categorySlug' ]  = $category->slug;

        $isCategory                   = $this->categoryRepository->isLeafCategory($category->id);
        $data[ 'featuredCategories' ] = $this->categoryRepository->featuredCategories($category->slug);

        $data[ 'filters' ] = explode(',', $request->filters);

        $data[ 'isSuperParent' ] = $category->category_parent_id;

        //if ( $isCategory == 0 ) {
        if($category->category_parent_id != 0) {
            if($data[ 'filters' ][ 0 ] != '') {
                $data[ 'allProductRecords' ] = $this->categoryRepository->allFilteredProducts($data[ 'filters' ], $sorting, 'DESC', $perPage, $category->id);
            } else {
                $search_term = '';
                $category_id = $category->id;

                if(isset($request[ 'srch-term' ])) {
                    $data[ 'search_term' ] = $search_term = $request[ 'srch-term' ];
                    $category_id           = $request[ 'cat' ];

                }

                $data[ 'allProductRecords' ] = $this->categoryRepository->allProduct($category_id, $sorting, 'DESC', $perPage, $search_term, $this->store_id);

                $data[ "perPage" ] = $perPage;
                $data[ "sorting" ] = $sorting;

            }

            $data[ 'categoryAttributes' ] = $this->categoryRepository->categoryAttributes($category->id, $sorting, 'DESC', $perPage);
            return view('category.category_products', $data);
        } else {
            return view('category.category', $data);
        }
    }

    public function getAllProductsCategory($category_id) {

        $data[ 'products_category' ] = $this->categoryRepository->getCategoryBySlug($category_id);

        return view('category.category_products', $data);
    }

    public function getNewArrivals() {
        $data[ 'active_top_link_number' ]        = 1;
        $data[ 'newArrivalsProducts' ]           = $this->categoryRepository->newArrivalsProducts();
        $data[ 'newArrivalsProductsCategories' ] = $this->categoryRepository->newArrivalsProductsCategories($data[ 'newArrivalsProducts' ]);

        return view('new_arrivals', $data);
    }

    public function getTopSellers() {
        $data[ 'active_top_link_number' ]       = 2;
        $data[ 'topSellersProducts' ]           = $this->categoryRepository->topSellersProducts();
        $data[ 'topSellersProductsCategories' ] = $this->categoryRepository->topSellersProductsCategories($data[ 'topSellersProducts' ]);

        return view('top_sellers', $data);
    }

    public function helpCreateAnAccount() {
        $data[ 'help_link_number' ] = 1;

        return view('help.create_account', $data);
    }

    public function helpMakingPayments() {
        $data[ 'help_link_number' ] = 2;

        return view('help.making_payments', $data);
    }

    public function helpDeliveryOptions() {
        $data[ 'help_link_number' ] = 3;

        return view('help.delivery_options', $data);
    }

    public function helpBuyerProtection() {
        $data[ 'help_link_number' ] = 4;

        return view('help.buyer_protection', $data);
    }

    public function helpNewUserGuide() {
        $data[ 'help_link_number' ] = 5;

        return view('help.user_guide', $data);
    }

    public function contactUs() {
        $data[ 'site_map_or_contact_link_number' ] = 1;

        return view('contact_us', $data);
    }

    public function siteMap() {
        $data[ 'site_map_or_contact_link_number' ] = 2;

        return view('site_map', $data);
    }

    public function partnership() {
        $data[ 'partner_promotion' ] = 1;

        return view('partnership', $data);
    }

    public function affiliateProgram() {
        $data[ 'partner_promotion' ] = 2;

        return view('affiliate-program', $data);
    }

    public function getPhoto($type, $name, $imageType = NULL) {
        $sm = new StorageManager();

        $file = $sm->getFile($type, $name, $imageType);

        return response()->make($file)->header('Content-Type', urldecode($type));
    }

    public function getStyleSheet() {

        return response()->view('style')->header('Content-Type', 'text/css');
    }

    public function getPageByID($page_id) {
        $page = Page::where('id', $page_id)->first();
        $data = ['page' => $page];
        return view('page', $data);
    }

    public function getProductByID($product_id) {
        $data = [];

        $storeAdminRepository       = new \Cartimatic\Store\Repository\admin\StoreAdminRepository();
        $storeProductStatRepository = new \Cartimatic\Store\Repository\StoreProductStatRepository();

        $user_id    = (isset(\Auth::user()->id)) ? \Auth::user()->id : -1;
        $user_type  = (isset(\Auth::user()->id)) ? \Auth::user()->user_type : -1;
        $country    = (isset(\Auth::user()->id)) ? \Auth::user()->country : -1;
        $ip         = getUserIpAddress();
        $userGender = getUserGender();
        $userAge    = getUserAge();

        $data[ 'key_feature' ]          = $storeAdminRepository->key_feature($product_id);
        $data[ 'productDetail' ]        = $product = $storeAdminRepository->getProductDetail($product_id);
        $data[ 'productKeepingDetail' ] = $allAttributes = $storeAdminRepository->getProductMasterAttribute($product_id);

        $masterAttribute1 = '';
        $masterAttribute2 = '';

        $allMasterAttribute = '';

        foreach ($allAttributes[ 'masterAttribut1' ] as $attr) {
            if(isset($attr->attr_id)) {
                $masterAttribute1 .= $attr->attr_id . '_' . $attr->label . '_' . $attr->value_id . '_' . $attr->value . '_' . $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ', ';
                $allMasterAttribute .= $attr->value_id_2 . $attr->value_id . '_' . $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ',';
            }
        }

        foreach ($allAttributes[ 'masterAttribut2' ] as $attr) {
            if(isset($attr->attr_id)) {
                $masterAttribute2 .= $attr->attr_id . '_' . $attr->label . '_' . $attr->value_id . '_' . $attr->value . '_' . $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ', ';
                $allMasterAttribute .= $attr->value_id_1 . $attr->value_id . '_' . $attr->price . '_' . $attr->quantity . '_' . $attr->discount . ',';
            }
        }

        $data[ 'masterAttribute1' ]   = $masterAttribute1;
        $data[ 'masterAttribute2' ]   = $masterAttribute2;
        $data[ 'allMasterAttribute' ] = $allMasterAttribute;

        if(!isset($product->id)) {
            $data[ 'productDetail' ] = $product = $storeAdminRepository->getDeletedProductDetail($product_id);

            if(!isset($product->id)) {
                return abort("404");
            }

            return view('Store::products.storeDeletedProductMessage', $data);
        }

        $brand = $storeAdminRepository->isStoreBrand($product->owner_id);

        $data[ 'isStoreOwner' ]      = $storeAdminRepository->is_product_owner($product_id);
        $data[ 'storeName' ]         = getUserNameByUserId($product->owner_id);
        $data[ 'brand' ]             = $storeAdminRepository->storeBrand($product->owner_id);
        $data[ "user" ][ "country" ] = Country::where("id", $country)->first();

        $data[ 'key_feature' ]    = $storeAdminRepository->key_feature($product_id);
        $data[ 'tech_spechs' ]    = $storeAdminRepository->tech_spechs($product_id);
        $data[ 'reviews' ]        = $storeAdminRepository->getReviews($product_id);
        $data[ 'isAbleToReview' ] = $storeAdminRepository->isAbleToReview($user_id, $product_id);
        $data[ 'isReviewed' ]     = $storeAdminRepository->isReviewed($user_id, $product_id);

        $productAttributes    = $data[ 'productAttributes' ] = $storeAdminRepository->getProductAttributes($product_id);
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
        $storeProductStatRepository->addProductStat('view', $user_id, $user_type, $userAge, $userGender, $country, $ip, $product->owner_id, $product->id);

        $data[ 'favourites' ] = ProductFavorites::where('product_id', $product_id)
                                                ->where('poster_type', 'user')
                                                ->where('poster_id', $user_id)->get();

        return view('product-details', $data);
    }

    public function getCart() {

        $data[ 'url_user_id' ] = '';

        if(Auth::check()) {
            if(Auth::user()->user_type == 2) {
                return redirect("/store/" . Auth::user()->username . "/admin/orders");
            }
            $data[ 'url_user_id' ] = Auth::user()->username;
        }

        $data[ 'cartProducts' ]      = Session::get('cart.products');
        $data[ 'countCartProducts' ] = Session::get('cart.total_items');
        return view('cart.shoppingCart', $data);
    }

    public function checkout($store_name, $store_id) {
        return redirect()->away($this->store_url . '/store/' . $store_name . '/shipping/address/' . $store_id);
    }

    public function deleteCartProduct($product_id) {

        $storeRepository = new \Cartimatic\Store\Repository\StoreRepository();
        $storeRepository->deleteProductFromCart($product_id);

        return redirect('cart');
    }

    public function getPos() {
        return view('pos');
    }

    /**
     * @return CategoryRepository
     */
    public function getCategoryRepository() {
        return $this->categoryRepository;
    }

    public function onlineStore() {
        return view('online-store');
    }

    public function helpCenter() {
        return view('help-center');
    }
    public function pricing() {
        return view('pricing');
    }

    public function getLoginPage() {
        return view('login');
    }

    public function saveContactUsForm() {
        $name    = \Request::get('name');
        $email   = \Request::get('email');
        $subject = \Request::get('subject');
        $message = \Request::get('message');

        $contactObj           = new StoreContactUs();
        $contactObj->name     = $name;
        $contactObj->email    = $email;
        $contactObj->subject  = $subject;
        $contactObj->store_id = $this->store_id;
        $contactObj->message  = $message;

        $contactObj->save();

        return redirect()->back();
    }

    public function migrate_me() {
        return view('migrate_me');
    }

    public function contactRequest(Request $request) {
        $validator = \Validator::make($request->all(), [
            'email'         => 'required|unique:contact_requests',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'company'       => 'required',
            'company_title' => 'required',
            'country'       => 'required',
            'phone'         => 'required',
        ]);

        if($validator->fails()) {
            return \Redirect::to('pos/#contact-request')->withErrors($validator)
                            ->withInput();
        }
        $contactRequest = new ContactRequest();

        $contactRequest->first_name    = $request->first_name;
        $contactRequest->last_name     = $request->last_name;
        $contactRequest->email         = $request->email;
        $contactRequest->phone         = $request->phone;
        $contactRequest->company       = $request->company;
        $contactRequest->company_title = $request->company_title;
        $contactRequest->country       = $request->country;
        $contactRequest->detail        = $request->detail;
        $contactRequest->save();

        $emailData = array(
            'subject'  => 'Contact Request',
            'message'  => 'Received a contact Request',
            'from'     => $request->email,
            'name'     => 'Cartimatic',
            'template' => 'contact-request',
            'to'       => \Config::get('admin_constants.ORDER_STATUS_EMAIL'),
            'detail'   => $request->all()
        );
        \Event::fire(new SendEmail($emailData));

        return redirect()->back()->with('success', 'Contact request sent successfully!');
    }
}
