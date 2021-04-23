<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 29-Nov-16 5:15 PM
 * File Name    : StorePurchaseOrderProducts.php
 */

namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StorePurchaseOrderProducts extends Model
{
    protected $table = "store_purchase_order_products";

    public function productDetail() {
        return $this->belongsTo('Cartimatic\Store\StoreProduct', 'product_id');
    }

    public function productKeeping() {
        return $this->belongsTo('Cartimatic\Store\StoreProductKeeping', 'product_keeping_id');
    }
}
