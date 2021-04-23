<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 01-Dec-16 11:43 AM
 * File Name    : StoreGrn.php
 */

namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreGrn extends Model
{

    public function supplier() {
        return $this->belongsTo('Cartimatic\Store\StoreSupplier');
    }

    public function products() {
        return $this->hasMany('Cartimatic\Store\StoreGrnProduct', 'grn_id');
    }

    public function po() {
        return $this->hasOne('Cartimatic\Store\StorePurchaseOrder', 'id', 'object_value');
    }
}
