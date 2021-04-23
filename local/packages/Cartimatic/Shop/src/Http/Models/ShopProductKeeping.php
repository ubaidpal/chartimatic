<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 12-Aug-16 11:35 AM
 * File Name    : ShopProductKeeping.php
 */

namespace Cartimatic\Shop\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ShopProductKeeping extends Model
{

    protected $table = 'shop_products_keeping';

    public function product() {
        return $this->belongsTo('Cartimatic\Store\StoreProduct', 'product_id')->withTrashed()->withoutGlobalScope('IsDraftScope');
    }

    public function master1(){
        return $this->hasOne('Cartimatic\Admin\Http\StoreAttribute', 'id','master_attribute_1');
    }

    public function value1() {
        return $this->hasOne('Cartimatic\Admin\Http\StoreAttributeValue', 'id','master_attribute_1_value');
    }

    public function master2(){
        return $this->hasOne('Cartimatic\Admin\Http\StoreAttribute', 'id','master_attribute_2');
    }

    public function value2() {
        return $this->hasOne('Cartimatic\Admin\Http\StoreAttributeValue', 'id','master_attribute_2_value');
    }
    public function shop() {
        return $this->belongsTo('Cartimatic\Shop\Http\Models\Shop', 'shop_id');
    }


}
