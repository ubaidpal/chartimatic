<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreProductCategoryAttributeValues extends Model
{
    protected $table = 'store_product_category_attribute_values';
    protected $primaryKey = 'id';

    protected $fillable =  [''];

}
