<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'store_product_categories';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    public function childCategories() {
        return $this->hasMany('Cartimatic\Store\Category', 'category_parent_id', 'id');
    }

    public function products() {
        return $this->hasMany('Cartimatic\Store\StoreProduct');
    }
}

