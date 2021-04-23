<?php

namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreClaim extends Model
{
    public static function boot() {

        parent::boot();

        StoreClaim::creating(function ($dispute) {
            $dispute->uuid = random_id(10);
        });
    }

    public function dispute() {
        return $this->belongsTo('Cartimatic\Store\StoreDispute', 'owner_id');
    }
    public static function find($id) {
        return StoreClaim::where('uuid', $id)->first();
    }
}
