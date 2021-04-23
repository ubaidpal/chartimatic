<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTemplate extends Model
{
	use SoftDeletes;
    protected $table = 'store_product_templates';

    protected $fillable = ['category_id' ,'name' , 'code' , 'sort_number' ,'store_id'];

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];
}
