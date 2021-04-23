<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProductAttributeValue extends Model
{
    protected $table = 'store_product_attribute_values';
    protected $primaryKey = 'id';

    protected $fillable =  [''];

    public function attributeValues() {
        return $this->hasOne('Cartimatic\Admin\Http\StoreAttributeValue', 'id','store_attribute_value_id');
    }
}
