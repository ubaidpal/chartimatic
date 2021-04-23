<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProductAttribute extends Model
{
    protected $table = 'store_product_attributes';
    protected $primaryKey = 'id';

    protected $fillable =  [''];

    public function defaults() {
        return $this->belongsTo('Cartimatic\Admin\Http\StoreCategoryAttribute','store_attribute_id','store_attribute_id')->where('is_default', 1);
    }
    public function attributeValues() {
        return $this->hasMany('Cartimatic\Admin\Http\StoreAttributeValue', 'store_attribute_id','store_attribute_id');
    }

    public function productAttribute() {
        return $this->hasMany('Cartimatic\Store\StoreProductAttributeValue', 'store_product_attribute_id','id');
    }




}
