<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
	use SoftDeletes;
    protected $table = 'store_product_unit';

    protected $fillable = ['name','code' ,'sort_number' , 'comments' ,'store_id' ];

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];
}
