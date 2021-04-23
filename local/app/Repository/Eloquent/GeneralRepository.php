<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 05-May-16 6:17 PM
 * File Name    : GeneralRepository.php
 */

namespace App\Repository\Eloquent;

use Cartimatic\Admin\Http\Banner;
use Cartimatic\Store\StoreProduct;

class GeneralRepository extends Repository
{
    public function getCategoryBlocks() {
        return Banner::whereNotNull('category_id')->where('status',1)->with('items')->with('categories.childCategories')->orderBy('sort_order', 'ASC')->get();
    }

    public function getSlider() {
        return Banner::where('banner_type', \Config::get('admin_constants.BANNER_TYPES.BANNER_SLIDER'))->orderBy('sort_order', 'ASC')->get();
    }

    public function bestSellingProducts()
    {
        return StoreProduct::
        select('store_products.*')
          ->where('store_products.sold', '>', 0)
          ->whereNull('store_products.deleted_at')
          ->where('store_products.category_id', '!=', 0)
          ->where('store_products.title', '!=', '')
          ->orderBy('store_products.sold', 'DESC')
          ->join('store_products_keeping', 'store_products.id', '=', 'store_products_keeping.product_id')
          ->take(8)->get();
    }
}
