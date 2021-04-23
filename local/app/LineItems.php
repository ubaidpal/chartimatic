<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineItems extends Model
{
	use SoftDeletes;
    protected $table = 'lineItems';

    protected $fillable = [ 'store_id','name' , 'code' , 'sort_number' , 'comments' , 'size_color' , '	one_load_item'];

    protected $primaryKey = 'id';

	protected $dates = ['deleted_at'];
}
