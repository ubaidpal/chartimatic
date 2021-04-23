<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class ProductFavorites extends Model
{
    protected $table = 'store_product_favorites';
    protected $primaryKey = 'favorite_id';

}

