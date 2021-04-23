<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/16/2015
 * Time: 6:27 PM
 */

namespace App\Repository\Eloquent;
use App;

use App\Classes\UrlFilter;
//use App\StorageFile;
use App\User;
use Auth;
use Cartimatic\Admin\Http\StoreAttribute;
use Cartimatic\Admin\Http\StoreAttributeValue;
use Cartimatic\Store\Category;
use Cartimatic\Store\StoreCategoryAttribute;
use Cartimatic\Store\StoreProduct;
use Cartimatic\Store\StoreProductAttribute;
use Cartimatic\Store\StoreProductAttributeValue;
use Cartimatic\Store\StoreProductCategoryAttribute;
use Cartimatic\Store\StoreProductImage;
use Cartimatic\Store\StoreProductReview;
use DB;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CategoryRepository extends Repository
{
    protected $data;
    protected $user_id;
    protected $is_api;

    public function __construct()
    {
        parent::__construct();
        $this->is_api = UrlFilter::filter();
    }

    public function getCategoryBySlug($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();

        if(isset($category->id)){
            return $category;
        }

        return false;
    }

    public function getCategoryById($categoryId)
    {
        $category = Category::where('id', $categoryId)->first();

        if(isset($category->id)){
            return $category;
        }

        return false;
    }

    public function getSubCategoriesArrayById($categoryId)
    {
        $subCategories = Category::select('id', 'slug', 'name')
          ->where('category_parent_id', $categoryId)
          ->get();
        return $subCategories;
    }

    public function getSubCategoriesArrayByIdForAPI($categoryId)
    {
        $subCategories = Category::select('id', 'category_image AS photo', 'name AS title')
            ->where('category_parent_id', $categoryId)
            ->get();
        return $subCategories;
    }

    public function getSubCategories($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();

        if(isset($category->id)){
            return $subCategories = Category::select('id', 'slug', 'name')
              ->where('category_parent_id', $category->id)
              ->get();
        }

        return false;
    }

    public function featuredCategories($category)
    {

        $category = Category::where('slug', $category)->first();

        if(isset($category->id)){
            $category_id = $category->id;
            if($category->category_parent_id != 0){
                $breadCrumbsCats = getBreadCrumbsBySubCategoryId($category->id);
                $breadCrumbsCats = array_reverse($breadCrumbsCats);
                $category_id = $breadCrumbsCats[0]['id'];
            }


            return $subCategories = Category::select('id', 'slug', 'name')
              ->where('category_parent_id', $category_id)
              ->orderByRaw("RAND()")
              ->paginate(25);
        }

        return false;
    }

    public function getSubCategoriesIds($category)
    {
        $category = Category::where('slug', $category)->first();

        if(isset($category->id)){
            return $subCategories = Category::select('id', 'slug', 'name')
              ->where('category_parent_id', $category->id)
              ->lists('id');
        }

        return false;
    }
    public function getCategories()
    {
        return $categories = Category::where('category_parent_id', 0 )->get();

    }

    public function getCategoriesHavingProducts()
    {
        $categories = Category::where('category_parent_id', 0 )->get();
        $onlyCatsHavingProduct = [];

        foreach($categories as $category){
            $productCount = superParentHasProducts($category->id);

            if($productCount > 0){
                $onlyCatsHavingProduct[] = $category;
            }
        }

        return $onlyCatsHavingProduct;
    }

    public function getCategoriesList()
    {
        $categories = Category::select('id', 'name as title', 'category_icon_url as photo')->where('category_parent_id', 0 )->get();

        foreach($categories as $category){
            if(isset($category->photo)){
                $category->photo = url('local/public/assets/categories-icon').'/'.$category->photo;
            }
        }

        return $categories;
    }

    public function isLeafCategory($category_id = 0){
        return $isCategory = Category::where('category_parent_id', $category_id)
          ->count();
    }

    public function topSellersProducts()
    {
        return $allProductRecords = StoreProduct::
        select( 'store_products.id', 'store_products.category_id', 'store_products.title', 'store_products.owner_id', 'sk.discount', 'store_products.description', 'store_products.created_at','sk.price', 'sk.product_id')

          ->join( 'store_products_keeping as sk', 'sk.product_id', '=', 'store_products.id' )
          ->orderBy( 'sold', 'DESC')
          ->where( 'store_products.is_published', 1)
          ->groupBy('store_products.id')
          ->take(25)->get();
    }

    public function newArrivalsProductsCategories($topSellersProducts=null)
    {
        if($topSellersProducts!=null){
            $topSellersProducts = $topSellersProducts->toArray();
            $productCatIds = array_column($topSellersProducts, 'category_id');
            //$productCats = Category::whereIn('id', $productCatIds)->lists('name', 'id');
            $category = ['0' => 'All Categories'];
            $categoryList   = DB::table('store_product_categories')->whereIn('id', $productCatIds)->lists('name', 'id');
            $productCats   = $category + $categoryList;

            return $productCats;
        }
    }

    public function topSellersProductsCategories($topSellersProducts=null)
    {
        if($topSellersProducts!=null){
            $topSellersProducts = $topSellersProducts->toArray();
            $productCatIds = array_column($topSellersProducts, 'category_id');
            $category = ['0' => 'All Categories'];
            $categoryList   = DB::table('store_product_categories')->whereIn('id', $productCatIds)->lists('name', 'id');
            $productCats   = $category + $categoryList;
            //$productCats = Category::whereIn('id', $productCatIds)->lists('name', 'id');

            return $productCats;
        }
    }

    public function newArrivalsProducts()
    {
        return $allProductRecords = StoreProduct::
        select( 'store_products.id', 'store_products.category_id', 'store_products.title', 'store_products.owner_id', 'sk.discount', 'store_products.description', 'store_products.created_at','sk.price', 'sk.product_id')

          ->join( 'store_products_keeping as sk', 'sk.product_id', '=', 'store_products.id' )
          ->orderBy( 'id', 'DESC')
          ->where( 'store_products.is_published', 1)
          ->groupBy('store_products.id')
          ->take(25)->get();
    }

    public function allProduct($category_id, $sorting = '', $sortingOrder = 'DESC', $perPage = 2, $search_term='',$store_id = null) {
        $productCategoryIds = Category::where('category_parent_id', $category_id)->lists('id');

        if( count($productCategoryIds) < 1){
            $productCategoryIds = [$category_id];
        }

        $allProductRecords = StoreProduct::
        select( 'store_products.id','store_products.owner_id', 'store_products.title', 'store_products.owner_id', 'sk.discount', 'store_products.description', 'store_products.created_at','sk.price', 'sk.product_id')

          ->join( 'store_products_keeping as sk', 'sk.product_id', '=', 'store_products.id' );

        $allProductRecords->whereIn( 'store_products.category_id', $productCategoryIds );

        if($search_term != ''){
            $allProductRecords->where( 'store_products.title', 'LIKE', "%".$search_term."%" );
        }

        if(!empty($store_id))
        {
            $allProductRecords->where('owner_id',$store_id);
        }

       return $allProductRecords
          ->orderBy( $sorting, $sortingOrder )
         ->where( 'store_products.is_published', 1)
         ->groupBy('store_products.id')
          ->paginate($perPage);
    }

    public function allProductArray($category_id, $sorting = '', $sortingOrder = 'DESC', $perPage = 2, $search_term='') {
        $productCategoryIds = Category::where('category_parent_id', $category_id)->lists('id');

        if( count($productCategoryIds) < 1){
            $productCategoryIds = [$category_id];
        }

        $allProductRecords = StoreProduct::
        select( 'store_products.id', 'store_products.title', 'store_products.owner_id', 'store_products.discount', 'store_products.description', 'store_products.created_at','store_products_keeping.price', 'store_products_keeping.product_id')

          ->join( 'store_products_keeping', 'store_products_keeping.product_id', '=', 'store_products.id' );

        $allProductRecords->whereIn( 'store_products.category_id', $productCategoryIds );

        if($search_term != ''){
            $allProductRecords->where( 'store_products.title', 'LIKE', "%".$search_term."%" );
        }

        $allProductRecords = $allProductRecords
          ->whereNull('store_products.deleted_at')
          ->orderBy( $sorting, $sortingOrder )
          ->groupBy('store_products.id')
          ->get();

        foreach($allProductRecords as $allProductRecord){
            $imagesOfProduct = StoreProductImage::where("product_id", $allProductRecord->product_id)->get();

            foreach($imagesOfProduct as $item){
                if(isset($item->id)){
                    $item->image_path = url('local/storage/app').'/'.$item->image_path;
                }
            }

            $allProductRecord->images = $imagesOfProduct->toArray();
            $allProductRecord->reviews = StoreProductReview::where("product_id", $allProductRecord->product_id)->get()->toArray();

            $brandInfo = getBrandInfo($allProductRecord->owner_id);

            if(isset($brandInfo->displayname)){
                $allProductRecord->brandInfo = ['brand_profile_link' => url('store/').'/'.$brandInfo->username, 'displayname' => $brandInfo->displayname, 'username' => $brandInfo->username];
            }


        }

        return $allProductRecords->toArray();
    }


    public function allFilteredProducts($filteredIds, $sorting = 'id', $sortingOrder = 'DESC', $perPage = 2, $category_id = null) {
        $onlyIds = [];
        foreach($filteredIds as $filteredId){
            $onlyId = explode('-', $filteredId);
            array_push($onlyIds, $onlyId[1]);
        }
//if second last category
        $isSecondLast = isLeafCategory($category_id);
        if($isSecondLast > 0){
            $productsCategoryIds = Category::where('category_parent_id', $category_id)->lists('id');
        }else{
            $productsCategoryIds = [$category_id];
        }
        $storeProductAttributeIds = StoreProductAttributeValue::whereIn('store_attribute_value_id', $onlyIds)->lists('store_product_attribute_id');
        $productIds = StoreProductAttribute::whereIn('id', $storeProductAttributeIds)->groupBy('product_id')->lists('product_id');

        return $allProductRecords = StoreProduct::
        select( 'store_products_keeping.id as sk_id','store_products.id', 'store_products.title', 'store_products.owner_id', 'store_products_keeping.discount', 'store_products.description', 'store_products.created_at','store_products_keeping.price', 'store_products_keeping.product_id')
          ->join( 'store_products_keeping', 'store_products_keeping.product_id', '=', 'store_products.id' )
          ->whereIn('store_products.id', $productIds)
            ->whereIn( 'store_products.category_id', $productsCategoryIds)
            ->where( 'store_products.is_published', 1)
          ->groupBy( 'store_products.id')
            ->orderBy( $sorting, $sortingOrder )
            ->paginate( $perPage );
    }

    public function categoryAttributes($category_id, $sorting = 'id', $sortingOrder = 'DESC', $perPage = 2) {
        $productCategoryIds = Category::where('category_parent_id', $category_id)->lists('id');

        if( count($productCategoryIds) < 1){
            $productCategoryIds = [$category_id];
        }

        $storeCategoryAttributeIds = StoreCategoryAttribute::whereIn('category_id', $productCategoryIds)->lists('store_attribute_id');
        $data['storeAttributes'] = StoreAttribute::whereIn('id', $storeCategoryAttributeIds)->get();
        $data['storeAttributeValues'] = StoreAttributeValue::whereIn('store_attribute_id', $storeCategoryAttributeIds)->get();

        return $data;
    }

    public function newArrivalsArray() {

        $allProductRecords = StoreProduct::
        select( 'store_products.id', 'store_products.title', 'store_products.owner_id', 'store_products.discount', 'store_products.description', 'store_products.created_at','store_products_keeping.price', 'store_products_keeping.product_id')

          ->join( 'store_products_keeping', 'store_products_keeping.product_id', '=', 'store_products.id' );

        $allProductRecords = $allProductRecords
          ->whereNull('store_products.deleted_at')
          ->where('store_products.category_id', '!=', 0)
          ->where( 'store_products.is_published', 1)
          ->where('store_products.title', '!=', '')
          ->orderBy('id', 'DESC')
          ->get();

        foreach($allProductRecords as $allProductRecord){
            $imagesOfProduct = StoreProductImage::where("product_id", $allProductRecord->product_id)->get();

            foreach($imagesOfProduct as $item){
                if(isset($item->id)){
                    $item->image_path = url('local/storage/app').'/'.$item->image_path;
                }
            }

            $allProductRecord->images = $imagesOfProduct->toArray();
            $allProductRecord->reviews = StoreProductReview::where("product_id", $allProductRecord->product_id)->get()->toArray();

            $brandInfo = getBrandInfo($allProductRecord->owner_id);

            if(isset($brandInfo->displayname)){
                $allProductRecord->brandInfo = ['brand_profile_link' => url('store/').'/'.$brandInfo->username, 'displayname' => $brandInfo->displayname, 'username' => $brandInfo->username];
            }
        }

        return $allProductRecords->toArray();
    }

    public function bestSellersArray() {

        $allProductRecords = StoreProduct::
        select( 'store_products.id', 'store_products.title', 'store_products.owner_id', 'store_products.discount', 'store_products.description', 'store_products.created_at','store_products_keeping.price', 'store_products_keeping.product_id')

          ->join( 'store_products_keeping', 'store_products_keeping.product_id', '=', 'store_products.id' );

        $allProductRecords = $allProductRecords
          ->whereNull('store_products.deleted_at')
          ->where('store_products.category_id', '!=', 0)
          ->where('store_products.title', '!=', '')
          ->orderBy('sold', 'DESC')
          ->where( 'store_products.is_published', 1)
          ->get();

        foreach($allProductRecords as $allProductRecord){
            $imagesOfProduct = StoreProductImage::where("product_id", $allProductRecord->product_id)->get();

            foreach($imagesOfProduct as $item){
                if(isset($item->id)){
                    $item->image_path = url('local/storage/app').'/'.$item->image_path;
                }
            }

            $allProductRecord->images = $imagesOfProduct->toArray();
            $allProductRecord->reviews = StoreProductReview::where("product_id", $allProductRecord->product_id)->get()->toArray();

            $brandInfo = getBrandInfo($allProductRecord->owner_id);

            if(isset($brandInfo->displayname)){
                $allProductRecord->brandInfo = ['brand_profile_link' => url('store/').'/'.$brandInfo->username, 'displayname' => $brandInfo->displayname, 'username' => $brandInfo->username];
            }
        }

        return $allProductRecords->toArray();
    }
}
