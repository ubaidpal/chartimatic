<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalenderSeason extends Model
{
	use SoftDeletes;
    protected $table = 'calender_season';

    protected $fillable = [ 'store_id','name' , 'code' , 'sort_number' , 'comments' , 'start_season' , 'end_season'];

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];
}
