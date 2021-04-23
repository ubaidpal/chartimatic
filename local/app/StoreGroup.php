<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreGroup extends Model
{
	use SoftDeletes;
    protected $table = 'store_group';

    protected $fillable = ['name','code' ,'sort_number' , 'comments' ,'category_id' ,'store_id' ];

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];
}
