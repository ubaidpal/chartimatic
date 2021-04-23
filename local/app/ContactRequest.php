<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    public function countryDetail() {
        return $this->belongsTo('App\Country','country');
    }
}
