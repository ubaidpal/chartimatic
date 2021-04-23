<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreCategoryAttribute extends Model
{
    protected $table = 'store_category_attributes';
    protected $primaryKey = 'id';

    protected $fillable =  [''];

}
