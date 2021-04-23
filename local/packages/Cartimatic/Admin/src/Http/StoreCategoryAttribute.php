<?php

namespace Cartimatic\Admin\Http;

use Illuminate\Database\Eloquent\Model;

class StoreCategoryAttribute extends Model
{
    public function attributeValues() {
        return $this->hasMany('Cartimatic\Admin\Http\StoreAttributeValue', 'store_attribute_id','store_attribute_id');
    }

    public function attribute() {
        return $this->belongsTo('Cartimatic\Admin\Http\StoreAttribute','store_attribute_id');
    }
}
