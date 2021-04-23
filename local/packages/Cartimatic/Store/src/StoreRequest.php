<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 01-Sep-16 12:35 PM
 * File Name    : StoreRequest.php
 */

namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class StoreRequest extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
  }
}
