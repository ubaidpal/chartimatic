<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 10-Aug-16 11:37 AM
 * File Name    : Shop.php
 */

namespace Cartimatic\Shop\Http\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Shop extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = 'shops';

    public function manager() {
        return $this->belongsTo('Cartimatic\Store\Employee', 'manager_id');
    }
}
