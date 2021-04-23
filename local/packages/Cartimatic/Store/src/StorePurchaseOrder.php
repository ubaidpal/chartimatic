<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 29-Nov-16 5:12 PM
 * File Name    : StorePurchaseOrder.php
 */

namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StorePurchaseOrder extends Model
{
    protected $table = 'store_purchase_orders';

    public function products() {
        return $this->hasMany('Cartimatic\Store\StorePurchaseOrderProducts', 'purchase_order_id');
    }


}
