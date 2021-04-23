<?php

namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreDispute extends Model
{

    public function attachments() {
        return $this->hasMany('Cartimatic\Store\RefundRequestAttachment', 'refund_request_id');
    }

    public static function boot() {

        parent::boot();

        StoreDispute::creating(function ($dispute) {
            $dispute->reference_id = random_id(10);
        });
    }

    public static function find($id) {
        return StoreDispute::where('reference_id', $id)->first();
    }

    public function order() {
        return $this->belongsTo('Cartimatic\Store\StoreOrder', 'order_id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'owner_id')->select(array('id', 'displayname'));
    }
}
