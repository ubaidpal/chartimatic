<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGender extends Model
{
	use SoftDeletes;
    protected $table = 'product_gender';

    protected $fillable = ['name','code' ,'sort_number' , 'comments' ,'store_id' ];

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];
}
