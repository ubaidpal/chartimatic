<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgeGroup extends Model
{
	use SoftDeletes;
    protected $table = 'age_group';

    protected $fillable = ['name','code' ,'sort_number' , 'comments' ,'category_id' ,'store_id' ];

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];
}
