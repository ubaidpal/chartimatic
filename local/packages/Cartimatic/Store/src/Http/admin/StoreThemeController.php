<?php
/**
 * Created by   :  Muhammad Abubakr
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 23-Sep-16 4:22 PM
 * File Name    : StoreThemeController.php
 */

namespace Cartimatic\Store\Http\admin;

use App\Classes\Kinnect2;
use App\Http\Controllers\Controller;
use App\Page;
use App\StoreContactUs;
use App\StoreTheme;
use App\StoreThemeOption;
use App\User;
use Cartimatic\Store\Category;
use Cartimatic\Store\StoreDomain;
use Cartimatic\Store\StoreProduct;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use App\StoreOption;
use Cartimatic\Store\Theme;
use phpDocumentor\Reflection\Types\String_;

class StoreThemeController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * DashboardController constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request) {
        parent::__construct();
        $this->request = $request;
        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
    }

    public function index() {
        $data['username'] = $this->user->username;
        $store_id = $this->user_id;

        $theme = StoreOption::where('key','like',\Config::get('constants_theme.STORE_SELECTED_THEME'))->where('store_id',$store_id)->first();
        $theme = StoreTheme::where('id',$theme->value)->first();

        $data['theme'] = $theme;

        $data['themes'] = StoreTheme::where('id','<>',@$theme->id)->get();

        return view('Store::admin.Theme.index', $data);
    }
    public function edit($store_id,$theme_id)
    {
        $data['username'] = $this->user->username ;
        $data['theme_id'] = $theme_id;
        $data['theme'] = StoreTheme::where('id',$theme_id)->first();
        $data['pages'] = Page::where('store_id',$this->user_id)->get();
        return view('Store::admin.Theme.edit', $data);
    }
    public function saveThemeOption($store_id,$theme_id)
    {
        if(!$this->isThemeOwner($store_id,$theme_id)) {
            return response()->json(['message' => 'you are not authorized to edit this theme']);
        }
        if(\Request::hasFile('options')) {
            $options = \Request::file('options');

            foreach ($options as $key => $value) {
                $this->uploadFile($theme_id,$key,$value,'image');
            }

        }else{
            $options = \Request::get('options');
            $type = \Request::get('type');
            foreach ($options as $key => $value) {
                if(!empty($type)){
                    $this->updateThemeOption($theme_id,$key,$value,$type);
                }else{
                    $this->updateThemeOption($theme_id,$key,$value);
                }
            }
        }
        return response()->json(['status' => 'option_saved']);
    }
    public function uploadFile($theme_id,$key,$value,$type) {
        $extension = \Request::file('options.'.$key)->getClientOriginalExtension();
        $image_name = $key.'-'.$theme_id.'-'.$this->user_id.'.'.$extension;
        if(file_exists(public_path().'/theme/images/'.$image_name))
        {
            unlink(public_path().'/theme/images/'.$image_name);
        }
        \Request::file('options.'.$key)->move(public_path().'/theme/images/',$image_name);
        $this->updateThemeOption($theme_id,$key,$image_name,$type);
    }
    public function isThemeOwner($store_id,$theme_id){

        return StoreTheme::where('id',$theme_id)->count();
    }
    public function updateThemeOption($theme_id,$key,$value,$type = 'css-rule',$parent_id = 0)
    {
        if(empty($theme_id) || empty($key)) {
            return false;
        }

        $option = StoreThemeOption::where('theme_id',$theme_id)->where('store_id',$this->user_id)->where('key',$key)->first();

        if(empty($option->id)){
            return $this->addThemeOption($theme_id,$key,$value,$type,$parent_id);
        }else {
            $option->value = $value;
            $option->save();

            return $option->id;
        }
    }
    public function addThemeOption($theme_id,$key,$value,$type,$parent_id = 0) {

        if(empty($theme_id) || empty($key)) {
            return false;
        }
        $order_no = null;
        if($key == 'menu' || $key == 'menu-name')
        {
            $order_no = StoreThemeOption::where('store_id',$this->user_id)->where('key',$key)->max('order_no');
            $order_no = $order_no + 1;
        }

        $stoObj = new StoreThemeOption();
        $stoObj->store_id = $this->user_id;
        $stoObj->theme_id = $theme_id;
        $stoObj->parent_id = $parent_id;
        $stoObj->key = $key;
        $stoObj->value = $value;
        $stoObj->type = $type;
        $stoObj->order_no = $order_no;
        $stoObj->save();

        return $stoObj->id;
    }
    public function updateThemeOptionByID($theme_id,$option_id,$value,$type = null,$key = null)
    {
        if(empty($theme_id) || empty($option_id)) {
            return false;
        }
        $option = StoreThemeOption::where('id',$option_id)->where('store_id',$this->user_id)->first();
        if(!empty($option->id))
        {
            $option->value = $value;
            if(!empty($type))
            {
                $option->type = $type;
            }
            if(!empty($key))
            {
                $option->key = $key;
            }
            $option->save();

            return $option->id;
        }
    }
    public function searchProduct($store_id) {

        $term = \Request::get('term');

        $products = StoreProduct::where('title','like',"$term%")
                            ->where('is_published',1)
                            ->where('owner_id',$this->user_id)
                            ->select(['id','title as label','title as value'])
                            ->get()->toArray();


        return response()->json($products);
    }
    public function addFeaturedProduct($store_id,$theme_id) {
        $data = [];

        $product_id = \Request::get('product_id');

        $this->addThemeOption($theme_id,'product-id',$product_id,'featured-product');

        $data['products'] = $this->renderFeaturedProducts();

        return response()->json($data);
    }
    public function removeFeaturedProduct($store_id,$theme_id) {
        $data = [];
        $option_id = \Request::get('option_id');
        $option = StoreThemeOption::where('id',$option_id)
                            ->where('theme_id',$theme_id)
                            ->where('key','like','product-id')
                            ->first();
        if(!empty($option->id)) {
            $option->delete();
            $data['success'] = 1;
            $data['products'] = $this->renderFeaturedProducts();
        }else{
            $data['success'] = 0;
        }
        return response()->json($data);
    }
    public function renderFeaturedProducts() {
        $view = \View::make('Store::admin.Theme.featured-products');
        $contents = $view->render();

        return (String)$contents;
    }
    public function saveThemeMenu($store_id,$theme_id)
    {
        if(!$this->isThemeOwner($store_id,$theme_id)) {
            return response()->json(['message' => 'you are not authorized to edit this theme']);
        }

        $option = \Request::get('menu');
        $type = \Request::get('type');
        $option_id = \Request::get('option_id');

        if(!empty($option_id)){
            $this->updateThemeOptionByID($theme_id,$option_id,$option);
        }else {
            $this->addThemeOption($theme_id, 'menu', $option, $type);
        }

        $data['status'] = 'option_saved';

        $data['menus'] = $this->renderMenuOptions();

        return response()->json($data);
    }
    public function saveMenu($store_id,$theme_id)
    {
        $menu = \Request::get('menu-name');
        $type = \Request::get('menu-type');
        $page = \Request::get('page');

        $option_id = $this->addThemeOption($theme_id,'menu-name',$menu,'top-nav');
        $this->addThemeOption($theme_id,'menu-type',$type,'top-nav-type',$option_id);

        if($type == 'page')
        {
            $this->addThemeOption($theme_id,'page-id',$page,'top-nav-item',$option_id);
        }

        $data['status'] = 'option_saved';

        $data['menus'] = $this->renderMenuOptions();

        return response()->json($data);
    }
    public function renderMenuOptions()
    {
        $view = \View::make('Store::admin.Theme.menus');
        $contents = $view->render();

        return (String)$contents;
    }
    public function removeMenu($store_id,$theme_id)
    {
        $data = [];
        $option_id = \Request::get('option_id');
        $option = StoreThemeOption::where('id',$option_id)
            ->where('store_id',$this->user_id)
            ->where('theme_id',$theme_id)
            ->where('key','like','menu')
            ->first();
        if(!empty($option->id)) {
            $option->delete();
            $data['success'] = 1;
            $data['menus'] = $this->renderMenuOptions();
        }else{
            $data['success'] = 0;
        }
        return response()->json($data);
    }
    public function searchProductCategory()
    {
        $term = \Request::get('term');
        $categories = Category::where('name','like',"$term%")
                                ->where('category_parent_id',0)
                                ->select(['id','name as label','name as value'])
                                ->get()
                                ->toArray();
        return response()->json($categories);
    }
    public function addNavigationItem($store_id,$theme_id)
    {
        $category_id = \Request::get('category_id');
        $option_id = \Request::get('option_id');
        $this->addThemeOption($theme_id,'category-id',$category_id,'top-nav-item',$option_id);

        $data['menus'] = $this->renderMenuOptions();

        return response()->json($data);
    }
    public function getPages($store_name)
    {
        $data = ['store_name' => $store_name];
        $pages = Page::where('store_id',$this->user_id)->get();
        $data['pages'] = $pages;
        return view('Store::admin.Theme.pages', $data);
    }
    public function addPage($store_name,$page_id = null)
    {
        $data = ['store_name' => $store_name];

        $page = Page::where('id',$page_id)->first();

        $data['page'] = $page;

        return view('Store::admin.Theme.add-page', $data);
    }
    public function storePage($store_name,$page_id = null)
    {
        $title = \Request::get('title');
        $content = \Request::get('content');

        if(!empty($page_id)) {
            $page = Page::where('id',$page_id)->first();
        }else{
            $page = new Page();
        }

        $page->title = $title;
        $page->content = $content;
        $page->store_id = $this->user_id;

        $page->save();

        return redirect()->to('store/'.$store_name.'/admin/pages');
    }
    public function removePage($store_name,$page_id)
    {

        $page = Page::where('id',$page_id)->first();

        if($page->store_id == $this->user_id) {
            $page->delete();
        }

        return redirect()->to('store/'.$store_name.'/admin/pages');
    }
    public function removeFooterNav($store_name,$theme_id)
    {
        $data = [];
        $option_id = \Request::get('option_id');
        $option = StoreThemeOption::where('id',$option_id)
            ->where('store_id',$this->user_id)
            ->where('theme_id',$theme_id)
            ->where('key','like','footer-nav-name')
            ->first();
        if(!empty($option->id)) {
            $option->delete();
            $data['success'] = 1;
            $data['nav'] = $this->renderFooterNav();
        }else{
            $data['success'] = 0;
        }
        return response()->json($data);
    }
    public function renderFooterNav()
    {
        $view = \View::make('Store::admin.Theme.nav');
        $contents = $view->render();

        return (String)$contents;
    }
    public function saveFooterOption($store_name,$theme_id)
    {
        if(!$this->isThemeOwner($store_name,$theme_id)) {
            return response()->json(['message' => 'you are not authorized to edit this theme']);
        }

        $option = \Request::get('name');
        $type = \Request::get('type');

        $this->addThemeOption($theme_id,'footer-nav-name',$option,$type);

        $data['status'] = 'option_saved';

        $data['nav'] = $this->renderFooterNav();

        return response()->json($data);
    }
    public function addFooterNavItem($store_name,$theme_id)
    {
        $name = \Request::get('name');
        $option = \Request::get('option');
        $page = \Request::get('page');
        $link = \Request::get('link');
        $option_id = \Request::get('option_id');
        $item_id = \Request::get('item_id');

        if(empty($item_id)) {
            $parent_id = $this->addThemeOption($theme_id, 'footer-nav-item-name', $name, 'text', $option_id);
            if ($option == 'page') {
                $this->addThemeOption($theme_id, $option, $page, 'page-id', $parent_id);
            } elseif ($option == 'link') {
                $this->addThemeOption($theme_id, $option, $link, 'link', $parent_id);
            }
        }else{
            $this->updateThemeOptionByID($theme_id, $item_id,$name);
            if($option == 'page') {
                $this->updateThemeOptionByID($theme_id,$option_id, $page,'page-id',$option);
            }else{
                $this->updateThemeOptionByID($theme_id, $option_id, $link,'link',$option);
            }
        }
        $data['nav'] = $this->renderFooterNav();
        return response()->json($data);

    }
    public function editFooterNavItem($store_name,$theme_id)
    {
        $option_id = \Request::get('option_id');
        $name = \Request::get('name');

        $this->updateThemeOptionByID($theme_id,$option_id,$name);

        $data['nav'] = $this->renderFooterNav();
        return response()->json($data);
    }
    public function removeMenuItem($store_id,$theme_id)
    {
        $option_id = \Request::get('option_id');

        if(!$this->isThemeOwner($store_id,$theme_id))
        {
            return response()->json(['message' => 'you are not authorized to edit this theme']);
        }

        $option = StoreThemeOption::where('id',$option_id)->where('store_id',$this->user_id)->where('theme_id',$theme_id)->first();
        if(!empty($option->id))
        {
            $option->delete();
        }
        $data = ['message' => 'option_deleted'];
        $data['menus'] = $this->renderMenuOptions();

        return response()->json();
    }
    public function renderHeaderPanel()
    {
        $view = \View::make('Store::admin.Theme.header-panel');
        $contents = $view->render();

        return (String)$contents;
    }
    public function getHeader(){

        $data['header'] = $this->renderHeaderPanel();

        return response()->json($data);
    }
    public function getThemeOption($store_id,$theme_id)
    {
        $key = \Request::get('key');
        $default = \Request::get('default');
        $return = \Request::get('return');
        $return = !empty($return) ? true : false;
        return get_theme_option($theme_id,$key,$default,$return);
    }
    public function getThemeOptionByID($store_id,$option_id)
    {
        $option = StoreThemeOption::where('id',$option_id)->first();

        return response()->json(['option' => $option]);
    }
    public function setAsDefault($store_id,$theme_id)
    {
        $theme = StoreTheme::where('id',$theme_id)->first();

        if(!empty($theme->id))
        {
            $option = StoreOption::where('store_id', $this->user_id)->where('key', 'like', \Config::get('constants_theme.STORE_SELECTED_THEME'))->first();
            if(!empty($option->id))
            {
                $option->value = $theme->id;
                $option->save();
            }else{
                $storeOptionObj = new StoreOption();
                $storeOptionObj->store_id = $this->user_id;
                $storeOptionObj->key = \Config::get('constants_theme.STORE_SELECTED_THEME');
                $storeOptionObj->value = $this->user_id;
                $storeOptionObj->save();
            }

        }
        return redirect()->back();
    }
    public function reOrderMenu($store_id,$theme_id)
    {
        $items = \Request::get('item');
        if(!empty($items))
        {
            foreach ($items as $index => $option_id)
            {
                $option = StoreThemeOption::where('id',$option_id)->where('store_id',$this->user_id)->first();

                $option->order_no = $index;

                $option->save();
            }
        }
    }
    public function removeFooterNavItem($store_id,$theme_id)
    {
        $option_id = \Request::get('option_id');

        $option = StoreThemeOption::where('id',$option_id)->where('store_id',$this->user_id)->first();

        if(!empty($option->id))
        {
            $option->delete();

            $data['success'] = 1;
            $data['nav'] = $this->renderFooterNav();
        }else{
            $data['success'] = 0;
        }

        return response()->json($data);
    }
    public function addCustomSectionProduct($store_id,$theme_id)
    {
        $data = [];

        $product_id = \Request::get('product_id');

        $this->addThemeOption($theme_id,'custom-section-product-id',$product_id,'custom-section-product');

        $data['products'] = $this->renderCustomSectionProducts();

        return response()->json($data);
    }

    public function renderCustomSectionProducts()
    {
        $view = \View::make('Store::admin.Theme.custom-section-products');
        $contents = $view->render();

        return (String)$contents;
    }
    public function domains($store_id)
    {
        $domain = StoreDomain::where('store_id',$this->user_id)->first();
        $data['store_id'] = $store_id;
        $data['domain'] = $domain;
        return view('Store::admin.Theme.domains',$data);
    }
    public function addDomain($store_id)
    {
        $name = \Request::get('name');
        $domain_id = \Request::get('domain-id');
        $validator = \Validator::make([
            'name' => $name
        ],[
            'name' => 'required|unique:store_domains,name,'.$domain_id
        ]);

        if($validator->fails())
        {
            if(\Request::ajax()){
                return response()->json($validator->messages());
            }else {
                return redirect()->back()->withErrors($validator->messages());
            }
        }

        if(!empty($domain_id)) {

            $domain = StoreDomain::where('id',$domain_id)->where('store_id',$this->user_id)->first();
            $domain->name = $name;
            $domain->save();

        }else{
            $storeDoamin = new StoreDomain();

            $storeDoamin->name = $name;
            $storeDoamin->store_id = $this->user_id;
            $storeDoamin->save();
        }
        if(\Request::ajax())
        {
            $data['success'] = 1;
            return response()->json($data);
        }else {
            return redirect()->back();
        }
    }
    public function removeDomain($store_id,$domain_id)
    {
        $domain = StoreDomain::where('id',$domain_id)->where('store_id',$this->user_id)->first();

        if(!empty($domain->id))
        {
            $domain->delete();
        }
        return redirect()->back();
    }
    public function showContactUsData($store_id)
    {
        $pages = StoreContactUs::where('store_id',$this->user_id)->where('is_deleted',0)->paginate();
        $data['pages'] = $pages;
        $data['store_id'] = $store_id;
        return view('Store::admin.Theme.contact-us-data',$data);
    }
    public function getMessage($store_id,$message_id)
    {
        $message = StoreContactUs::where('store_id',$this->user_id)->where('id',$message_id)->first();
        $data['message'] = $message;
        $view = \View::make('Store::admin.Theme.message',$data);
        $contents = $view->render();
        return $contents;
    }
    public function removeMessage($store_id,$message_id)
    {
        $message = StoreContactUs::where('store_id',$this->user_id)->where('id',$message_id)->first();

        if(!empty($message->id))
        {
            $message->is_deleted = 1;
            $message->save();
        }
        return redirect()->back();
    }
    public function enableStore($store_id)
    {
        $data['store_id'] = $store_id;
        $key = \Config::get('constants_theme.STORE_URL');

        $db_name = StoreOption::where('store_id',$this->user_id)->where('key',$key)->first();
        $data['db_name'] = $db_name;
        if($this->user->registered_via == 'marketplace' && !empty($this->user->store_enabled))
        {
            return redirect()->to('store/'.$store_id.'/admin/theme');
        }

        return view('Store::admin.Theme.store-enable',$data);
    }
    public function postStoreEnable($store_id)
    {
        $store_name = \Request::get('store_name');

        if(!empty($store_name)) {

            $store_name = \Kinnect2::formatStoreName($store_name);

            $validator = \Validator::make([
                'store_name' => $store_name
            ], [
                'store_name' => \Kinnect2::getStoreNameValidationRule()
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $key = \Config::get('constants_theme.STORE_URL');
            \Kinnect2::saveStoreOption($this->user_id,$key,$store_name);
        }

        \Kinnect2::saveDefaultTheme($this->user_id);

        $user = User::where('id',$this->user_id)->first();

        if(!empty($user->id)) {
            $user->store_enabled = 1;
            $user->save();
        }

        return redirect()->to('store/'.$store_id.'/admin/theme');
    }
    public function checkStoreName()
    {
        $store_name = \Request::get('store_name');

        $store_name = \Kinnect2::formatStoreName($store_name);

        $validator = \Validator::make([
            'store_name' => $store_name
        ],[
            'store_name' => \Kinnect2::getStoreNameValidationRule()
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors()->first('store_name'));
        }
        return response()->json('true');
    }
}