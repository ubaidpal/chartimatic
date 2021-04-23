<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreOrderTransaction extends Model
{
    protected $table = 'store_order_transactions';
    protected $primaryKey = 'id';

    protected $fillable =  [''];

    public function storeOrder(){
        return $this->belongsTo('Cartimatic\Store\StoreOrder','order_id');
    }

}
