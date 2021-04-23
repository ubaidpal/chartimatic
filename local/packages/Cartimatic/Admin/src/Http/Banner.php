<?php

namespace Cartimatic\Admin\Http;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function items() {
       return $this->hasMany('Cartimatic\Admin\Http\Banner', 'parent_id')->where('banner_type','item');
    }

    public function categories() {
       // return $this->hasMany('Cartimatic\Store\Category', 'category_parent_id', 'category_id')->take(4);
        return $this->hasMany('Cartimatic\Store\Category', 'category_parent_id', 'category_id')->orderByRaw("RAND()")->take(500);
    }
}
