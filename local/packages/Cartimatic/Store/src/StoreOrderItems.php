<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreOrderItems extends Model
{
    protected $table = 'store_order_items';
    protected $primaryKey = 'id';
    protected $fillable =  [''];

    public function StoreProductKeeping() {
        return $this->belongsTo('Cartimatic\Store\StoreProductKeeping','product_keeping_id');
    }
}
