<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProductKeeping extends Model
{
    use SoftDeletes;
    protected $table = 'store_products_keeping';
    protected $primaryKey = 'id';

    protected $fillable =  [''];

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

    public function product() {
        return $this->belongsTo('Cartimatic\Store\StoreProduct', 'product_id')->select(['id', 'owner_id', 'title']);
    }

    public function productDetail() {
        return $this->belongsTo('Cartimatic\Store\StoreProduct', 'product_id');
    }

    public function priceLog() {
        return $this->hasOne('Cartimatic\Store\StoreProductPriceLog','keeping_id');
    }
}
