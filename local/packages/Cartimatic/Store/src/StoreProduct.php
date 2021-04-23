<?php
namespace Cartimatic\Store;

use Cartimatic\Store\Scopes\IsDraftScope;
use Cartimatic\Store\traits\PublishedTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class StoreProduct extends Model
{
    use SoftDeletes;
    use PublishedTrait;

    protected $table      = 'store_products';
    protected $primaryKey = 'id';

    protected $fillable = [''];
    protected $dates    = ['deleted_at'];

    public function category() {
        return $this->belongsTo('Cartimatic\Store\Category');
    }

    public function attributes() {
        return $this->hasMany('Cartimatic\Store\StoreProductAttribute', 'product_id', 'id');
    }

    public function productKeeping() {
        return $this->hasMany('Cartimatic\Store\StoreProductKeeping', 'product_id', 'id');
    }

    public function owner() {
        return $this->belongsTo('App\User', 'owner_id')->select(['id','email', 'displayname']);
    }
//    public function scopeWithDrafts($query)
//    {
//        return $query->whereIn('is_published', [1, 0]);
//    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsDraftScope);
    }
}
