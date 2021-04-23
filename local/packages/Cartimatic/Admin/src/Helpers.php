<?php
use Cartimatic\Store\Category;

/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 03-May-16 10:40 AM
 * File Name    : Helpers.php
 */
function getCategoryName($id) {
    $category = DB::table('store_product_categories')->where('id', $id)->first(['name']);
	if(!$category){
		return "CategoryNotFound";
	}
    return $category->name;
}

function getCategoryId($id) {
    return $category = DB::table('store_product_categories')->where('id', $id)->first();
}

function getImage($imagePath,$type =  NULL) {

    if(empty($imagePath) || is_null($imagePath)) {
        return asset('local/public/assets/images/cartimatic/product-large-image.jpg');
    } else {
        return url($imagePath);
    }
}

function getSubCategories($parent_category_id) {
    return \Cartimatic\Store\Category::where('category_parent_id', $parent_category_id)->get();
}

function getSubCategoriesIds($parent_category_id) {
    return \Cartimatic\Store\Category::where('category_parent_id', $parent_category_id)->lists('id');
}

function countCategoryProducts($category_id) {
    return \Cartimatic\Store\StoreProduct::where('sub_category_id', $category_id)->count();
}

//Start Child to till parent
function getBreadCrumbsBySubCategoryId($child = 0, $category_tree_array = '') {
    if(!is_array($category_tree_array))
        $category_tree_array = array();

    $resCategories = getParentChildCategories($child);

    if(count($resCategories) > 0) {
        foreach ($resCategories as $rowCategory) {
            $category_tree_array[] = array("id" => $rowCategory[ 'id' ], "name" => $rowCategory[ 'name' ], "category_image" => $rowCategory[ 'category_image' ], "slug" => $rowCategory[ 'slug' ]);
            $category_tree_array   = getBreadCrumbsBySubCategoryId($rowCategory[ 'category_parent_id' ], $category_tree_array);
        }
    }

    return $category_tree_array;
}

function getParentChildCategories($child) {
    return $sub_categories = Category::select('id', 'name', 'category_image', 'slug', 'category_parent_id')
                                     ->where('id', $child)
                                     ->orderBy('id', 'ASC')
                                     ->get();
}

//Child to till parent end


function getSubCategoryIds($parent = 0, $category_tree_array = '') {
    if(!is_array($category_tree_array))
        $category_tree_array = array();

    $resCategories = getSubChildCategories($parent);

    if(count($resCategories) > 0) {
        foreach ($resCategories as $rowCategory) {
            $category_tree_array[] = array("id" => $rowCategory[ 'id' ]);
            $category_tree_array   = getSubCategoryIds($rowCategory[ 'id' ], $category_tree_array);
        }
    }

    return $category_tree_array;
}

function getSubChildCategories($parent) {
    return $sub_categories = Category::select('id', 'category_parent_id')
                                     ->where('category_parent_id', $parent)
                                     ->orderBy('id', 'ASC')
                                     ->get();
}
function itemBannerCount($id) {
    return \Cartimatic\Admin\Http\Banner::where('banner_type', config('admin_constants.BANNER_TYPES.ITEM'))
                                        ->whereNotNull('banner_path')
                                        ->where('parent_id', $id)
                                        ->count();
    
}
function getRandomImageOfProduct($product_id = 0){
    if($product_id > 0){
        $imagePath = \Cartimatic\Store\StoreProductImage::select('image_path')->where('product_id', $product_id)->first();
        if(isset($imagePath->image_path)){
            return url($imagePath->image_path);
        }

        return url('local/public/assets/bootstrap/images/products-images/product-images-1.jpg');
    }
}

function getAllImagesOfProduct($product_id = 0){
    if($product_id > 0){
        $images = \Cartimatic\Store\StoreProductImage::select('image_path')->where('product_id', $product_id)->get();
        $paths = [];
        $count = 0;
        foreach($images as $img){
            $paths[$count++] = url($img->image_path);
        }
        return $paths;
//        if(isset($imagePath->image_path)){
//            return url($imagePath->image_path);
//        }
//
//        return url('local/public/assets/bootstrap/images/products-images/product-images-1.jpg');
    }
}

function getRandomImageOfProductBycatId($category_id=0){
    if(isLeafCategory($category_id) > 0){
        $childCatIds = Category::where('category_parent_id', $category_id)
          ->lists('id');

        if(count($childCatIds) > 0){
            $product = \Cartimatic\Store\StoreProduct::select('id')->whereNull('deleted_at')->whereIn('category_id', $childCatIds)->orderBy(DB::raw('RAND()'))->take(1)->first();
        }

        if(isset($product->id)){
            $imagePath = \Cartimatic\Store\StoreProductImage::select('image_path')->where('product_id', $product->id)->first();
            if(isset($imagePath->image_path)){
                return url($imagePath->image_path);
            }
        }
    }

    $product = \Cartimatic\Store\StoreProduct::select('id')->where('category_id', $category_id)->orderBy(DB::raw('RAND()'))->take(1)->first();

    if(isset($product->id)){
        $imagePath = \Cartimatic\Store\StoreProductImage::select('image_path')->where('product_id', $product->id)->first();
        if(isset($imagePath->image_path)){
            return url($imagePath->image_path);
        }
    }
    return url('local/storage/app/product-images/default.jpg');
}

function isLeafCategory($category_id = 0){
    return $isCategory = Category::where('category_parent_id', $category_id)
      ->count();
}

function hasProducts($subCategoryItemId,$store_id = null){
    $query = \Cartimatic\Store\StoreProduct::whereNull('store_products.deleted_at')
      ->where('category_id', $subCategoryItemId)
      ->where('is_published', 1)
      ->whereNull('users.deleted_at')
      ->join('users', 'store_products.owner_id', '=', 'users.id');

    if(!empty($store_id))
    {
        $query->where('owner_id',$store_id);
    }
    $product_ids = $query->lists('store_products.id');
    $result = \Cartimatic\Store\StoreProductKeeping::select('id')->whereIn('product_id', $product_ids)->groupBy('product_id')->get()->toArray();

    return count($result);
}

function parentHasProducts($subCategoryItemId,$store_id = null){

     $childCatIds= Category::where('category_parent_id', $subCategoryItemId)
      ->lists('id');
    $query = \Cartimatic\Store\StoreProduct::whereIn('category_id', $childCatIds)
      ->whereNull('store_products.deleted_at')
      ->whereNull('users.deleted_at')
      ->where('is_published', 1)
      ->join('users', 'store_products.owner_id', '=', 'users.id');

    if(!empty($store_id))
    {
        $query->where('owner_id',$store_id);
    }

    $product_ids = $query->lists('store_products.id');

    $result = \Cartimatic\Store\StoreProductKeeping::select('id')->whereIn('product_id', $product_ids)->groupBy('product_id')->get()->toArray();
    return count($result);
}

function superParentHasProducts($superParentId){
     //To get all ids of super parent child's to check if they have products in them.
    $breadCrumbsCats = getSubCategoryIds($superParentId);
    return \Cartimatic\Store\StoreProduct::select('id')->whereNull('deleted_at')->whereIn('category_id', $breadCrumbsCats)->count();
}

function getMinimumProductPrice($productId = 0){
    $price = \Cartimatic\Store\StoreProductKeeping::select('price')->whereNull('deleted_at')->where('product_id', $productId)->orderBy('price', 'asc')->first();
    if(isset($price->price)){
        return $price->price;
    }

}

function getProductReviews($product_id = 0){
    return \Cartimatic\Store\StoreProductReview::select('rating', 'description', 'owner_id', 'product_id')
      ->where('product_id', $product_id)
      ->get();
}

function getProductReviewInfo($product_id = 0){
    return \Cartimatic\Store\StoreProductReview::select('rating', DB::raw('count(rating) as count_review'))->where('product_id', $product_id)->first();
}


