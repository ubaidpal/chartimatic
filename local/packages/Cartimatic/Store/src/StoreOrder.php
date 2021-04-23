<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreOrder extends Model
{
    protected $table = 'store_orders';
    protected $primaryKey = 'id';

    protected $fillable =  [''];

    public function user() {
        return $this->belongsTo('App\User', 'customer_id')->select(array('username', 'displayname'));
    }
    public function customer() {
        return $this->belongsTo('App\User');
    }

    public function orderItems() {
        return $this->hasMany('Cartimatic\Store\StoreOrderItems', 'order_id');
    }
    public function orderItemsCount() {
        $items = $this->orderItems();
        return $items;
    }

    public function storeOrderTransaction(){
        return $this->hasOne('Cartimatic\Store\StoreOrderTransaction','order_id');
    }

    public function delivery() {
        return $this->hasOne('Cartimatic\Store\DeliveryCourier','order_id');
    }

    public function transaction() {
        return $this->hasOne('Cartimatic\Store\StoreOrderTransaction','order_id')->orderBy('id', 'DESC');
    }

    public function shop() {
        return $this->belongsTo('Cartimatic\Shop\Http\Models\Shop');
    }
}
