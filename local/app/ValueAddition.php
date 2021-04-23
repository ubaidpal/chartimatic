<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ValueAddition extends Model
{
	use SoftDeletes;
    protected $table = 'value_addition';

    protected $fillable = ['name','code' ,'sort_number' , 'comments' ,'store_id' ];

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];
}
