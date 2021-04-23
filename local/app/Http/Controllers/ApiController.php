<?php

namespace App\Http\Controllers;

use Api;
use App\Classes\WebServerResponse;
use App\Http\Requests;
use App\Repository\Eloquent\CategoryRepository;
use App\User;
use Cartimatic\Store\Category;
use Cartimatic\Store\Repository\StoreRepository;
use Cartimatic\Store\StoreCategoryAttribute;
use Cartimatic\Store\StoreProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Session;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class ApiController extends Controller
{
    private $is_api;
    private $categoryRepository;
    private $storeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $middleware,
                                CategoryRepository $categoryRepository,
                                StoreRepository $storeRepository
                                )
    {
        if(isset( $middleware['middleware']['is_api'])) {
            $this->is_api =  $middleware['middleware']['is_api'];
        }
        $this->categoryRepository   = $categoryRepository;
        $this->storeRepository      = $storeRepository;
    }

    public function getCategoriesList()
    {
            $categoriesList = $this->categoryRepository->getCategoriesList();
            return $categoriesList;
    }

    public function login(Request $request) {

        if(Auth::attempt(['email' => $request->email,  'password' => $request->password,  'active' => '1'])) {

            $access_token = Authorizer::issueAccessToken();
            $data         = array(
                'base_url'     => url(),
                'email'     => $request->email,
                'first_name'     => Auth::user()->first_name,
                'last_name'     => Auth::user()->last_name,
                'access_token' => $access_token
            );
            return \Api::success($data);
        } else {

            return \Api::invalid_param('Please provide valid credentials!');

        }
    }

    public function stepOne(Request $request)
    {

        $validator = Validator::make(
            [
                'email'                 => $request->email,
                'password'              => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ],
            [
                'email'                 => 'required|email|unique:users',
                'password'              => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/|confirmed',
                'password_confirmation' => 'required|min:6',
            ],
            [
                'required' => ':attribute field is required',
            ]
        );

        if ($validator->fails()) {
            //return $validator->messages();
            return \Api::invalid_param();
        } else {
            return '';
        }
    }
    public function signUp(Request $request) {

        $rules      = array(
            'email'    => 'required|unique:users|email',
            'password' => 'required'
        );
        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()) {
            $msg = '';
            if($validation->errors()->has('email')) {
                $email = $validation->errors()->get('email');
                $msg .= $email[0];
            }
            if($validation->errors()->has('password')) {
                $password = $validation->errors()->get('password');
                $msg .= '\n' . $password[0];
            }

            return \Api::already_done($msg);
        }

        $activation_code = str_random(60) . $request->input('email');

        $user        = new User();
        $username = $this->slugify($request->input('first_name') . '-' . $request->input('last_name'), ['table' => 'users', 'field' => 'username']);
        $user->name            = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->first_name      = $request->input('first_name');
        $user->last_name       = $request->input('last_name');
        $user->email           = $request->input('email');
        $user->password        = bcrypt($request->input('password'));
        $user->activation_code = $activation_code;
        $user->user_type       = $request->input('user_type');
        $user->displayname     = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->username        = $username;
        $user->website         = 'http://www.cartimatic.com';
        $user->facebook        = 'http://www.cartimatic.com';
        $user->twitter         = 'http://www.cartimatic.com';
        $user->country         = '161';
        $user->timezone        = 'asia';
        $dt = Carbon::Now();
        $dt->addDays(29);

        $user->token_expiry_date = $dt;

        $user->save();
        //$this->sendEmail($user);
        return \Api::success_with_message('Registered Successfully. Please Verify your email');

    }
    public function sendEmail(User $user)
    {

        $data = array(
            'name' => $user->name,
            'code' => $user->activation_code,
        );

        \Mail::queue('emails.activateAccount', $data, function ($message) use ($user) {
            $message->subject(\Lang::get('auth.pleaseActivate'));
            $message->to($user->email);
            $message->from("Cartimatic@no-reply.com");
        });
    }

    public function getCategoryFilters(Request $request)
    {
        //select(DB::raw('COUNT(pro_att.store_attribute_id) as total_items'))->

        $categoryIds = getFilterCategoryIds($request->category_id);

        $attributes = StoreCategoryAttribute::select(
          'pav.id as product_attribute_value_pk',
          'pav.store_attribute_value_id as product_attribute_value_ref',
          'a.id as att_id',
          'av.id as att_val_id',
          'a.label',
          'av.value',
          'pa.id as pro_id_pk'
          ,DB::raw('COUNT(pa.id) as total_items')
        )
          ->whereIn('category_id', $categoryIds)

          ->join('store_attributes as a', 'store_category_attributes.store_attribute_id', '=', 'a.id')
          ->join('store_attribute_values as av', 'a.id', '=', 'av.store_attribute_id')

          ->join('store_product_attributes as pa', 'a.id', '=', 'pa.store_attribute_id')
          ->join('store_product_attribute_values as pav', 'pa.id', '=', 'pav.store_product_attribute_id')

          ->whereRaw('av.id = pav.store_attribute_value_id')
          ->where('pa.is_deleted', 0)

          ->groupBy('pav.store_attribute_value_id')

          ->get();

        $pretty = [];

        $breadCrumbsCats = getBreadCrumbsBySubCategoryId($request->category_id);
        $breadCrumbsCats = array_reverse($breadCrumbsCats);

        $pretty['subCategories'] = $this->getSubByCatID($breadCrumbsCats[1]['id']);

        foreach($attributes as $attribute){

            $pretty['attributes'][$attribute->att_id]['attribute_info'] = ['attribute_id' => $attribute->att_id, 'label' => $attribute->label];

            $pretty['attributes'][$attribute->att_id]['attribute_values'][$attribute->att_val_id][] = [
                        'attribute_value_id' => $attribute->att_val_id,
                        'attribute_value' => $attribute->value,
                        'total_items' => $attribute->total_items
            ];
        }

        return Api::success($pretty);

    }

    public function getSubByCatID($id)
    {
        return Category::where( 'category_parent_id', $id )
          ->orderBy( "name", 'ASC' )
          ->get()->toArray();
    }
    public function getCategoryIndex(Request $request, $sorting='id', $perPage='10' ) {

        $data['category'] = $category = $this->categoryRepository->getCategoryById( $request->category_id );

        if ( ! isset( $category->id ) ) {
            return ['error'=>"Not found"];
        }

        $data['isSuperParent']  = ($category->category_parent_id == 0)?1:0;
        //$data['isLeafCategory'] = ($this->categoryRepository->isLeafCategory( $category->id ) > 0)?0:1;//Last item in category
        $data['isLeafCategory'] = ($category->category_parent_id == 0)?1:0;//Last item in category

        $data['subCategories'] = $this->categoryRepository->getSubCategoriesArrayByIdForAPI( $category->id );
        $data['categoryName']  = ucfirst( $category->name );
        $data['categorySlug']  = $category->slug ;

        $data['allProductRecords'] = '';

        if ( $category->category_parent_id != 0 ) {
             $data['allProductRecords'] = $this->categoryRepository->allProductArray( $category->id, $sorting, 'DESC', $perPage );
        }

        return Api::success($data);
    }

    public function getProductDetail(Request $request){
        $product_id = $request->product_id;
        $data['product_info']  = $this->storeRepository->getProductDetail($product_id);

        $images = StoreProductImage::where("product_id", $product_id)->get();

        foreach($images as $image){
            if(isset($image->image_path)){
                $image->image_path = url('local/storage/app').'/'.$image->image_path;
            }
        }

        $data['product_images'] = $images->toArray();
        $data[ 'brand' ]       = $this->storeRepository->storeBrandInfo($data['product_info']->owner_id);

        //Master attributes detail
        $data[ 'productKeeping' ] = $allAttributes = $this->storeRepository->storeProductKeeping($product_id);
        //$data[ 'productKeepingDetail' ] = $allAttributes = $this->storeRepository->getProductMasterAttribute($product_id);
        //End of Master attributes detail

        return Api::success($data);
    }

    public function getRating(Request $request)
    {
        $product_id = $request->product_id;
        return getProductReviews($product_id);
    }

    public function getCountriesList()
    {
        $data['countries'] = allCountriesList();
        return Api::success($data);
    }

    public function getPaymentInfo(Request $request)
    {
        Session::set('cart', '');
        $cart_session = $this->getCartSessionInfo($request->cart_token);
        //Convert meta data to array
        $pInCarts = $this->getArrayFromBase64($cart_session->meta);

        foreach($pInCarts['products'] as $key => $p){
            $data['sellerBrandIdNotEncoded'] = $key;
            $data['sellerBrandId'] = $key;
            $data['sellerBrandId'] = Hashids::encode($data['sellerBrandId']);
            break;
        }

        if(count($pInCarts['products']) > 1){
            $data['sellerBrandIdNotEncoded'] = 'buy-all';
            $data['sellerBrandId'] = 'buy-all';
        }

        Session::set('cart.total_items', $pInCarts['total_items']);
        Session::set('cart.order_address', $pInCarts['order_address']);

        foreach($pInCarts['products'] as $brands){
            foreach($brands as $p){
                $response = $this->storeRepository->updateCart('', $p->product_id, $p->quantity, $p->master_attribute_1, $p->master_attribute_2, '', 'color', 'size', 'red', 'large');
            }
        }

        $data['cart_token'] = $cart_session->cart_token;

        $userInfo = DB::table('users')->select('id', 'username', 'email', 'password')->where('id', $cart_session->user_id)->first();

        $data['method'] = 'card';
        $data['prefix'] = config('constants_api.API_ROUTE_PREFIX');

        $data['userInfo'] = $userInfo;
        Session::set('user', $userInfo);

        $meta = base64_decode($cart_session->meta);
        $data['cart_info'] = (array)json_decode($meta);

        $data['orderInfo'] = $cart_session;
        Session::set('order', $cart_session);

        $cartItems = $this->storeRepository->getCartProducts($data['sellerBrandIdNotEncoded']);
        $data['orderAmountInfo'] = $this->storeRepository->orderAmountInfoInSession($cartItems);

        return view('apicart', $data);
    }

    public function getCartSessionInfo($token)
    {
        $cart_session = DB::table('cart_sessions')
          ->where( 'cart_token', $token)
          ->first();

        return $cart_session;
    }

    public function getArrayFromBase64($meta)
    {
        $meta = base64_decode($meta);
        $pInCarts = (array)json_decode($meta);
        return $pInCarts;
    }

    public function getNewArrivals(Request $request)
    {
        $data['newArrivalsProducts']  = $this->categoryRepository->newArrivalsArray();

        return \Api::success($data);
    }

    public function getBestSeller(Request $request)
    {
        $data['topSellersProducts']  = $this->categoryRepository->bestSellersArray();

        return \Api::success($data);
    }

    private function slugify($str, $options = array()) {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

        $defaults = array(
          'delimiter'     => '-',
          'limit'         => NULL,
          'lowercase'     => TRUE,
          'replacements'  => array(),
          'transliterate' => FALSE,
        );

        // Merge options
        $options = array_merge($defaults, $options);

        $char_map = array(
            // Latin
          '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'AE', '�' => 'C',
          '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'I',
          '�' => 'D', '�' => 'N', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '?' => 'O',
          '�' => 'O', '�' => 'U', '�' => 'U', '�' => 'U', '�' => 'U', '?' => 'U', '�' => 'Y', '�' => 'TH',
          '�' => 'ss',
          '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'ae', '�' => 'c',
          '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'i',
          '�' => 'd', '�' => 'n', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '?' => 'o',
          '�' => 'o', '�' => 'u', '�' => 'u', '�' => 'u', '�' => 'u', '?' => 'u', '�' => 'y', '�' => 'th',
          '�' => 'y',
            // Latin symbols
          '�' => '(c)',
            // Greek
          '?' => 'A', '?' => 'B', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Z', '?' => 'H', '?' => '8',
          '?' => 'I', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => '3', '?' => 'O', '?' => 'P',
          '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'Y', '?' => 'F', '?' => 'X', '?' => 'PS', '?' => 'W',
          '?' => 'A', '?' => 'E', '?' => 'I', '?' => 'O', '?' => 'Y', '?' => 'H', '?' => 'W', '?' => 'I',
          '?' => 'Y',
          '?' => 'a', '?' => 'b', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'z', '?' => 'h', '?' => '8',
          '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => '3', '?' => 'o', '?' => 'p',
          '?' => 'r', '?' => 's', '?' => 't', '?' => 'y', '?' => 'f', '?' => 'x', '?' => 'ps', '?' => 'w',
          '?' => 'a', '?' => 'e', '?' => 'i', '?' => 'o', '?' => 'y', '?' => 'h', '?' => 'w', '?' => 's',
          '?' => 'i', '?' => 'y', '?' => 'y', '?' => 'i',
            // Turkish
          '?' => 'S', '?' => 'I', '�' => 'C', '�' => 'U', '�' => 'O', '?' => 'G',
          '?' => 's', '?' => 'i', '�' => 'c', '�' => 'u', '�' => 'o', '?' => 'g',
            // Russian
          '?' => 'A', '?' => 'B', '?' => 'V', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'Yo', '?' => 'Zh',
          '?' => 'Z', '?' => 'I', '?' => 'J', '?' => 'K', '?' => 'L', '?' => 'M', '?' => 'N', '?' => 'O',
          '?' => 'P', '?' => 'R', '?' => 'S', '?' => 'T', '?' => 'U', '?' => 'F', '?' => 'H', '?' => 'C',
          '?' => 'Ch', '?' => 'Sh', '?' => 'Sh', '?' => '', '?' => 'Y', '?' => '', '?' => 'E', '?' => 'Yu',
          '?' => 'Ya',
          '?' => 'a', '?' => 'b', '?' => 'v', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'yo', '?' => 'zh',
          '?' => 'z', '?' => 'i', '?' => 'j', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n', '?' => 'o',
          '?' => 'p', '?' => 'r', '?' => 's', '?' => 't', '?' => 'u', '?' => 'f', '?' => 'h', '?' => 'c',
          '?' => 'ch', '?' => 'sh', '?' => 'sh', '?' => '', '?' => 'y', '?' => '', '?' => 'e', '?' => 'yu',
          '?' => 'ya',
            // Ukrainian
          '?' => 'Ye', '?' => 'I', '?' => 'Yi', '?' => 'G',
          '?' => 'ye', '?' => 'i', '?' => 'yi', '?' => 'g',
            // Czech
          '?' => 'C', '?' => 'D', '?' => 'E', '?' => 'N', '?' => 'R', '�' => 'S', '?' => 'T', '?' => 'U',
          '�' => 'Z',
          '?' => 'c', '?' => 'd', '?' => 'e', '?' => 'n', '?' => 'r', '�' => 's', '?' => 't', '?' => 'u',
          '�' => 'z',
            // Polish
          '?' => 'A', '?' => 'C', '?' => 'e', '?' => 'L', '?' => 'N', '�' => 'o', '?' => 'S', '?' => 'Z',
          '?' => 'Z',
          '?' => 'a', '?' => 'c', '?' => 'e', '?' => 'l', '?' => 'n', '�' => 'o', '?' => 's', '?' => 'z',
          '?' => 'z',
            // Latvian
          '?' => 'A', '?' => 'C', '?' => 'E', '?' => 'G', '?' => 'i', '?' => 'k', '?' => 'L', '?' => 'N',
          '�' => 'S', '?' => 'u', '�' => 'Z',
          '?' => 'a', '?' => 'c', '?' => 'e', '?' => 'g', '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'n',
          '�' => 's', '?' => 'u', '�' => 'z',
        );

        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

        // Transliterate characters to ASCII
        if($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }

        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);

        $slug = $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;

        $result = DB::table($options['table'])
          ->where($options['field'], 'like', $slug . '%')
          ->get();

        // echo '<tt><pre>'; print_r($result); die;
        //dd(DB::getQueryLog());
        if(count($result)) {

            $slugs = array();
            $i     = 0;
            foreach ($result as $row) {
                $slugs[$i] = $options['lowercase'] ? mb_strtolower($row->$options['field'], 'UTF-8') : $row->$options['field'];
                $i++;
            }

            if(in_array($slug, $slugs)) {

                $max = 0;

                //keep incrementing $max until a space is found
                while (in_array(($slug . '-' . ++$max), $slugs))
                    ;

                //update $slug with the appendage
                $slug .= '-' . $max;
            }

            return $slug;
        } else {
            return $slug;
        }
    }
}
