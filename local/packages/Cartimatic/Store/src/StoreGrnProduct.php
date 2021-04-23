<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 01-Dec-16 11:44 AM
 * File Name    : StoreGrnProduct.php
 */

namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreGrnProduct extends Model
{
    public function product() {
        return $this->belongsTo('Cartimatic\Store\StoreProduct', 'product_id');
    }

    public function productKeeping() {
        return $this->belongsTo('Cartimatic\Store\StoreProductKeeping','product_keeping_id');
    }
}
