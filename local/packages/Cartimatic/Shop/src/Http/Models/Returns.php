<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 23-Aug-16 4:15 PM
 * File Name    : DamageLost.php
 */

namespace Cartimatic\Shop\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    
    protected $table = 'store_returns';

    public function shop() {
        return $this->belongsTo('Cartimatic\Shop\Http\Models\Shop', 'shop_id');
    }

    public function product() {
        return $this->belongsTo('Cartimatic\Store\StoreProduct')->withTrashed()->withDrafts();
    }

    public function productLog() {
        return $this->hasOne('Cartimatic\Store\StoreProductKeepingLog', 'product_keeping_id','store_keeping_id' );
    }

    public function keeping() {
        return $this->belongsTo('Cartimatic\Store\StoreProductKeeping','store_keeping_id');
    }
}
